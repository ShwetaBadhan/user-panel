@extends('layouts.master')

@section("title", "Change Password")

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
                            <h4 class="card-title mb-0">CHANGE YOUR PASSWORD HERE....</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.change-password.update') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="old_password" class="form-label">Old Password</label>
                                    <input type="password" 
                                           name="old_password" 
                                           id="old_password" 
                                           class="form-control @error('old_password') is-invalid @enderror"
                                           placeholder="Old New Password"
                                           value="{{ old('old_password') }}"
                                           required>
                                    @error('old_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Input New Password</label>
                                    <input type="password" 
                                           name="new_password" 
                                           id="new_password" 
                                           class="form-control @error('new_password') is-invalid @enderror"
                                           placeholder="Enter New Password"
                                           required>
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        Minimum 6 characters required
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="form-label">Input Confirm Password</label>
                                    <input type="password" 
                                           name="new_password_confirmation" 
                                           id="new_password_confirmation" 
                                           class="form-control"
                                           placeholder="Enter Confirm Password"
                                           required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-key me-2"></i>Change
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">
                                    <i class="las la-times me-2"></i>Cancel
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