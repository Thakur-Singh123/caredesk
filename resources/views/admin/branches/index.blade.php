@extends('admin.layouts.app')

@section('title', 'Branch Management')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Branches</h4>

<!-- Notifications -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Branch List</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">
            <i class="bx bx-plus me-1"></i> Add New Branch
        </button>
    </div>

    <!-- Fix: style="overflow: visible;" prevents dropdown from getting cut off -->
    <div class="table-responsive" style="overflow: visible;">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Branch Name</th>
                    <th>Code</th>
                    <th>Address</th>
                    <th>Assigned Users</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 80px;">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($branches as $index => $branch)
                <tr>
                    <td>{{ $branches->firstItem() + $index }}</td>
                    <td><strong>{{ $branch->name }}</strong></td>
                    <td><span class="badge bg-label-secondary">{{ $branch->code }}</span></td>
                    <td>{{ Str::limit($branch->address, 30) ?? 'N/A' }}</td>
                    <td><span class="badge bg-label-info">{{ $branch->users_count }} Users</span></td>
                    <td>
                        <form action="{{ route('admin.branches.status', $branch->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $branch->is_active ? 'btn-success' : 'btn-warning' }}">
                                {{ $branch->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <!-- Edit Button -->
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editBranchModal{{ $branch->id }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>
                                <!-- Delete Button -->
                                <form action="{{ route('admin.branches.destroy', $branch->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this branch?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bx bx-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No branches found. Click "Add New Branch" to create one.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="card-footer d-flex justify-content-end">
        {{ $branches->links() }}
    </div>
</div>

<!-- ==================== MODALS SECTION (Outside Table) ==================== -->

<!-- Edit Branch Modals -->
@foreach($branches as $branch)
<div class="modal fade" id="editBranchModal{{ $branch->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.branches.update', $branch->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Branch: {{ $branch->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Branch Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $branch->name }}" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch Code</label>
                        <input type="text" name="code" class="form-control" value="{{ $branch->code }}" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2">{{ $branch->address }}</textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActiveEdit{{ $branch->id }}" {{ $branch->is_active ? 'checked' : '' }} />
                        <label class="form-check-label" for="isActiveEdit{{ $branch->id }}">Active Status</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Branch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Add Branch Modal -->
<div class="modal fade" id="addBranchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.branches.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Branch Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Mumbai Central Branch" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Branch Code</label>
                        <input type="text" name="code" class="form-control" placeholder="e.g. MUM-01" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="2" placeholder="Enter branch full address"></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActiveAdd" checked />
                        <label class="form-check-label" for="isActiveAdd">Active Status</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Branch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection