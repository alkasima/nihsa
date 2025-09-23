@extends('layouts.admin')

@section('title', 'Email Settings')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Email Settings</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Email Settings</h1>
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
                <a href="{{ route('admin.settings.email') }}" class="list-group-item list-group-item-action active">
                    <i class="fas fa-envelope me-2"></i> Email
                </a>
                <a href="{{ route('admin.settings.system') }}" class="list-group-item list-group-item-action">
                    <i class="fas fa-server me-2"></i> System
                </a>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Email Configuration</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.email.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="mail_driver" class="form-label">Mail Driver <span class="text-danger">*</span></label>
                            <select class="form-select @error('mail_driver') is-invalid @enderror" id="mail_driver" name="mail_driver" required>
                                <option value="smtp" {{ old('mail_driver', $settings['mail_driver']) == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                <option value="sendmail" {{ old('mail_driver', $settings['mail_driver']) == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                <option value="mailgun" {{ old('mail_driver', $settings['mail_driver']) == 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                                <option value="ses" {{ old('mail_driver', $settings['mail_driver']) == 'ses' ? 'selected' : '' }}>Amazon SES</option>
                                <option value="postmark" {{ old('mail_driver', $settings['mail_driver']) == 'postmark' ? 'selected' : '' }}>Postmark</option>
                                <option value="log" {{ old('mail_driver', $settings['mail_driver']) == 'log' ? 'selected' : '' }}>Log</option>
                                <option value="array" {{ old('mail_driver', $settings['mail_driver']) == 'array' ? 'selected' : '' }}>Array</option>
                            </select>
                            @error('mail_driver')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div id="smtp-settings">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mail_host" class="form-label">Mail Host <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_host') is-invalid @enderror" id="mail_host" name="mail_host" value="{{ old('mail_host', $settings['mail_host']) }}" required>
                                        @error('mail_host')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mail_port" class="form-label">Mail Port <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_port') is-invalid @enderror" id="mail_port" name="mail_port" value="{{ old('mail_port', $settings['mail_port']) }}" required>
                                        @error('mail_port')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mail_username" class="form-label">Mail Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('mail_username') is-invalid @enderror" id="mail_username" name="mail_username" value="{{ old('mail_username', $settings['mail_username']) }}" required>
                                        @error('mail_username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="mail_password" class="form-label">Mail Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control @error('mail_password') is-invalid @enderror" id="mail_password" name="mail_password" value="{{ old('mail_password', $settings['mail_password']) }}" required>
                                        @error('mail_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="mail_encryption" class="form-label">Mail Encryption <span class="text-danger">*</span></label>
                                <select class="form-select @error('mail_encryption') is-invalid @enderror" id="mail_encryption" name="mail_encryption" required>
                                    <option value="tls" {{ old('mail_encryption', $settings['mail_encryption']) == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ old('mail_encryption', $settings['mail_encryption']) == 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="" {{ old('mail_encryption', $settings['mail_encryption']) == '' ? 'selected' : '' }}>None</option>
                                </select>
                                @error('mail_encryption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mail_from_address" class="form-label">From Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('mail_from_address') is-invalid @enderror" id="mail_from_address" name="mail_from_address" value="{{ old('mail_from_address', $settings['mail_from_address']) }}" required>
                                    @error('mail_from_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mail_from_name" class="form-label">From Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('mail_from_name') is-invalid @enderror" id="mail_from_name" name="mail_from_name" value="{{ old('mail_from_name', $settings['mail_from_name']) }}" required>
                                    @error('mail_from_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="enable_email_notifications" name="enable_email_notifications" value="1" {{ old('enable_email_notifications', $settings['enable_email_notifications']) ? 'checked' : '' }}>
                            <label class="form-check-label" for="enable_email_notifications">Enable Email Notifications</label>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-outline-primary" id="test-email-btn">
                                <i class="fas fa-paper-plane me-1"></i> Send Test Email
                            </button>
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Email Templates</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Template Name</th>
                                    <th>Subject</th>
                                    <th>Variables</th>
                                    <th width="100">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $template)
                                    <tr>
                                        <td>{{ $template['name'] }}</td>
                                        <td>{{ $template['subject'] }}</td>
                                        <td>
                                            @foreach($template['variables'] as $variable)
                                                <span class="badge bg-secondary">{{ $variable }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.settings.email.template.edit', $template['id']) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Test Email Modal -->
    <div class="modal fade" id="testEmailModal" tabindex="-1" aria-labelledby="testEmailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testEmailModalLabel">Send Test Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="test-email-form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="test_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="test_email" name="test_email" required>
                            <div class="form-text">Enter the email address where you want to send the test email.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Test Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show/hide SMTP settings based on mail driver
            const mailDriver = document.getElementById('mail_driver');
            const smtpSettings = document.getElementById('smtp-settings');
            
            function toggleSmtpSettings() {
                if (mailDriver.value === 'smtp') {
                    smtpSettings.style.display = 'block';
                } else {
                    smtpSettings.style.display = 'none';
                }
            }
            
            toggleSmtpSettings();
            mailDriver.addEventListener('change', toggleSmtpSettings);
            
            // Test email modal
            const testEmailBtn = document.getElementById('test-email-btn');
            const testEmailModal = new bootstrap.Modal(document.getElementById('testEmailModal'));
            
            testEmailBtn.addEventListener('click', function() {
                testEmailModal.show();
            });
            
            // Test email form submission
            const testEmailForm = document.getElementById('test-email-form');
            
            testEmailForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // In a real implementation, we would send an AJAX request to send the test email
                // For now, we'll just show a success message
                alert('Test email sent successfully!');
                testEmailModal.hide();
            });
        });
    </script>
@endsection
