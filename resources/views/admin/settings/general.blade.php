@extends('layouts.admin')

@section('title', 'General Settings')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">General Settings</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">General Settings</h1>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.settings.general') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-cog me-2"></i> General
                </a>
                <a href="{{ route('admin.settings.appearance') }}" class="list-group-item list-group-item-action">
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
                    <form action="{{ route('admin.settings.general.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <h5>Website Information</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="site_title" class="form-label">Site Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('site_title') is-invalid @enderror" id="site_title" name="site_title" value="{{ old('site_title', $settings['site_title']) }}" required>
                                @error('site_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">The title of your website, displayed in the browser tab and search results.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="site_description" class="form-label">Site Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('site_description') is-invalid @enderror" id="site_description" name="site_description" rows="3" required>{{ old('site_description', $settings['site_description']) }}</textarea>
                                @error('site_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">A short description of your website, used in search results and metadata.</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Contact Information</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="contact_email" class="form-label">Contact Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}" required>
                                @error('contact_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="contact_phone" class="form-label">Contact Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}" required>
                                @error('contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="contact_address" class="form-label">Contact Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('contact_address') is-invalid @enderror" id="contact_address" name="contact_address" rows="3" required>{{ old('contact_address', $settings['contact_address']) }}</textarea>
                                @error('contact_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Social Media</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="social_facebook" class="form-label">Facebook URL</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                    <input type="url" class="form-control @error('social_facebook') is-invalid @enderror" id="social_facebook" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook']) }}">
                                </div>
                                @error('social_facebook')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="social_twitter" class="form-label">Twitter URL</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                                    <input type="url" class="form-control @error('social_twitter') is-invalid @enderror" id="social_twitter" name="social_twitter" value="{{ old('social_twitter', $settings['social_twitter']) }}">
                                </div>
                                @error('social_twitter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="social_instagram" class="form-label">Instagram URL</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                    <input type="url" class="form-control @error('social_instagram') is-invalid @enderror" id="social_instagram" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram']) }}">
                                </div>
                                @error('social_instagram')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="social_linkedin" class="form-label">LinkedIn URL</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                    <input type="url" class="form-control @error('social_linkedin') is-invalid @enderror" id="social_linkedin" name="social_linkedin" value="{{ old('social_linkedin', $settings['social_linkedin']) }}">
                                </div>
                                @error('social_linkedin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="social_youtube" class="form-label">YouTube URL</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                    <input type="url" class="form-control @error('social_youtube') is-invalid @enderror" id="social_youtube" name="social_youtube" value="{{ old('social_youtube', $settings['social_youtube']) }}">
                                </div>
                                @error('social_youtube')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Footer</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="footer_text" class="form-label">Footer Text <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('footer_text') is-invalid @enderror" id="footer_text" name="footer_text" value="{{ old('footer_text', $settings['footer_text']) }}" required>
                                @error('footer_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Analytics</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="google_analytics_id" class="form-label">Google Analytics ID</label>
                                <input type="text" class="form-control @error('google_analytics_id') is-invalid @enderror" id="google_analytics_id" name="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id']) }}">
                                @error('google_analytics_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Your Google Analytics tracking ID (e.g., UA-XXXXXXXXX-X).</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Maintenance Mode</h5>
                            <hr>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1" {{ old('maintenance_mode', $settings['maintenance_mode']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="maintenance_mode">Enable Maintenance Mode</label>
                            </div>
                            
                            <div class="mb-3">
                                <label for="maintenance_message" class="form-label">Maintenance Message</label>
                                <textarea class="form-control @error('maintenance_message') is-invalid @enderror" id="maintenance_message" name="maintenance_message" rows="3">{{ old('maintenance_message', $settings['maintenance_message']) }}</textarea>
                                @error('maintenance_message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">This message will be displayed to visitors when maintenance mode is enabled.</div>
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
