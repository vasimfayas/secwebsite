<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddProject extends Component
{
    use WithFileUploads;

    public $projectId;
    public $data = [];

    public function mount($id = null)
    {
        if ($id) {
            $project = Project::findOrFail($id);
            $this->projectId = $id;
            $this->data = $project->toArray();
        } else {
            // Set defaults for new form
            $this->data['status'] = 'ongoing';
            $this->data['visible'] = 1;
            $this->data['featured'] = 1;
        }
    }


    public function save()
    {
        DB::beginTransaction();

        try {
            $this->validate([
                'data.title' => 'required|string|max:255',
                'data.category_id' => 'required|exists:project_categories,id',
                'data.location' => 'nullable|string|max:255',
                'data.status' => 'required|in:completed,ongoing',
                'data.visible' => 'required|boolean',
                'data.description' => 'required|string',
                'data.card_img' => $this->projectId ? 'nullable' : 'required',
                'data.featured' => 'required|boolean',
                'data.size' => 'nullable|string|max:255',
            ], [
                'data.title.required' => 'The project title is required.',
                'data.category_id.required' => 'Please select a project category.',
                'data.category_id.exists' => 'The selected category is invalid.',
                'data.status.in' => 'Status must be either "completed" or "ongoing".',
                'data.card_img.required' => 'Please upload a card image.',
                'data.description.required' => 'A project description is required.',
                'data.visible.required' => 'Please specify whether the project should be visible.',
                'data.featured.required' => 'Please indicate if the project is featured.',
            ]);

            // Handle image upload if file was submitted
            if (isset($this->data['card_img']) && is_object($this->data['card_img'])) {
                $this->data['card_img'] = $this->data['card_img']->store('project-images', 'public');
            }

            // Insert or update the project
            Project::updateOrCreate(
                ['id' => $this->projectId],
                $this->data
            );

            DB::commit();

            session()->flash('success', $this->projectId ? 'Project updated successfully.' : 'Project created successfully.');
            $this->reset(['data', 'projectId']);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Warning: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.project.add-project', [
            'categories' => ProjectCategory::all()
        ]);
    }
}
