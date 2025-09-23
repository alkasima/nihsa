@extends('layouts.admin')

@section('title', 'Edit Email Template')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .note-editor {
            margin-bottom: 0;
        }
        .variable-badge {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.settings.email') }}">Email Settings</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Email Template</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Email Template: {{ $template['name'] }}</h1>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.settings.email.template.update', $template['id']) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject', $template['subject']) }}" required>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="body" class="form-label">Email Body <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="10" required>{{ old('body', $template['body']) }}</textarea>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Available Variables</label>
                    <div>
                        @foreach($template['variables'] as $variable)
                            <span class="badge bg-secondary variable-badge me-2 mb-2" data-variable="{{ $variable }}">{{{ $variable }}}</span>
                        @endforeach
                    </div>
                    <div class="form-text">Click on a variable to insert it into the email body.</div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.settings.email') }}" class="btn btn-secondary">Cancel</a>
                    <div>
                        <button type="button" class="btn btn-outline-primary me-2" id="preview-btn">
                            <i class="fas fa-eye me-1"></i> Preview
                        </button>
                        <button type="submit" class="btn btn-primary">Save Template</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Email Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <div class="p-2 border rounded" id="preview-subject"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Body</label>
                        <div class="p-2 border rounded" id="preview-body"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Summernote editor
            $('#body').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            
            // Insert variables into the editor
            $('.variable-badge').on('click', function() {
                const variable = '{' + $(this).data('variable') + '}';
                $('#body').summernote('insertText', variable);
            });
            
            // Preview email
            const previewBtn = document.getElementById('preview-btn');
            const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
            
            previewBtn.addEventListener('click', function() {
                const subject = document.getElementById('subject').value;
                const body = $('#body').summernote('code');
                
                // Replace variables with sample values
                let previewSubject = subject;
                let previewBody = body;
                
                @foreach($template['variables'] as $variable)
                    previewSubject = previewSubject.replace(/{{{ $variable }}}/g, '<strong>Sample {{ $variable }}</strong>');
                    previewBody = previewBody.replace(/{{{ $variable }}}/g, '<strong>Sample {{ $variable }}</strong>');
                @endforeach
                
                document.getElementById('preview-subject').innerHTML = previewSubject;
                document.getElementById('preview-body').innerHTML = previewBody;
                
                previewModal.show();
            });
        });
    </script>
@endsection
