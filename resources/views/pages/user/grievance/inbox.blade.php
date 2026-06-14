@extends('layouts.master')
@section('title', 'Grievance Inbox')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box shadow-sm border-0">
                        <h4 class="mb-0 fs-20">
                            <i class="las la-inbox text-primary me-2"></i>GRIEVANCE INBOX
                            <small class="text-muted fs-14 ms-2">(Replies from admin)</small>
                        </h4>
                    </div>
                </div>
            </div>

            <!-- Toast -->
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                <div id="mainToast" class="toast align-items-center text-white border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body" id="toastMessage"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>

            <!-- Raise Ticket Button -->
            <div class="mb-3">
                <a href="{{ route('user.grievance.raise-ticket') }}" class="btn btn-primary" style="background: #1e3a5f; border: none;">
                    <i class="las la-plus-circle me-1"></i> Raise New Ticket
                </a>
            </div>

            <!-- Filter -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form id="filterForm">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label text-muted fw-medium">Filter by Status</label>
                                <select name="status" id="statusFilter" class="form-select">
                                    <option value="">All</option>
                                    <option value="open">Open</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn w-100 text-white" style="background: #1e3a5f; border: none;">
                                    <i class="las la-search me-1"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle mb-0" id="inboxTable">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th>Ticket No</th>
                                    <th>Subject</th>
                                    <th>Category</th>
                                    <th>Reply Date</th>
                                    <th class="text-center">Status</th>
                                    <th>Admin Reply</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
let dataTable;

const statusBadge = {
    open:        '<span class="badge bg-primary">Open</span>',
    in_progress: '<span class="badge bg-warning text-dark">In Progress</span>',
    resolved:    '<span class="badge bg-success">Resolved</span>',
    closed:      '<span class="badge bg-secondary">Closed</span>',
};

function showToast(message, type = 'success') {
    const toast = document.getElementById('mainToast');
    const toastMessage = document.getElementById('toastMessage');
    toast.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');
    toast.classList.add(type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : 'bg-warning');
    toastMessage.textContent = message;
    new bootstrap.Toast(toast, { delay: 4000 }).show();
}

function formatDate(dateStr) {
    if (!dateStr) return 'N/A';
    const d = new Date(dateStr);
    return d.toLocaleDateString('en-IN', { day: '2-digit', month: '2-digit', year: 'numeric' });
}

function loadInbox(status = '') {
    dataTable.clear().draw();

    fetch(`{{ route('user.grievance.inbox.data') }}?status=${status}`, {
        headers: { 'Accept': 'application/json' }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success && data.data && data.data.length > 0) {
            data.data.forEach((item, index) => {
                const adminReply = item.admin_reply
                    ? `<span title="${item.admin_reply}">${item.admin_reply.substring(0, 60)}${item.admin_reply.length > 60 ? '...' : ''}</span>`
                    : '<span class="text-muted fst-italic">No reply yet</span>';

                dataTable.row.add([
                    index + 1,
                    `<span class="badge bg-light text-dark fw-bold">${item.ticket_no ?? ('#' + item.id)}</span>`,
                    item.subject ?? 'N/A',
                    item.category ?? 'N/A',
                    formatDate(item.replied_at ?? item.updated_at),
                    statusBadge[item.status] ?? `<span class="badge bg-secondary">${item.status ?? 'N/A'}</span>`,
                    adminReply,
                ]);
            });
            dataTable.draw();
        } else if (!data.success) {
            showToast(data.message || 'Failed to load inbox.', 'error');
        }
    })
    .catch(() => showToast('Failed to load data. Please try again.', 'error'));
}

document.addEventListener('DOMContentLoaded', function () {
    dataTable = $('#inboxTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: { emptyTable: 'No admin replies yet.' },
        columnDefs: [{ orderable: false, targets: [5, 6] }],
    });

    loadInbox();
});

document.getElementById('filterForm').addEventListener('submit', function (e) {
    e.preventDefault();
    loadInbox(document.getElementById('statusFilter').value);
});
</script>
@endpush
