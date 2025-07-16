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
            @csrf

            <!-- Category -->
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" id="category" wire:model.defer="data.category" required>
                @error('category') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Card Image -->
            <div class="form-group">
                <label for="card_img">Upload Card Image</label>
                <input type="file" class="form-control-file" id="card_img" wire:model="data.card_img" accept="image/*">
                @error('card_img') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" wire:model.defer="data.description" rows="4"></textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Category</button>
        </form>
    </div>
</div>