@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Add User</h1>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">User Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Role & Permissions</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Assign Roles <span class="text-danger">*</span></label>
                                    <div class="border rounded p-3">
                                        @forelse($roles as $role)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input @error('roles') is-invalid @enderror" 
                                                       type="checkbox" 
                                                       name="roles[]" 
                                                       value="{{ $role->id }}"
                                                       id="role{{ $role->id }}"
                                                       {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="role{{ $role->id }}">
                                                    <strong>{{ $role->name }}</strong>
                                                    @if($role->is_system)
                                                        <span class="badge bg-primary ms-1">System</span>
                                                    @endif
                                                    @if($role->description)
                                                        <br><small class="text-muted">{{ $role->description }}</small>
                                                    @endif
                                                </label>
                                            </div>
                                        @empty
                                            <p class="text-muted mb-0">No roles available. Please create roles first.</p>
                                        @endforelse
                                    </div>
                                    @error('roles')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Select one or more roles for this user</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Role Permissions Info</label>
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="mb-2"><i class="fas fa-info-circle text-info me-2"></i><small>Users inherit all permissions from their assigned roles.</small></p>
                                            <p class="mb-0"><i class="fas fa-shield-alt text-success me-2"></i><small>Multiple roles can be assigned for combined permissions.</small></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Additional Information</label>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="send_welcome_email" name="send_welcome_email" value="1" checked>
                                        <label class="form-check-label" for="send_welcome_email">
                                            Send welcome email with login details
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="require_password_change" name="require_password_change" value="1" checked>
                                        <label class="form-check-label" for="require_password_change">
                                            Require password change on first login
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Profile Information (Optional)</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
