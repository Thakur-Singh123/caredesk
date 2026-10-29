 <!DOCTYPE html>
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operations Login - CareDesk</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
</head>
<body class="bg-body d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4 shadow-lg border-top border-danger border-3" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-3">
            <div class="avatar avatar-lg bg-label-danger rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center">
                <i class="bx bx-task fs-2"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">Operations Team Login</h4>
            <p class="text-muted small">Enter your credentials to access the Operations Dashboard</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 px-3 small mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('ops.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus />
            </div>

            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                    <input type="password" name="password" id="password" class="form-control" placeholder="············" required />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label small" for="remember">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-danger w-100 fw-semibold">Sign In</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('home') }}" class="text-muted small"><i class="bx bx-arrow-back me-1"></i> Back to Welcome</a>
        </div>
    </div>
    <script>
    //Password visibility toggle logic
    document.querySelectorAll('.form-password-toggle .input-group-text').forEach(function (toggleIcon) {
        toggleIcon.addEventListener('click', function (e) {
            const inputGroup = this.closest('.input-group');
            const passwordInput = inputGroup.querySelector('input');
            const icon = this.querySelector('i');

            if (passwordInput.getAttribute('type') === 'password') {
                passwordInput.setAttribute('type', 'text');
                icon.classList.replace('bx-hide', 'bx-show');
            } else {
                passwordInput.setAttribute('type', 'password');
                icon.classList.replace('bx-show', 'bx-hide');
            }
        });
    });
    </script>
</body>
</html>