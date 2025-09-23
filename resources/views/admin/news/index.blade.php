@extends('layouts.admin')

@section('title', 'News Management')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">News Management</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">News Management</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Add News
            </a>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.news.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search by title or content" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">All Categories</option>
                        <option value="News" {{ request('category') == 'News' ? 'selected' : '' }}>News</option>
                        <option value="Press Release" {{ request('category') == 'Press Release' ? 'selected' : '' }}>Press Release</option>
                        <option value="Event" {{ request('category') == 'Event' ? 'selected' : '' }}>Event</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date_range" class="form-label">Date Range</label>
                    <select class="form-select" id="date_range" name="date_range">
                        <option value="">All Time</option>
                        <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                        <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                        <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
                        <option value="year" {{ request('date_range') == 'year' ? 'selected' : '' }}>This Year</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- News List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-admin">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Published Date</th>
                            <th>Featured</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Use the paginated results from controller
                            $newsList = $news;
                        @endphp

                        @foreach($newsList as $news)
                            <tr>
                                <td>{{ $news->id }}</td>
                                <td>{{ $news->title }}</td>
                                <td><span class="badge bg-secondary">{{ $news->category }}</span></td>
                                <td>{{ $news->published_at ? $news->published_at->format('M d, Y') : 'Unpublished' }}</td>
                                <td>
                                    @if($news->is_featured)
                                        <span class="badge bg-success">Featured</span>
                                    @else
                                        <span class="badge bg-light text-dark">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('news.show', $news->id) }}" class="btn btn-sm btn-outline-primary" target="_blank" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.news.edit', $news->id) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $news->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $news->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $news->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $news->id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the news article "{{ $news->title }}"? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Publish / Unpublish --}}
                                    @if($news->published_at)
                                        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" style="display:inline-block;margin-left:6px;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="title" value="{{ $news->title }}">
                                            <input type="hidden" name="content" value="{{ $news->content }}">
                                            <input type="hidden" name="category" value="{{ $news->category }}">
                                            <input type="hidden" name="is_featured" value="{{ $news->is_featured ? 1 : 0 }}">
                                            <input type="hidden" name="published_at" value="">
                                            <button class="btn btn-sm btn-outline-warning" onclick="return confirm('Unpublish this news item?')">Unpublish</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" style="display:inline-block;margin-left:6px;">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="title" value="{{ $news->title }}">
                                            <input type="hidden" name="content" value="{{ $news->content }}">
                                            <input type="hidden" name="category" value="{{ $news->category }}">
                                            <input type="hidden" name="is_featured" value="{{ $news->is_featured ? 1 : 0 }}">
                                            <input type="hidden" name="published_at" value="{{ now() }}">
                                            <button class="btn btn-sm btn-outline-success">Publish</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4">
                {{ $newsList->appends(request()->query())->links() }}
            </nav>
        </div>
    </div>
@endsection
