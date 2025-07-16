<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\DB;

class Category extends Component
{
    use WithFileUploads;
    public $data = [];

    public function save()
    {
        $this->validate([
            'data.category' => 'required|string|max:255',
            'data.description' => 'required|string',
            'data.card_img' => 'nullable|image|max:5120',
        ], [
            'data.description.required' => 'Enter the project description',
            'data.card_img.max' => 'Upload img with smaller size'
        ]);

        DB::beginTransaction();

        try {
            $imagePath = null;

            if (isset($this->data['card_img']) && $this->data['card_img']) {
                $imagePath = $this->data['card_img']->store('project-category-images', 'public');
            }

            ProjectCategory::create([
                'category' => $this->data['category'],
                'description' => $this->data['description'],
                'card_img' => $imagePath,
            ]);

            DB::commit();

            session()->flash('success', 'Project category saved successfully.');
            $this->reset('data'); // resets the form

        } catch (\Exception $e) {
            DB::rollBack();



            session()->flash('error', 'Warning: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.project.category');
    }
}
