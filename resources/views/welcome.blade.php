 <!DOCTYPE html>
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Welcome to CareDesk - Insurance & Operations CRM</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Centralized enterprise multi-branch platform to manage companies, automated policy CSV imports, customer follow-ups, and field inspection workflows." />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts & Boxicons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Custom Style Enhancements for Mobile & Modern Look -->
    <style>
        .portal-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-radius: 0.75rem !important;
        }
        .portal-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 0.5rem 1.5rem rgba(105, 108, 255, 0.15) !important;
        }
        .hero-badge {
            font-size: 0.8125rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        @media (max-width: 575.98px) {
            .hero-title {
                font-size: 1.75rem !important;
            }
            .hero-btns {
                flex-direction: column;
                width: 100%;
            }
            .hero-btns .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>
    
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>
<body class="bg-body">
    
    <!-- Navbar / Header -->
    <nav class="layout-navbar container-xxl navbar navbar-expand-lg navbar-detached align-items-center bg-navbar-theme my-3 rounded shadow-sm">
        <div class="container-fluid px-0">
            <a class="navbar-brand d-flex align-items-center me-0" href="{{ route('home') }}">
                <div class="avatar avatar-sm bg-primary rounded me-2 d-flex align-items-center justify-content-center">
                    <i class="bx bx-shield-alt-2 text-white fs-4"></i>
                </div>
                <span class="fw-bolder fs-4 text-primary">CareDesk</span>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bx bx-menu fs-2"></i>
            </button>

            <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarCollapse">
                <div class="ms-auto d-flex flex-column flex-lg-row align-items-lg-center gap-2 mt-2 mt-lg-0">
                    @auth
                        <!-- Authenticated Navigation -->
                        <span class="text-muted small me-2 d-none d-lg-inline">Hello, <strong>{{ auth()->user()->name }}</strong></span>
                        
                        @if(auth()->user()->role === 'super_admin')
                            <a href="{{ route('super.dashboard') }}" class="btn btn-primary btn-sm">
                                <i class="bx bx-speedometer me-1"></i> Super Admin Dashboard
                            </a>
                        @elseif(in_array(auth()->user()->role, ['admin', 'staff']))
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm">
                                <i class="bx bx-speedometer me-1"></i> Admin Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'cre')
                            <a href="{{ route('cre.dashboard') }}" class="btn btn-info text-white btn-sm">
                                <i class="bx bx-speedometer me-1"></i> CRE Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'field_inspector')
                            <a href="{{ route('fi.dashboard') }}" class="btn btn-warning text-white btn-sm">
                                <i class="bx bx-speedometer me-1"></i> FI Dashboard
                            </a>
                        @elseif(auth()->user()->role === 'operations')
                            <a href="{{ route('ops.dashboard') }}" class="btn btn-danger btn-sm">
                                <i class="bx bx-speedometer me-1"></i> Ops Dashboard
                            </a>
                        @endif

                        <form action="{{ route('universal.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="bx bx-power-off me-1"></i> Logout
                            </button>
                        </form>
                    @else
                        <!-- Guest Navigation -->
                        <a href="{{ route('company.register') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-plus-circle me-1"></i> Register Company
                        </a>
                        <a href="{{ route('admin.login') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bx bx-log-in-circle me-1"></i> Company Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container-xxl py-4">
        <div class="text-center py-4 py-md-5 max-w-750 mx-auto">
            <span class="badge bg-label-primary hero-badge rounded-pill px-3 py-2 mb-3">Multi-Tenant SaaS CRM</span>
            <h1 class="display-5 fw-bold hero-title text-dark mb-3">Enterprise Insurance & Field Operations Ecosystem</h1>
            <p class="lead text-muted mb-4 fs-6 fs-md-5">
                Centralized platform to manage multi-branch companies, automated policy CSV imports, customer follow-ups, and field inspection workflows.
            </p>

            <div class="d-flex justify-content-center gap-3 hero-btns">
                @auth
                    @if(auth()->user()->role === 'super_admin')
                        <a href="{{ route('super.dashboard') }}" class="btn btn-primary btn-lg shadow-sm">
                            <i class="bx bx-speedometer me-1"></i> Open Dashboard
                        </a>
                    @elseif(in_array(auth()->user()->role, ['admin', 'staff']))
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg shadow-sm">
                            <i class="bx bx-speedometer me-1"></i> Open Dashboard
                        </a>
                    @elseif(auth()->user()->role === 'cre')
                        <a href="{{ route('cre.dashboard') }}" class="btn btn-info text-white btn-lg shadow-sm">
                            <i class="bx bx-speedometer me-1"></i> Open Dashboard
                        </a>
                    @elseif(auth()->user()->role === 'field_inspector')
                        <a href="{{ route('fi.dashboard') }}" class="btn btn-warning text-white btn-lg shadow-sm">
                            <i class="bx bx-speedometer me-1"></i> Open Dashboard
                        </a>
                    @elseif(auth()->user()->role === 'operations')
                        <a href="{{ route('ops.dashboard') }}" class="btn btn-danger btn-lg shadow-sm">
                            <i class="bx bx-speedometer me-1"></i> Open Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('company.register') }}" class="btn btn-primary btn-lg shadow-sm">
                        <i class="bx bx-rocket me-1"></i> Get Started Free
                    </a>
                    <a href="{{ route('admin.login') }}" class="btn btn-outline-primary btn-lg">
                        <i class="bx bx-log-in me-1"></i> Sign In
                    </a>
                @endauth
            </div>
        </div>

        <!-- Platform Highlights Bar -->
        <div class="row g-3 my-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                    <div class="avatar bg-label-primary me-3 rounded d-flex align-items-center justify-content-center">
                        <i class="bx bx-buildings fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Multi-Branch Scoping</h6>
                        <small class="text-muted">Branch-wise data isolation</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                    <div class="avatar bg-label-success me-3 rounded d-flex align-items-center justify-content-center">
                        <i class="bx bx-file fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Bulk CSV Engine</h6>
                        <small class="text-muted">Normalized policy upload</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center p-3 bg-white rounded shadow-sm">
                    <div class="avatar bg-label-info me-3 rounded d-flex align-items-center justify-content-center">
                        <i class="bx bx-user-check fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Role Workflows</h6>
                        <small class="text-muted">CRE, FI & Ops dashboards</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Portals Section -->
        <div id="portals" class="pt-4">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark mb-1">Access Your Specialized Portal</h3>
                <p class="text-muted small">Select your role below to log in to your designated dashboard</p>
            </div>
            
            <div class="row g-4 justify-content-center">
                
                <!-- 1. Super Admin Portal -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card h-100 border-top border-primary border-3 shadow-sm portal-card">
                        <div class="card-body p-4 d-flex flex-column text-center">
                            <div class="avatar avatar-xl bg-label-primary mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bx bx-shield-quarter fs-1"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2">Super Admin</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">
                                Platform owner control panel to manage registered companies, subscriptions, and system configurations.
                            </p>
                            <span class="badge bg-label-primary mb-3 align-self-center">Platform Control</span>
                            <a href="{{ auth()->check() && auth()->user()->role === 'super_admin' ? route('super.dashboard') : route('super.login') }}" class="btn btn-primary w-100">
                                <i class="bx bx-log-in me-1"></i> {{ auth()->check() && auth()->user()->role === 'super_admin' ? 'Go to Dashboard' : 'Super Admin Login' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 2. Company Admin Portal -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card h-100 border-top border-success border-3 shadow-sm portal-card">
                        <div class="card-body p-4 d-flex flex-column text-center">
                            <div class="avatar avatar-xl bg-label-success mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bx bx-buildings fs-1"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2">Company Admin & Staff</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">
                                Tenant portal to manage physical branches, staff accounts, permissions, and policy imports.
                            </p>
                            <span class="badge bg-label-success mb-3 align-self-center">Management & Scoping</span>
                            <a href="{{ auth()->check() && in_array(auth()->user()->role, ['admin', 'staff']) ? route('admin.dashboard') : route('admin.login') }}" class="btn btn-success w-100">
                                <i class="bx bx-log-in me-1"></i> {{ auth()->check() && in_array(auth()->user()->role, ['admin', 'staff']) ? 'Go to Dashboard' : 'Company Login' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 3. CRE Portal -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card h-100 border-top border-info border-3 shadow-sm portal-card">
                        <div class="card-body p-4 d-flex flex-column text-center">
                            <div class="avatar avatar-xl bg-label-info mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bx bx-support fs-1"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2">CRE (Customer Relation)</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">
                                Specialized portal for customer interactions, lead tracking, and renewal call management.
                            </p>
                            <span class="badge bg-label-info mb-3 align-self-center">Lead & Renewal Calls</span>
                            <a href="{{ auth()->check() && auth()->user()->role === 'cre' ? route('cre.dashboard') : route('cre.login') }}" class="btn btn-info w-100 text-white">
                                <i class="bx bx-log-in me-1"></i> {{ auth()->check() && auth()->user()->role === 'cre' ? 'Go to Dashboard' : 'CRE Login' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 4. Field Inspector Portal -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card h-100 border-top border-warning border-3 shadow-sm portal-card">
                        <div class="card-body p-4 d-flex flex-column text-center">
                            <div class="avatar avatar-xl bg-label-warning mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bx bx-map-alt fs-1"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2">Field Inspector (FI)</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">
                                Field portal for physical vehicle inspections, document collection, and site report submissions.
                            </p>
                            <span class="badge bg-label-warning mb-3 align-self-center">On-Ground Verification</span>
                            <a href="{{ auth()->check() && auth()->user()->role === 'field_inspector' ? route('fi.dashboard') : route('fi.login') }}" class="btn btn-warning w-100 text-white">
                                <i class="bx bx-log-in me-1"></i> {{ auth()->check() && auth()->user()->role === 'field_inspector' ? 'Go to Dashboard' : 'Field Inspector Login' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 5. Operations Portal -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card h-100 border-top border-danger border-3 shadow-sm portal-card">
                        <div class="card-body p-4 d-flex flex-column text-center">
                            <div class="avatar avatar-xl bg-label-danger mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bx bx-task fs-1"></i>
                            </div>
                            <h5 class="card-title fw-bold text-dark mb-2">Operations Team</h5>
                            <p class="card-text text-muted small mb-3 flex-grow-1">
                                Operational portal for policy verification, payment approvals, and final issue completion.
                            </p>
                            <span class="badge bg-label-danger mb-3 align-self-center">Policy Verification</span>
                            <a href="{{ auth()->check() && auth()->user()->role === 'operations' ? route('ops.dashboard') : route('ops.login') }}" class="btn btn-danger w-100">
                                <i class="bx bx-log-in me-1"></i> {{ auth()->check() && auth()->user()->role === 'operations' ? 'Go to Dashboard' : 'Operations Login' }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center py-4 mt-5 text-muted border-top">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                <small>© {{ date('Y') }} <strong>CareDesk</strong>. All rights reserved.</small>
                <div class="d-flex gap-3">
                    <a href="#" class="text-muted small">Privacy Policy</a>
                    <a href="#" class="text-muted small">Terms of Service</a>
                    <a href="#" class="text-muted small">Support</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>