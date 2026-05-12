const prototypeOtp = "123456";

/* =========================
   OTP FUNCTIONS
========================= */

function sendPhoneOtp() {
  const phone = document.getElementById("phone").value.trim();
  if (!phone) { alert("Enter phone number"); return; }

  fetch("/api/send-otp", {          // ✅ relative, not hardcoded
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json"
    },
    body: JSON.stringify({ phone })
  })
  .then(async res => {
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || "API error");
    alert(data.message);
    localStorage.setItem("otp_target", phone);
    window.location.href = '/otp/validate';
  })
  .catch(err => alert("Failed to send OTP: " + err.message));
}

function sendEmailOtp() {
  const email = document.getElementById("email").value.trim();
  if (!email) { alert("Please enter your email address."); return; }

  fetch("/api/send-otp", {          // ✅ already correct
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json"
    },
    body: JSON.stringify({ email })
  })
  .then(async res => {
    const data = await res.json();
    if (!res.ok) throw new Error(data.message || "API error");
    alert(data.message);
    localStorage.setItem("otp_target", email);
    window.location.href = "/otp/validate";
  })
  .catch(err => alert("Failed to send OTP: " + err.message));
}

/* =========================
   OTP VALIDATION
========================= */

function validateOtp() {
  const inputs = document.querySelectorAll(".otp");
  let otp = "";

  inputs.forEach(input => otp += input.value);

  const message = document.getElementById("message");

  if (otp === prototypeOtp) {
    localStorage.setItem("verified_user", localStorage.getItem("otp_target"));
    window.location.href = "/mailbox";
  } else {
    message.textContent = "Invalid OTP. Please try again.";
    message.style.color = "#dc2626";
  }
}

/* =========================
   OTP INPUT UI HANDLING
========================= */

document.addEventListener("DOMContentLoaded", () => {
  const target = document.getElementById("otpTarget");

  if (target) {
    target.textContent = localStorage.getItem("otp_target") || "your account";
  }

  const otpInputs = document.querySelectorAll(".otp");

  otpInputs.forEach((input, index) => {
    input.addEventListener("input", () => {
      input.value = input.value.replace(/[^0-9]/g, "");

      if (input.value && index < otpInputs.length - 1) {
        otpInputs[index + 1].focus();
      }
    });

    input.addEventListener("keydown", (e) => {
      if (e.key === "Backspace" && !input.value && index > 0) {
        otpInputs[index - 1].focus();
      }
    });
  });
});

/* =========================
   MAILBOX SYSTEM
========================= */

const inboxEmails = [
  {
    title: "Welcome to RepoHive Mail",
    from: "RepoHive Team",
    body: "Your secure mailbox is now ready."
  },
  {
    title: "OTP Verification Successful",
    from: "Security",
    body: "Your account verification was successful."
  },
  {
    title: "Project Invitation",
    from: "Admin",
    body: "You have been added to a workspace."
  }
];

let sentEmails = JSON.parse(localStorage.getItem("sent_emails")) || [];
let currentBox = "inbox";

function loadMailbox() {
  const userEmail = document.getElementById("userEmail");

  if (userEmail) {
    userEmail.textContent = localStorage.getItem("verified_user") || "Verified User";
  }

  showInbox();
}

function renderEmails(emails) {
  const list = document.getElementById("mailList");
  list.innerHTML = "";

  if (!emails.length) {
    list.innerHTML = "<div class='mail-item'>No emails found</div>";
    return;
  }

  emails.forEach((mail, index) => {
    const item = document.createElement("div");
    item.className = "mail-item";

    item.onclick = () => openEmail(mail, item);

    item.innerHTML = `
      <strong>${mail.title || mail.subject}</strong>
      <small>${mail.from ? "From: " + mail.from : "To: " + mail.to}</small>
    `;

    list.appendChild(item);

    if (index === 0) openEmail(mail, item);
  });
}

function openEmail(mail, element) {
  document.querySelectorAll(".mail-item").forEach(i => i.classList.remove("active"));
  if (element) element.classList.add("active");

  document.getElementById("previewTitle").textContent = mail.title || mail.subject;
  document.getElementById("previewMeta").textContent =
    mail.from ? `From: ${mail.from}` : `To: ${mail.to}`;
  document.getElementById("previewBody").textContent = mail.body;
}

function showInbox() {
  currentBox = "inbox";
  document.getElementById("mailTitle").textContent = "Inbox";
  renderEmails(inboxEmails);
}

function showSent() {
  currentBox = "sent";
  document.getElementById("mailTitle").textContent = "Sent";
  renderEmails(sentEmails);
}

function sendEmail() {
  const to = document.getElementById("composeTo").value.trim();
  const subject = document.getElementById("composeSubject").value.trim();
  const body = document.getElementById("composeBody").value.trim();

  if (!to || !subject || !body) {
    alert("Please complete all fields.");
    return;
  }

  const email = { to, subject, body, date: new Date().toLocaleString() };

  sentEmails.unshift(email);
  localStorage.setItem("sent_emails", JSON.stringify(sentEmails));

  document.getElementById("sentCount").textContent = sentEmails.length;

  closeCompose();
  showSent();
}

function openCompose() {
  document.getElementById("composeModal").classList.add("active");
}

function closeCompose() {
  document.getElementById("composeModal").classList.remove("active");
}

function filterMail() {
  const keyword = document.getElementById("searchMail").value.toLowerCase();
  const emails = currentBox === "inbox" ? inboxEmails : sentEmails;

  const filtered = emails.filter(m =>
    JSON.stringify(m).toLowerCase().includes(keyword)
  );

  renderEmails(filtered);
}

/* =========================
   CHATBOT SYSTEM
========================= */

function sendChat() {
  const input = document.getElementById("chatInput");
  const message = input.value.trim();

  if (!message) return;

  appendMessage(message, "user");
  input.value = "";

  showTyping();

  setTimeout(() => {
    removeTyping();
    appendMessage(generateBotReply(message), "bot");
  }, 900);
}

function handleChatKey(event) {
  if (event.key === "Enter") sendChat();
}

function appendMessage(text, sender) {
  const chatWindow = document.getElementById("chatWindow");

  const wrapper = document.createElement("div");
  wrapper.className = `chat-message ${sender}`;

  wrapper.innerHTML = `
    <div class="avatar">${sender === "user" ? "👤" : "🤖"}</div>
    <div class="bubble">${text}</div>
  `;

  chatWindow.appendChild(wrapper);
  chatWindow.scrollTop = chatWindow.scrollHeight;
}

function showTyping() {
  const chatWindow = document.getElementById("chatWindow");

  const typing = document.createElement("div");
  typing.id = "typingIndicator";
  typing.className = "chat-message bot";

  typing.innerHTML = `
    <div class="avatar">🤖</div>
    <div class="bubble">
      <div class="typing"><span></span><span></span><span></span></div>
    </div>
  `;

  chatWindow.appendChild(typing);
}

function removeTyping() {
  const t = document.getElementById("typingIndicator");
  if (t) t.remove();
}

function generateBotReply(message) {
  const text = message.toLowerCase();

  if (text.includes("email")) return "Mailbox updates are available.";
  if (text.includes("otp")) return "OTP helps secure your account.";
  if (text.includes("task")) return "RepoHive manages tasks and projects.";

  return "I can help you navigate RepoHive.";
}

/* =========================
   GOOGLE LOGIN (FAKE)
========================= */

function loginWithGoogle() {
  localStorage.setItem("verified_user", "google.user@gmail.com");
  window.location.href = "/mailbox";
}