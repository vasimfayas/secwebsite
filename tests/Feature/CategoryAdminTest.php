<?php

namespace Tests\Feature;

use App\Livewire\Project\Category;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryAdminTest extends TestCase
{
    use RefreshDatabase;

    private function category(string $name = 'Housing', array $extra = []): ProjectCategory
    {
        return ProjectCategory::create(array_merge(['category' => $name, 'description' => 'Homes', 'card_img' => 'old.jpg'], $extra));
    }

    public function test_page_renders_and_lists_categories_with_counts(): void
    {
        $cat = $this->category();
        Project::create(['title' => 'A', 'status' => 'ongoing', 'category_id' => $cat->id, 'visible' => 1, 'featured' => 0, 'description' => 'x', 'card_img' => 'a.jpg']);
        Project::create(['title' => 'B', 'status' => 'completed', 'category_id' => $cat->id, 'visible' => 1, 'featured' => 0, 'description' => 'x', 'card_img' => 'b.jpg']);

        $this->actingAs(User::factory()->create())
            ->get(route('admin.category'))
            ->assertOk()
            ->assertSee('Housing')
            ->assertSee('1 ongoing')
            ->assertSee('1 delivered');
    }

    public function test_create_requires_name_description_and_image(): void
    {
        Livewire::test(Category::class)
            ->call('save')
            ->assertHasErrors(['data.category', 'data.description', 'card_img']);
    }

    public function test_create_and_unique_name(): void
    {
        Storage::fake('public');

        Livewire::test(Category::class)
            ->set('data.category', '  Healthcare ')
            ->set('data.description', 'Clinics')
            ->set('card_img', UploadedFile::fake()->image('c.jpg', 1600, 900))
            ->call('save')
            ->assertHasNoErrors()
            ->assertSet('table_id', null);

        $cat = ProjectCategory::sole();
        $this->assertSame('Healthcare', $cat->category);
        Storage::disk('public')->assertExists($cat->card_img);

        Livewire::test(Category::class)
            ->set('data.category', 'Healthcare')
            ->set('data.description', 'Dup')
            ->set('card_img', UploadedFile::fake()->image('d.jpg'))
            ->call('save')
            ->assertHasErrors(['data.category' => 'unique']);
    }

    public function test_edit_keeps_image_when_not_replaced_and_swaps_it_when_replaced(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('old.jpg', 'x');
        $cat = $this->category();

        Livewire::test(Category::class, ['id' => $cat->id])
            ->assertSet('data.category', 'Housing')
            ->set('data.category', 'Residential')
            ->call('save')
            ->assertHasNoErrors();
        $this->assertSame(['Residential', 'old.jpg'], [$cat->refresh()->category, $cat->card_img]);

        Livewire::test(Category::class)
            ->call('edit', $cat->id)
            ->set('card_img', UploadedFile::fake()->image('new.jpg'))
            ->call('save')
            ->assertHasNoErrors();
        $this->assertNotSame('old.jpg', $cat->refresh()->card_img);
        Storage::disk('public')->assertMissing('old.jpg');
    }

    public function test_delete_keeps_projects_without_category(): void
    {
        $cat = $this->category();
        $project = Project::create(['title' => 'A', 'status' => 'ongoing', 'category_id' => $cat->id, 'visible' => 1, 'featured' => 0, 'description' => 'x', 'card_img' => 'a.jpg']);

        Livewire::test(Category::class)->call('delete', $cat->id);

        $this->assertModelMissing($cat);
        $this->assertNull($project->refresh()->category_id);
    }

    public function test_public_sector_dropdown_lists_many_categories(): void
    {
        foreach (range(1, 12) as $i) {
            $this->category("Sector {$i}");
        }

        $this->get(route('ongoingProjects'))
            ->assertOk()
            ->assertSee('Sector:')
            ->assertSee('Search sectors…')
            ->assertSee('Sector 12');
    }
}
