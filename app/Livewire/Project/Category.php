<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ProjectCategory;

class Category extends Component
{
    use WithFileUploads;
    public $data = [];

    public function save()
    {
        $this->validate([
            'data.category' => 'required|string|max:255',
            'data.description' => 'nullable|string',
            'data.card_img' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if (isset($this->data['card_img']) && $this->data['card_img']) {
            $imagePath = $this->data['card_img']->store('project-category-images', 'public');
        }

        ProjectCategory::create([
            'category' => $this->data['category'],
            'description' => $this->data['description'],
            'card_img' => $imagePath,
        ]);

        session()->flash('success', 'Project category saved successfully.');

        $this->reset('data'); // clears $data only
    }

    public function render()
    {
        return view('livewire.project.category');
    }
}
