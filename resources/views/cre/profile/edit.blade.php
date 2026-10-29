@extends('cre.layouts.app')

@section('title', 'CRE Profile')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Profile</h4>

<!-- Flash Success Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
  <!-- Profile Details Card -->
  <div class="col-md-12 mb-4">
    <div class="card">
      <h5 class="card-header">Profile Details</h5>
      <div class="card-body">
      
      <!-- MAIN PROFILE UPDATE FORM START -->
      <form method="POST" action="{{ route('cre.profile.update') }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Centered Circle Profile Image Section -->
          <div class="row justify-content-center mb-4">
              <div class="col-md-12 text-center">
                  <div class="d-inline-block position-relative">
                      <!-- Avatar Preview -->
                      <img 
                          src="{{ get_profile_image($user->image) }}" 
                          alt="user-avatar" 
                          class="rounded-circle shadow-sm" 
                          id="uploadedAvatar" 
                          style="width: 120px; height: 120px; object-fit: cover;" 
                      />
                  </div>

                  <div class="button-wrapper mt-3">
                      <label for="upload" class="btn btn-primary btn-sm me-2 mb-2" tabindex="0">
                          <span class="d-none d-sm-block">Upload new photo</span>
                          <i class="bx bx-upload d-block d-sm-none"></i>
                          <input type="file" id="upload" name="image" class="account-file-input" hidden accept="image/png, image/jpeg, image/jpg" />
                      </label>
                      <p class="text-muted mb-0"><small>Allowed JPG, GIF or PNG. Max size of 2MB</small></p>
                      @error('image')<div class="invalid-feedback d-block mt-1">{{ $message }}</div>@enderror
                  </div>
              </div>
          </div>

          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Full Name</label>
              <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required />
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" />
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="phone" class="form-label">Phone Number</label>
              <input class="form-control @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" />
              @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="role" class="form-label">Role</label>
              <input class="form-control text-uppercase" type="text" id="role" value="{{ $user->role }}" disabled />
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
          </div>
        </form>
        <!-- MAIN PROFILE UPDATE FORM END -->

      <!-- ABSOLUTE DELETE ICON FORM (Positioned cleanly on top-right of image without breaking main form) -->
        @if($user->image)
            <div style="position: absolute; text-align: center; width: 100%; pointer-events: none;">
                <div class="d-inline-block position-relative" style="width: 120px; height: 0;">
                    <form action="{{ route('cre.profile.image.delete') }}" method="POST" class="delete-form" style="position: absolute; top: -450px; right: 20px; pointer-events: auto;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-icon btn-danger btn-sm rounded-pill shadow-sm delete-btn" title="Delete Image">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endif

      </div>
    </div>
  </div>

  <!-- Change Password Card -->
  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Change Password</h5>
      <div class="card-body">
        <form method="POST" action="{{ route('cre.password.update') }}">
          @csrf
          @method('PUT')
          <div class="row">
            <!-- Current Password -->
            <div class="mb-3 col-md-4 form-password-toggle">
              <label class="form-label" for="current_password">Current Password</label>
              <div class="input-group input-group-merge">
                <input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" name="current_password" placeholder="············" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              @error('current_password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <!-- New Password -->
            <div class="mb-3 col-md-4 form-password-toggle">
              <label class="form-label" for="password">New Password</label>
              <div class="input-group input-group-merge">
                <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="············" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
              @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
            </div>

            <!-- Confirm New Password -->
            <div class="mb-3 col-md-4 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm New Password</label>
              <div class="input-group input-group-merge">
                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="············" required />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-danger">Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection