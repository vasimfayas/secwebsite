<?php

namespace App\Livewire\Career;

use App\Models\Career;
use Livewire\Component;

class Jobs extends Component
{
    public $jobs;
    public function mount()
    {
        $this->jobs = Career::all();
    }
    public function render()
    {
        return view('livewire.career.jobs');
    }
}
