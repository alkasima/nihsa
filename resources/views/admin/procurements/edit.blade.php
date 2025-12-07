@extends('layouts.admin')

@section('title', 'Edit Procurement')

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
            <li class="breadcrumb-item"><a href="{{ route('admin.procurements.index') }}">Procurements Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Procurement</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Procurement</h1>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.procurements.update', $procurement->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $procurement->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $procurement->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10">{{ old('content', $procurement->content ?? '') }}</textarea>
                            <div class="form-text">Optional. If provided, this content will be displayed on the procurement detail page.</div>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Procurement Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="">Select Type</option>
                                        <option value="Tender" {{ old('type', $procurement->type) == 'Tender' ? 'selected' : '' }}>Tender</option>
                                        <option value="Contract" {{ old('type', $procurement->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                        <option value="Award" {{ old('type', $procurement->type) == 'Award' ? 'selected' : '' }}>Award</option>
                                        <option value="Notice" {{ old('type', $procurement->type) == 'Notice' ? 'selected' : '' }}>Notice</option>
                                        <option value="RFP" {{ old('type', $procurement->type) == 'RFP' ? 'selected' : '' }}>RFP</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                                    <select class="form-select @error('year') is-invalid @enderror" id="year" name="year" required>
                                        <option value="">Select Year</option>
                                        @for($y = date('Y') + 1; $y >= 2020; $y--)
                                            <option value="{{ $y }}" {{ old('year', $procurement->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="publication_date" class="form-label">Publication Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('publication_date') is-invalid @enderror" id="publication_date" name="publication_date" value="{{ old('publication_date', $procurement->publication_date->format('Y-m-d')) }}" required>
                                    @error('publication_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $procurement->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Feature this procurement
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Cover Image</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="cover_image" class="form-label">Upload New Cover Image</label>
                                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
                                    @error('cover_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Recommended size: 800x1200 pixels</div>
                                </div>

                                <div class="text-center mt-3">
                                    <div class="image-preview">
                                        <img id="preview" src="{{ $procurement->cover_image ?? asset('images/placeholder-200x300.svg') }}" class="img-fluid rounded" alt="Preview">
                                    </div>

                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" id="remove_cover_image" name="remove_cover_image" value="1">
                                        <label class="form-check-label" for="remove_cover_image">
                                            Remove current cover image
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Procurement File</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Upload New PDF File</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".pdf">
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div id="file-info" class="mt-2 d-none">
                                    <div class="alert alert-info">
                                        <strong>Selected File:</strong> <span id="file-name"></span><br>
                                        <strong>Size:</strong> <span id="file-size"></span>
                                    </div>
                                </div>

                                @if($procurement->file_path)
                                <div class="alert alert-secondary mt-2">
                                    <strong>Current File:</strong> {{ basename($procurement->file_path) }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.procurements.index') }}" class="btn btn-secondary">Cancel</a>
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
        // Pass PHP variables to JavaScript
        const placeholderImage = "{{ asset('images/placeholder-200x300.svg') }}";
        const currentImage = "{{ $procurement->cover_image ?? asset('images/placeholder-200x300.svg') }}";

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
            document.getElementById('cover_image').addEventListener('change', function(e) {
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
            document.getElementById('remove_cover_image').addEventListener('change', function(e) {
                const preview = document.getElementById('preview');
                if (this.checked) {
                    preview.src = placeholderImage;
                    document.getElementById('cover_image').disabled = true;
                } else {
                    preview.src = currentImage;
                    document.getElementById('cover_image').disabled = false;
                }
            });

            // File info
            document.getElementById('file').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    document.getElementById('file-info').classList.remove('d-none');
                    document.getElementById('file-name').textContent = file.name;

                    // Format file size
                    let size = file.size;
                    const units = ['B', 'KB', 'MB', 'GB'];
                    let unitIndex = 0;

                    while (size >= 1024 && unitIndex < units.length - 1) {
                        size /= 1024;
                        unitIndex++;
                    }

                    document.getElementById('file-size').textContent = size.toFixed(2) + ' ' + units[unitIndex];
                } else {
                    document.getElementById('file-info').classList.add('d-none');
                }
            });
        });
    </script>
@endsection
