@extends('layouts.admin')

@section('title', 'Contact Message Details - Admin')

@section('content')
<div class="container-fluid">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.contacts.index', request()->query()) }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Messages
        </a>
    </div>

    <!-- Message Details -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-envelope{{ $contact->is_read ? '-open' : '' }} me-2"></i>
                        Message Details
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Message Header -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">From:</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle text-primary me-2"></i>
                                    <strong>{{ $contact->name }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Email:</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                        {{ $contact->email }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Subject:</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-tag text-primary me-2"></i>
                                    <strong>{{ $contact->subject }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-muted">Received:</label>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <span>{{ $contact->created_at->format('F j, Y \a\t H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Badge -->
                    <div class="mb-4">
                        <label class="form-label text-muted">Status:</label>
                        <div>
                            @if($contact->is_read)
                                <span class="badge bg-success fs-6">
                                    <i class="fas fa-envelope-open me-1"></i> Read
                                    @if($contact->read_at)
                                        ({{ $contact->read_at->format('M j, Y H:i') }})
                                    @endif
                                </span>
                            @else
                                <span class="badge bg-danger fs-6">
                                    <i class="fas fa-envelope me-1"></i> Unread
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="mb-4">
                        <label class="form-label text-muted">Message:</label>
                        <div class="border rounded p-3 bg-light">
                            <div class="message-content" style="white-space: pre-wrap;">{{ $contact->message }}</div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 justify-content-end">
                        @if($contact->is_read)
                            <form method="POST" action="{{ route('admin.contacts.mark-unread', $contact) }}"
                                  onsubmit="return confirm('Mark this message as unread?')">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-outline-warning">
                                    <i class="fas fa-undo me-2"></i> Mark as Unread
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('admin.contacts.mark-read', $contact) }}">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="fas fa-check me-2"></i> Mark as Read
                                </button>
                            </form>
                        @endif

                        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}"
                           class="btn btn-primary">
                            <i class="fas fa-reply me-2"></i> Reply via Email
                        </a>

                        <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                              class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-2"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar with Quick Actions -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i> Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}"
                           class="btn btn-primary">
                            <i class="fas fa-reply me-2"></i> Reply Now
                        </a>

                        <button type="button" class="btn btn-outline-info" onclick="copyToClipboard()">
                            <i class="fas fa-copy me-2"></i> Copy Details
                        </button>

                        <a href="{{ route('admin.contacts.index', ['search' => $contact->email]) }}"
                           class="btn btn-outline-secondary">
                            <i class="fas fa-search me-2"></i> Find Similar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card shadow mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-address-card me-2"></i> Contact Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong><br>
                        {{ $contact->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong><br>
                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                    </div>
                    <div class="mb-3">
                        <strong>Subject:</strong><br>
                        {{ $contact->subject }}
                    </div>
                    <div class="mb-0">
                        <strong>Received:</strong><br>
                        <small class="text-muted">
                            {{ $contact->created_at->format('F j, Y \a\t H:i') }}<br>
                            ({{ $contact->created_at->diffForHumans() }})
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function copyToClipboard() {
    const contactInfo = `
Name: {{ $contact->name }}
Email: {{ $contact->email }}
Subject: {{ $contact->subject }}
Date: {{ $contact->created_at->format('F j, Y H:i') }}

Message:
{{ $contact->message }}
    `.trim();

    navigator.clipboard.writeText(contactInfo).then(function() {
        // Show success message
        const alert = document.createElement('div');
        alert.className = 'alert alert-success alert-dismissible fade show position-fixed';
        alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        alert.innerHTML = `
            <i class="fas fa-check-circle me-2"></i> Contact details copied to clipboard!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(alert);

        // Auto dismiss after 3 seconds
        setTimeout(() => {
            alert.remove();
        }, 3000);
    }).catch(function(err) {
        alert('Failed to copy: ' + err);
    });
}
</script>
@endsection