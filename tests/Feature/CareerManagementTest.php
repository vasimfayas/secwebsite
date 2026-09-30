<?php

namespace Tests\Feature;

use App\Livewire\Career\Form;
use App\Models\Career;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CareerManagementTest extends TestCase
{
    use RefreshDatabase;

    private function job(array $overrides = []): Career
    {
        return Career::create(array_merge([
            'title' => 'Site Engineer',
            'desc' => "Line one\nLine two",
            'experience' => '1-5 years',
            'period' => 'full-time',
            'location' => 'Doha',
            'is_active' => true,
            'deadline' => null,
        ], $overrides));
    }

    public function test_admin_jobs_page_requires_login(): void
    {
        $this->get(route('admin.career'))->assertRedirect();
    }

    public function test_admin_jobs_page_renders(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('admin.career'))
            ->assertOk()
            ->assertSee('Add a new job');
    }

    public function test_create_job(): void
    {
        Livewire::test(Form::class)
            ->set('career.title', 'Quantity Surveyor')
            ->set('career.desc', 'Prepare BOQs')
            ->set('career.experience', '5 years+')
            ->call('submit')
            ->assertHasNoErrors();

        $job = Career::sole();
        $this->assertSame('Quantity Surveyor', $job->title);
        $this->assertSame('Doha', $job->location);
        $this->assertTrue($job->is_active);
        $this->assertNull($job->deadline);
    }

    public function test_create_job_validates_required_fields(): void
    {
        Livewire::test(Form::class)
            ->set('career.title', '')
            ->call('submit')
            ->assertHasErrors(['career.title', 'career.desc', 'career.experience']);

        $this->assertSame(0, Career::count());
    }

    public function test_edit_and_update_job(): void
    {
        $job = $this->job();

        Livewire::test(Form::class)
            ->call('edit', $job->id)
            ->assertSet('career.title', 'Site Engineer')
            ->set('career.title', 'Senior Site Engineer')
            ->set('career.deadline', '2099-01-31')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('careerId', null);

        $job->refresh();
        $this->assertSame('Senior Site Engineer', $job->title);
        $this->assertSame('2099-01-31', $job->deadline->format('Y-m-d'));
        $this->assertSame(1, Career::count());
    }

    public function test_toggle_and_delete_job(): void
    {
        $job = $this->job();

        Livewire::test(Form::class)->call('toggleActive', $job->id);
        $this->assertFalse($job->refresh()->is_active);

        Livewire::test(Form::class)->call('delete', $job->id);
        $this->assertModelMissing($job);
    }

    public function test_careers_page_only_lists_open_jobs(): void
    {
        $this->job(['title' => 'Open No Deadline']);
        $this->job(['title' => 'Open Future Deadline', 'deadline' => now()->addWeek()]);
        $this->job(['title' => 'Closes Today', 'deadline' => today()]);
        $this->job(['title' => 'Hidden Inactive', 'is_active' => false]);
        $this->job(['title' => 'Hidden Expired', 'deadline' => now()->subDay()]);

        $this->get(route('careers'))
            ->assertOk()
            ->assertSee('Open No Deadline')
            ->assertSee('Open Future Deadline')
            ->assertSee('Closes Today')
            ->assertDontSee('Hidden Inactive')
            ->assertDontSee('Hidden Expired')
            ->assertSee('Line one<br />', false);
    }
}
