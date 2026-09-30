<?php

namespace Tests\Feature;

use App\Livewire\Project\AddProject;
use App\Models\Client;
use App\Models\Consultant;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PublicProjectListingTest extends TestCase
{
    use RefreshDatabase;

    private ProjectCategory $housing;
    private ProjectCategory $health;

    protected function setUp(): void
    {
        parent::setUp();

        $this->housing = ProjectCategory::create(['category' => 'Housing', 'description' => 'Homes', 'card_img' => 'h.jpg']);
        $this->health = ProjectCategory::create(['category' => 'Healthcare', 'description' => 'Clinics', 'card_img' => 'c.jpg']);

        $this->make('Villa Ongoing', 'ongoing', $this->housing);
        $this->make('Villa Delivered', 'completed', $this->housing);
        $this->make('Clinic Ongoing', 'ongoing', $this->health);
        $this->make('Uncategorised Delivered', 'completed', null);
    }

    private function make(string $title, string $status, ?ProjectCategory $category): Project
    {
        return Project::create([
            'title' => $title, 'status' => $status, 'category_id' => $category?->id,
            'visible' => 1, 'featured' => 0, 'description' => 'x', 'card_img' => 'x.jpg', 'size' => '100',
        ]);
    }

    public function test_all_projects(): void
    {
        $this->get(route('projects'))->assertOk()
            ->assertSee('Villa Ongoing')->assertSee('Villa Delivered')
            ->assertSee('Clinic Ongoing')->assertSee('Uncategorised Delivered');
    }

    public function test_ongoing_is_a_filter_not_a_category(): void
    {
        // Ongoing across all categories (old URL keeps working)
        $this->get(route('ongoingProjects'))->assertOk()
            ->assertSee('Villa Ongoing')->assertSee('Clinic Ongoing')
            ->assertDontSee('Villa Delivered')->assertDontSee('Uncategorised Delivered');

        // Delivered across all categories
        $this->get(route('projects', ['status' => 'delivered']))->assertOk()
            ->assertSee('Villa Delivered')->assertSee('Uncategorised Delivered')
            ->assertDontSee('Villa Ongoing')->assertDontSee('Clinic Ongoing');
    }

    public function test_category_combined_with_ongoing_flag(): void
    {
        $this->get(route('listprojects', $this->housing->id))->assertOk()
            ->assertSee('Villa Ongoing')->assertSee('Villa Delivered')->assertDontSee('Clinic Ongoing');

        $this->get(route('listprojects', ['cat' => $this->housing->id, 'status' => 'ongoing']))->assertOk()
            ->assertSee('Villa Ongoing')->assertDontSee('Villa Delivered')->assertDontSee('Clinic Ongoing');

        $this->get(route('listprojects', ['cat' => $this->housing->id, 'status' => 'delivered']))->assertOk()
            ->assertSee('Villa Delivered')->assertDontSee('Villa Ongoing');

        $this->get(route('listprojects', ['cat' => $this->health->id, 'status' => 'delivered']))->assertOk()
            ->assertSee('No delivered projects in Healthcare yet.');
    }

    public function test_invalid_status_is_ignored_and_unknown_category_404s(): void
    {
        $this->get(route('projects', ['status' => 'banana']))->assertOk()->assertSee('Villa Ongoing')->assertSee('Villa Delivered');
        $this->get(route('listprojects', 999))->assertNotFound();
    }

    public function test_old_ongoing_detail_url_redirects_to_single_project_page(): void
    {
        $project = Project::where('title', 'Villa Ongoing')->first();

        $this->get(route('ongoingdetails', $project->id))
            ->assertStatus(301)
            ->assertRedirect(route('detailprojects', $project->id));

        $this->get(route('detailprojects', $project->id))->assertOk()
            ->assertSee('Under Construction')
            ->assertSee('Villa Delivered'); // neighbour / related from the same category
    }

    public function test_admin_ongoing_switch_sets_status(): void
    {
        $project = Project::where('title', 'Villa Ongoing')->first();
        $project->update([
            'client_id' => Client::create(['name' => 'C'])->id,
            'consultant_id' => Consultant::create(['name' => 'K'])->id,
        ]);

        Livewire::test(AddProject::class, ['id' => $project->id])
            ->assertSet('ongoing', true)
            ->set('ongoing', false)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertFalse($project->refresh()->is_ongoing);
        $this->assertSame('completed', $project->status);
    }
}
