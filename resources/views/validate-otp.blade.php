<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Validate OTP</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>
<body>

<div class="center-screen">
  <div class="card">
    <div class="brand">🔐 Verification</div>
    <h1>Enter your code</h1>
    <p class="muted">Code sent to: <strong id="otpTarget" style="color:#fff;"></strong></p>

    <div class="success">OTP sent successfully.</div>

    <div class="otp-box">
      <input maxlength="1" class="otp">
      <input maxlength="1" class="otp">
      <input maxlength="1" class="otp">
      <input maxlength="1" class="otp">
      <input maxlength="1" class="otp">
      <input maxlength="1" class="otp">
    </div>

    <button class="btn primary" onclick="validateOtp()">Verify</button>
    <p id="message" class="muted center"></p>
    <a class="link" href="{{ url('/') }}">← Back to home</a>
  </div>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>