<?php

namespace Tests\Feature;

use App\Livewire\Project\AddProject;
use App\Livewire\Project\ProjectTable;
use App\Models\Client;
use App\Models\Consultant;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectAdminTest extends TestCase
{
    use RefreshDatabase;

    private Client $client;
    private Consultant $consultant;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = Client::create(['name' => 'Ashghal']);
        $this->consultant = Consultant::create(['name' => 'KEO International']);
    }

    private function project(array $overrides = []): Project
    {
        return Project::create(array_merge([
            'title' => 'Tower',
            'status' => 'ongoing',
            'visible' => 1,
            'featured' => 0,
            'description' => '<p>About</p>',
            'card_img' => 'cover.jpg',
            'size' => '1000',
            'client_id' => $this->client->id,
            'consultant_id' => $this->consultant->id,
        ], $overrides));
    }

    public function test_admin_pages_render_for_logged_in_user(): void
    {
        $project = $this->project();
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('admin.list'))->assertOk()->assertSee('Tower');
        $this->actingAs($user)->get(route('admin.project'))->assertOk()->assertSee('Add project');
        $this->actingAs($user)->get(route('admin.project', $project->id))->assertOk()->assertSee('Edit project');
    }

    public function test_list_search_and_filters(): void
    {
        $cat = ProjectCategory::create(['category' => 'Housing', 'description' => 'x', 'card_img' => 'c.jpg']);
        $other = Client::create(['name' => 'Qatar Foundation']);

        $this->project(['title' => 'Lusail Villa', 'project_code' => 'LV-01', 'category_id' => $cat->id]);
        $this->project(['title' => 'Doha Mall', 'status' => 'completed', 'client_id' => $other->id, 'featured' => 1]);
        $this->project(['title' => 'Hidden Depot', 'visible' => 0, 'client_id' => null]);

        Livewire::test(ProjectTable::class)
            ->assertSee('Lusail Villa')->assertSee('Doha Mall')->assertSee('Hidden Depot')
            ->set('search', 'LV-01')->assertSee('Lusail Villa')->assertDontSee('Doha Mall')
            ->set('search', 'qatar found')->assertSee('Doha Mall')->assertDontSee('Lusail Villa')
            ->call('resetFilters')
            ->set('status', 'completed')->assertSee('Doha Mall')->assertDontSee('Lusail Villa')
            ->call('resetFilters')
            ->set('category', $cat->id)->assertSee('Lusail Villa')->assertDontSee('Doha Mall')
            ->call('resetFilters')
            ->set('visibility', 'hidden')->assertSee('Hidden Depot')->assertDontSee('Lusail Villa')
            ->set('visibility', 'featured')->assertSee('Doha Mall')->assertDontSee('Hidden Depot')
            ->set('visibility', 'incomplete')->assertSee('Hidden Depot')->assertDontSee('Doha Mall')
            ->call('resetFilters')
            ->set('client', 'none')->assertSee('Hidden Depot')->assertDontSee('Lusail Villa')
            ->call('resetFilters')
            ->set('view', 'table')->assertSee('Lusail Villa');
    }

    public function test_toggle_and_delete_from_list(): void
    {
        $project = $this->project();

        Livewire::test(ProjectTable::class)->call('toggle', $project->id, 'visible');
        $this->assertFalse((bool) $project->refresh()->visible);

        Livewire::test(ProjectTable::class)->call('toggle', $project->id, 'featured');
        $this->assertTrue((bool) $project->refresh()->featured);

        $project->images()->create(['image_path' => 'g1.jpg', 'position' => 1]);
        Livewire::test(ProjectTable::class)->call('delete', $project->id);
        $this->assertModelMissing($project);
        $this->assertDatabaseCount('project_images', 0);
    }

    public function test_create_project_requires_client_consultant_and_size(): void
    {
        Livewire::test(AddProject::class)
            ->set('data.title', 'New Tower')
            ->set('data.description', '<p>Desc</p>')
            ->call('save')
            ->assertHasErrors(['data.client_id', 'data.consultant_id', 'data.size', 'card_img']);

        $this->assertSame(0, Project::count());
    }

    public function test_create_project_with_uploads_and_empty_optional_fields(): void
    {
        Storage::fake('public');

        Livewire::test(AddProject::class)
            ->set('data.title', 'New Tower')
            ->set('data.client_id', $this->client->id)
            ->set('data.consultant_id', $this->consultant->id)
            ->set('data.size', '25000')
            ->set('data.category_id', '')
            ->set('data.completed_year', '')
            ->set('data.duration', '')
            ->set('data.description', '<p>Desc</p>')
            ->set('card_img', UploadedFile::fake()->image('cover.jpg'))
            ->set('newgallery', [UploadedFile::fake()->image('a.jpg'), UploadedFile::fake()->image('b.jpg')])
            ->call('save')
            ->assertHasNoErrors()
            ->assertRedirect(route('admin.list'));

        $project = Project::sole();
        $this->assertSame('new-tower', $project->slug);
        $this->assertNull($project->category_id);
        $this->assertNull($project->completed_year);
        $this->assertSame([1, 2], $project->images()->pluck('position')->all());
        Storage::disk('public')->assertExists($project->card_img);
    }

    public function test_edit_reorders_removes_and_appends_gallery(): void
    {
        Storage::fake('public');
        $project = $this->project();
        $a = $project->images()->create(['image_path' => 'a.jpg', 'position' => 1]);
        $b = $project->images()->create(['image_path' => 'b.jpg', 'position' => 2]);
        $c = $project->images()->create(['image_path' => 'c.jpg', 'position' => 3]);

        Livewire::test(AddProject::class, ['id' => $project->id])
            ->call('moveImage', 2, -1)      // a, c, b
            ->call('removeOldImage', 0)     // c, b
            ->set('newgallery', [UploadedFile::fake()->image('d.jpg')])
            ->set('data.title', 'Tower Updated')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertModelMissing($a);
        $this->assertSame(1, $c->refresh()->position);
        $this->assertSame(2, $b->refresh()->position);
        $this->assertSame(3, $project->images()->reorder()->latest('id')->first()->position);
        $this->assertSame('Tower Updated', $project->refresh()->title);
    }

    public function test_switches_load_and_save_as_booleans(): void
    {
        $project = $this->project(['visible' => 1, 'featured' => 1]);

        Livewire::test(AddProject::class, ['id' => $project->id])
            ->assertSet('data.visible', true)
            ->assertSet('data.featured', true)
            ->set('data.visible', false)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertFalse((bool) $project->refresh()->visible);
        $this->assertTrue((bool) $project->featured);
    }

    public function test_delete_from_edit_page(): void
    {
        $project = $this->project();

        Livewire::test(AddProject::class, ['id' => $project->id])
            ->call('deleteProject')
            ->assertRedirect(route('admin.list'));

        $this->assertModelMissing($project);
    }
}
