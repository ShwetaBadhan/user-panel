@extends('layouts.master')

@section("title", "Forgot Transaction Password")

@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="las la-check-circle me-2"></i>
                            <strong>New Transaction Password:</strong> 
                            <span class="fs-4 fw-bold text-primary">{{ session('new_password') }}</span>
                            <br><small>Please save this password securely!</small>
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
                            <h4 class="card-title mb-0">Forgot Transaction Password</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.forgot-transaction-password.submit') }}" method="POST">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" 
                                           name="username" 
                                           id="username" 
                                           class="form-control @error('username') is-invalid @enderror"
                                           placeholder="Enter your username"
                                           value="{{ old('username', $user->user_name ?? '') }}"
                                           readonly
                                           required>
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Enter your name"
                                           value="{{ old('name', $user->first_name . ' ' . $user->last_name ?? '') }}"
                                           readonly
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Enter your email"
                                           value="{{ old('email', $user->email ?? '') }}"
                                           readonly
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-paper-plane me-2"></i>Continue
                                </button>
                                <a href="{{ route('user.change-transaction-password') }}" class="btn btn-secondary ms-2">
                                    <i class="las la-arrow-left me-2"></i>Back to Change Password
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