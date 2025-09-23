@extends('layouts.admin')

@section('title', 'Publications Management')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Publications Management</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Publications Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.publications.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Add Publication
            </a>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.publications.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search by title" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="type">
                        <option value="">All Types</option>
                        <option value="AFO" {{ request('type') == 'AFO' ? 'selected' : '' }}>Annual Flood Outlook</option>
                        <option value="Bulletin" {{ request('type') == 'Bulletin' ? 'selected' : '' }}>Bulletin</option>
                        <option value="Report" {{ request('type') == 'Report' ? 'selected' : '' }}>Report</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="year" class="form-label">Year</label>
                    <select class="form-select" id="year" name="year">
                        <option value="">All Years</option>
                        <option value="2025" {{ request('year') == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2023" {{ request('year') == '2023' ? 'selected' : '' }}>2023</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="featured" class="form-label">Featured</label>
                    <select class="form-select" id="featured" name="featured">
                        <option value="">All</option>
                        <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured</option>
                        <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Not Featured</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Publications List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-admin">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Year</th>
                            <th>Publication Date</th>
                            <th>Featured</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publications as $publication)
                            <tr>
                                <td>{{ $publication['id'] }}</td>
                                <td>{{ $publication['title'] }}</td>
                                <td><span class="badge bg-secondary">{{ $publication['type'] }}</span></td>
                                <td>{{ $publication['year'] }}</td>
                                <td>{{ date('M d, Y', strtotime($publication['publication_date'])) }}</td>
                                <td>
                                    @if($publication['is_featured'])
                                        <span class="badge bg-success">Featured</span>
                                    @else
                                        <span class="badge bg-light text-dark">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('publications.show', $publication['id']) }}" class="btn btn-sm btn-outline-primary" target="_blank" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.publications.edit', $publication['id']) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $publication['id'] }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $publication['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $publication['id'] }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $publication['id'] }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the publication "{{ $publication['title'] }}"? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.publications.destroy', $publication['id']) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
                {{ $publications->appends(request()->query())->links() }}
            </nav>
        </div>
    </div>
@endsection
