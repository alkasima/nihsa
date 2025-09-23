@extends('layouts.admin')

@section('title', 'Zonal Offices Management')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Zonal Offices Management</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Zonal Offices Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.zonal-offices.create') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-plus me-1"></i> Add New Office
                </a>
            </div>
        </div>
    </div>

    <!-- Zonal Offices List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-admin">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>States Covered</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($zonalOffices as $zonalOffice)
                            <tr>
                                <td>{{ $zonalOffice->id }}</td>
                                <td>
                                    <strong>{{ $zonalOffice->name }}</strong>
                                    @if($zonalOffice->description)
                                        <br><small class="text-muted">{{ Str::limit($zonalOffice->description, 50) }}</small>
                                    @endif
                                </td>
                                <td>{{ $zonalOffice->location }}</td>
                                <td>
                                    <small>{{ Str::limit($zonalOffice->address, 40) }}</small>
                                </td>
                                <td>
                                    @if($zonalOffice->phone)
                                        <div><i class="fas fa-phone text-success me-1"></i> {{ $zonalOffice->phone }}</div>
                                    @endif
                                    @if($zonalOffice->email)
                                        <div><i class="fas fa-envelope text-primary me-1"></i> {{ $zonalOffice->email }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $zonalOffice->states_covered }}</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" title="View" data-bs-toggle="modal" data-bs-target="#viewModal{{ $zonalOffice->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.zonal-offices.edit', $zonalOffice->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $zonalOffice->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $zonalOffice->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $zonalOffice->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $zonalOffice->id }}">{{ $zonalOffice->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <h6 class="fw-bold">Location</h6>
                                                    <p>{{ $zonalOffice->location }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="fw-bold">Contact</h6>
                                                    <p>
                                                        @if($zonalOffice->phone)
                                                            <div><i class="fas fa-phone me-1"></i> {{ $zonalOffice->phone }}</div>
                                                        @endif
                                                        @if($zonalOffice->email)
                                                            <div><i class="fas fa-envelope me-1"></i> {{ $zonalOffice->email }}</div>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h6 class="fw-bold">Address</h6>
                                                    <p>{{ $zonalOffice->address }}</p>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-12">
                                                    <h6 class="fw-bold">States Covered</h6>
                                                    <p><span class="badge bg-info">{{ $zonalOffice->states_covered }}</span></p>
                                                </div>
                                            </div>

                                            @if($zonalOffice->description)
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <h6 class="fw-bold">Description</h6>
                                                        <p>{{ $zonalOffice->description }}</p>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($zonalOffice->latitude && $zonalOffice->longitude)
                                                <div class="row mb-4">
                                                    <div class="col-12">
                                                        <h6 class="fw-bold">Coordinates</h6>
                                                        <p>
                                                            <i class="fas fa-map-marker-alt me-1"></i>
                                                            Latitude: {{ $zonalOffice->latitude }},
                                                            Longitude: {{ $zonalOffice->longitude }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="{{ route('admin.zonal-offices.edit', $zonalOffice->id) }}" class="btn btn-primary">
                                                <i class="fas fa-edit me-1"></i> Edit Office
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $zonalOffice->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $zonalOffice->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $zonalOffice->id }}">Delete Zonal Office</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete <strong>{{ $zonalOffice->name }}</strong>?</p>
                                            <p class="text-muted">This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.zonal-offices.destroy', $zonalOffice->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Office</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-building fa-3x mb-3"></i>
                                        <h5>No Zonal Offices Found</h5>
                                        <p>There are no zonal offices in the system yet.</p>
                                        <a href="{{ route('admin.zonal-offices.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Add First Office
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($zonalOffices->hasPages())
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        {{ $zonalOffices->links() }}
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@endsection