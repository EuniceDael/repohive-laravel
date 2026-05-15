<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Send OTP Email</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>
<body>

<div class="center-screen">
  <div class="card">
    <div class="brand">📧 Email Verification</div>
    <h1>Send OTP to Email</h1>
    <p class="muted">Enter your email address to receive a 6-digit code.</p>

    @if(session('email_error'))
        <p style="color:red;">{{ session('email_error') }}</p>
    @endif

    <form method="POST" action="{{ route('otp.email.send') }}">
        @csrf
        <label>Email Address</label>
        <input name="email" type="email" placeholder="example@company.com" required>
        <button class="btn primary" type="submit">Send OTP</button>
    </form>

    <a class="link" href="{{ route('home') }}">Back</a>
  </div>
</div>
</body>
</html>