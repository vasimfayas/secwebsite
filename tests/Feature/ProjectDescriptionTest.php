<?php

namespace Tests\Feature;

use App\Livewire\Project\AddProject;
use App\Models\Client;
use App\Models\Consultant;
use App\Models\Project;
use App\Support\RichText;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectDescriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_keeps_editor_formatting(): void
    {
        $html = '<h2>Scope</h2><p style="text-align: center; padding-left: 40px;"><strong>Bold</strong> <em>it</em> <u>u</u></p>'
            . '<ul><li>One<ul><li>Nested</li></ul></li></ul><ol style="list-style-type: lower-roman;"><li>First</li></ol>';

        $clean = RichText::sanitize($html);

        $this->assertStringContainsString('<h2>Scope</h2>', $clean);
        $this->assertStringContainsString('<strong>Bold</strong>', $clean);
        $this->assertStringContainsString('<ul><li>One<ul><li>Nested</li></ul></li></ul>', $clean);
        $this->assertStringContainsString('text-align: center; padding-left: 40px', $clean);
        $this->assertStringContainsString('list-style-type: lower-roman', $clean);
    }

    public function test_strips_dangerous_markup(): void
    {
        $clean = RichText::sanitize(
            '<p onclick="alert(1)" style="position: fixed; background: url(javascript:x)">Hi</p>'
            . '<script>alert(1)</script><img src=x onerror=alert(1)><a href="javascript:alert(1)">x</a>'
            . '<iframe src="https://evil.test"></iframe><div><b>kept</b></div>'
        );

        $this->assertStringNotContainsString('onclick', $clean);
        $this->assertStringNotContainsString('script', $clean);
        $this->assertStringNotContainsString('onerror', $clean);
        $this->assertStringNotContainsString('javascript', $clean);
        $this->assertStringNotContainsString('iframe', $clean);
        $this->assertStringNotContainsString('position', $clean);
        $this->assertStringContainsString('<p>Hi</p>', $clean);
        $this->assertStringContainsString('<b>kept</b>', $clean);
    }

    public function test_legacy_plain_text_keeps_line_breaks_and_is_escaped(): void
    {
        $this->assertSame("Line 1<br>\nA &amp; B &lt;x&gt;", RichText::toHtml("Line 1\nA & B <x>"));
    }

    public function test_plain_text_excerpt(): void
    {
        $this->assertSame('Title First item Second & more', RichText::toText('<h2>Title</h2><ul><li>First item</li><li>Second &amp; more</li></ul>'));
    }

    public function test_admin_save_sanitizes_description(): void
    {
        $project = Project::create([
            'title' => 'Tower', 'status' => 'ongoing', 'visible' => 1, 'featured' => 1,
            'description' => 'old', 'card_img' => 'x.jpg', 'size' => '1000',
            'client_id' => Client::create(['name' => 'C'])->id,
            'consultant_id' => Consultant::create(['name' => 'K'])->id,
        ]);

        Livewire::test(AddProject::class, ['id' => $project->id])
            ->set('data.description', '<p><strong>New</strong></p><script>alert(1)</script>')
            ->call('save');

        $this->assertSame('<p><strong>New</strong></p>', $project->refresh()->description);
    }

    public function test_empty_editor_is_rejected(): void
    {
        $project = Project::create([
            'title' => 'Tower', 'status' => 'ongoing', 'visible' => 1, 'featured' => 1,
            'description' => 'old', 'card_img' => 'x.jpg', 'size' => '1000',
            'client_id' => Client::create(['name' => 'C'])->id,
            'consultant_id' => Consultant::create(['name' => 'K'])->id,
        ]);

        Livewire::test(AddProject::class, ['id' => $project->id])
            ->set('data.description', '<p>&nbsp;</p>')
            ->call('save');

        $this->assertSame('old', $project->refresh()->description);
    }

    public function test_detail_page_renders_formatting(): void
    {
        $project = Project::create([
            'title' => 'Tower', 'status' => 'ongoing', 'visible' => 1, 'featured' => 1, 'card_img' => 'x.jpg',
            'description' => '<p>Intro</p><ol><li>Step <strong>one</strong></li></ol>',
        ]);

        $this->get(route('detailprojects', $project->id))
            ->assertOk()
            ->assertSee('<ol><li>Step <strong>one</strong></li></ol>', false);
    }
}
