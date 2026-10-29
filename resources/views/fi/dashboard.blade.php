@extends('fi.layouts.app')

@section('title', 'FI Dashboard')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">FI /</span> Dashboard</h4>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-primary">Welcome, FI! 🚀</h5>
                <p class="mb-4">You have full platform control. Manage registered companies, monitor subscriptions, and oversee platform status.</p>
                <a href="{{ route('fi.dashboard') }}" class="btn btn-primary">Manage Companies</a>
            </div>
        </div>
    </div>
</div>
@endsection