@extends('layouts.master')

@section("title", "Change Transaction Password")

@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="las la-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="las la-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Card -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">CHANGE YOUR TRANSACTION PASSWORD.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.change-transaction-password.update') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="old_transaction_password" class="form-label">Old Transaction Password</label>
                                    <input type="password" 
                                           name="old_transaction_password" 
                                           id="old_transaction_password" 
                                           class="form-control @error('old_transaction_password') is-invalid @enderror"
                                           placeholder="Old New Password"
                                           value="{{ old('old_transaction_password') }}"
                                           required>
                                    @error('old_transaction_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_transaction_password" class="form-label">Input New Transaction Password</label>
                                    <input type="password" 
                                           name="new_transaction_password" 
                                           id="new_transaction_password" 
                                           class="form-control @error('new_transaction_password') is-invalid @enderror"
                                           placeholder="Enter New Password"
                                           required>
                                    @error('new_transaction_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Minimum 6 characters required
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="new_transaction_password_confirmation" class="form-label">Input Confirm Transaction Password</label>
                                    <input type="password" 
                                           name="new_transaction_password_confirmation" 
                                           id="new_transaction_password_confirmation" 
                                           class="form-control"
                                           placeholder="Enter Confirm Password"
                                           required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-lock me-2"></i>Change
                                </button>
                                <a href="{{ route('user.forgot-transaction-password') }}" class="btn btn-dark ms-2">
                                    <i class="las la-unlock-alt me-2"></i>Forgot Transaction Password
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection