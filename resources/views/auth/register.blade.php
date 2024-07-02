<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-direction: row;
        }
        .register-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-image img {
            max-width: 100%;
            height: auto;
        }
        .register-form {
            flex: 1;
            padding: 20px;
        }
        .register-form .form-group input {
            border-radius: 20px;
        }
        .register-form .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 20px;
            padding: 10px 20px;
            width: 100%;
        }
        .register-form .btn-danger {
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
        .register-form .btn-danger img {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
        .register-form .btn-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
        .register-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                padding: 20px;
            }
            .register-image {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-image">
            <img src="{{ asset('storage/ensa-course.png') }}" alt="Register Illustration">
        </div>
        <div class="register-form">
            <h2>Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>
                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Register</button>
                    <a href="{{ route('auth.google') }}" class="btn btn-danger">
                        <img src="{{ asset('storage/icon-google.png') }}" alt="Google Icon"> Register with Google
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn
