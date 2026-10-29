@extends('admin.layouts.app')

@section('title', 'Admin Profile')

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
      <h5 class="card-header">Profile Details </h5>
      <div class="card-body">
        <form method="POST" action="{{ route('supper.profile.update') }}">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Full Name</label>
              <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required />
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required />
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
      </div>
    </div>
  </div>

  <!-- Change Password Card -->
  <div class="col-md-12">
    <div class="card">
      <h5 class="card-header">Change Password</h5>
      <div class="card-body">
        <form method="POST" action="{{ route('supper.password.update') }}">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="mb-3 col-md-4 form-password-toggle">
              <label class="form-label" for="current_password">Current Password</label>
              <input class="form-control @error('current_password') is-invalid @enderror" type="password" id="current_password" name="current_password" required />
              @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 col-md-4 form-password-toggle">
              <label class="form-label" for="password">New Password</label>
              <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required />
              @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3 col-md-4 form-password-toggle">
              <label class="form-label" for="password_confirmation">Confirm New Password</label>
              <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required />
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