@extends('layouts.master')

@section("title", "Edit Profile Image")

@section("content")
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
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
                    <h4 class="card-title mb-0">EDIT PROFILE IMAGE</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.profile.image.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row align-items-center">
                            <!-- Current Image Preview -->
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <div class="border p-2 rounded" style="max-width: 200px;">
                                    @if($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path))
                                        <img src="{{ Storage::url($user->profile_photo_path) }}" 
                                             alt="Profile Image" 
                                             class="img-fluid rounded"
                                             id="currentImage"
                                             style="max-height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/images/avatar/1.png') }}" 
                                             alt="Default Profile" 
                                             class="img-fluid rounded"
                                             id="currentImage"
                                             style="max-height: 200px; object-fit: cover;">
                                    @endif
                                </div>
                            </div>

                            <!-- Upload Section -->
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="profile_image" class="form-label">Choose Profile Image</label>
                                    <input type="file" 
                                           name="profile_image" 
                                           id="profile_image" 
                                           class="form-control @error('profile_image') is-invalid @enderror"
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    @error('profile_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <strong>Note:</strong> make sure that your image size is below 2MB.
                                        <br>Allowed formats: JPG, JPEG, PNG, GIF
                                    </div>
                                </div>

                                <!-- New Image Preview -->
                                <div class="mb-3" id="newImagePreview" style="display: none;">
                                    <label class="form-label">New Image Preview:</label>
                                    <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 150px;">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="las la-save me-2"></i>Save
                                </button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">
                                    <i class="las la-times me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            // New image preview dikhao
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('newImagePreview').style.display = 'block';
            
            // Current image ko bhi update karo (optional)
            document.getElementById('currentImage').src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection