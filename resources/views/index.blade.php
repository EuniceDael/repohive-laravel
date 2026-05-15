<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive Apps</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
</head>
<body>

<div class="center-screen">
  <div class="card">
    <div class="brand">🐝 RepoHive</div>

    <h1>Welcome back.</h1>
    <p class="muted">Access your verification, mailbox, and AI assistant from one place.</p>

    <a class="btn primary" href="{{ url('/otp-phone') }}">📱 Send OTP via SMS</a>
    <a class="btn light" href="{{ url('/otp-email') }}">📧 Send OTP via Email</a>
    <a class="btn light" href="{{ url('/validate/otp') }}">🔐 Validate OTP</a>
    <a class="btn light" href="{{ url('/mailbox') }}">📬 Open Mailbox</a>
    <a class="btn light" href="{{ url('/ai-chatbot') }}">🤖 AI Assistant</a>

    <hr>

    <button class="btn google" onclick="loginWithGoogle()">
      <img src="./assets/Google_Favicon_2025.svg.webp" alt="" height="20">
      Continue with Google
    </button>

    <p class="note">Prototype — connected via HTML, CSS, JS &amp; localStorage.</p>
  </div>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
</body>
</html>