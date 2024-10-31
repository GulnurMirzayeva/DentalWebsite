<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --blue: #2f89fc;
            --white: #fff;
            --light: #f8f9fa;
            --teal: #2cbcbc;
            --cyan: #21aac4;
            --violet: rgba(93, 82, 186, 1);
            --light-gray: #cfd0d1;
            --dark: #343a40;
            --light-black: #191919;
            --gray: #6c757d;
            --gray-dark: #343a40;
        }
        body {
            background: linear-gradient(to right, var(--violet), var(--cyan));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            color: var(--white);
        }
        .login-container {
            background-color: var(--white);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 450px;
            width: 100%;
            color: var(--dark);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--dark);
            font-family: 'Poppins', sans-serif;
        }
        .form-control {
            border-radius: 5px;
            font-size: 16px;
            border: 1px solid var(--light-gray);
        }
        .btn-primary {
            width: 100%;
            font-size: 16px;
            padding: 12px;
            border-radius: 5px;
            background-color: var(--blue);
            border: none;
        }
        .btn-primary:hover {
            background-color: var(--teal);
        }
        .error-message {
            color: var(--light-black);
            text-align: center;
        }
        .forgot-password {
            text-align: right;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 20px;
        }
        .forgot-password a {
            color: var(--violet);
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="login-container">
{{--    <p style="color: var(--blue)">We will send a link to your email, use that link to reset password.</p>--}}
    @if(session('error'))
        <p class="error-message">{{ session('error') }}</p>
    @endif
    <form method="POST" action="{{ route('reset.password.post') }}">
        @csrf
        <input type="text" name="token" hidden value="{{$token}}">
        <div class="mb-3">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Enter new password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
