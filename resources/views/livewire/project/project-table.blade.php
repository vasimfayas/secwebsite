<div class="container-fluid">

    <style>
        .pt-thumb { height: 180px; object-fit: cover; }
        .pt-card { transition: transform .2s ease, box-shadow .2s ease; }
        .pt-card:hover { transform: translateY(-3px); box-shadow: 0 .75rem 1.5rem rgba(58, 59, 69, .15) !important; }
        .pt-badges { position: absolute; top: .6rem; left: .6rem; }
        .pt-meta dt { font-size: .7rem; text-transform: uppercase; letter-spacing: .06em; color: #858796; font-weight: 700; }
        .pt-meta dd { margin-bottom: .4rem; color: #3a3b45; }
        .pt-missing { color: #e74a3b; font-style: italic; }
        .pt-table-thumb { width: 64px; height: 48px; object-fit: cover; border-radius: .35rem; }
        .pt-filters .form-control, .pt-filters .custom-select { font-size: .85rem; }
        .pt-loading { opacity: .5; pointer-events: none; transition: opacity .15s; }
    </style>

    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Projects</h1>
            <p class="mb-0 small text-muted">
                {{ $counts['all'] }} total · {{ $counts['ongoing'] }} ongoing · {{ $counts['completed'] }} delivered
            </p>
        </div>
        <a href="{{ route('admin.project') }}" class="btn btn-primary shadow-sm mt-3 mt-sm-0">
            <i class="fas fa-plus fa-sm mr-1"></i> Add Project
        </a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Filters -->
    <div class="card shadow mb-4 pt-filters">
        <div class="card-body pb-2">
            <div class="form-row">
                <div class="col-lg-4 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white"><i class="fas fa-search text-gray-400"></i></span>
                        </div>
                        <input type="search" class="form-control border-left-0" placeholder="Search title, code, location, client, consultant…"
                               wire:model.live.debounce.300ms="search">
                    </div>
                </div>
                <div class="col-6 col-lg-2 mb-2">
                    <select class="custom-select" wire:model.live="status">
                        <option value="">Ongoing: any</option>
                        <option value="ongoing">Ongoing: yes</option>
                        <option value="completed">Ongoing: no (delivered)</option>
                    </select>
                </div>
                <div class="col-6 col-lg-2 mb-2">
                    <select class="custom-select" wire:model.live="category">
                        <option value="">All categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                        @endforeach
                        <option value="none">— No category —</option>
                    </select>
                </div>
                <div class="col-6 col-lg-2 mb-2">
                    <select class="custom-select" wire:model.live="client">
                        <option value="">All clients</option>
                        @foreach ($clients as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                        <option value="none">— No client —</option>
                    </select>
                </div>
                <div class="col-6 col-lg-2 mb-2">
                    <select class="custom-select" wire:model.live="consultant">
                        <option value="">All consultants</option>
                        @foreach ($consultants as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                        <option value="none">— No consultant —</option>
                    </select>
                </div>
            </div>

            <div class="form-row align-items-center">
                <div class="col-auto mb-2">
                    <div class="btn-group btn-group-sm" role="group">
                        @foreach (['' => 'All', 'visible' => 'Visible', 'hidden' => 'Hidden', 'featured' => 'Featured', 'incomplete' => 'Missing info'] as $key => $label)
                            <button type="button" wire:click="$set('visibility', '{{ $key }}')"
                                    class="btn {{ $visibility === $key ? 'btn-primary' : 'btn-outline-secondary' }}">
                                @if ($key === 'incomplete')<i class="fas fa-exclamation-triangle fa-xs mr-1"></i>@endif{{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="col-auto mb-2 ml-lg-auto">
                    <select class="custom-select custom-select-sm" wire:model.live="sort">
                        <option value="latest">Newest first</option>
                        <option value="oldest">Oldest first</option>
                        <option value="title">Title A–Z</option>
                        <option value="sequence">Sequence</option>
                        <option value="year">Completed year</option>
                    </select>
                </div>
                <div class="col-auto mb-2">
                    <div class="btn-group btn-group-sm" role="group" aria-label="View">
                        <button type="button" wire:click="$set('view', 'grid')" class="btn {{ $view === 'grid' ? 'btn-dark' : 'btn-outline-secondary' }}" title="Grid view">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button type="button" wire:click="$set('view', 'table')" class="btn {{ $view === 'table' ? 'btn-dark' : 'btn-outline-secondary' }}" title="Table view">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
                @if ($hasFilters)
                    <div class="col-auto mb-2">
                        <button type="button" class="btn btn-sm btn-link text-danger" wire:click="resetFilters">
                            <i class="fas fa-times mr-1"></i>Clear filters
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="small text-muted">
            Showing {{ $projects->firstItem() ?? 0 }}–{{ $projects->lastItem() ?? 0 }} of {{ $projects->total() }}
            {{ \Illuminate\Support\Str::plural('project', $projects->total()) }}
        </span>
        <span wire:loading class="small text-primary"><span class="spinner-border spinner-border-sm mr-1"></span>Loading…</span>
    </div>

    <div wire:loading.class="pt-loading">
        @if ($projects->isEmpty())
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    <i class="fas fa-folder-open fa-3x text-gray-300 mb-3"></i>
                    <p class="mb-3 text-gray-600">No projects match your filters.</p>
                    @if ($hasFilters)
                        <button class="btn btn-outline-primary btn-sm" wire:click="resetFilters">Clear filters</button>
                    @endif
                </div>
            </div>
        @elseif ($view === 'grid')
            <!-- ============ GRID ============ -->
            <div class="row">
                @foreach ($projects as $project)
                    @php
                        $publicUrl = route('detailprojects', $project->id);
                    @endphp
                    <div class="col-md-6 col-xl-4 mb-4" wire:key="grid-{{ $project->id }}">
                        <div class="card h-100 shadow-sm pt-card {{ $project->visible ? '' : 'border-left-secondary' }}">
                            <div class="position-relative">
                                <img src="{{ $project->card_img ? asset('storage/' . $project->card_img) : asset('images/optimized/skyline-960.webp') }}"
                                     class="card-img-top pt-thumb" alt="{{ $project->title }}" loading="lazy"
                                     style="{{ $project->visible ? '' : 'filter: grayscale(1); opacity:.6' }}">
                                <div class="pt-badges">
                                    <span class="badge badge-{{ $project->status === 'ongoing' ? 'warning' : 'success' }} shadow-sm">
                                        {{ $project->is_ongoing ? 'Ongoing' : 'Delivered' }}
                                    </span>
                                    @if ($project->featured)
                                        <span class="badge badge-info shadow-sm"><i class="fas fa-star fa-xs"></i> Featured</span>
                                    @endif
                                    @unless ($project->visible)
                                        <span class="badge badge-dark shadow-sm"><i class="fas fa-eye-slash fa-xs"></i> Hidden</span>
                                    @endunless
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title font-weight-bold text-gray-800 mb-0">{{ $project->title }}</h5>
                                    @if ($project->project_code)
                                        <span class="badge badge-light border ml-2">{{ $project->project_code }}</span>
                                    @endif
                                </div>
                                <p class="small text-muted mb-3">
                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $project->location ?: '—' }}
                                    · {{ $project->category?->category ?? 'No category' }}
                                </p>

                                <dl class="row pt-meta small mb-0">
                                    <dt class="col-5">Client</dt>
                                    <dd class="col-7 {{ $project->client ? '' : 'pt-missing' }}">{{ $project->client?->name ?? 'Missing' }}</dd>
                                    <dt class="col-5">Consultant</dt>
                                    <dd class="col-7 {{ $project->consultant ? '' : 'pt-missing' }}">{{ $project->consultant?->name ?? 'Missing' }}</dd>
                                    <dt class="col-5">Size</dt>
                                    <dd class="col-7 {{ filled($project->size) ? '' : 'pt-missing' }}">{!! filled($project->size) ? e($project->size) . ' m<sup>2</sup>' : 'Missing' !!}</dd>
                                    @if ($project->completed_year || $project->duration)
                                        <dt class="col-5">Year / Days</dt>
                                        <dd class="col-7">{{ $project->completed_year ?: '—' }} / {{ $project->duration ?: '—' }}</dd>
                                    @endif
                                    <dt class="col-5">Gallery</dt>
                                    <dd class="col-7">{{ $project->images_count }} {{ \Illuminate\Support\Str::plural('photo', $project->images_count) }}</dd>
                                </dl>
                            </div>

                            <div class="card-footer bg-white d-flex align-items-center">
                                <a href="{{ route('admin.project', $project->id) }}" class="btn btn-sm btn-primary mr-1">
                                    <i class="fas fa-pen fa-sm mr-1"></i>Edit
                                </a>
                                <a href="{{ $publicUrl }}" target="_blank" class="btn btn-sm btn-outline-secondary mr-auto" title="View on website">
                                    <i class="fas fa-external-link-alt fa-sm"></i>
                                </a>
                                <button type="button" wire:click="toggle({{ $project->id }}, 'featured')"
                                        class="btn btn-sm {{ $project->featured ? 'btn-info' : 'btn-outline-info' }} mr-1"
                                        title="{{ $project->featured ? 'Unfeature' : 'Feature' }}">
                                    <i class="fas fa-star fa-sm"></i>
                                </button>
                                <button type="button" wire:click="toggle({{ $project->id }}, 'visible')"
                                        class="btn btn-sm {{ $project->visible ? 'btn-outline-secondary' : 'btn-secondary' }} mr-1"
                                        title="{{ $project->visible ? 'Hide' : 'Show' }}">
                                    <i class="fas {{ $project->visible ? 'fa-eye' : 'fa-eye-slash' }} fa-sm"></i>
                                </button>
                                <button type="button" wire:click="delete({{ $project->id }})"
                                        wire:confirm="Delete “{{ $project->title }}” and its gallery? This cannot be undone."
                                        class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="fas fa-trash fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- ============ TABLE ============ -->
            <div class="card shadow mb-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th>Project</th>
                                <th>Ongoing</th>
                                <th>Category</th>
                                <th>Client</th>
                                <th>Consultant</th>
                                <th>Size</th>
                                <th class="text-center">Seq.</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                @php
                                    $publicUrl = route('detailprojects', $project->id);
                                @endphp
                                <tr wire:key="row-{{ $project->id }}" class="{{ $project->visible ? '' : 'text-muted' }}">
                                    <td class="align-middle">
                                        <img src="{{ $project->card_img ? asset('storage/' . $project->card_img) : asset('images/optimized/skyline-960.webp') }}"
                                             class="pt-table-thumb" alt="" loading="lazy">
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.project', $project->id) }}" class="font-weight-bold text-gray-800">{{ $project->title }}</a>
                                        <div class="small text-muted">
                                            {{ $project->project_code ? $project->project_code . ' · ' : '' }}{{ $project->location ?: '—' }}
                                            @if ($project->featured) · <i class="fas fa-star text-info" title="Featured"></i>@endif
                                            @unless ($project->visible) · <i class="fas fa-eye-slash" title="Hidden"></i>@endunless
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge badge-{{ $project->is_ongoing ? 'warning' : 'success' }}">{{ $project->is_ongoing ? 'Ongoing' : 'Delivered' }}</span>
                                    </td>
                                    <td class="align-middle small">{{ $project->category?->category ?? '—' }}</td>
                                    <td class="align-middle small {{ $project->client ? '' : 'pt-missing' }}">{{ $project->client?->name ?? 'Missing' }}</td>
                                    <td class="align-middle small {{ $project->consultant ? '' : 'pt-missing' }}">{{ $project->consultant?->name ?? 'Missing' }}</td>
                                    <td class="align-middle small {{ filled($project->size) ? '' : 'pt-missing' }}">{{ filled($project->size) ? $project->size : 'Missing' }}</td>
                                    <td class="align-middle text-center small">{{ $project->sequence ?? '—' }}</td>
                                    <td class="align-middle text-right text-nowrap">
                                        <a href="{{ route('admin.project', $project->id) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fas fa-pen fa-sm"></i></a>
                                        <a href="{{ $publicUrl }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="View on website"><i class="fas fa-external-link-alt fa-sm"></i></a>
                                        <button type="button" wire:click="toggle({{ $project->id }}, 'visible')" class="btn btn-sm btn-outline-secondary" title="{{ $project->visible ? 'Hide' : 'Show' }}">
                                            <i class="fas {{ $project->visible ? 'fa-eye' : 'fa-eye-slash' }} fa-sm"></i>
                                        </button>
                                        <button type="button" wire:click="delete({{ $project->id }})"
                                                wire:confirm="Delete “{{ $project->title }}” and its gallery? This cannot be undone."
                                                class="btn btn-sm btn-outline-danger" title="Delete"><i class="fas fa-trash fa-sm"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="mb-2">{{ $projects->links() }}</div>
            <div class="mb-2 form-inline small text-muted">
                Per page
                <select class="custom-select custom-select-sm ml-2" wire:model.live="perPage">
                    @foreach ([12, 24, 48, 96] as $n)
                        <option value="{{ $n }}">{{ $n }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
