<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>RepoHive Mailbox</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">
  <style>
    /* Slide-over chat panel */
    .chat-overlay {
      position: fixed;
      inset: 0;
      z-index: 200;
      display: none;
      pointer-events: none;
    }
    .chat-overlay.active {
      display: block;
      pointer-events: all;
    }
    .chat-overlay-backdrop {
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.5);
      backdrop-filter: blur(3px);
    }
    .chat-drawer {
      position: absolute;
      right: 0;
      top: 0;
      bottom: 0;
      width: 420px;
      background: #1a1a1a;
      border-left: 1px solid rgba(255,255,255,0.08);
      display: flex;
      flex-direction: column;
      animation: slideInRight 0.22s ease;
    }
    @keyframes slideInRight {
      from { transform: translateX(40px); opacity: 0; }
      to   { transform: translateX(0);    opacity: 1; }
    }
    .chat-drawer-header {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 1.25rem 1.5rem;
      border-bottom: 1px solid rgba(255,255,255,0.08);
      flex-shrink: 0;
    }
    .chat-drawer-header h2 { font-size: 1rem; font-weight: 700; flex: 1; }
    .chat-drawer-header small { font-size: 11px; color: #1db954; display: block; }
    .drawer-close {
      background: none;
      border: none;
      color: #6a6a6a;
      font-size: 1.3rem;
      cursor: pointer;
      line-height: 1;
      padding: 4px;
      border-radius: 50%;
      transition: color 0.15s, background 0.15s;
    }
    .drawer-close:hover { color: #fff; background: rgba(255,255,255,0.08); }
  </style>
</head>
<body>

<div class="mailbox">

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="brand white">🐝 RepoHive</div>

    <button class="compose-btn" onclick="openCompose()">+ Compose</button>

    <div class="sidebar-section">Mailbox</div>
    <a class="menu active" onclick="showInbox()">📥 Inbox <span>3</span></a>
    <a class="menu" onclick="showSent()">📤 Sent <span id="sentCount">0</span></a>
    <a class="menu" onclick="showDrafts()">📝 Drafts <span>0</span></a>
    <a class="menu">🗃️ Archived <span>4</span></a>

    <div class="sidebar-bottom">
      <button class="sidebar-ai-btn" onclick="openChatDrawer()">
        <span class="ai-dot"></span>
        AI Assistant
      </button>
      <button class="sidebar-logout" onclick="logout()">
        🚪 Log out
      </button>
    </div>
  </aside>

  <!-- Main -->
  <main class="main">
    <header class="topbar">
      <div>
        <h2 id="mailTitle">Inbox</h2>
        <small id="userEmail">Verified User</small>
      </div>
      <input id="searchMail" placeholder="🔍 Search mail..." onkeyup="filterMail()">
    </header>

    <section class="mail-area">
      <div id="mailList" class="mail-list"></div>
      <div class="preview">
        <h2 id="previewTitle">Select an email</h2>
        <p id="previewMeta" class="muted"></p>
        <p id="previewBody"></p>
      </div>
    </section>
  </main>
</div>

<!-- Compose Modal -->
<div id="composeModal" class="modal">
  <div class="modal-card">
    <button class="close" onclick="closeCompose()">×</button>
    <h2>New Message</h2>

    <label>To</label>
    <input id="composeTo" type="email" placeholder="recipient@email.com">

    <label>Subject</label>
    <input id="composeSubject" type="text" placeholder="Email subject">

    <label>Message</label>
    <textarea id="composeBody" placeholder="Write your message..."></textarea>

    <button class="btn primary" onclick="sendEmail()">Send</button>
  </div>
</div>

<!-- AI Chat Drawer -->
<div id="chatOverlay" class="chat-overlay">
  <div class="chat-overlay-backdrop" onclick="closeChatDrawer()"></div>
  <div class="chat-drawer">
    <div class="chat-drawer-header">
      <div class="ai-orb">🤖</div>
      <div>
        <h2>RepoHive AI Assistant</h2>
        <small>Online · Ready to help</small>
      </div>
      <button class="drawer-close" onclick="closeChatDrawer()">×</button>
    </div>

    <section class="chat-window" id="chatWindow">
      <div class="chat-message bot">
        <div class="avatar">🤖</div>
        <div class="bubble">Hi! I'm your RepoHive AI Assistant. How can I help you today?</div>
      </div>
    </section>

    <footer class="chat-input-bar">
      <input id="chatInput" placeholder="Type a message..." onkeydown="handleChatKey(event)">
      <button onclick="sendChat()">Send</button>
    </footer>
  </div>
</div>

<script src="assets/app.js"></script>
<script>
  loadMailbox();

  function openChatDrawer()  { document.getElementById('chatOverlay').classList.add('active'); }
  function closeChatDrawer() { document.getElementById('chatOverlay').classList.remove('active'); }

  function logout() {
    if (confirm('Log out of RepoHive?')) {
      localStorage.removeItem('verified_user');
      localStorage.removeItem('auth_provider');
      localStorage.removeItem('user_name');
      localStorage.removeItem('otp_target');
      localStorage.removeItem('otp_type');
      window.location.href = '/';
    }
  }
</script>
</body>
</html>