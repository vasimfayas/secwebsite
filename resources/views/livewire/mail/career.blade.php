<div
    x-data="{ open: false, success: false }"
    x-on:open-career-modal.window="
        open = true;
        success = false;
        $wire.set('job_id', $event.detail.id);
    "
    x-on:career-submitted.window="success = true"
    x-on:close-career-modal.window="open = false"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center px-4 overflow-y-auto py-8">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg shadow-lg max-h-full overflow-y-auto">

        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-1">Application for </h2>
            <p class="text-lg text-red-600 font-semibold">
                {{ is_string($job) ? $job : $job->title ?? 'General Application' }}
            </p>
        </div>

        <!-- Loading state -->
        <div
            x-show="!success"
            wire:loading
            wire:target="submit"
            class="flex items-center justify-center text-gray-600 text-sm mb-4">
            <svg class="animate-spin h-5 w-5 mr-2 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10"
                    stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8v8H4z"></path>
            </svg>
            Submitting your application...
        </div>

        <!-- Success message -->
        <div x-show="success" class="bg-green-100 text-green-800 p-2 rounded mb-4 text-center">
            Your application has been submitted successfully.
        </div>

        <form wire:submit.prevent="submit" class="space-y-4">
            <div>
                <label>First Name</label>
                <input type="text" wire:model="first_name" class="w-full border rounded px-3 py-2">
                @error('first_name') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label>Last Name</label>
                <input type="text" wire:model="last_name" class="w-full border rounded px-3 py-2">
                @error('last_name') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label>Age</label>
                <input type="number" wire:model="age" class="w-full border rounded px-3 py-2">
                @error('age') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label>Experience</label>
                <input type="text" wire:model="experience" class="w-full border rounded px-3 py-2">
                @error('experience') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label>Nationality</label>
                <input type="text" wire:model="nationality" class="w-full border rounded px-3 py-2">
                @error('nationality') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label>Email</label>
                <input type="email" wire:model="email" class="w-full border rounded px-3 py-2">
                @error('email') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label>Contact Number</label>
                <input type="text" wire:model="contact_number" class="w-full border rounded px-3 py-2">
                @error('contact_number') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label>Upload CV (PDF, DOC)</label>
                <input type="file" wire:model="cv" class="w-full">
                @error('cv') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div>
                <label>Cover Letter</label>
                <textarea wire:model="cover_letter" rows="5" class="w-full border rounded px-3 py-2"></textarea>
                @error('cover_letter') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <div class="flex justify-end gap-4 pt-2">
                <button type="button" @click="open = false" class="text-gray-600 hover:underline">Cancel</button>
                <button
                    type="submit"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700"
                    wire:loading.attr="disabled"
                    wire:target="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>