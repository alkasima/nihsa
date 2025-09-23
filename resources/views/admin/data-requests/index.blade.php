@extends('layouts.admin')

@section('title', 'Data Requests Management')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Requests Management</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Requests Management</h1>
    </div>
    
    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('admin.data-requests.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Search</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label for="data_type" class="form-label">Data Type</label>
                    <select class="form-select" id="data_type" name="data_type">
                        <option value="">All Types</option>
                        <option value="Flood Data" {{ request('data_type') == 'Flood Data' ? 'selected' : '' }}>Flood Data</option>
                        <option value="Rainfall Data" {{ request('data_type') == 'Rainfall Data' ? 'selected' : '' }}>Rainfall Data</option>
                        <option value="Groundwater Data" {{ request('data_type') == 'Groundwater Data' ? 'selected' : '' }}>Groundwater Data</option>
                        <option value="Surface Water Data" {{ request('data_type') == 'Surface Water Data' ? 'selected' : '' }}>Surface Water Data</option>
                        <option value="Water Quality Data" {{ request('data_type') == 'Water Quality Data' ? 'selected' : '' }}>Water Quality Data</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                </div>
                <div class="col-md-2">
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
    
    <!-- Data Requests List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-admin">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Data Type</th>
                            <th>Purpose</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataRequests as $dataRequest)
                            <tr>
                                <td>{{ $dataRequest->id }}</td>
                                <td>{{ $dataRequest->name }}</td>
                                <td>{{ $dataRequest->email }}</td>
                                <td>{{ $dataRequest->data_type }}</td>
                                <td>{{ Str::limit($dataRequest->description, 30) }}</td>
                                <td>{{ $dataRequest->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if($dataRequest->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($dataRequest->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($dataRequest->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @elseif($dataRequest->status == 'delivered')
                                        <span class="badge bg-info">Delivered</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" title="View" data-bs-toggle="modal" data-bs-target="#viewModal{{ $dataRequest->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if($dataRequest->status == 'pending')
                                            <button type="button" class="btn btn-sm btn-outline-success" title="Approve" data-bs-toggle="modal" data-bs-target="#approveModal{{ $dataRequest->id }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Reject" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $dataRequest->id }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                    
                                    <!-- Approve Modal -->
                                    <div class="modal fade" id="approveModal{{ $dataRequest->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $dataRequest->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="approveModalLabel{{ $dataRequest->id }}">Approve Data Request</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.data-requests.approve', $dataRequest->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>You are about to approve the data request from <strong>{{ $dataRequest->name }}</strong> for <strong>{{ $dataRequest->data_type }}</strong>.</p>
                                                        
                                                        <div class="mb-3">
                                                            <label for="notes" class="form-label">Notes (Optional)</label>
                                                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Add any notes or instructions for the requester"></textarea>
                                                        </div>
                                                        
                                                        <div class="mb-3">
                                                            <label for="estimated_delivery" class="form-label">Estimated Delivery Date</label>
                                                            <input type="date" class="form-control" id="estimated_delivery" name="estimated_delivery" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-success">Approve Request</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $dataRequest->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $dataRequest->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel{{ $dataRequest->id }}">Reject Data Request</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.data-requests.reject', $dataRequest->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>You are about to reject the data request from <strong>{{ $dataRequest->name }}</strong> for <strong>{{ $dataRequest->data_type }}</strong>.</p>
                                                        
                                                        <div class="mb-3">
                                                            <label for="rejection_reason" class="form-label">Reason for Rejection <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3" placeholder="Provide a reason for rejecting this request" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Reject Request</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- View Modal -->
                                    <div class="modal fade" id="viewModal{{ $dataRequest->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $dataRequest->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="viewModalLabel{{ $dataRequest->id }}">Data Request Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Request ID</h6>
                                                            <p>{{ $dataRequest->id }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Status</h6>
                                                            <p>
                                                                @if($dataRequest->status == 'pending')
                                                                    <span class="badge bg-warning">Pending</span>
                                                                @elseif($dataRequest->status == 'approved')
                                                                    <span class="badge bg-success">Approved</span>
                                                                @elseif($dataRequest->status == 'rejected')
                                                                    <span class="badge bg-danger">Rejected</span>
                                                                @elseif($dataRequest->status == 'delivered')
                                                                    <span class="badge bg-info">Delivered</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Date Requested</h6>
                                                            <p>{{ $dataRequest->created_at->format('F j, Y g:i A') }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Data Type</h6>
                                                            <p>{{ $dataRequest->data_type }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Name</h6>
                                                            <p>{{ $dataRequest->name }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Email</h6>
                                                            <p><a href="mailto:{{ $dataRequest->email }}">{{ $dataRequest->email }}</a></p>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Phone</h6>
                                                            <p><a href="tel:{{ $dataRequest->phone }}">{{ $dataRequest->phone }}</a></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Organization</h6>
                                                            <p>{{ $dataRequest->organization ?? 'Not specified' }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Time Period</h6>
                                                            <p>{{ $dataRequest->time_period ?? 'Not specified' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Geographic Area</h6>
                                                            <p>{{ $dataRequest->geographic_area ?? 'Not specified' }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Preferred Data Format</h6>
                                                            <p>{{ $dataRequest->data_format ?? 'Not specified' }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6 class="fw-bold">Additional Information</h6>
                                                            <p>{{ $dataRequest->additional_info ?? 'No additional information provided' }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4">
                                                        <h6 class="fw-bold">Purpose of Request</h6>
                                                        <p>{{ $dataRequest->description }}</p>
                                                    </div>

                                                    @if($dataRequest->status == 'approved')
                                                        <div class="row mb-4">
                                                            <div class="col-md-6">
                                                                <h6 class="fw-bold">Estimated Delivery Date</h6>
                                                                <p>{{ $dataRequest->estimated_delivery ? $dataRequest->estimated_delivery->format('F j, Y') : 'Not set' }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6 class="fw-bold">Notes</h6>
                                                                <p>{{ $dataRequest->admin_notes ?? 'No notes provided' }}</p>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if($dataRequest->status == 'rejected')
                                                        <div class="mb-4">
                                                            <h6 class="fw-bold">Reason for Rejection</h6>
                                                            <p>{{ $dataRequest->rejection_reason }}</p>
                                                        </div>
                                                    @endif

                                                    @if($dataRequest->status == 'delivered')
                                                        <div class="row mb-4">
                                                            <div class="col-md-6">
                                                                <h6 class="fw-bold">Delivered On</h6>
                                                                <p>{{ $dataRequest->delivered_at ? $dataRequest->delivered_at->format('F j, Y g:i A') : 'Not set' }}</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <h6 class="fw-bold">Delivered By</h6>
                                                                <p>{{ $dataRequest->delivered_by ?? 'Not specified' }}</p>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    @if($dataRequest->status == 'pending')
                                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal{{ $dataRequest->id }}">
                                                            <i class="fas fa-check me-1"></i> Approve
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $dataRequest->id }}">
                                                            <i class="fas fa-times me-1"></i> Reject
                                                        </button>
                                                    @endif
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
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
