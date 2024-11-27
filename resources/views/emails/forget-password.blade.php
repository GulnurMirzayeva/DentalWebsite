<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 40px auto;
        border: 1px solid #e0e0e0;
    }

    h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    p {
        color: #555;
        line-height: 1.6;
    }

    .button {
        display: inline-block;
        padding: 15px 30px;
        margin-top: 20px;
        font-size: 16px;
        font-weight: bold;
        color: #ffffff;
        background-color: #28a745;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        text-align: center;
    }

    .button:hover {
        background-color: #218838;
    }

    .footer {
        margin-top: 20px;
        font-size: 12px;
        color: #888888;
        text-align: center;
    }

    @media (max-width: 600px) {
        .container {
            padding: 20px;
        }

        .button {
            padding: 12px 20px;
            font-size: 14px;
        }
    }
</style>

<div class="container">
    <h2>Password Reset Request</h2>
    <p>We received a request to reset your password. Click the button below to reset it:</p>
    <a href="{{ route('reset.password', $token) }}" class="button">Reset Password</a>
    <p>If you didn't request a password reset, please ignore this email.</p>
</div>

<div class="footer">
    <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
</div>
