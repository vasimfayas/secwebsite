<div class="container">
    <div class="card shadow p-4 mb-5">
        @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form wire:submit.prevent="submit">
            <div class="row">
                <!-- Title -->
                <div class="form-group col-md-6 mb-3">
                    <label>Job Title</label>
                    <input type="text" class="form-control" wire:model.defer="career.title">
                    @error('career.title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Period -->
                <div class="form-group col-md-6 mb-3">
                    <label>Period</label>
                    <select class="form-control" wire:model.defer="career.period">
                        <option value="">-- Select --</option>
                        <option value="full-time">Full-time</option>
                        <option value="part-time">Part-time</option>
                    </select>
                    @error('career.period') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Location -->
                <div class="form-group col-md-6 mb-3">
                    <label>Location</label>
                    <input type="text" class="form-control" wire:model.defer="career.location">
                    @error('career.location') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Experience -->
                <div class="form-group col-md-6 mb-3">
                    <label>Experience</label>
                    <select class="form-control" wire:model.defer="career.experience">
                        <option value="">-- Select --</option>
                        <option value="fresher">Fresher</Fption>
                        <option value="1-5 years">1-5 Years</option>
                        <option value="5 years+">5 Years+</option>
                        <option value="10 years+">10 Years+</option>
                    </select>
                    @error('career.experience') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Deadline -->
                <div class="form-group col-md-6 mb-3">
                    <label>Application Deadline</label>
                    <input type="date" class="form-control" wire:model.defer="career.deadline">
                    @error('career.deadline') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Is Active -->
                <div class="form-group col-md-6 mb-3">
                    <label>Active?</label>
                    <select class="form-control" wire:model.defer="career.is_active">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('career.is_active') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Description (full width) -->
                <div class="form-group col-12 mb-3">
                    <label>Description</label>
                    <textarea class="form-control" rows="4" wire:model.defer="career.desc"></textarea>
                    @error('career.desc') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="text-end">
                <button class="btn btn-primary" type="submit">
                    {{ $careerId ? 'Update' : 'Create' }} Career
                </button>
            </div>
        </form>
    </div>

    <!-- Existing Jobs Table Placeholder -->
    <div class="card shadow p-4">
        <h5 class="mb-3">Existing Job Posts</h5>
        @livewire('career.jobs')
    </div>
</div>