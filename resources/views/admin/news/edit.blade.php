@extends('layouts.admin')

@section('title', 'Edit News')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">News Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit News</li>
        </ol>
    </nav>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.news.update', $newsItem->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $newsItem->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content', $newsItem->content) }}</textarea>
                            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-light"><h5 class="card-title mb-0">Publishing Options</h5></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="News" {{ old('category', $newsItem->category) == 'News' ? 'selected' : '' }}>News</option>
                                        <option value="Press Release" {{ old('category', $newsItem->category) == 'Press Release' ? 'selected' : '' }}>Press Release</option>
                                        <option value="Event" {{ old('category', $newsItem->category) == 'Event' ? 'selected' : '' }}>Event</option>
                                    </select>
                                    @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Publication Date</label>
                                    <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', $newsItem->published_at ? $newsItem->published_at->format('Y-m-d') : '') }}">
                                    @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $newsItem->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">Feature this news</label>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light"><h5 class="card-title mb-0">Featured Image</h5></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload New Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <div class="form-text">Recommended size: 1200x800 pixels</div>
                                </div>

                                <div class="text-center mt-3">
                                    <div class="image-preview">
                                        @if($newsItem->image)
                                            <img id="preview" src="{{ asset('storage/'.$newsItem->image) }}" class="img-fluid rounded" alt="Preview">
                                        @else
                                            <img id="preview" src="{{ asset('images/placeholder-300x200.svg') }}" class="img-fluid rounded" alt="Preview">
                                        @endif
                                    </div>

                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                        <label class="form-check-label" for="remove_image">Remove current image</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
                    <div>
                        <button type="submit" name="save_draft" class="btn btn-outline-primary">Save as Draft</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#content').summernote({ height: 300 });

            const imageInput = document.getElementById('image');
            if (imageInput) {
                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            document.getElementById('preview').src = event.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            const removeCheckbox = document.getElementById('remove_image');
            if (removeCheckbox) {
                removeCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        document.getElementById('preview').src = "{{ asset('images/placeholder-300x200.svg') }}";
                        if (imageInput) imageInput.disabled = true;
                    } else {
                        @if($newsItem->image)
                            document.getElementById('preview').src = "{{ asset('storage/'.$newsItem->image) }}";
                        @endif
                        if (imageInput) imageInput.disabled = false;
                    }
                });
            }
        });
    </script>
@endsection
@extends('layouts.admin')

@section('title', 'Edit News')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <h1>Edit News</h1>

        <form action="{{ route('admin.news.update', $newsItem->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $newsItem->title) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="6" required>{{ old('content', $newsItem->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" name="category" class="form-control" value="{{ old('category', $newsItem->category) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Image (optional)</label>
                <input type="file" name="image" class="form-control">
                @if($newsItem->image)
                    <div class="mt-2"><img src="{{ asset('storage/'.$newsItem->image) }}" alt="" style="max-width:240px;" /></div>
                @endif
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $newsItem->is_featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_featured">Featured</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Publish Date (leave blank to keep current)</label>
                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', $newsItem->published_at ? $newsItem->published_at->format('Y-m-d\TH:i') : '') }}">
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#content').summernote({ height: 300 });
        });
    </script>
@endsection
@extends('layouts.admin')

@section('title', 'Edit News')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .note-editor {
            margin-bottom: 0;
        }
        .custom-file-label::after {
            content: "Browse";
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">News Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit News</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit News</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <!-- In a real implementation, this would be populated from the database -->
            @php
                $news = [
                    'id' => 1,
                    'title' => '2025 Annual Flood Outlook Released',
                    'content' => '<p>The Nigeria Hydrological Services Agency (NIHSA) has released the 2025 Annual Flood Outlook (AFO) with predictions for the rainy season. The outlook provides detailed information on potential flood risk areas across Nigeria.</p>

                    <p>According to the AFO, several states are at high risk of flooding during the 2025 rainy season, including Lagos, Rivers, Bayelsa, Delta, and Kogi. The outlook also identifies moderate and low-risk areas, providing valuable information for flood preparedness and response.</p>

                    <p>The Director-General of NIHSA, in his address during the launch of the AFO, emphasized the importance of early warning and preparedness in mitigating the impacts of floods. He urged state and local governments, as well as communities in flood-prone areas, to take proactive measures to reduce flood risks.</p>

                    <p>The AFO is a key tool for flood management in Nigeria, providing stakeholders with information on potential flood scenarios and recommendations for flood mitigation and adaptation. The outlook is based on comprehensive analysis of rainfall patterns, river levels, and other hydrological data.</p>

                    <p>NIHSA will continue to monitor the situation and provide updates as necessary. The agency also calls on the public to report any signs of flooding to the appropriate authorities for prompt action.</p>',
                    'category' => 'Press Release',
                    'published_at' => '2025-05-05',
                    'is_featured' => true,
                    'image' => 'https://images.unsplash.com/photo-1574724713425-fee7e2eacf84?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
                ];
            @endphp

            <form action="{{ route('admin.news.update', $news['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $news['title']) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content', $news['content']) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Publishing Options</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="News" {{ old('category', $news['category']) == 'News' ? 'selected' : '' }}>News</option>
                                        <option value="Press Release" {{ old('category', $news['category']) == 'Press Release' ? 'selected' : '' }}>Press Release</option>
                                        <option value="Event" {{ old('category', $news['category']) == 'Event' ? 'selected' : '' }}>Event</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="published_at" class="form-label">Publication Date</label>
                                    <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', date('Y-m-d', strtotime($news['published_at']))) }}">
                                    @error('published_at')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $news['is_featured']) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Feature this news
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Featured Image</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Upload New Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Recommended size: 1200x800 pixels</div>
                                </div>

                                <div class="text-center mt-3">
                                    <div class="image-preview">
                                        <img id="preview" src="{{ $news['image'] }}" class="img-fluid rounded" alt="Preview">
                                    </div>

                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1">
                                        <label class="form-check-label" for="remove_image">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
                    <div>
                        <button type="submit" name="save_draft" class="btn btn-outline-primary">Save as Draft</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Summernote editor
            $('#content').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Image preview
            document.getElementById('image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('preview').src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Remove image checkbox
            document.getElementById('remove_image').addEventListener('change', function(e) {
                if (this.checked) {
                    document.getElementById('preview').src = '{{ asset('images/placeholder-300x200.svg') }}';
                    document.getElementById('image').disabled = true;
                } else {
                    document.getElementById('preview').src = '{{ $news['image'] }}';
                    document.getElementById('image').disabled = false;
                }
            });
        });
    </script>
@endsection
