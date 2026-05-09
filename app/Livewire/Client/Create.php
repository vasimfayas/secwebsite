<?php

namespace App\Livewire\Client;


use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $clients = [];

    public $client_id;
    public $name;
    public $image;
    public $newImage;

    public $editMode = false;

    public function mount()
    {
        $this->loadClients();
    }

    public function loadClients()
    {
        $this->clients = Client::latest()->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'newImage' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($this->newImage) {
            $imagePath = $this->newImage->store('clients', 'public');
        }

        Client::create([
            'name' => $this->name,
            'img' => $imagePath,
        ]);

        $this->resetForm();
        $this->loadClients();
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        $this->client_id = $client->id;
        $this->name = $client->name;
        $this->image = $client->image;

        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'newImage' => 'nullable|image|max:2048',
        ]);

        $client = Client::findOrFail($this->client_id);

        $imagePath = $client->image;

        if ($this->newImage) {
            $imagePath = $this->newImage->store('clients', 'public');
        }

        $client->update([
            'name' => $this->name,
            'img' => $imagePath,
        ]);

        $this->resetForm();
        $this->loadClients();
    }

    public function delete($id)
    {
        Client::findOrFail($id)->delete();
        $this->loadClients();
    }

    public function resetForm()
    {
        $this->client_id = null;
        $this->name = '';
        $this->image = null;
        $this->newImage = null;
        $this->editMode = false;
    }

    public function render()
    {
        return view('livewire.client.create');
    }
}
