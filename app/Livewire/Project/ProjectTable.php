<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;

class ProjectTable extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::with('category')->latest()->get();
    }
    public function render()
    {
        return view('livewire.project.project-table');
    }
}
