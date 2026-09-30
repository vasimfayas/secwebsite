<?php

namespace App\Livewire\Career;

use App\Models\Career;
use Livewire\Component;

class Form extends Component
{
    public $careerId;
    public $career = [];

    public $search = '';
    public $filter = 'all'; // all | open | inactive | expired

    public function mount($id = null)
    {
        if ($id) {
            $this->edit($id);
        } else {
            $this->resetForm();
        }
    }

    protected function rules()
    {
        return [
            'career.title' => 'required|string|max:255',
            'career.desc' => 'required|string',
            'career.experience' => 'required|string|max:255',
            'career.period' => 'required|in:full-time,part-time',
            'career.location' => 'required|string|max:255',
            'career.is_active' => 'required|boolean',
            'career.deadline' => 'nullable|date',
        ];
    }

    protected $validationAttributes = [
        'career.title' => 'job title',
        'career.desc' => 'description',
        'career.experience' => 'experience',
        'career.period' => 'period',
        'career.location' => 'location',
        'career.is_active' => 'status',
        'career.deadline' => 'deadline',
    ];

    public function submit()
    {
        $data = $this->validate()['career'];
        $data['deadline'] = $data['deadline'] ?: null;

        try {
            Career::updateOrCreate(['id' => $this->careerId], $data);
            session()->flash('success', $this->careerId ? 'Job updated.' : 'Job created.');
            $this->resetForm();
        } catch (\Exception $e) {
            report($e);
            session()->flash('error', 'Something went wrong while saving the job.');
        }
    }

    public function edit($id)
    {
        $career = Career::findOrFail($id);

        $this->careerId = $career->id;
        $this->career = [
            'title' => $career->title,
            'desc' => $career->desc,
            'experience' => $career->experience,
            'period' => $career->period,
            'location' => $career->location,
            'is_active' => $career->is_active ? 1 : 0,
            'deadline' => $career->deadline?->format('Y-m-d'),
        ];
        $this->resetValidation();
        $this->dispatch('career-form-focus');
    }

    public function toggleActive($id)
    {
        $career = Career::findOrFail($id);
        $career->update(['is_active' => ! $career->is_active]);
        session()->flash('success', $career->is_active ? 'Job activated.' : 'Job deactivated.');
    }

    public function delete($id)
    {
        Career::findOrFail($id)->delete();

        if ((int) $this->careerId === (int) $id) {
            $this->resetForm();
        }
        session()->flash('success', 'Job deleted.');
    }

    public function resetForm()
    {
        $this->careerId = null;
        $this->career = [
            'title' => '',
            'desc' => '',
            'experience' => '',
            'period' => 'full-time',
            'location' => 'Doha',
            'is_active' => 1,
            'deadline' => null,
        ];
        $this->resetValidation();
    }

    public function render()
    {
        $jobs = Career::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('title', 'like', "%{$this->search}%")
                        ->orWhere('location', 'like', "%{$this->search}%");
                });
            })
            ->when($this->filter === 'open', fn ($q) => $q->open())
            ->when($this->filter === 'inactive', fn ($q) => $q->where('is_active', false))
            ->when($this->filter === 'expired', fn ($q) => $q->whereDate('deadline', '<', today()))
            ->latest()
            ->get();

        $counts = [
            'all' => Career::count(),
            'open' => Career::open()->count(),
            'inactive' => Career::where('is_active', false)->count(),
            'expired' => Career::whereDate('deadline', '<', today())->count(),
        ];

        return view('livewire.career.form', compact('jobs', 'counts'));
    }
}
