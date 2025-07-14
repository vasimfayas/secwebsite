<?php

namespace App\Livewire\Project;

use App\Models\ProjectCategory;
use Livewire\Component;

class DisplayCat extends Component
{
    public $categories;
    public function mount()
    {
        $this->categories = ProjectCategory::get();
    }
    public function render()
    {
        return view('livewire.project.display-cat');
    }
}
