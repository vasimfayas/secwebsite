<div class="row">

    <!-- FORM -->
    <div class="col-md-4">

        <div class="card">
            <div class="card-body">

                <h5>{{ $editMode ? 'Edit Consultant' : 'Add Consultant' }}</h5>

                <input type="text"
                       class="form-control mb-2"
                       placeholder="Consultant Name"
                       wire:model="name">

                <input type="file"
                       class="form-control mb-2"
                       wire:model="newImage">

                <!-- Preview -->
                @if($newImage)
                    <img src="{{ $newImage->temporaryUrl() }}"
                         width="100"
                         class="mb-2">
                @elseif($image && !$newImage)
                    <img src="{{ asset('storage/'.$image) }}"
                         width="100"
                         class="mb-2">
                @endif

                @if($editMode)
                    <button class="btn btn-primary w-100" wire:click="update">
                        Update
                    </button>

                    <button class="btn btn-secondary w-100 mt-2" wire:click="resetForm">
                        Cancel
                    </button>
                @else
                    <button class="btn btn-success w-100" wire:click="save">
                        Save
                    </button>
                @endif

            </div>
        </div>

    </div>

    <!-- LIST -->
    <div class="col-md-8">

        <div class="card">
            <div class="card-body">

                <h5>Consultants</h5>

                <div class="row">
                    @foreach($consultants as $consultant)
                        <div class="col-md-4 mb-3">

                            <div class="card p-2 text-center">

                                <img src="{{ asset('storage/'.$consultant->img) }}"
                                     width="80"
                                     height="80"
                                     class="rounded-circle mx-auto">

                                <h6 class="mt-2">{{ $consultant->name }}</h6>

                                <button class="btn btn-sm btn-primary"
                                        wire:click="edit({{ $consultant->id }})">
                                    Edit
                                </button>

                                <button class="btn btn-sm btn-danger mt-1"
                                        wire:click="delete({{ $consultant->id }})">
                                    Delete
                                </button>

                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>

</div>