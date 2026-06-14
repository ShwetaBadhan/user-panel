@extends('layouts.master')
@section('title', 'Fund Summary')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box shadow-sm border-0">
                        <h4 class="mb-0 fs-20">
                            <i class="las la-chart-pie text-primary me-2"></i>FUND SUMMARY
                        </h4>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('user.fund-summary') }}">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-3">
                                <label class="form-label text-muted fw-medium">Select Type</label>
                                <select name="type" class="form-select">
                                    <option value="">Select</option>
                                    <option value="ADMIN CREDIT" {{ request('type') == 'ADMIN CREDIT' ? 'selected' : '' }}>ADMIN CREDIT</option>
                                    <option value="ADMIN DEBIT" {{ request('type') == 'ADMIN DEBIT' ? 'selected' : '' }}>ADMIN DEBIT</option>
                                    <option value="Admin Transfer" {{ request('type') == 'Admin Transfer' ? 'selected' : '' }}>Admin Transfer</option>
                                    <option value="Credit Transfer" {{ request('type') == 'Credit Transfer' ? 'selected' : '' }}>Credit Transfer</option>
                                    <option value="Debit Transfer" {{ request('type') == 'Debit Transfer' ? 'selected' : '' }}>Debit Transfer</option>
                                    <option value="Product Purchase" {{ request('type') == 'Product Purchase' ? 'selected' : '' }}>Product Purchase</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-muted fw-medium">Date From</label>
                                <input type="date" name="date_from" class="form-control" 
                                       value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-muted fw-medium">Date To</label>
                                <input type="date" name="date_to" class="form-control" 
                                       value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn w-100 text-white" 
                                        style="background: #1e3a5f; border: none;">
                                    <i class="las la-search me-1"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Fund Summary Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle mb-0" id="fundSummaryTable">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" style="width: 60px;">SrNo</th>
                                    <th>Username</th>
                                    <th>Date</th>
                                    <th>Particular</th>
                                    <th>Remark</th>
                                    <th class="text-center">Credit</th>
                                    <th class="text-center">Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($fundSummaries as $index => $fund)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td><span class="fw-semibold">{{ $fund->username ?? 'N/A' }}</span></td>
                                    <td>
                                        @if($fund->transaction_date)
                                            {{ \Carbon\Carbon::parse($fund->transaction_date)->format('d-m-Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $fund->particular ?? 'N/A' }}</td>
                                    <td>{{ $fund->remark ?? '-' }}</td>
                                    <td class="text-center">
                                        @if($fund->credit > 0)
                                            <span class="text-success fw-bold">{{ number_format($fund->credit, 2) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($fund->debit > 0)
                                            <span class="text-danger fw-bold">₹{{ number_format($fund->debit, 2) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="py-5">
                                            <i class="las la-chart-pie fs-1 text-muted d-block mb-3"></i>
                                            <h5 class="text-muted">No Fund Summary Found</h5>
                                            <p class="text-muted mb-0">No transactions available for the selected filters.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <td colspan="5" class="text-end fw-bold">Total</td>
                                    <td class="text-center fw-bold text-success">₹{{ number_format($totals->credit ?? 0, 2) }}</td>
                                    <td class="text-center fw-bold text-danger">₹{{ number_format($totals->debit ?? 0, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endpush

@push('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
    $('#fundSummaryTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries available",
            infoFiltered: "(filtered from _MAX_ total entries)",
            zeroRecords: "No matching records found",
            emptyTable: "No data available in table"
        },
        order: [[2, 'desc']], // Sort by Date column (index 2)
        columnDefs: [
            { orderable: false, targets: [0] } // Disable sorting on SrNo column
        ],
        footerCallback: function(row, data, start, end, display) {
            // This keeps the total row visible even with pagination
        }
    });
});
</script>
@endpush