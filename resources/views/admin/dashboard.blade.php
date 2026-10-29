@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Dashboard</h4>

<div class="row">
    <!-- Welcome Card -->
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Welcome back, {{ auth()->user()->name }}! 🎉</h5>
                        <p class="mb-4">You are logged into the <span class="fw-bold">CareDesk</span> admin panel for branch: <span class="badge bg-label-primary">{{ auth()->user()->branch->name ?? 'Head Office' }}</span></p>
                        <a href="{{ route('admin.profile') }}" class="btn btn-sm btn-outline-primary">Manage Profile</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Quick Stats Cards -->
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <span class="fw-semibold d-block mb-1">Total Branches</span>
                <h3 class="card-title mb-2">1</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Active</small>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <span class="fw-semibold d-block mb-1">Total Users</span>
                <h3 class="card-title mb-2">1</h3>
                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Online</small>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card">
            <div class="card-body">
                <span class="fw-semibold d-block mb-1">System Status</span>
                <h3 class="card-title mb-2 text-success">Healthy</h3>
                <small class="text-muted">Laravel 13 Running</small>
            </div>
        </div>
    </div>
</div>
@endsection