<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive AI Assistant</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
  <style>
    body { display: flex; flex-direction: column; height: 100vh; overflow: hidden; }
  </style>
</head>
<body>

<div class="chatbot-only-page">

  <header class="chat-header" style="justify-content: space-between;">
    <div style="display:flex;align-items:center;gap:12px;">
      <div class="ai-orb">🤖</div>
      <div>
        <h2 style="font-size:1.1rem;font-weight:700;">RepoHive AI Assistant</h2>
        <small style="font-size:12px;color:#1db954;">Online · Ready to help</small>
      </div>
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
      <a href="{{ route('mailbox') }}" class="back-btn">Back to Mailbox</a>
    </div>
  </header>

  <section class="chat-window" id="chatWindow">
    <div class="chat-message bot">
      <div class="avatar">🤖</div>
      <div class="bubble">Hi! I'm your RepoHive AI Assistant. Ask me anything about your mailbox, OTP verification, or workspace.</div>
    </div>
  </section>

  <footer class="chat-input-bar">
    <input id="chatInput" placeholder="Type your message..." onkeydown="handleChatKey(event)">
    <button onclick="sendChat()">Send</button>
  </footer>
</div>

<script src="{{ asset('assets/app.js') }}"></script>
<script>
</script>
</body>
</html>