<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Category extends Component
{
    use WithFileUploads;

    public $table_id;
    public $data = ['category' => '', 'description' => '', 'card_img' => null];
    public $card_img;
    public $search = '';

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        }
    }

    protected function rules()
    {
        return [
            'data.category' => 'required|string|max:255|unique:project_categories,category' . ($this->table_id ? ',' . $this->table_id : ''),
            'data.description' => 'required|string|max:2000',
            'card_img' => ($this->table_id ? 'nullable' : 'required') . '|image|max:10240',
        ];
    }

    protected $messages = [
        'data.category.required' => 'Enter the category name.',
        'data.category.unique' => 'A category with this name already exists.',
        'data.description.required' => 'Enter a short description.',
        'card_img.required' => 'Upload a cover image.',
        'card_img.image' => 'The cover must be an image.',
        'card_img.max' => 'The cover image must be smaller than 10 MB.',
    ];

    public function updatedCardImg()
    {
        $this->validateOnly('card_img');
    }

    public function edit($id)
    {
        $category = ProjectCategory::findOrFail($id);

        $this->table_id = $category->id;
        $this->data = $category->only(['category', 'description', 'card_img']);
        $this->card_img = null;
        $this->resetValidation();
        $this->dispatch('category-form-focus');
    }

    public function resetForm()
    {
        $this->reset(['table_id', 'data', 'card_img']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->data['category'] = trim($this->data['category'] ?? '');
        $this->validate();

        $attributes = [
            'category' => $this->data['category'],
            'description' => $this->data['description'],
        ];

        if ($this->card_img) {
            $attributes['card_img'] = $this->card_img->store('project-category-images', 'public');
        }

        if ($this->table_id) {
            $category = ProjectCategory::findOrFail($this->table_id);
            $oldImage = $category->card_img;
            $category->update($attributes);

            if (isset($attributes['card_img']) && $oldImage && $oldImage !== $attributes['card_img']) {
                Storage::disk('public')->delete($oldImage);
            }
            session()->flash('success', "“{$category->category}” was updated.");
        } else {
            $category = ProjectCategory::create($attributes);
            session()->flash('success', "“{$category->category}” was created.");
        }

        $this->resetForm();
    }

    public function delete($id)
    {
        $category = ProjectCategory::withCount('projects')->findOrFail($id);
        $name = $category->category;
        $moved = $category->projects_count;

        // Projects are kept: the foreign key sets their category to NULL.
        Project::where('category_id', $category->id)->update(['category_id' => null]);
        $category->delete();

        if ($category->card_img) {
            Storage::disk('public')->delete($category->card_img);
        }
        if ((int) $this->table_id === (int) $id) {
            $this->resetForm();
        }

        session()->flash('success', "“{$name}” was deleted." . ($moved ? " {$moved} " . str('project')->plural($moved) . ' now have no category.' : ''));
    }

    public function render()
    {
        $term = trim($this->search);

        return view('livewire.project.category', [
            'categories' => ProjectCategory::query()
                ->withCount([
                    'projects',
                    'projects as ongoing_count' => fn ($q) => $q->ongoing(),
                    'projects as delivered_count' => fn ($q) => $q->delivered(),
                ])
                ->when($term !== '', fn ($q) => $q->where('category', 'like', "%{$term}%"))
                ->orderBy('category')
                ->get(),
            'uncategorised' => Project::whereNull('category_id')->count(),
        ]);
    }
}
