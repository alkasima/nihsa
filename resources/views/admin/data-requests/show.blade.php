@extends('layouts.admin')

@section('title', 'View Data Request')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.data-requests.index') }}">Data Requests Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Request</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">View Data Request</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('admin.data-requests.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>
    
    <!-- Use real data from controller -->
    
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Request Details</h5>
                </div>
                <div class="card-body">
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
                            <h6 class="fw-bold">Organization</h6>
                            <p>{{ $dataRequest->organization ?? 'Not specified' }}</p>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="fw-bold">Purpose of Request</h6>
                        <p>{{ $dataRequest->description }}</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold">Additional Information</h6>
                        <p>{{ $dataRequest->additional_info ?? 'No additional information provided' }}</p>
                    </div>
                    
                    @if($request['status'] == 'approved')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Estimated Delivery Date</h6>
                                <p>{{ date('F j, Y', strtotime($request['estimated_delivery'])) }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Notes</h6>
                                <p>{{ $request['notes'] ?? 'No notes provided' }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($request['status'] == 'rejected')
                        <div class="mb-4">
                            <h6 class="fw-bold">Reason for Rejection</h6>
                            <p>{{ $request['rejection_reason'] }}</p>
                        </div>
                    @endif
                    
                    @if($request['status'] == 'delivered')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Delivered On</h6>
                                <p>{{ date('F j, Y g:i A', strtotime($request['delivered_at'])) }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Delivered By</h6>
                                <p>{{ $request['delivered_by'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            @if($request['status'] == 'pending')
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Process Request</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#approveModal">
                                    <i class="fas fa-check me-1"></i> Approve Request
                                </button>
                                
                                <!-- Approve Modal -->
                                <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approveModalLabel">Approve Data Request</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.data-requests.approve', $request['id']) }}" method="POST">
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
                            </div>

                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#rejectModal">
                                    <i class="fas fa-times me-1"></i> Reject Request
                                </button>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rejectModalLabel">Reject Data Request</h5>
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
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
            @if($request['status'] == 'approved')
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Deliver Data</h5>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="data_file" class="form-label">Upload Data File</label>
                                <input type="file" class="form-control" id="data_file" name="data_file" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="delivery_notes" class="form-label">Delivery Notes</label>
                                <textarea class="form-control" id="delivery_notes" name="delivery_notes" rows="3" placeholder="Add any notes or instructions for the requester"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i> Deliver Data
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Requester Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="fw-bold">Name</h6>
                        <p>{{ $dataRequest->name }}</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold">Email</h6>
                        <p><a href="mailto:{{ $dataRequest->email }}">{{ $dataRequest->email }}</a></p>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold">Phone</h6>
                        <p><a href="tel:{{ $dataRequest->phone }}">{{ $dataRequest->phone }}</a></p>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold">Organization</h6>
                        <p>{{ $dataRequest->organization ?? 'Not specified' }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="mailto:{{ $dataRequest->email }}" class="btn btn-outline-primary w-100 mb-2">
                            <i class="fas fa-envelope me-1"></i> Send Email
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Activity Log</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item mb-3 pb-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold">Request Submitted</div>
                                    <div class="text-muted small">May 5, 2025 - 10:30 AM</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="timeline-item mb-3 pb-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <div class="fw-bold">Request Viewed</div>
                                    <div class="text-muted small">May 5, 2025 - 11:45 AM</div>
                                    <div class="text-muted small">by Admin User</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional activity items would be added here based on the request status -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
