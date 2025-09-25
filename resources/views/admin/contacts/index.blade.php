@extends('layouts.admin')

@section('title', 'Contact Messages - Admin')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Contact Messages</h1>
            <p class="text-muted">Manage contact form submissions</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-primary" onclick="bulkMarkAsRead()">
                <i class="fas fa-envelope-open me-1"></i> Mark Selected as Read
            </button>
            <button type="button" class="btn btn-outline-danger" onclick="bulkDelete()">
                <i class="fas fa-trash me-1"></i> Delete Selected
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Messages
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Unread Messages
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $unreadCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Read Messages
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $readCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs card-header-tabs" id="contactTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ request('status', 'all') === 'all' ? 'active' : '' }}"
                       href="{{ route('admin.contacts.index') }}">
                        All ({{ $totalCount }})
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ request('status') === 'unread' ? 'active' : '' }}"
                       href="{{ route('admin.contacts.index', ['status' => 'unread']) }}">
                        Unread ({{ $unreadCount }})
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ request('status') === 'read' ? 'active' : '' }}"
                       href="{{ route('admin.contacts.index', ['status' => 'read']) }}">
                        Read ({{ $readCount }})
                    </a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <!-- Search Form -->
            <form method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search"
                                   placeholder="Search by name, email, subject, or message..."
                                   value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>All Status</option>
                            <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Bulk Actions Form -->
            <form id="bulkActionsForm" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="contact_ids[]" id="selectedContacts">
            </form>

            <!-- Messages Table -->
            @if($contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                </th>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message Preview</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                                <tr class="{{ $contact->is_read ? 'table-light' : 'table-warning' }}">
                                    <td>
                                        <input type="checkbox" class="form-check-input contact-checkbox"
                                               value="{{ $contact->id }}" form="bulkActionsForm">
                                    </td>
                                    <td>
                                        @if($contact->is_read)
                                            <span class="badge bg-success">
                                                <i class="fas fa-envelope-open me-1"></i> Read
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-envelope me-1"></i> Unread
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $contact->name }}</strong>
                                    </td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ Str::limit($contact->subject, 30) }}</td>
                                    <td>{{ Str::limit(strip_tags($contact->message), 50) }}</td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $contact->created_at->format('M j, Y') }}<br>
                                            {{ $contact->created_at->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.contacts.show', $contact) }}"
                                               class="btn btn-sm btn-outline-primary" title="View Message">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($contact->is_read)
                                                <form method="POST" action="{{ route('admin.contacts.mark-unread', $contact) }}"
                                                      class="d-inline" onsubmit="return confirm('Mark this message as unread?')">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-sm btn-outline-warning" title="Mark as Unread">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('admin.contacts.mark-read', $contact) }}"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-sm btn-outline-success" title="Mark as Read">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $contacts->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No contact messages found</h5>
                    <p class="text-muted">Contact messages will appear here when users submit the contact form.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all checkbox functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const contactCheckboxes = document.querySelectorAll('.contact-checkbox');

    selectAllCheckbox.addEventListener('change', function() {
        contactCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Update select all when individual checkboxes change
    contactCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
            selectAllCheckbox.checked = checkedBoxes.length === contactCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < contactCheckboxes.length;
        });
    });
});

function bulkMarkAsRead() {
    const selectedContacts = getSelectedContacts();
    if (selectedContacts.length === 0) {
        alert('Please select at least one message.');
        return;
    }

    if (confirm(`Mark ${selectedContacts.length} messages as read?`)) {
        const form = document.getElementById('bulkActionsForm');
        form.action = '{{ route("admin.contacts.bulk-mark-read") }}';
        document.getElementById('selectedContacts').value = JSON.stringify(selectedContacts);
        form.submit();
    }
}

function bulkDelete() {
    const selectedContacts = getSelectedContacts();
    if (selectedContacts.length === 0) {
        alert('Please select at least one message.');
        return;
    }

    if (confirm(`Delete ${selectedContacts.length} messages? This action cannot be undone.`)) {
        const form = document.getElementById('bulkActionsForm');
        form.action = '{{ route("admin.contacts.bulk-delete") }}';
        document.getElementById('selectedContacts').value = JSON.stringify(selectedContacts);
        form.submit();
    }
}

function getSelectedContacts() {
    return Array.from(document.querySelectorAll('.contact-checkbox:checked')).map(cb => parseInt(cb.value));
}
</script>
@endsection