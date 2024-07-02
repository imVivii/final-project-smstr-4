<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 0 15px;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-direction: row;
        }
        .login-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-image img {
            max-width: 100%;
            height: auto;
        }
        .login-form {
            flex: 1;
            padding: 20px;
        }
        .login-form .form-group input {
            border-radius: 20px;
        }
        .login-form .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 20px;
            padding: 10px 20px;
            width: 100%;
        }
        .login-form .btn-danger {
            background-color: #dd4b39;
            border-color: #dd4b39;
            border-radius: 20px;
            padding: 10px 20px;
            width: 100%;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-form .btn-danger img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
        .login-form .btn-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                padding: 20px;
            }
            .login-image {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-image">
            <img src="{{ asset('storage/ensa-course.png') }}" alt="Login Illustration">
        </div>
        <div class="login-form">
            <h2>Login</h2>

            @if(session('error'))
                <div class="alert alert-danger" id="error-message">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Username</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="{{ route('auth.google') }}" class="btn btn-danger">
                        <img src="{{ asset('storage/icon-google.png') }}" alt="Google Icon"> With Google Account
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                alert(errorMessage.textContent);
            }
        });
    </script>
</body>
</html>
