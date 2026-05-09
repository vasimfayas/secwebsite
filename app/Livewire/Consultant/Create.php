<?php

namespace App\Livewire\Consultant;

use App\Models\Consultant;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $consultants = [];

    public $consultant_id;
    public $name;
    public $image;
    public $newImage;

    public $editMode = false;

    public function mount()
    {
        $this->loadConsultants();
    }

    public function loadConsultants()
    {
        $this->consultants = Consultant::latest()->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'newImage' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($this->newImage) {
            $imagePath = $this->newImage->store('consultants', 'public');
        }

        Consultant::create([
            'name' => $this->name,
            'img' => $imagePath,
        ]);

        $this->resetForm();
        $this->loadConsultants();
    }

    public function edit($id)
    {
        $consultant = Consultant::findOrFail($id);

        $this->consultant_id = $consultant->id;
        $this->name = $consultant->name;
        $this->image = $consultant->image;

        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'newImage' => 'nullable|image|max:2048',
        ]);

        $consultant = Consultant::findOrFail($this->consultant_id);

        $imagePath = $consultant->image;

        if ($this->newImage) {
            $imagePath = $this->newImage->store('consultants', 'public');
        }

        $consultant->update([
            'name' => $this->name,
            'img' => $imagePath,
        ]);

        $this->resetForm();
        $this->loadConsultants();
    }

    public function delete($id)
    {
        Consultant::findOrFail($id)->delete();
        $this->loadConsultants();
    }

    public function resetForm()
    {
        $this->consultant_id = null;
        $this->name = '';
        $this->image = null;
        $this->newImage = null;
        $this->editMode = false;
    }

    public function render()
    {
        return view('livewire.consultant.create');
    }
}
