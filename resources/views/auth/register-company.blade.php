<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    
    <!-- SEO Meta Tags -->
    <title>Register Your Company - CareDesk Insurance CRM</title>
    <meta name="description" content="Register your company on CareDesk to easily manage multi-branch operations, automated CSV policy imports, customer workflows, and staff permissions." />
    <meta name="keywords" content="CareDesk, Insurance CRM, Company Registration, Multi-Branch CRM, Policy Management SaaS" />
    <meta name="author" content="CareDesk" />

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Register Your Company - CareDesk Insurance CRM" />
    <meta property="og:description" content="Manage multi-branch insurance operations and policy data efficiently with CareDesk." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts & Boxicons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Parsley CSS for Clean Error Styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.css" />
    
    <style>

         .authentication-wrapper.authentication-basic .authentication-inner {
            max-width: 600px;
            position: relative;
        }
 
        /* Responsive Card Wrapper Fix */
        .auth-card-container {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        /* Clean Input Error Styling */
        input.parsley-error, select.parsley-error, textarea.parsley-error {
            border-color: #ff3e1d !important;
            background-color: #fff5f5;
        }
        
        .parsley-errors-list {
            list-style: none;
            padding-left: 0;
            margin-top: 5px;
            margin-bottom: 0;
            color: #ff3e1d;
            font-size: 0.8125rem;
            font-weight: 500;
        }

        /* Input Group Error Border Fix */
        .input-group.is-invalid-group .form-control,
        .input-group.is-invalid-group .input-group-text {
            border-color: #ff3e1d !important;
        }

        /* Responsive Mobile Adjustments */
        @media (max-width: 575.98px) {
            .authentication-wrapper.authentication-basic .authentication-inner {
                max-width: 100% !important;
                padding: 1rem !important;
            }
            .card-body {
                padding: 1.5rem !important;
            }
        }
    </style>

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>
<body class="bg-body">
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y d-flex justify-content-center align-items-center min-vh-100">
            <div class="authentication-inner auth-card-container py-4">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-4 p-md-5">
                        
                        <!-- App Brand / Logo -->
                        <div class="app-brand justify-content-center mb-4">
                            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <div class="avatar avatar-sm bg-primary rounded d-flex align-items-center justify-content-center">
                                        <i class="bx bx-shield-alt-2 text-white fs-3"></i>
                                    </div>
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder fs-3">CareDesk</span>
                            </a>
                        </div>
                        
                        <h4 class="mb-2 fw-bold text-center">Start Your Company Account 🚀</h4>
                        <p class="mb-4 text-muted text-center fs-6">Register your business to manage branches, policies, and staff workflows.</p>

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

                        <!-- Parsley Form -->
                        <form id="companyRegisterForm" class="mb-3" action="{{ route('company.register.submit') }}" method="POST" data-parsley-validate>
                            @csrf
                            
                            <!-- Company Name -->
                            <div class="mb-3">
                                <label for="company_name" class="form-label text-uppercase fs-7 fw-bold">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="e.g. Apex Insurance Ltd" required autofocus data-parsley-required-message="Company name is required." />
                            </div>

                            <!-- Owner Name -->
                            <div class="mb-3">
                                <label for="owner_name" class="form-label text-uppercase fs-7 fw-bold">Owner Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" id="owner_name" name="owner_name" value="{{ old('owner_name') }}" placeholder="e.g. John Doe" required data-parsley-required-message="Owner full name is required." />
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label text-uppercase fs-7 fw-bold">Business Email (Login ID) <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" placeholder="admin@apexinsurance.com" required data-parsley-type="email" data-parsley-required-message="A valid email address is required." />
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label text-uppercase fs-7 fw-bold">Phone Number</label>
                                <input type="text" class="form-control form-control-lg" id="phone" name="phone" value="{{ old('phone') }}" placeholder="9876543210" data-parsley-type="digits" data-parsley-length="[10, 15]" data-parsley-length-message="Enter a valid phone number (10 to 15 digits)." />
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label text-uppercase fs-7 fw-bold" for="password">Password <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge" id="passwordGroup">
                                    <input type="password" id="password" class="form-control form-control-lg" name="password" placeholder="••••••••••••" required data-parsley-minlength="6" data-parsley-minlength-message="Password must be at least 6 characters." data-parsley-errors-container="#passwordError" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <div id="passwordError"></div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label class="form-label text-uppercase fs-7 fw-bold" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge" id="confirmPasswordGroup">
                                    <input type="password" id="password_confirmation" class="form-control form-control-lg" name="password_confirmation" placeholder="••••••••••••" required data-parsley-equalto="#password" data-parsley-equalto-message="Passwords do not match." data-parsley-errors-container="#confirmPasswordError" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <div id="confirmPasswordError"></div>
                            </div>

                            <!-- Submit Button -->
                            <button id="btnSubmit" type="submit" class="btn btn-primary btn-lg d-grid w-100 shadow-sm fw-bold">
                                <span>Register Company</span>
                            </button>
                        </form>

                        <p class="text-center mb-0 mt-4">
                            <span class="text-muted">Already have an account?</span>
                            <a href="{{ route('admin.login') }}" class="fw-bold">Sign in instead</a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Parsley JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

    <!-- Form Submit & UI Helper Scripts -->
    <script>
        $(document).ready(function() {
            // Password toggle visibility logic
            $('.input-group-text').on('click', function() {
                var input = $(this).closest('.input-group').find('input');
                var icon = $(this).find('i');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });

            // Highlight input group when parsley validation fails
            $('#companyRegisterForm').parsley().on('field:error', function() {
                if (this.$element.closest('.input-group').length) {
                    this.$element.closest('.input-group').addClass('is-invalid-group');
                }
            }).on('field:success', function() {
                if (this.$element.closest('.input-group').length) {
                    this.$element.closest('.input-group').removeClass('is-invalid-group');
                }
            });

            // Prevent double-submission & show loading state
            $('#companyRegisterForm').on('submit', function() {
                if ($(this).parsley().isValid()) {
                    var $btn = $('#btnSubmit');
                    $btn.prop('disabled', true);
                    $btn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Creating Account...');
                }
            });
        });
    </script>
</body>
</html>