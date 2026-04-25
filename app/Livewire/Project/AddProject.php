<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddProject extends Component
{
    use WithFileUploads;

    public $projectId, $card_img;
    public $data = [];
    public $gallery = [];
    public $newgallery = [];
    public $deletedImages = [];


    public function mount($id = null)
    {
        if ($id) {
            $project = Project::with('images')->findOrFail($id);
            $this->projectId = $id;
            $this->data = $project->toArray();
            $this->gallery = $project->images->toArray();
        } else {
            // Set defaults for new form
            $this->data['status'] = 'ongoing';
            $this->data['card_img'] = null;
            $this->data['visible'] = 1;
            $this->data['featured'] = 1;
        }
    }
    public function cardImage() {}

    public function removeOldImage($index)
    {
        if (isset($this->gallery[$index])) {

            // store id for delete on save
            if (isset($this->gallery[$index]['id'])) {
                $this->deletedImages[] = $this->gallery[$index]['id'];
            }

            unset($this->gallery[$index]);

            // reindex array
            $this->gallery = array_values($this->gallery);
        }
    }

    /**
     * Remove newly uploaded image preview
     */
    public function removeNewImage($index)
    {
        if (isset($this->newgallery[$index])) {

            unset($this->newgallery[$index]);

            // reindex array
            $this->newgallery = array_values($this->newgallery);
        }
    }

    public function save()
    {
        DB::beginTransaction();

        try {
            $this->validate([
                'data.title' => 'required|string|max:255',
                'data.category_id' => 'nullable|exists:project_categories,id',
                'data.location' => 'nullable|string|max:255',
                'data.status' => 'required|in:completed,ongoing',
                'data.visible' => 'required|boolean',
                'data.description' => 'required|string',
                'card_img' => $this->projectId ? 'nullable' : 'required|image',
                'data.featured' => 'required|boolean',
                'data.size' => 'nullable|string|max:255',
                'newgallery.*' => 'required|image|max:30480'
            ], [
                'data.title.required' => 'The project title is required.',
                'data.category_id.required' => 'Please select a project category.',
                'data.category_id.exists' => 'The selected category is invalid.',
                'data.status.in' => 'Status must be either "completed" or "ongoing".',
                'data.card_img.required' => 'Please upload a card image.',
                'data.description.required' => 'A project description is required.',
                'data.visible.required' => 'Please specify whether the project should be visible.',
                'data.featured.required' => 'Please indicate if the project is featured.',
                'gallery.max' => 'Galley Upload maximum size reached'
            ]);

            if ($this->card_img) {
                $url = $this->card_img->store('project-galley', 'public');
                $this->data['card_img'] = $url;
            }
            if ($this->data['category_id'] === '') {
                $this->data['category_id'] = null;
            }

            // Insert or update the project
            $project = Project::updateOrCreate(
                ['id' => $this->projectId],
                $this->data
            );
            if (!empty($this->deletedImages)) {
                $project->images()
                    ->whereIn('id', $this->deletedImages)
                    ->delete();
            }
            if (!empty($this->newgallery)) {
                foreach ($this->newgallery as $index => $file) {

                    $path = $file->store('project-gallery', 'public');

                    $project->images()->create([
                        'image_path' => $path,
                        'position' => $index + 1
                    ]);
                }
            }



            DB::commit();

            session()->flash('success', $this->projectId ? 'Project updated successfully.' : 'Project created successfully.');
            $this->reset(['data', 'projectId', 'gallery']);
            $this->mount();
            $this->redirect(route('admin.project'));
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
