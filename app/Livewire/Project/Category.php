<?php

namespace App\Livewire\Project;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Category extends Component
{
    use WithFileUploads;
    public $data = [];
    public $table_id;


    public function save()
    {
        $rules = [
            'data.category' => 'required|string|max:255',
            'data.description' => 'required|string',
            // We'll still validate as image, but handle failure manually
            'data.card_img' => 'nullable|max:5120',
        ];

        $this->validate($rules, [
            'data.description.required' => 'Enter the project description',
            'data.card_img.max' => 'Upload img with smaller size',
        ]);

        DB::beginTransaction();

        try {
            $imagePath = null;

            // Check if image is an uploaded file (not a string path)
            if (isset($this->data['card_img']) && is_object($this->data['card_img']) && method_exists($this->data['card_img'], 'store')) {
                $imagePath = $this->data['card_img']->store('project-category-images', 'public');
            }

            if ($this->table_id) {
                // Update existing
                $category = ProjectCategory::findOrFail($this->table_id);
                $category->category = $this->data['category'];
                $category->description = $this->data['description'];

                if ($imagePath) {
                    // Delete old image
                    if (!empty($category->card_img) && Storage::disk('public')->exists($category->card_img)) {
                        Storage::disk('public')->delete($category->card_img);
                    }
                    $category->card_img = $imagePath;
                }

                $category->save();
                session()->flash('success', 'Project category updated successfully.');
            } else {
                // Create new
                ProjectCategory::create([
                    'category' => $this->data['category'],
                    'description' => $this->data['description'],
                    'card_img' => $imagePath,
                ]);

                $this->reset('data');
                session()->flash('success', 'Project category saved successfully.');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Warning: ' . $e->getMessage());
        }
    }

    public function mount($id = null)
    {
        $this->table_id = $id;
        if ($this->table_id) {
            $this->data = ProjectCategory::findorfail($this->table_id)->toArray();
        }
    }
    public function render()
    {
        return view('livewire.project.category');
    }
}
