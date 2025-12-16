@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-4">
        <h1 class="h3 mb-0">Edit Role: {{ $role->name }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    @if($role->is_system)
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>System Role:</strong> You can modify permissions but cannot change the role name or delete this role.
        </div>
    @endif

    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Role Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $role->name) }}" 
                                   {{ $role->is_system ? 'readonly' : 'required' }}>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3"
                                      {{ $role->is_system ? 'readonly' : '' }}>{{ old('description', $role->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Permissions</h5>
                        <small class="text-muted">
                            {{ count($rolePermissions) }} of {{ array_sum(array_map('count', $permissions)) }} permissions assigned
                        </small>
                    </div>
                    <div class="card-body">
                        @foreach($modules as $moduleKey => $moduleLabel)
                            @if(isset($permissions[$moduleKey]))
                                @php
                                    $modulePermissionIds = collect($permissions[$moduleKey])->pluck('id')->toArray();
                                    $moduleCheckedCount = count(array_intersect($modulePermissionIds, $rolePermissions));
                                @endphp
                                <div class="permission-module mb-4 pb-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">
                                            <i class="fas fa-folder text-primary me-2"></i>
                                            {{ $moduleLabel }}
                                            <span class="badge bg-secondary ms-2">{{ $moduleCheckedCount }}/{{ count($permissions[$moduleKey]) }}</span>
                                        </h6>
                                        <div class="form-check">
                                            <input class="form-check-input select-all-module" 
                                                   type="checkbox" 
                                                   id="selectAll{{ $moduleKey }}"
                                                   data-module="{{ $moduleKey }}"
                                                   {{ $moduleCheckedCount == count($permissions[$moduleKey]) ? 'checked' : '' }}>
                                            <label class="form-check-label text-muted small" for="selectAll{{ $moduleKey }}">
                                                Select All
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div class="row g-2">
                                        @foreach($permissions[$moduleKey] as $permission)
                                            <div class="col-md-3 col-sm-6">
                                                <div class="form-check">
                                                    <input class="form-check-input permission-checkbox" 
                                                           type="checkbox" 
                                                           name="permissions[]" 
                                                           value="{{ $permission->id }}"
                                                           id="permission{{ $permission->id }}"
                                                           data-module="{{ $moduleKey }}"
                                                           {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission{{ $permission->id }}">
                                                        <i class="fas fa-{{ $permission->action == 'view' ? 'eye' : ($permission->action == 'create' ? 'plus' : ($permission->action == 'edit' ? 'edit' : 'trash')) }} me-1 text-muted"></i>
                                                        {{ ucfirst($permission->action) }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        @error('permissions')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Update Role
                            </button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                        </div>

                        <hr>

                        <div class="alert alert-info mb-0">
                            <small>
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Users:</strong> {{ $role->users()->count() }} user(s) currently have this role.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle "Select All" for each module
    document.querySelectorAll('.select-all-module').forEach(selectAllCheckbox => {
        selectAllCheckbox.addEventListener('change', function() {
            const module = this.dataset.module;
            const checkboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updatePermissionCount();
        });
    });

    // Update "Select All" checkbox when individual permissions change
    document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const module = this.dataset.module;
            const allCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]`);
            const checkedCheckboxes = document.querySelectorAll(`.permission-checkbox[data-module="${module}"]:checked`);
            const selectAllCheckbox = document.querySelector(`.select-all-module[data-module="${module}"]`);
            
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = allCheckboxes.length === checkedCheckboxes.length;
            }
            updatePermissionCount();
        });
    });

    function updatePermissionCount() {
        // Update module badges
        document.querySelectorAll('.permission-module').forEach(module => {
            const moduleKey = module.querySelector('.select-all-module').dataset.module;
            const totalCheckboxes = module.querySelectorAll('.permission-checkbox').length;
            const checkedCheckboxes = module.querySelectorAll('.permission-checkbox:checked').length;
            const badge = module.querySelector('.badge');
            if (badge) {
                badge.textContent = `${checkedCheckboxes}/${totalCheckboxes}`;
            }
        });
    }
});
</script>
@endpush
@endsection
