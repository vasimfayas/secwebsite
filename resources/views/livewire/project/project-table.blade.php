<div class="row">
    @foreach ($projects as $project)
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <img src="{{ asset('storage/' . $project->card_img) }}"
                class="card-img-top"
                alt="{{ $project->title }}"
                style="height: 200px; object-fit: cover;">

            <div class="card-body d-flex flex-column">
                <h5 class="card-title font-weight-bold">{{ $project->title }}</h5>

                <p class="mb-1"><strong>Category:</strong> {{ $project->category->category ?? 'N/A' }}</p>
                <p class="mb-1"><strong>Status:</strong>
                    <span class="badge badge-{{ $project->status === 'completed' ? 'success' : 'warning' }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </p>
                <p class="mb-1"><strong>Location:</strong> {{ $project->location ?? '—' }}</p>
                <p class="mb-1"><strong>Size:</strong> {{ $project->size ?? '—' }}</p>
                <p class="mb-1"><strong>Visible:</strong>
                    <span class="badge badge-{{ $project->visible ? 'primary' : 'secondary' }}">
                        {{ $project->visible ? 'Yes' : 'No' }}
                    </span>
                </p>
                <p class="mb-1"><strong>Featured:</strong>
                    <span class="badge badge-{{ $project->featured ? 'info' : 'light' }}">
                        {{ $project->featured ? 'Yes' : 'No' }}
                    </span>
                </p>

                <p class="mt-3 text-muted small">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</p>
            </div>

            <div class="card-footer text-right bg-white border-top-0">
                <a href="#" class="btn btn-sm btn-outline-primary">View</a>
                <a href="#" class="btn btn-sm btn-outline-secondary">Edit</a>
            </div>
        </div>
    </div>
    @endforeach
</div>