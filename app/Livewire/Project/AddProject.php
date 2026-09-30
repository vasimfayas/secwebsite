<?php

namespace App\Livewire\Project;

use App\Models\Client;
use App\Models\Consultant;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Support\RichText;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
    public $clients = [];
    public $consultants = [];

    /** "Ongoing" yes/no switch; stored in the `status` column (ongoing | completed). */
    public bool $ongoing = true;

    public function updatedDataTitle($value)
    {
        $this->data['slug'] = Str::slug($value);
    }

    public function mount($id = null)
    {
        if ($id) {
            $project = Project::with('images')->findOrFail($id);
            $this->projectId = $project->id;
            $this->data = $project->only((new Project)->getFillable());
            // Checkbox switches bind to real booleans (the DB returns 1/0).
            $this->data['visible'] = (bool) $project->visible;
            $this->data['featured'] = (bool) $project->featured;
            $this->gallery = $project->images->map->only(['id', 'image_path', 'position'])->all();
        } else {
            $this->data = [
                'title' => '',
                'slug' => '',
                'project_code' => null,
                'category_id' => null,
                'client_id' => null,
                'consultant_id' => null,
                'location' => '',
                'size' => '',
                'status' => 'ongoing',
                'completed_year' => null,
                'duration' => null,
                'sequence' => null,
                'visible' => true,
                'featured' => true,
                'description' => '',
                'card_img' => null,
            ];
        }

        $this->ongoing = ($this->data['status'] ?? Project::STATUS_ONGOING) === Project::STATUS_ONGOING;

        $this->clients = Client::orderBy('name')->get(['id', 'name']);
        $this->consultants = Consultant::orderBy('name')->get(['id', 'name']);
    }

    protected function rules()
    {
        return [
            'data.title' => 'required|string|max:255',
            'data.project_code' => 'nullable|string|max:100',
            'data.category_id' => 'nullable|exists:project_categories,id',
            'data.client_id' => 'required|exists:clients,id',
            'data.consultant_id' => 'required|exists:consultants,id',
            'data.location' => 'nullable|string|max:255',
            'data.size' => 'required|string|max:255',
            'data.status' => 'required|in:completed,ongoing',
            'data.completed_year' => 'nullable|integer|between:1950,' . (date('Y') + 5),
            'data.duration' => 'nullable|integer|min:1|max:100000',
            'data.sequence' => 'nullable|integer|min:0',
            'data.visible' => 'required|boolean',
            'data.featured' => 'required|boolean',
            'data.description' => 'required|string',
            'card_img' => ($this->projectId ? 'nullable' : 'required') . '|image|max:10240',
            'newgallery.*' => 'image|max:30480',
        ];
    }

    protected $messages = [
        'data.client_id.required' => 'Please select the client.',
        'data.consultant_id.required' => 'Please select the consultant.',
        'data.size.required' => 'Please enter the project size.',
        'data.description.required' => 'A project description is required.',
        'card_img.required' => 'Please upload a cover image.',
        'newgallery.*.image' => 'Gallery files must be images.',
        'newgallery.*.max' => 'Each gallery image must be smaller than 30 MB.',
    ];

    protected $validationAttributes = [
        'data.title' => 'title',
        'data.project_code' => 'code',
        'data.category_id' => 'category',
        'data.location' => 'location',
        'data.completed_year' => 'completed year',
        'data.duration' => 'duration',
        'data.sequence' => 'sequence',
        'card_img' => 'cover image',
    ];

    public function updatedOngoing($value)
    {
        $this->data['status'] = $value ? Project::STATUS_ONGOING : Project::STATUS_DELIVERED;
    }

    public function updatedCardImg()
    {
        $this->validateOnly('card_img');
    }

    public function updatedNewgallery()
    {
        $this->validateOnly('newgallery.*');
    }

    public function removeOldImage($index)
    {
        if (isset($this->gallery[$index])) {
            $this->deletedImages[] = $this->gallery[$index]['id'];
            unset($this->gallery[$index]);
            $this->gallery = array_values($this->gallery);
        }
    }

    public function removeNewImage($index)
    {
        if (isset($this->newgallery[$index])) {
            unset($this->newgallery[$index]);
            $this->newgallery = array_values($this->newgallery);
        }
    }

    /** Move an existing gallery image one step left (-1) or right (+1). */
    public function moveImage($index, $direction)
    {
        $target = $index + $direction;
        if (isset($this->gallery[$index], $this->gallery[$target])) {
            [$this->gallery[$index], $this->gallery[$target]] = [$this->gallery[$target], $this->gallery[$index]];
        }
    }

    public function save()
    {
        $this->data['status'] = $this->ongoing ? Project::STATUS_ONGOING : Project::STATUS_DELIVERED;

        // Empty selects / inputs become NULL (foreign keys and integer columns reject '').
        foreach (['category_id', 'client_id', 'consultant_id', 'completed_year', 'duration', 'sequence', 'project_code'] as $key) {
            if (($this->data[$key] ?? null) === '') {
                $this->data[$key] = null;
            }
        }

        // Rich text from the editor: keep only safe formatting; treat an empty editor as empty.
        $description = $this->data['description'] ?? '';
        $this->data['description'] = match (true) {
            RichText::toText($description) === '' => '',
            RichText::isHtml($description) => RichText::sanitize($description),
            default => $description,
        };

        if (blank($this->data['slug'] ?? null)) {
            $this->data['slug'] = Str::slug($this->data['title'] ?? '');
        }

        $this->validate();

        DB::beginTransaction();

        try {
            $attributes = collect($this->data)->only((new Project)->getFillable())->all();

            if ($this->card_img) {
                $attributes['card_img'] = $this->card_img->store('project-galley', 'public');
            }

            $project = Project::updateOrCreate(['id' => $this->projectId], $attributes);

            if (! empty($this->deletedImages)) {
                $project->images()->whereIn('id', $this->deletedImages)->delete();
            }

            // Existing images keep the order chosen in the form; new uploads go after them.
            foreach (array_values($this->gallery) as $i => $image) {
                $project->images()->whereKey($image['id'])->update(['position' => $i + 1]);
            }
            $offset = count($this->gallery);
            foreach ($this->newgallery as $i => $file) {
                $project->images()->create([
                    'image_path' => $file->store('project-gallery', 'public'),
                    'position' => $offset + $i + 1,
                ]);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            session()->flash('error', 'The project could not be saved. Please try again.');

            return;
        }

        session()->flash('success', $this->projectId ? "“{$project->title}” was updated." : "“{$project->title}” was created.");

        return $this->redirect(route('admin.list'));
    }

    public function deleteProject()
    {
        if (! $this->projectId) {
            return;
        }

        $project = Project::findOrFail($this->projectId);
        $title = $project->title;
        $project->delete();

        session()->flash('success', "“{$title}” was deleted.");

        return $this->redirect(route('admin.list'));
    }

    public function render()
    {
        return view('livewire.project.add-project', [
            'categories' => ProjectCategory::orderBy('category')->get(['id', 'category']),
        ]);
    }
}
