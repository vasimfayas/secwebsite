<?php

namespace App\Livewire\Career;

use App\Models\Career;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Form extends Component
{
    public $careerId;
    public $career = [];

    public function mount($id = null)
    {
        if ($id) {
            $career = Career::findOrFail($id);
            $this->careerId = $career->id;
            $this->career = $career->toArray();
        } else {
            $this->career['location'] = 'Doha';
        }
    }

    public function submit()
    {
        $this->validate([
            'career.title' => 'required|string|max:255',
            'career.desc' => 'required|string',
            'career.experience' => 'required|string|max:255',
            'career.period' => 'required|in:full-time,part-time',
            'career.location' => 'required|string|max:255',
            'career.is_active' => 'nullable|boolean',
            'career.deadline' => 'nullable|date',
        ]);

        DB::beginTransaction();

        try {
            Career::updateOrCreate(
                ['id' => $this->careerId],
                $this->career
            );

            DB::commit();

            session()->flash('success', $this->careerId ? 'Career updated.' : 'Career created.');
            return redirect()->route('admin.career');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.career.form');
    }
}
