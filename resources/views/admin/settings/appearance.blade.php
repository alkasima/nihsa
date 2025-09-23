@extends('layouts.admin')

@section('title', 'Appearance Settings')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.min.css">
    <style>
        .color-preview {
            width: 30px;
            height: 30px;
            border-radius: 5px;
            margin-right: 10px;
        }
        
        .image-preview {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Appearance Settings</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Appearance Settings</h1>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.settings.general') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> General
                </a>
                <a href="{{ route('admin.settings.appearance') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-palette me-2"></i> Appearance
                </a>
                <a href="{{ route('admin.settings.email') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-envelope me-2"></i> Email
                </a>
                <a href="{{ route('admin.settings.system') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-server me-2"></i> System
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.settings.appearance.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <h5>Logo & Favicon</h5>
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Recommended size: 200x50 pixels</div>
                                        
                                        <div class="mt-2">
                                            <img src="{{ asset($settings['logo']) }}" alt="Logo" class="image-preview" style="max-height: 50px;">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="favicon" class="form-label">Favicon</label>
                                        <input type="file" class="form-control @error('favicon') is-invalid @enderror" id="favicon" name="favicon" accept="image/x-icon,image/png">
                                        @error('favicon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Recommended size: 32x32 pixels</div>
                                        
                                        <div class="mt-2">
                                            <img src="{{ asset($settings['favicon']) }}" alt="Favicon" class="image-preview" style="max-height: 32px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Colors</h5>
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="primary_color" class="form-label">Primary Color <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <div class="color-preview" style="background-color: {{ $settings['primary_color'] }};"></div>
                                            </span>
                                            <input type="text" class="form-control colorpicker @error('primary_color') is-invalid @enderror" id="primary_color" name="primary_color" value="{{ old('primary_color', $settings['primary_color']) }}" required>
                                        </div>
                                        @error('primary_color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="secondary_color" class="form-label">Secondary Color <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <div class="color-preview" style="background-color: {{ $settings['secondary_color'] }};"></div>
                                            </span>
                                            <input type="text" class="form-control colorpicker @error('secondary_color') is-invalid @enderror" id="secondary_color" name="secondary_color" value="{{ old('secondary_color', $settings['secondary_color']) }}" required>
                                        </div>
                                        @error('secondary_color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="accent_color" class="form-label">Accent Color <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <div class="color-preview" style="background-color: {{ $settings['accent_color'] }};"></div>
                                            </span>
                                            <input type="text" class="form-control colorpicker @error('accent_color') is-invalid @enderror" id="accent_color" name="accent_color" value="{{ old('accent_color', $settings['accent_color']) }}" required>
                                        </div>
                                        @error('accent_color')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Typography</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="font_family" class="form-label">Font Family <span class="text-danger">*</span></label>
                                <select class="form-select @error('font_family') is-invalid @enderror" id="font_family" name="font_family" required>
                                    <option value="Roboto, sans-serif" {{ old('font_family', $settings['font_family']) == 'Roboto, sans-serif' ? 'selected' : '' }}>Roboto</option>
                                    <option value="Open Sans, sans-serif" {{ old('font_family', $settings['font_family']) == 'Open Sans, sans-serif' ? 'selected' : '' }}>Open Sans</option>
                                    <option value="Lato, sans-serif" {{ old('font_family', $settings['font_family']) == 'Lato, sans-serif' ? 'selected' : '' }}>Lato</option>
                                    <option value="Montserrat, sans-serif" {{ old('font_family', $settings['font_family']) == 'Montserrat, sans-serif' ? 'selected' : '' }}>Montserrat</option>
                                    <option value="Poppins, sans-serif" {{ old('font_family', $settings['font_family']) == 'Poppins, sans-serif' ? 'selected' : '' }}>Poppins</option>
                                    <option value="Nunito, sans-serif" {{ old('font_family', $settings['font_family']) == 'Nunito, sans-serif' ? 'selected' : '' }}>Nunito</option>
                                    <option value="Arial, sans-serif" {{ old('font_family', $settings['font_family']) == 'Arial, sans-serif' ? 'selected' : '' }}>Arial</option>
                                    <option value="Helvetica, sans-serif" {{ old('font_family', $settings['font_family']) == 'Helvetica, sans-serif' ? 'selected' : '' }}>Helvetica</option>
                                    <option value="Georgia, serif" {{ old('font_family', $settings['font_family']) == 'Georgia, serif' ? 'selected' : '' }}>Georgia</option>
                                    <option value="Times New Roman, serif" {{ old('font_family', $settings['font_family']) == 'Times New Roman, serif' ? 'selected' : '' }}>Times New Roman</option>
                                </select>
                                @error('font_family')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enable_dark_mode" name="enable_dark_mode" value="1" {{ old('enable_dark_mode', $settings['enable_dark_mode']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_dark_mode">Enable Dark Mode Option</label>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Hero Section</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="hero_image" class="form-label">Hero Image</label>
                                <input type="file" class="form-control @error('hero_image') is-invalid @enderror" id="hero_image" name="hero_image" accept="image/*">
                                @error('hero_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Recommended size: 1920x600 pixels</div>
                                
                                <div class="mt-2">
                                    <img src="{{ asset($settings['hero_image']) }}" alt="Hero Image" class="image-preview">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="hero_title" class="form-label">Hero Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('hero_title') is-invalid @enderror" id="hero_title" name="hero_title" value="{{ old('hero_title', $settings['hero_title']) }}" required>
                                @error('hero_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="hero_subtitle" class="form-label">Hero Subtitle <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('hero_subtitle') is-invalid @enderror" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $settings['hero_subtitle']) }}" required>
                                @error('hero_subtitle')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize color pickers
            $('.colorpicker').colorpicker();
            
            // Update color preview when color changes
            $('.colorpicker').on('colorpickerChange', function(event) {
                $(this).closest('.input-group').find('.color-preview').css('background-color', event.color.toString());
            });
            
            // Preview uploaded images
            $('#logo').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $(this).next('.invalid-feedback').next('.form-text').next('.mt-2').find('img').attr('src', e.target.result);
                    }.bind(this);
                    reader.readAsDataURL(file);
                }
            });
            
            $('#favicon').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $(this).next('.invalid-feedback').next('.form-text').next('.mt-2').find('img').attr('src', e.target.result);
                    }.bind(this);
                    reader.readAsDataURL(file);
                }
            });
            
            $('#hero_image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $(this).next('.invalid-feedback').next('.form-text').next('.mt-2').find('img').attr('src', e.target.result);
                    }.bind(this);
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endsection
