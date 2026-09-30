<div class="container-fluid"
     x-data
     x-on:career-form-focus.window="$nextTick(() => { $refs.form.scrollIntoView({ behavior: 'smooth', block: 'start' }); $refs.title.focus(); })">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jobs</h1>
        <a href="{{ route('careers') }}" target="_blank" class="btn btn-sm btn-outline-secondary">
            View careers page <i class="fas fa-external-link-alt ml-1"></i>
        </a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- ============ FORM ============ -->
    <div class="card shadow mb-4 {{ $careerId ? 'border-left-warning' : 'border-left-primary' }}" x-ref="form">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold {{ $careerId ? 'text-warning' : 'text-primary' }}">
                @if ($careerId)
                    <i class="fas fa-pen mr-1"></i> Editing: {{ $career['title'] }}
                @else
                    <i class="fas fa-plus mr-1"></i> Add a new job
                @endif
            </h6>
            @if ($careerId)
                <button type="button" class="btn btn-sm btn-light" wire:click="resetForm">Cancel edit</button>
            @endif
        </div>

        <div class="card-body">
            <form wire:submit.prevent="submit">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold small">Job Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('career.title') is-invalid @enderror"
                               wire:model="career.title" x-ref="title" placeholder="e.g. Site Engineer">
                        @error('career.title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold small">Period <span class="text-danger">*</span></label>
                        <select class="form-control @error('career.period') is-invalid @enderror" wire:model="career.period">
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                        </select>
                        @error('career.period') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label class="font-weight-bold small">Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('career.location') is-invalid @enderror" wire:model="career.location">
                        @error('career.location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small">Experience <span class="text-danger">*</span></label>
                        <select class="form-control @error('career.experience') is-invalid @enderror" wire:model="career.experience">
                            <option value="">-- Select --</option>
                            <option value="fresher">Fresher</option>
                            <option value="1-5 years">1-5 Years</option>
                            <option value="5 years+">5 Years+</option>
                            <option value="10 years+">10 Years+</option>
                            @if (!empty($career['experience']) && !in_array($career['experience'], ['fresher', '1-5 years', '5 years+', '10 years+']))
                                <option value="{{ $career['experience'] }}">{{ $career['experience'] }}</option>
                            @endif
                        </select>
                        @error('career.experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small">Application Deadline</label>
                        <input type="date" class="form-control @error('career.deadline') is-invalid @enderror" wire:model="career.deadline">
                        <small class="form-text text-muted">Leave empty to keep it open until you deactivate it.</small>
                        @error('career.deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label class="font-weight-bold small">Status</label>
                        <select class="form-control" wire:model="career.is_active">
                            <option value="1">Active (shown on website)</option>
                            <option value="0">Inactive (hidden)</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label class="font-weight-bold small">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('career.desc') is-invalid @enderror" rows="6" wire:model="career.desc"
                                  placeholder="Responsibilities, requirements, benefits… Line breaks are kept on the website."></textarea>
                        @error('career.desc') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="text-right">
                    @if ($careerId)
                        <button type="button" class="btn btn-light mr-2" wire:click="resetForm">Cancel</button>
                    @endif
                    <button class="btn {{ $careerId ? 'btn-warning' : 'btn-primary' }}" type="submit" wire:loading.attr="disabled" wire:target="submit">
                        <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm mr-1"></span>
                        {{ $careerId ? 'Update Job' : 'Create Job' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============ LIST ============ -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <ul class="nav nav-pills mb-2 mb-md-0">
                    @foreach (['all' => 'All', 'open' => 'Live on website', 'inactive' => 'Inactive', 'expired' => 'Expired'] as $key => $label)
                        <li class="nav-item">
                            <a href="#" wire:click.prevent="$set('filter', '{{ $key }}')"
                               class="nav-link py-1 px-3 small {{ $filter === $key ? 'active' : '' }}">
                                {{ $label }} <span class="badge badge-{{ $filter === $key ? 'light' : 'secondary' }} ml-1">{{ $counts[$key] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <input type="search" class="form-control form-control-sm" style="max-width: 240px"
                       placeholder="Search title or location…" wire:model.live.debounce.300ms="search">
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Title</th>
                            <th>Period</th>
                            <th>Location</th>
                            <th>Experience</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jobs as $job)
                            <tr wire:key="job-{{ $job->id }}" class="{{ (int) $careerId === $job->id ? 'table-warning' : '' }}">
                                <td class="align-middle">
                                    <div class="font-weight-bold text-gray-800">{{ $job->title }}</div>
                                    <div class="small text-muted">{{ \Illuminate\Support\Str::limit($job->desc, 70) }}</div>
                                </td>
                                <td class="align-middle">{{ ucfirst($job->period) }}</td>
                                <td class="align-middle">{{ $job->location }}</td>
                                <td class="align-middle">{{ ucfirst($job->experience) }}</td>
                                <td class="align-middle">
                                    @if ($job->deadline)
                                        <span class="{{ $job->isExpired() ? 'text-danger' : '' }}">{{ $job->deadline->format('M d, Y') }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if (!$job->is_active)
                                        <span class="badge badge-secondary">Inactive</span>
                                    @elseif ($job->isExpired())
                                        <span class="badge badge-danger">Expired</span>
                                    @else
                                        <span class="badge badge-success">Live</span>
                                    @endif
                                </td>
                                <td class="align-middle text-right text-nowrap">
                                    @if ($job->is_active && !$job->isExpired())
                                        <a href="{{ route('careers') }}#job-{{ $job->id }}" target="_blank"
                                           class="btn btn-sm btn-outline-primary" title="View on website">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    <button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"
                                            wire:click="edit({{ $job->id }})">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm {{ $job->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                            title="{{ $job->is_active ? 'Deactivate' : 'Activate' }}"
                                            wire:click="toggleActive({{ $job->id }})">
                                        <i class="fas {{ $job->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Delete"
                                            wire:click="delete({{ $job->id }})"
                                            wire:confirm="Delete “{{ $job->title }}”? This cannot be undone.">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">No jobs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
