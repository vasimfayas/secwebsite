<div class="container-fluid"
     x-data
     x-on:category-form-focus.window="$nextTick(() => { $refs.form.scrollIntoView({ behavior: 'smooth', block: 'start' }); $refs.name.focus(); })">

    <style>
        .cf-label { font-size: .8rem; font-weight: 700; color: #5a5c69; }
        .cf-req::after { content: ' *'; color: #e74a3b; }
        .cf-cover { position: relative; border: 2px dashed #d1d3e2; border-radius: .6rem; background: #f8f9fc; overflow: hidden; aspect-ratio: 16 / 9; display: flex; align-items: center; justify-content: center; cursor: pointer; margin: 0; transition: border-color .2s; }
        .cf-cover:hover { border-color: #4e73df; }
        .cf-cover img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        .cf-cover .cf-hint { position: absolute; bottom: .5rem; left: .5rem; right: .5rem; text-align: center; background: rgba(0,0,0,.55); color: #fff; font-size: .75rem; border-radius: .35rem; padding: .25rem; opacity: 0; transition: opacity .2s; }
        .cf-cover:hover .cf-hint { opacity: 1; }
        .cf-thumb { width: 96px; height: 60px; object-fit: cover; border-radius: .4rem; }
        .cf-sticky { position: sticky; top: 1.5rem; }
    </style>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Project categories</h1>
            <p class="mb-0 small text-muted">Sectors shown on the website's project filters and menu.</p>
        </div>
        <a href="{{ route('projects') }}" target="_blank" class="btn btn-sm btn-outline-secondary mt-3 mt-sm-0">
            View projects page <i class="fas fa-external-link-alt fa-sm ml-1"></i>
        </a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="row">
        <!-- ============ FORM ============ -->
        <div class="col-lg-4 mb-4">
            <div class="cf-sticky" x-ref="form">
                <div class="card shadow {{ $table_id ? 'border-left-warning' : 'border-left-primary' }}">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold {{ $table_id ? 'text-warning' : 'text-primary' }}">
                            @if ($table_id)
                                <i class="fas fa-pen mr-1"></i> Edit category
                            @else
                                <i class="fas fa-plus mr-1"></i> New category
                            @endif
                        </h6>
                        @if ($table_id)
                            <button type="button" class="btn btn-sm btn-light" wire:click="resetForm">Cancel</button>
                        @endif
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="save">
                            <div class="form-group">
                                <label class="cf-label cf-req">Name</label>
                                <input type="text" x-ref="name" class="form-control @error('data.category') is-invalid @enderror"
                                       wire:model="data.category" placeholder="e.g. Healthcare">
                                @error('data.category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label class="cf-label {{ $table_id ? '' : 'cf-req' }}">Cover image</label>
                                <label class="cf-cover {{ $errors->has('card_img') ? 'border-danger' : '' }}">
                                    <input type="file" class="d-none" wire:model="card_img" accept="image/*">
                                    @if ($card_img && method_exists($card_img, 'isPreviewable') && $card_img->isPreviewable())
                                        <img src="{{ $card_img->temporaryUrl() }}" alt="">
                                        <span class="cf-hint">Click to change</span>
                                    @elseif (!empty($data['card_img']))
                                        <img src="{{ asset('storage/' . $data['card_img']) }}" alt="">
                                        <span class="cf-hint">Click to change</span>
                                    @else
                                        <span class="text-center text-muted small px-3">
                                            <i class="fas fa-image fa-2x d-block mb-2 text-gray-400"></i>
                                            Click to upload<br>(wide photo — shown as the sector's page header)
                                        </span>
                                    @endif
                                    <span wire:loading wire:target="card_img" class="position-absolute" style="inset:0; background: rgba(255,255,255,.7);">
                                        <span class="d-flex h-100 align-items-center justify-content-center"><span class="spinner-border text-primary"></span></span>
                                    </span>
                                </label>
                                @error('card_img') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="form-group">
                                <label class="cf-label cf-req">Description</label>
                                <textarea class="form-control @error('data.description') is-invalid @enderror" rows="4"
                                          wire:model="data.description" placeholder="One or two sentences shown under the sector title."></textarea>
                                @error('data.description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-block {{ $table_id ? 'btn-warning' : 'btn-primary' }}"
                                    wire:loading.attr="disabled" wire:target="save,card_img">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm mr-1"></span>
                                {{ $table_id ? 'Save changes' : 'Create category' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============ LIST ============ -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary mb-2 mb-md-0">
                        {{ $categories->count() }} {{ \Illuminate\Support\Str::plural('category', $categories->count()) }}
                        @if ($uncategorised)
                            <a href="{{ route('admin.list', ['category' => 'none']) }}" class="badge badge-warning ml-2 font-weight-normal">
                                {{ $uncategorised }} {{ \Illuminate\Support\Str::plural('project', $uncategorised) }} without a category
                            </a>
                        @endif
                    </h6>
                    <input type="search" class="form-control form-control-sm" style="max-width: 220px"
                           placeholder="Search categories…" wire:model.live.debounce.250ms="search">
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 110px"></th>
                                <th>Category</th>
                                <th class="text-center">Projects</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr wire:key="cat-{{ $category->id }}" class="{{ (int) $table_id === $category->id ? 'table-warning' : '' }}">
                                    <td class="align-middle">
                                        @if ($category->card_img)
                                            <img src="{{ asset('storage/' . $category->card_img) }}" class="cf-thumb" alt="" loading="lazy">
                                        @else
                                            <div class="cf-thumb bg-light d-flex align-items-center justify-content-center text-danger small"><i class="fas fa-image mr-1"></i>None</div>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="font-weight-bold text-gray-800">{{ $category->category }}</div>
                                        <div class="small text-muted">{{ \Illuminate\Support\Str::limit($category->description, 90) ?: '—' }}</div>
                                    </td>
                                    <td class="align-middle text-center text-nowrap">
                                        <a href="{{ route('admin.list', ['category' => $category->id]) }}" class="font-weight-bold" title="Show these projects">{{ $category->projects_count }}</a>
                                        <div class="small">
                                            <span class="text-warning" title="Ongoing">{{ $category->ongoing_count }} ongoing</span> ·
                                            <span class="text-success" title="Delivered">{{ $category->delivered_count }} delivered</span>
                                        </div>
                                    </td>
                                    <td class="align-middle text-right text-nowrap">
                                        <a href="{{ route('listprojects', $category->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="View on website">
                                            <i class="fas fa-external-link-alt fa-sm"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-primary" title="Edit" wire:click="edit({{ $category->id }})">
                                            <i class="fas fa-pen fa-sm"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete"
                                                wire:click="delete({{ $category->id }})"
                                                wire:confirm="Delete “{{ $category->category }}”?{{ $category->projects_count ? ' Its ' . $category->projects_count . ' ' . \Illuminate\Support\Str::plural('project', $category->projects_count) . ' will be kept but will have no category.' : '' }}">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        {{ $search ? 'No categories match “' . $search . '”.' : 'No categories yet — add the first one.' }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
