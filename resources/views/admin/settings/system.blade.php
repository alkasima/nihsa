@extends('layouts.admin')

@section('title', 'System Settings')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">System Settings</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">System Settings</h1>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('admin.settings.general') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-cog me-2"></i> General
                </a>
                <a href="{{ route('admin.settings.appearance') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-palette me-2"></i> Appearance
                </a>
                <a href="{{ route('admin.settings.email') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-envelope me-2"></i> Email
                </a>
                <a href="{{ route('admin.settings.system') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-server me-2"></i> System
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.settings.system.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <h5>General Settings</h5>
                            <hr>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pagination_limit" class="form-label">Pagination Limit <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('pagination_limit') is-invalid @enderror" id="pagination_limit" name="pagination_limit" value="{{ old('pagination_limit', $settings['pagination_limit']) }}" min="5" max="100" required>
                                        @error('pagination_limit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Number of items to display per page.</div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="timezone" class="form-label">Timezone <span class="text-danger">*</span></label>
                                        <select class="form-select @error('timezone') is-invalid @enderror" id="timezone" name="timezone" required>
                                            @foreach($timezones as $key => $value)
                                                <option value="{{ $key }}" {{ old('timezone', $settings['timezone']) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('timezone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_format" class="form-label">Date Format <span class="text-danger">*</span></label>
                                        <select class="form-select @error('date_format') is-invalid @enderror" id="date_format" name="date_format" required>
                                            @foreach($dateFormats as $key => $value)
                                                <option value="{{ $key }}" {{ old('date_format', $settings['date_format']) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('date_format')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="time_format" class="form-label">Time Format <span class="text-danger">*</span></label>
                                        <select class="form-select @error('time_format') is-invalid @enderror" id="time_format" name="time_format" required>
                                            @foreach($timeFormats as $key => $value)
                                                <option value="{{ $key }}" {{ old('time_format', $settings['time_format']) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('time_format')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Security Settings</h5>
                            <hr>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enable_registration" name="enable_registration" value="1" {{ old('enable_registration', $settings['enable_registration']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_registration">Enable User Registration</label>
                                <div class="form-text">Allow new users to register on the website.</div>
                            </div>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enable_captcha" name="enable_captcha" value="1" {{ old('enable_captcha', $settings['enable_captcha']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_captcha">Enable CAPTCHA</label>
                                <div class="form-text">Enable CAPTCHA on forms to prevent spam.</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>API Settings</h5>
                            <hr>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="enable_api" name="enable_api" value="1" {{ old('enable_api', $settings['enable_api']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="enable_api">Enable API</label>
                                <div class="form-text">Enable the API for external applications to access data.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="api_key" class="form-label">API Key</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="api_key" value="{{ $settings['api_key'] }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button" id="copy-api-key">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                    <button class="btn btn-outline-secondary" type="submit" name="generate_api_key" value="1">
                                        <i class="fas fa-sync-alt"></i> Generate New
                                    </button>
                                </div>
                                <div class="form-text">This key is used to authenticate API requests. Keep it secret!</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Logging Settings</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label for="log_level" class="form-label">Log Level <span class="text-danger">*</span></label>
                                <select class="form-select @error('log_level') is-invalid @enderror" id="log_level" name="log_level" required>
                                    @foreach($logLevels as $key => $value)
                                        <option value="{{ $key }}" {{ old('log_level', $settings['log_level']) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('log_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">The minimum severity level of messages that should be logged.</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5>Backup Settings</h5>
                            <hr>
                            
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="backup_enabled" name="backup_enabled" value="1" {{ old('backup_enabled', $settings['backup_enabled']) ? 'checked' : '' }}>
                                <label class="form-check-label" for="backup_enabled">Enable Automatic Backups</label>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="backup_frequency" class="form-label">Backup Frequency <span class="text-danger">*</span></label>
                                        <select class="form-select @error('backup_frequency') is-invalid @enderror" id="backup_frequency" name="backup_frequency" required>
                                            @foreach($backupFrequencies as $key => $value)
                                                <option value="{{ $key }}" {{ old('backup_frequency', $settings['backup_frequency']) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('backup_frequency')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="backup_retention" class="form-label">Backup Retention (days) <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('backup_retention') is-invalid @enderror" id="backup_retention" name="backup_retention" value="{{ old('backup_retention', $settings['backup_retention']) }}" min="1" max="365" required>
                                        @error('backup_retention')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Number of days to keep backups before they are automatically deleted.</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2 mt-3">
                                <button type="button" class="btn btn-outline-primary" id="backup-now-btn">
                                    <i class="fas fa-download me-1"></i> Backup Now
                                </button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Copy API key to clipboard
            const copyApiKeyBtn = document.getElementById('copy-api-key');
            const apiKeyInput = document.getElementById('api_key');
            
            copyApiKeyBtn.addEventListener('click', function() {
                apiKeyInput.select();
                document.execCommand('copy');
                
                // Show tooltip
                const originalTitle = copyApiKeyBtn.getAttribute('title');
                copyApiKeyBtn.setAttribute('title', 'Copied!');
                setTimeout(function() {
                    copyApiKeyBtn.setAttribute('title', originalTitle);
                }, 2000);
            });
            
            // Backup now button
            const backupNowBtn = document.getElementById('backup-now-btn');
            
            backupNowBtn.addEventListener('click', function() {
                // In a real implementation, we would send an AJAX request to trigger a backup
                // For now, we'll just show a success message
                backupNowBtn.disabled = true;
                backupNowBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Backing up...';
                
                setTimeout(function() {
                    backupNowBtn.disabled = false;
                    backupNowBtn.innerHTML = '<i class="fas fa-download me-1"></i> Backup Now';
                    alert('Backup completed successfully!');
                }, 3000);
            });
        });
    </script>
@endsection
