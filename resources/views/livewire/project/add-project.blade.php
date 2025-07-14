<div class="card shadow mb-4">
    <div class="card-body">
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form wire:submit.prevent="save" enctype="multipart/form-data">

            <!-- Title -->
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" wire:model.defer="data.title">
                @error('data.title') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Category -->
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" wire:model.defer="data.category_id">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
                @error('data.category_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Location -->
            <div class="form-group">
                <label>Location</label>
                <input type="text" class="form-control" wire:model.defer="data.location">
            </div>

            <!-- Status -->
            <div class="form-group">
                <label>Status</label>
                <select class="form-control" wire:model="data.status">
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                </select>
            </div>

            <!-- Visibility -->
            <div class="form-group">
                <label>Visible?</label>
                <select class="form-control" wire:model.defer="data.visible">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="4" wire:model.defer="data.description"></textarea>
                @error('data.description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <!-- Card Image -->
            <div class="form-group">
                <label>Card Image</label>
                <input type="file" class="form-control-file" wire:model="data.card_img">
                @if (isset($data['card_img']) && is_string($data['card_img']))
                <img src="{{ asset('storage/' . $data['card_img']) }}" class="mt-2" width="120">
                @endif
            </div>

            <!-- Featured -->
            <div class="form-group">
                <label>Featured?</label>
                <select class="form-control" wire:model.defer="data.featured">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- Size -->
            <div class="form-group">
                <label>Size</label>
                <input type="text" class="form-control" wire:model.defer="data.size">
            </div>

            <button class="btn btn-primary">{{ $projectId ? 'Update' : 'Create' }} Project</button>
        </form>
    </div>
</div>