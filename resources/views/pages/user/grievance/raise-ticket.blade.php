@extends('layouts.master')
@section('title', 'Raise Ticket')
@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box shadow-sm border-0 d-flex align-item-center justify-content-between gap-3 ">
                        <h4 class="mb-0 fs-20">
                            <i class="las la-ticket-alt text-primary me-2"></i>RAISE TICKET
                        </h4>
                        <a href="{{ route('user.grievance.outbox') }}" class="btn btn-outline-secondary ms-2">
                            <i class="las la-inbox me-1"></i>View My Tickets
                        </a>
                    </div>
                </div>
            </div>

            <!-- Toast -->
            <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                <div id="mainToast" class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body" id="toastMessage"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form id="raiseTicketForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row"> 
                            <div class="mb-3 col-md-6">
                                <label class="form-label text-muted fw-medium">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject" placeholder="Enter ticket subject" required maxlength="255">
                            </div>

                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted fw-medium">Category <span class="text-danger">*</span></label>
                                <select class="form-select" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="dispatch">Dispatch</option>
                                    <option value="e-wallet">E-Wallet</option>
                                    <option value="software-issue">Software Issue</option>
                                    <option value="kyc">KYC</option>
                                    <option value="TDS-and-gst">TDS & GST</option>
                                    <option value="direct-seller">Direct Seller</option>
                                    <option value="product-and-quality">Product & Quality</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Priority -->
                            {{-- <div class="col-md-6 mb-3">
                                <label class="form-label text-muted fw-medium">Priority</label>
                                <select class="form-select" name="priority">
                                    <option value="low">Low</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div> --}}

                            <!-- Description -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted fw-medium">Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" rows="5" placeholder="Describe your issue in detail..." required></textarea>
                            </div>

                            <!-- Attachment -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-muted fw-medium">Attachment <span class="text-muted">(optional)</span></label>
                                <input type="file" class="form-control" name="attachment" id="attachmentInput" accept="image/*,.pdf">
                                <small class="text-muted">Max 2 MB. Accepted: JPG, PNG, PDF</small>
                                <small class="text-danger d-none" id="fileSizeError">File size must not exceed 2 MB.</small>
                            </div>

                            <!-- Submit -->
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary px-4" id="submitBtn" style="background: #1e3a5f; border: none;">
                                    <i class="las la-paper-plane me-2"></i>Submit Ticket
                                </button>
                                
                            </div> 
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function showToast(message, type = 'success') {
    const toast = document.getElementById('mainToast');
    const toastMessage = document.getElementById('toastMessage');
    toast.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');
    toast.classList.add(type === 'success' ? 'bg-success' : type === 'error' ? 'bg-danger' : type === 'warning' ? 'bg-warning' : 'bg-info');
    toastMessage.textContent = message;
    new bootstrap.Toast(toast, { delay: 4000 }).show();
}

// File size check
document.getElementById('attachmentInput').addEventListener('change', function () {
    const file = this.files[0];
    const err = document.getElementById('fileSizeError');
    if (file && file.size > 2 * 1024 * 1024) {
        err.classList.remove('d-none');
        this.value = '';
    } else {
        err.classList.add('d-none');
    }
});

// Form submit
document.getElementById('raiseTicketForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="las la-spinner la-spin me-2"></i>Submitting...';

    const formData = new FormData(this);

    fetch('{{ route("user.grievance.submit") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            showToast('Ticket submitted successfully!', 'success');
            document.getElementById('raiseTicketForm').reset();
        } else {
            showToast(data.message || 'Failed to submit ticket.', 'error');
        }
    })
    .catch(() => showToast('An error occurred. Please try again.', 'error'))
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="las la-paper-plane me-2"></i>Submit Ticket';
    });
});
</script>
@endpush
