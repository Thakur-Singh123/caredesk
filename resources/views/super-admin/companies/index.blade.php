@extends('super-admin.layouts.app')

@section('title', 'Company Management')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Super Admin /</span> Companies</h4>

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
        <h5 class="mb-0">Registered Companies</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
            <i class="bx bx-plus me-1"></i> Register New Company
        </button>
    </div>

    <div class="table-responsive" style="overflow: visible;">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company Name</th>
                    <th>Owner Name</th>
                    <th>Email / Phone</th>
                    <th>Branches</th>
                    <th>Users</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $index => $company)
                <tr>
                    <td>{{ $companies->firstItem() + $index }}</td>
                    <td><strong>{{ $company->company_name }}</strong></td>
                    <td>{{ $company->owner_name }}</td>
                    <td>{{ $company->email }}<br><small class="text-muted">{{ $company->phone ?? 'N/A' }}</small></td>
                    <td><span class="badge bg-label-info">{{ $company->branches_count }} Branches</span></td>
                    <td><span class="badge bg-label-secondary">{{ $company->users_count }} Users</span></td>
                    <td>
                        <form action="{{ route('super.companies.status', $company->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $company->status === 'active' ? 'btn-success' : 'btn-danger' }}">
                                {{ ucfirst($company->status) }}
                            </button>
                        </form>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end shadow">
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCompanyModal{{ $company->id }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>
                                <form action="{{ route('super.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are you sure? This will delete the company and all its branches/users!');">
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

                <!-- Edit Modal -->
                <div class="modal fade" id="editCompanyModal{{ $company->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('super.companies.update', $company->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Company: {{ $company->company_name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" name="company_name" class="form-control" value="{{ $company->company_name }}" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Owner Name</label>
                                        <input type="text" name="owner_name" class="form-control" value="{{ $company->owner_name }}" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" value="{{ $company->email }}" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $company->phone }}" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="active" {{ $company->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="suspended" {{ $company->status === 'suspended' ? 'selected' : '' }}>Suspended</option>
                                            <option value="trial" {{ $company->status === 'trial' ? 'selected' : '' }}>Trial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4">No companies registered yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex justify-content-end">
        {{ $companies->links() }}
    </div>
</div>

<!-- Add Company Modal -->
<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('super.companies.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Register New Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" placeholder="e.g. Apex Insurance Corp" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Owner Name</label>
                        <input type="text" name="owner_name" class="form-control" placeholder="e.g. John Doe" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin Email (Login ID)</label>
                        <input type="email" name="email" class="form-control" placeholder="admin@apexinsurance.com" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="9876543210" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Admin Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Company & Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection