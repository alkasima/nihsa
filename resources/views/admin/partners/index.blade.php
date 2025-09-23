@extends('layouts.admin')

@section('title', 'Partners Management')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Partners Management</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Partners Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.partners.create') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-plus me-1"></i> Add New Partner
                </a>
            </div>
        </div>
    </div>

    <!-- Partners List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-admin">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Partner Name</th>
                            <th>Type</th>
                            <th>Website</th>
                            <th>Display Order</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $partner)
                            <tr>
                                <td>{{ $partner->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($partner->logo)
                                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="rounded me-2" width="40" height="40">
                                        @else
                                            <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-building text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <strong>{{ $partner->name }}</strong>
                                            @if($partner->description)
                                                <br><small class="text-muted">{{ Str::limit($partner->description, 50) }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($partner->partnership_type)
                                        <span class="badge bg-info">{{ $partner->partnership_type }}</span>
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </td>
                                <td>
                                    @if($partner->website_url)
                                        <a href="{{ $partner->website_url }}" target="_blank" class="text-decoration-none">
                                            <i class="fas fa-external-link-alt me-1"></i>
                                            {{ parse_url($partner->website_url, PHP_URL_HOST) }}
                                        </a>
                                    @else
                                        <span class="text-muted">No website</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $partner->display_order }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" title="View" data-bs-toggle="modal" data-bs-target="#viewModal{{ $partner->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $partner->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $partner->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $partner->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $partner->id }}">
                                                @if($partner->logo)
                                                    <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="rounded me-2" width="30" height="30">
                                                @endif
                                                {{ $partner->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <h6 class="fw-bold">Partnership Type</h6>
                                                    <p>
                                                        @if($partner->partnership_type)
                                                            <span class="badge bg-info">{{ $partner->partnership_type }}</span>
                                                        @else
                                                            <span class="text-muted">Not specified</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="fw-bold">Display Order</h6>
                                                    <p><span class="badge bg-secondary">{{ $partner->display_order }}</span></p>
                                                </div>
                                            </div>

                                            @if($partner->website_url)
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <h6 class="fw-bold">Website</h6>
                                                        <p>
                                                            <a href="{{ $partner->website_url }}" target="_blank" class="text-decoration-none">
                                                                <i class="fas fa-external-link-alt me-1"></i>
                                                                {{ $partner->website_url }}
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($partner->description)
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <h6 class="fw-bold">Description</h6>
                                                        <p>{{ $partner->description }}</p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($partner->logo)
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <h6 class="fw-bold">Logo</h6>
                                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-primary">
                                                <i class="fas fa-edit me-1"></i> Edit Partner
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $partner->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $partner->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $partner->id }}">Delete Partner</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <strong>{{ $partner->name }}</strong>?</p>
                                            <p class="text-muted">This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Partner</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-handshake fa-3x mb-3"></i>
                                        <h5>No Partners Found</h5>
                                        <p>There are no partners in the system yet.</p>
                                        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Add First Partner
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($partners->hasPages())
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        {{ $partners->links() }}
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@endsection