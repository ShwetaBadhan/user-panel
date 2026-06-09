@extends('layouts.master')
@section("title", "Update Profile")
@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($user && $user->profile_update_count >= 1)
            <div class="alert alert-warning">
                <strong>(YOU UPDATED YOUR PROFILE {{ $user->profile_update_count }} TIME, SECOND TIME YOU CAN UPDATE YOUR PROFILE BY ADMIN)</strong>
            </div>
        @else
            <div class="alert alert-info">
                <strong>Note:</strong> 
You can update your profile only <b>1 time</b>. Fill in carefully!
            </div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf

            <!-- PERSONAL DETAIL -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0">PERSONAL DETAIL</h5></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{ $user->first_name }} {{ $user->last_name }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Father Name</label>
                            <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $user->father_name) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Enter Date Of Birth</label>
                            <input type="date" name="dob" class="form-control" value="{{ old('dob', $user->dob) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sex</label>
                            <select name="sex" class="form-control">
                                <option value="">Select</option>
                                <option value="Male" {{ old('sex', $user->sex) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('sex', $user->sex) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('sex', $user->sex) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">PinCode</label>
                            <input type="text" name="pincode" class="form-control" value="{{ old('pincode', $user->pincode) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">GSTIN</label>
                            <input type="text" name="gstin" class="form-control" value="{{ old('gstin', $user->gstin) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mobile</label>
                            <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <input type="text" class="form-control" value="{{ $user->is_active ? 'Active' : 'Inactive' }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">State</label>
                            <input type="text" name="state" class="form-control" value="{{ old('state', $user->state) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">District</label>
                            <input type="text" name="district" class="form-control" value="{{ old('district', $user->district) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ADMISSION DETAIL (Read Only) -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0">ADMISSION DETAIL</h5></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">UserName</label>
                            <input type="text" class="form-control" value="{{ $user->user_name }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">GW No.</label>
                            <input type="text" class="form-control" value="{{ $user->track_id }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sponsor ID</label>
                            <input type="text" class="form-control" value="{{ $user->sponsor->user_name ?? 'N/A' }}" readonly>
                            @if($user->sponsor)
                                <small class="text-muted">{{ $user->sponsor->first_name }} {{ $user->sponsor->last_name }}</small>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Upline ID</label>
                            <input type="text" class="form-control" value="{{ $user->upline->user_name ?? 'N/A' }}" readonly>
                            @if($user->upline)
                                <small class="text-muted">{{ $user->upline->first_name }} {{ $user->upline->last_name }}</small>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date of Joining</label>
                            <input type="text" class="form-control" value="{{ $user->created_at->format('d-m-Y') }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Date of Activation</label>
                            <input type="text" class="form-control" value="{{ $user->activated_at ? $user->activated_at->format('d-m-Y') : 'Not Activated' }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BANK DETAIL -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0">BANK DETAIL</h5></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" value="{{ old('bank_name', $user->bank_name) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Branch Name</label>
                            <input type="text" name="branch_name" class="form-control" value="{{ old('branch_name', $user->branch_name) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Account Type</label>
                            <input type="text" name="account_type" class="form-control" value="{{ old('account_type', $user->account_type) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Account Number</label>
                            <input type="text" name="account_number" class="form-control" value="{{ old('account_number', $user->account_number) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Account Holder Name</label>
                            <input type="text" name="account_holder_name" class="form-control" value="{{ old('account_holder_name', $user->account_holder_name) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IFSC Code</label>
                            <input type="text" name="ifsc_code" class="form-control" value="{{ old('ifsc_code', $user->ifsc_code) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- NOMINEE DETAIL -->
            <div class="card mb-4">
                <div class="card-header"><h5 class="mb-0">NOMINEE DETAIL</h5></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nominee Name</label>
                            <input type="text" name="nominee_name" class="form-control" value="{{ old('nominee_name', $user->nominee_name) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Relation with Nominee</label>
                            <input type="text" name="nominee_relation" class="form-control" value="{{ old('nominee_relation', $user->nominee_relation) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mb-5">
                @if($user->profile_update_count < 1)
                    <button type="submit" class="btn btn-primary px-5 py-2">Update Record</button>
                @else
                    <button type="button" class="btn btn-secondary px-5 py-2" disabled>Update Locked</button>
                @endif
            </div>
        </form>
    </div>
</div>
</div>
@endsection