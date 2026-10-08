<div class="container-fluid">

    <style>
        .pf-section-title { font-size: .72rem; letter-spacing: .08em; text-transform: uppercase; font-weight: 800; color: #4e73df; }
        .pf-label { font-size: .8rem; font-weight: 700; color: #5a5c69; }
        .pf-req::after { content: ' *'; color: #e74a3b; }
        .pf-sticky { position: sticky; top: 1.5rem; }
        .pf-cover { position: relative; border: 2px dashed #d1d3e2; border-radius: .6rem; background: #f8f9fc; overflow: hidden; aspect-ratio: 4 / 3; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: border-color .2s; }
        .pf-cover:hover { border-color: #4e73df; }
        .pf-cover img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        .pf-cover .pf-cover-hint { position: absolute; bottom: .5rem; left: .5rem; right: .5rem; text-align: center; background: rgba(0,0,0,.55); color: #fff; font-size: .75rem; border-radius: .35rem; padding: .25rem; opacity: 0; transition: opacity .2s; }
        .pf-cover:hover .pf-cover-hint { opacity: 1; }
        .pf-drop { border: 2px dashed #d1d3e2; border-radius: .6rem; background: #f8f9fc; padding: 1.5rem; text-align: center; cursor: pointer; transition: all .2s; display: block; margin: 0; }
        .pf-drop:hover, .pf-drop.is-over { border-color: #4e73df; background: #eef2ff; }
        .pf-thumb { position: relative; width: 132px; }
        .pf-thumb img { width: 132px; height: 100px; object-fit: cover; border-radius: .45rem; }
        .pf-thumb .pf-thumb-actions { position: absolute; top: .3rem; right: .3rem; display: flex; gap: .2rem; }
        .pf-thumb .pf-thumb-actions .btn { width: 24px; height: 24px; padding: 0; line-height: 22px; border-radius: 50%; font-size: .7rem; }
        .pf-thumb .pf-pos { position: absolute; bottom: .3rem; left: .3rem; font-size: .65rem; }
        .custom-switch .custom-control-label { cursor: pointer; }
    </style>

    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('admin.list') }}" class="small text-muted"><i class="fas fa-arrow-left mr-1"></i>All projects</a>
            <h1 class="h3 mb-0 mt-1 text-gray-800">{{ $projectId ? 'Edit project' : 'Add project' }}</h1>
        </div>
        @if ($projectId)
            <a href="{{ route('detailprojects', $projectId) }}"
               target="_blank" class="btn btn-sm btn-outline-secondary mt-3 mt-sm-0">
                View on website <i class="fas fa-external-link-alt fa-sm ml-1"></i>
            </a>
        @endif
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="fas fa-exclamation-circle mr-1"></i>Please fix {{ $errors->count() }} {{ \Illuminate\Support\Str::plural('field', $errors->count()) }}:</strong>
            <ul class="mb-0 mt-1 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="row">

            <!-- ============ MAIN ============ -->
            <div class="col-lg-8">

                <!-- Basics -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="pf-section-title mb-3"><i class="fas fa-info-circle mr-1"></i>Basics</div>

                        <div class="form-group">
                            <label class="pf-label pf-req">Title</label>
                            <input type="text" class="form-control form-control-lg @error('data.title') is-invalid @enderror"
                                   wire:model.live.debounce.400ms="data.title" placeholder="e.g. Lusail Residential Tower">
                            @error('data.title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <small class="form-text text-muted">URL slug: <code>{{ $data['slug'] ?: '—' }}</code></small>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="pf-label">Ongoing project?</label>
                                <div class="custom-control custom-switch mt-1">
                                    <input type="checkbox" class="custom-control-input" id="pf-ongoing" wire:model.live="ongoing">
                                    <label class="custom-control-label font-weight-bold {{ $ongoing ? 'text-warning' : 'text-success' }}" for="pf-ongoing">
                                        {{ $ongoing ? 'Yes — under construction' : 'No — delivered' }}
                                    </label>
                                </div>
                                <small class="form-text text-muted">Independent of the category.</small>
                            </div>
                            <div class="form-group col-md-5">
                                <label class="pf-label">Category</label>
                                <select class="custom-select @error('data.category_id') is-invalid @enderror" wire:model="data.category_id">
                                    <option value="">— Select category —</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                @error('data.category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label class="pf-label">Project code</label>
                                <input type="text" class="form-control @error('data.project_code') is-invalid @enderror" wire:model="data.project_code" placeholder="Optional">
                                @error('data.project_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Key details -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="pf-section-title mb-3"><i class="fas fa-clipboard-list mr-1"></i>Key details</div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="pf-label">Client</label>
                                <select class="custom-select @error('data.client_id') is-invalid @enderror" wire:model="data.client_id">
                                    <option value="">— Select client —</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                    @endforeach
                                </select>
                                @error('data.client_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <small class="form-text text-muted">Not listed? <a href="{{ route('admin.client') }}" target="_blank">Add a client</a></small>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="pf-label">Consultant</label>
                                <select class="custom-select @error('data.consultant_id') is-invalid @enderror" wire:model="data.consultant_id">
                                    <option value="">— Select consultant —</option>
                                    @foreach ($consultants as $consultant)
                                        <option value="{{ $consultant->id }}">{{ $consultant->name }}</option>
                                    @endforeach
                                </select>
                                @error('data.consultant_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <small class="form-text text-muted">Not listed? <a href="{{ route('admin.consultant') }}" target="_blank">Add a consultant</a></small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="pf-label">Location</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span></div>
                                    <input type="text" class="form-control @error('data.location') is-invalid @enderror" wire:model="data.location" placeholder="e.g. Lusail, Qatar">
                                </div>
                                @error('data.location') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="pf-label">Project size</label>
                                <div class="input-group">
                                    <input type="text" inputmode="numeric" class="form-control @error('data.size') is-invalid @enderror" wire:model="data.size" placeholder="e.g. 25000">
                                    <div class="input-group-append"><span class="input-group-text">m²</span></div>
                                </div>
                                @error('data.size') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="pf-label">Completed year</label>
                                <select class="custom-select @error('data.completed_year') is-invalid @enderror" wire:model="data.completed_year">
                                    <option value="">— {{ ($data['status'] ?? '') === 'ongoing' ? 'Not completed yet' : 'Select year' }} —</option>
                                    @for ($year = date('Y') + 1; $year >= 1990; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('data.completed_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="pf-label">Duration</label>
                                <div class="input-group">
                                    <input type="number" min="1" class="form-control @error('data.duration') is-invalid @enderror" wire:model="data.duration" placeholder="e.g. 540">
                                    <div class="input-group-append"><span class="input-group-text">days</span></div>
                                </div>
                                @error('data.duration') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="pf-section-title mb-3"><i class="fas fa-align-left mr-1"></i>About the project <span class="text-danger">*</span></div>
                        <div wire:ignore
                             x-data="{
                                init() {
                                    const boot = () => {
                                        tinymce.init({
                                            target: this.$refs.editor,
                                            height: 420,
                                            menubar: false,
                                            branding: false,
                                            promotion: false,
                                            plugins: 'lists advlist autolink link nonbreaking wordcount',
                                            toolbar: 'undo redo | blocks | bold italic underline strikethrough | bullist numlist | outdent indent | alignleft aligncenter alignright alignjustify | link | removeformat',
                                            block_formats: 'Paragraph=p; Heading=h2; Subheading=h3; Small heading=h4',
                                            nonbreaking_force_tab: true,
                                            paste_data_images: false,
                                            invalid_elements: 'img,script,iframe,object,embed,table',
                                            content_style: 'body { font-family: -apple-system, Segoe UI, Roboto, sans-serif; font-size: 15px; line-height: 1.7; }',
                                            setup: (editor) => {
                                                const sync = () => this.$wire.set('data.description', editor.getContent(), false);
                                                editor.on('change input undo redo keyup ExecCommand', sync);
                                            },
                                        });
                                    };
                                    if (window.tinymce) return boot();
                                    const s = document.createElement('script');
                                    s.src = 'https://cdn.jsdelivr.net/npm/tinymce@6.8.5/tinymce.min.js';
                                    s.referrerPolicy = 'origin';
                                    s.onload = boot;
                                    document.head.appendChild(s);
                                },
                                destroy() { window.tinymce?.get(this.$refs.editor.id)?.remove(); }
                             }">
                            <textarea x-ref="editor" id="project-description-editor">{{ \App\Support\RichText::toHtml($data['description'] ?? '') }}</textarea>
                        </div>
                        <small class="form-text text-muted">
                            Use the toolbar for headings, <strong>bold</strong>, bullet and numbered lists, and indentation.
                            <kbd>Tab</kbd> indents list items (or adds spacing in a paragraph); <kbd>Shift</kbd>+<kbd>Tab</kbd> outdents.
                            Pasting from Word keeps the formatting.
                        </small>
                        @error('data.description') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Gallery -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="pf-section-title"><i class="fas fa-images mr-1"></i>Gallery</div>
                            <span class="small text-muted">{{ count($gallery) + count($newgallery) }} {{ \Illuminate\Support\Str::plural('photo', count($gallery) + count($newgallery)) }}</span>
                        </div>

                        <label class="pf-drop" x-data="{ over: false }" :class="over && 'is-over'"
                               @dragover.prevent="over = true" @dragleave="over = false" @drop="over = false">
                            <input type="file" class="d-none" wire:model="newgallery" multiple accept="image/*">
                            <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                            <div class="font-weight-bold text-gray-700">Drop photos here or click to browse</div>
                            <div class="small text-muted">JPG, PNG or WebP · up to 30 MB each · select several at once</div>
                            <div wire:loading wire:target="newgallery" class="small text-primary mt-2">
                                <span class="spinner-border spinner-border-sm mr-1"></span>Uploading…
                            </div>
                        </label>
                        @error('newgallery.*') <small class="text-danger d-block mt-2">{{ $message }}</small> @enderror

                        @if (count($gallery) || count($newgallery))
                            <div class="d-flex flex-wrap mt-3" style="gap: .75rem">
                                @foreach ($gallery as $index => $image)
                                    <div class="pf-thumb shadow-sm" wire:key="old-{{ $image['id'] }}">
                                        <img src="{{ Storage::url($image['image_path']) }}" alt="">
                                        <span class="pf-pos badge badge-dark">{{ $index + 1 }}</span>
                                        <div class="pf-thumb-actions">
                                            @if ($index > 0)
                                                <button type="button" class="btn btn-light shadow-sm" title="Move left" wire:click="moveImage({{ $index }}, -1)"><i class="fas fa-chevron-left"></i></button>
                                            @endif
                                            @if ($index < count($gallery) - 1)
                                                <button type="button" class="btn btn-light shadow-sm" title="Move right" wire:click="moveImage({{ $index }}, 1)"><i class="fas fa-chevron-right"></i></button>
                                            @endif
                                            <button type="button" class="btn btn-danger shadow-sm" title="Remove" wire:click="removeOldImage({{ $index }})"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach ($newgallery as $index => $image)
                                    <div class="pf-thumb shadow-sm" wire:key="new-{{ $index }}">
                                        @if ($image->isPreviewable())
                                            <img src="{{ $image->temporaryUrl() }}" alt="" style="outline: 3px solid #1cc88a; outline-offset: -3px;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light text-danger small rounded" style="width:132px;height:100px">
                                                <i class="fas fa-file-excel mr-1"></i>Not an image
                                            </div>
                                        @endif
                                        <span class="pf-pos badge badge-success">New</span>
                                        <div class="pf-thumb-actions">
                                            <button type="button" class="btn btn-danger shadow-sm" title="Remove" wire:click="removeNewImage({{ $index }})"><i class="fas fa-times"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if (count($deletedImages))
                                <small class="text-warning d-block mt-2"><i class="fas fa-info-circle mr-1"></i>{{ count($deletedImages) }} removed {{ \Illuminate\Support\Str::plural('photo', count($deletedImages)) }} will be deleted when you save.</small>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <!-- ============ SIDEBAR ============ -->
            <div class="col-lg-4">
                <div class="pf-sticky">

                    <!-- Publish -->
                    <div class="card shadow mb-4 border-left-primary">
                        <div class="card-body">
                            <div class="pf-section-title mb-3"><i class="fas fa-paper-plane mr-1"></i>Publish</div>

                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="pf-visible" wire:model="data.visible">
                                <label class="custom-control-label" for="pf-visible">Visible on website</label>
                            </div>
                            <div class="custom-control custom-switch mb-3">
                                <input type="checkbox" class="custom-control-input" id="pf-featured" wire:model="data.featured">
                                <label class="custom-control-label" for="pf-featured">Featured project</label>
                            </div>

                            <div class="form-group">
                                <label class="pf-label">Display order (sequence)</label>
                                <input type="number" min="0" class="form-control @error('data.sequence') is-invalid @enderror" wire:model="data.sequence" placeholder="Lower shows first">
                                @error('data.sequence') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block" wire:loading.attr="disabled" wire:target="save,card_img,newgallery">
                                <span wire:loading wire:target="save" class="spinner-border spinner-border-sm mr-1"></span>
                                <i class="fas fa-save mr-1" wire:loading.remove wire:target="save"></i>
                                {{ $projectId ? 'Save changes' : 'Create project' }}
                            </button>
                            <a href="{{ route('admin.list') }}" class="btn btn-light btn-block">Cancel</a>
                        </div>
                    </div>

                    <!-- Cover image -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="pf-section-title mb-3"><i class="fas fa-image mr-1"></i>Cover image @unless($projectId)<span class="text-danger">*</span>@endunless</div>
                            <label class="pf-cover mb-2 {{ $errors->has('card_img') ? 'border-danger' : '' }}">
                                <input type="file" class="d-none" wire:model="card_img" accept="image/*">
                                @if ($card_img && method_exists($card_img, 'isPreviewable') && $card_img->isPreviewable())
                                    <img src="{{ $card_img->temporaryUrl() }}" alt="">
                                    <span class="pf-cover-hint">Click to change</span>
                                @elseif (!empty($data['card_img']))
                                    <img src="{{ asset('storage/' . $data['card_img']) }}" alt="">
                                    <span class="pf-cover-hint">Click to change</span>
                                @else
                                    <span class="text-center text-muted small px-3">
                                        <i class="fas fa-image fa-2x d-block mb-2 text-gray-400"></i>
                                        Click to upload the main photo<br>(used on cards and at the top of the project page)
                                    </span>
                                @endif
                                <span wire:loading wire:target="card_img" class="position-absolute" style="inset:0; background: rgba(255,255,255,.7);">
                                    <span class="d-flex h-100 align-items-center justify-content-center"><span class="spinner-border text-primary"></span></span>
                                </span>
                            </label>
                            @error('card_img') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    @if ($projectId)
                        <!-- Danger zone -->
                        <div class="card shadow mb-4 border-left-danger">
                            <div class="card-body">
                                <div class="pf-section-title text-danger mb-2"><i class="fas fa-exclamation-triangle mr-1"></i>Danger zone</div>
                                <p class="small text-muted mb-3">Deleting removes this project and its gallery from the website permanently.</p>
                                <button type="button" class="btn btn-outline-danger btn-block btn-sm"
                                        wire:click="deleteProject"
                                        wire:confirm="Delete “{{ $data['title'] }}” and its gallery? This cannot be undone.">
                                    <i class="fas fa-trash mr-1"></i>Delete project
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
