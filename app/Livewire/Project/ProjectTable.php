<?php

namespace App\Livewire\Project;

use App\Models\Client;
use App\Models\Consultant;
use App\Models\Project;
use App\Models\ProjectCategory;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q', except: '')]
    public $search = '';

    #[Url(except: '')]
    public $status = '';

    #[Url(except: '')]
    public $category = '';

    #[Url(except: '')]
    public $client = '';

    #[Url(except: '')]
    public $consultant = '';

    #[Url(except: '')]
    public $visibility = '';   // visible | hidden | featured

    #[Url(except: 'latest')]
    public $sort = 'latest';   // latest | oldest | title | sequence | year

    #[Url(except: 'grid')]
    public $view = 'grid';     // grid | table

    public $perPage = 12;

    public function updating($name)
    {
        if (in_array($name, ['search', 'status', 'category', 'client', 'consultant', 'visibility', 'sort', 'perPage'])) {
            $this->resetPage();
        }
    }

    public function resetFilters()
    {
        $this->reset(['search', 'status', 'category', 'client', 'consultant', 'visibility', 'sort']);
        $this->resetPage();
    }

    public function toggle($id, $field)
    {
        abort_unless(in_array($field, ['visible', 'featured'], true), 400);

        $project = Project::findOrFail($id);
        $project->update([$field => ! $project->{$field}]);

        session()->flash('success', "“{$project->title}” " . match ($field) {
            'visible' => $project->visible ? 'is now visible.' : 'is now hidden.',
            'featured' => $project->featured ? 'is now featured.' : 'is no longer featured.',
        });
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $title = $project->title;
        $project->delete(); // gallery rows are removed by the FK cascade

        session()->flash('success', "“{$title}” was deleted.");
    }

    protected function query()
    {
        $term = trim($this->search);

        return Project::query()
            ->with(['category', 'client', 'consultant'])
            ->withCount('images')
            ->when($term !== '', function ($q) use ($term) {
                $q->where(function ($q) use ($term) {
                    $like = "%{$term}%";
                    $q->where('title', 'like', $like)
                        ->orWhere('project_code', 'like', $like)
                        ->orWhere('location', 'like', $like)
                        ->orWhereHas('client', fn ($c) => $c->where('name', 'like', $like))
                        ->orWhereHas('consultant', fn ($c) => $c->where('name', 'like', $like));
                });
            })
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->when($this->category === 'none', fn ($q) => $q->whereNull('category_id'))
            ->when($this->category && $this->category !== 'none', fn ($q) => $q->where('category_id', $this->category))
            ->when($this->client === 'none', fn ($q) => $q->whereNull('client_id'))
            ->when($this->client && $this->client !== 'none', fn ($q) => $q->where('client_id', $this->client))
            ->when($this->consultant === 'none', fn ($q) => $q->whereNull('consultant_id'))
            ->when($this->consultant && $this->consultant !== 'none', fn ($q) => $q->where('consultant_id', $this->consultant))
            ->when($this->visibility === 'visible', fn ($q) => $q->where('visible', true))
            ->when($this->visibility === 'hidden', fn ($q) => $q->where('visible', false))
            ->when($this->visibility === 'featured', fn ($q) => $q->where('featured', true))
            ->when($this->visibility === 'incomplete', fn ($q) => $q->where(function ($q) {
                $q->whereNull('client_id')->orWhereNull('consultant_id')->orWhereNull('size')->orWhere('size', '');
            }))
            ->tap(fn ($q) => match ($this->sort) {
                'oldest' => $q->oldest('id'),
                'title' => $q->orderBy('title'),
                'sequence' => $q->orderByRaw('sequence IS NULL, sequence')->latest('id'),
                'year' => $q->orderByDesc('completed_year')->latest('id'),
                default => $q->latest('id'),
            });
    }

    public function render()
    {
        return view('livewire.project.project-table', [
            'projects' => $this->query()->paginate($this->perPage),
            'categories' => ProjectCategory::orderBy('category')->get(['id', 'category']),
            'clients' => Client::orderBy('name')->get(['id', 'name']),
            'consultants' => Consultant::orderBy('name')->get(['id', 'name']),
            'counts' => [
                'all' => Project::count(),
                'ongoing' => Project::where('status', 'ongoing')->count(),
                'completed' => Project::where('status', 'completed')->count(),
            ],
            'hasFilters' => $this->search !== '' || $this->status || $this->category || $this->client
                || $this->consultant || $this->visibility || $this->sort !== 'latest',
        ]);
    }
}
