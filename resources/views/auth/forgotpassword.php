<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Quest — Reset Password</title>

  <!-- Favicon -->
  <link rel="icon" href="/assets/quest/favicon.ico" sizes="any">
  <link rel="icon" href="/assets/quest/favicon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="/assets/quest/apple-touch-icon.png">

  <!-- Fonts & Bootstrap -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* ============================================================
       DESIGN TOKENS (Consistent with other Quest pages)
    ============================================================ */
    :root {
      --g100:#dcfce7;--g200:#bbf7d0;--g300:#86efac;--g400:#4ade80;
      --g500:#22c55e;--g600:#16a34a;--g700:#15803d;--g800:#166534;--g900:#14532d;
      --accent:#22c55e;--accent-d:#16a34a;--accent-l:#4ade80;
      --bg:#f6fefa;--bg2:#edfbf3;--bg3:#f0fdf4;
      --card:#ffffff;--txt:#071a0e;--txt2:#374151;--txt3:#6b7280;--txt4:#9ca3af;
      --bdr:#c6f6d5;--bdr2:#e5e7eb;
      --sh:rgba(22,163,74,.12);--sh2:rgba(22,163,74,.22);
      --ff:'Syne',sans-serif;--fb:'DM Sans',sans-serif;
      --ease:.28s cubic-bezier(.4,0,.2,1);
      --nav-h: 70px;
    }
    [data-bs-theme="dark"] {
      --bg:#040d07;--bg2:#071209;--bg3:#0a1a0f;--card:#0d1f12;
      --txt:#ecfdf5;--txt2:#d1fae5;--txt3:#86efac;--txt4:#4ade80;
      --bdr:#1a3a24;--bdr2:#1e3326;
      --sh:rgba(34,197,94,.18);--sh2:rgba(34,197,94,.28);
    }

    /* ============================================================
       BASE
    ============================================================ */
    html, body { height:100%; }
    body {
      font-family:var(--fb);
      background:var(--bg);
      color:var(--txt);
      min-height:100vh;
      display:flex;
      flex-direction:column; /* Allows content to flow naturally */
      transition:background var(--ease),color var(--ease);
      position:relative; overflow-x: hidden;
    }
    a { text-decoration:none;color:inherit; }
    button { cursor:pointer; border:none; font-family: inherit; }

    /* Ambient blobs */
    body::before {
      content:'';position:fixed;top:-15%;left:-10%;width:80vw;height:80vw;max-width:600px;max-height:600px;
      background:radial-gradient(circle,rgba(34,197,94,.1) 0%,transparent 70%);border-radius:50%;pointer-events:none;z-index:0;
      animation:blobDrift 14s ease-in-out infinite alternate;
    }
    body::after {
      content:'';position:fixed;bottom:-15%;right:-10%;width:70vw;height:70vw;max-width:500px;max-height:500px;
      background:radial-gradient(circle,rgba(74,222,128,.07) 0%,transparent 70%);border-radius:50%;pointer-events:none;z-index:0;
      animation:blobDrift 10s ease-in-out infinite alternate-reverse;
    }
    @keyframes blobDrift{from{transform:translate(0,0) scale(1)}to{transform:translate(24px,18px) scale(1.07)}}

    /* ============================================================
       NAVBAR (Simplified for Auth Page)
    ============================================================ */
    .quest-navbar {
      position:fixed;top:0;left:0;right:0;z-index:200;height:var(--nav-h);
      background:rgba(246,254,250,.92);
      backdrop-filter:blur(24px) saturate(180%);
      border-bottom:1px solid var(--bdr);
      transition:background var(--ease),box-shadow var(--ease), padding var(--ease);
    }
    [data-bs-theme="dark"] .quest-navbar { background:rgba(4,13,7,.92); }

    .nav-logo {
      display:flex;align-items:center;gap:10px;
      font-family:var(--ff);font-weight:800;font-size:1.25rem;
      color:var(--txt);letter-spacing:-.02em;
    }
    .nav-logo .logo-img { width:38px;height:38px;border-radius:10px; object-fit: cover; }

    .theme-btn {
      width:38px;height:38px;border-radius:50%;
      background:var(--bg3);border:1px solid var(--bdr);
      display:flex;align-items:center;justify-content:center;
      font-size:18px;cursor:pointer;flex-shrink:0;transition:all var(--ease);
    }
    .theme-btn:hover { background:var(--bdr);transform:rotate(15deg); }

    /* ============================================================
       PAGE LAYOUT
    ============================================================ */
    .page-wrapper {
      flex: 1;
      display:flex;
      align-items:center;
      justify-content:center;
      position:relative;
      z-index:1;
      padding-top:calc(var(--nav-h) + 2rem);
      padding-bottom: 2rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    @media(min-width: 768px) {
      .page-wrapper { padding-top: var(--nav-h); padding-bottom: 3rem; }
    }

    /* ============================================================
       AUTH CARD (Split Layout)
    ============================================================ */
    .auth-container {
      background:var(--card);
      border:1px solid var(--bdr);
      border-radius:24px; /* Mobile friendly */
      box-shadow:0 20px 60px rgba(0,0,0,.08),0 0 0 1px var(--bdr);
      width:100%;
      max-width:480px; /* Focused width on mobile */
      overflow:hidden;
      animation:slideUp .5s ease forwards;
      margin: 0 auto;
      position: relative;
    }

    @media(min-width: 992px) {
      .auth-container {
        display:grid;
        grid-template-columns: 1fr 1fr;
        max-width:1000px; /* Expands on desktop */
        border-radius:32px;
        box-shadow:0 32px 80px rgba(0,0,0,.1),0 0 0 1px var(--bdr);
        min-height: 550px;
      }
    }

    @keyframes slideUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}

    /* ============================================================
       FORM SIDE
    ============================================================ */
    .auth-form-side {
      padding:2rem;
      display:flex;flex-direction:column;justify-content:space-between;
      min-height: auto;
    }
    @media(min-width: 576px) { .auth-form-side { padding: 3rem; } }
    @media(min-width: 992px) { .auth-form-side { padding: 3.5rem; } }

    .auth-header { margin-bottom:1.5rem; text-align: center; }
    @media(min-width: 992px) { .auth-header { text-align: left; margin-bottom: 2rem; } }

    .forgot-icon-wrap {
      width:64px;height:64px;border-radius:50%;
      background:linear-gradient(135deg,var(--g100),var(--g200));
      display:flex;align-items:center;justify-content:center;font-size:28px;
      margin:0 auto 1.2rem auto; box-shadow: 0 8px 24px var(--sh);
    }
    [data-bs-theme="dark"] .forgot-icon-wrap {
      background:linear-gradient(135deg,#0a2d18,#155c30);
    }
    @media(min-width: 992px) { .forgot-icon-wrap { margin: 0 0 1.2rem 0; } }

    .auth-title {
      font-family:var(--ff);font-weight:800;
      font-size:clamp(1.5rem, 4vw, 2.1rem);
      color:var(--txt);letter-spacing:-.02em;margin-bottom:.5rem;
    }
    .auth-sub {
      font-size:.9rem;color:var(--txt3);line-height:1.6;
      max-width:320px; margin: 0 auto;
    }
    @media(min-width: 992px) { .auth-sub { margin: 0; } }

    /* Inputs */
    .form-group { display:flex;flex-direction:column;gap:6px; margin-bottom: 1rem; }
    .form-label {
      font-size:.75rem;font-weight:700;text-transform:uppercase;
      letter-spacing:.05em;color:var(--txt4);
    }
    .form-input {
      width:100%;padding:12px 16px;
      border-radius:10px;border:1.5px solid var(--bdr2);
      background:var(--bg3);color:var(--txt);
      font-size:1rem; /* Prevents zoom on iOS */
      transition:all var(--ease);outline:none;font-family:var(--fb);
    }
    .form-input:focus {
      border-color:var(--accent);
      box-shadow:0 0 0 3px rgba(34,197,94,.15);
      background:var(--card);
    }
    .form-input::placeholder { color:var(--txt4); }

    /* Submit Button */
    .btn-submit {
      width:100%;padding:14px;border-radius:12px;
      font-size:1rem;font-weight:700;color:#fff;
      background:linear-gradient(135deg,var(--accent),var(--accent-d));
      box-shadow:0 6px 20px rgba(22,163,74,.4);
      transition:all var(--ease);letter-spacing:.01em;
      display: flex; justify-content: center; align-items: center;
    }
    .btn-submit:hover { transform:translateY(-2px);box-shadow:0 10px 28px rgba(22,163,94,.5); }
    .btn-submit:active { transform:translateY(0); }
    .btn-submit:disabled { opacity:.7;cursor:not-allowed;transform:none; }

    /* Links */
    .auth-switch { text-align:center;font-size:.85rem;color:var(--txt3); margin-top: 1rem; }
    .auth-switch a { color:var(--accent);font-weight:600;text-decoration:none; }
    .auth-switch a:hover { text-decoration:underline; }

    .auth-footer {
      display:flex;justify-content:space-between;align-items:center;
      padding-top:1rem;border-top:1px solid var(--bdr);margin-top:1rem; flex-wrap: wrap; gap: 0.5rem;
    }
    .auth-footer-text { font-size:.75rem;color:var(--txt4); }
    .auth-footer-text a { color:var(--accent); }

    /* ============================================================
       SUCCESS STATE
    ============================================================ */
    .success-state {
      display:none;flex-direction:column;align-items:center;
      text-align:center;padding:1rem 0;gap:1rem; height: 100%; justify-content: center;
    }
    .success-state.show { display:flex; }
    .success-icon {
      width:72px;height:72px;border-radius:50%;
      background:linear-gradient(135deg,var(--accent),var(--accent-d));
      display:flex;align-items:center;justify-content:center;font-size:32px;
      box-shadow:0 8px 24px rgba(22,163,74,.4);
      animation:popIn .4s ease; margin-bottom: 0.5rem;
    }
    @keyframes popIn{from{transform:scale(0.5);opacity:0}to{transform:scale(1);opacity:1}}
    .success-title {
      font-family:var(--ff);font-weight:700;font-size:1.5rem;color:var(--txt);
    }
    .success-sub { font-size:.9rem;color:var(--txt3);line-height:1.6;max-width:320px; }
    .success-email { font-weight:700;color:var(--accent); }
    .resend-link { font-size:.85rem;color:var(--txt3); margin-top: 0.5rem; }
    .resend-link a { color:var(--accent);font-weight:600;cursor:pointer; }
    .resend-link a:hover { text-decoration:underline; }

    /* ============================================================
       VISUAL SIDE (Desktop Only)
    ============================================================ */
    .auth-visual-side {
      display:none; /* Hidden on mobile */
      position:relative;overflow:hidden;
    }
    @media(min-width: 992px) { .auth-visual-side { display: block; } }

    .auth-visual-bg {
      position:absolute;inset:0;
      background:linear-gradient(160deg,var(--g100) 0%,var(--g200) 50%,var(--g300) 100%);
    }
    [data-bs-theme="dark"] .auth-visual-bg {
      background:linear-gradient(160deg,#0a2d18 0%,#0f4025 55%,#155c30 100%);
    }
    .auth-visual-overlay {
      position:absolute;inset:0;
      background-image:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2322c55e' fill-opacity='0.06'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .visual-content {
      position:relative;z-index:2;
      padding:3rem;height:100%;
      display:flex;flex-direction:column;
      justify-content:center;align-items:center;gap:1.5rem;text-align:center;
    }
    .visual-big-icon {
      font-size:5rem;line-height:1;animation:float 3s ease-in-out infinite;
    }
    @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
    .visual-title {
      font-family:var(--ff);font-weight:800;font-size:1.5rem;color:var(--txt);
      letter-spacing:-.02em;
    }
    .visual-sub {
      font-size:.95rem;color:var(--txt3);line-height:1.65;max-width:280px;
    }
    .security-badges { display:flex;flex-direction:column;gap:1rem;width:100%; max-width: 300px; }
    .security-badge {
      background:var(--card);border-radius:12px;
      padding:1rem 1.2rem;display:flex;align-items:center;gap:1rem;
      box-shadow:0 4px 16px rgba(0,0,0,.08); border: 1px solid rgba(255,255,255,0.2);
    }
    .security-badge-icon { font-size:20px;flex-shrink:0; }
    .security-badge-text {
      font-size:.85rem;color:var(--txt2);font-weight:500; line-height: 1.3;
    }
  </style>
</head>
<body>

<!-- ============================================================ TOP NAVBAR -->
<nav class="quest-navbar" id="nav">
  <div class="container-xl h-100 d-flex align-items-center justify-content-between">
    <a class="nav-logo" href="/">
      <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img">
      <span>Quest</span>
    </a>
    <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" aria-label="Toggle Theme">🌙</button>
  </div>
</nav>

<!-- ============================================================ PAGE WRAPPER -->
<div class="page-wrapper">
  <div class="auth-container">

    <!-- FORM SIDE -->
    <div class="auth-form-side">
      
      <!-- Default (Input) State -->
      <div id="formState">
        <div class="auth-header">
          <div class="forgot-icon-wrap">🔑</div>
          <h1 class="auth-title">Forgot password?</h1>
          <p class="auth-sub">No worries — enter your email and we'll send you reset instructions right away.</p>
        </div>
        
        <form onsubmit="event.preventDefault(); sendReset();" class="d-flex flex-column gap-2 mt-4">
          <div class="form-group">
            <label class="form-label" for="emailInput">Email address</label>
            <input class="form-input" type="email" id="emailInput" placeholder="you@example.com" required autocomplete="email">
          </div>
          <button class="btn-submit" id="submitBtn">Send Reset Link</button>
        </form>

        <p class="auth-switch">
          <a href="/login">← Back to login</a>
        </p>

        <div class="auth-footer">
          <span class="auth-footer-text">© 2025 Quest</span>
          <a class="auth-footer-text" href="#">Terms & Conditions</a>
        </div>
      </div>

      <!-- Success State -->
      <div class="success-state" id="successState">
        <div class="success-icon">📬</div>
        <h2 class="success-title">Check your inbox!</h2>
        <p class="success-sub">We've sent a reset link to <span class="success-email" id="successEmail"></span>. It expires in 15 minutes.</p>
        <p class="resend-link">Didn't receive it? <a onclick="resend()">Resend email</a></p>
        <p class="auth-switch"><a href="/login">← Back to login</a></p>
      </div>

    </div>

    <!-- VISUAL SIDE (Desktop) -->
    <div class="auth-visual-side">
      <div class="auth-visual-bg"></div>
      <div class="auth-visual-overlay"></div>
      <div class="visual-content">
        <div class="visual-big-icon">📩</div>
        <h3 class="visual-title">Secure password reset</h3>
        <p class="visual-sub">We take security seriously. Your reset link is encrypted, one-time use, and expires in 15 minutes.</p>
        <div class="security-badges">
          <div class="security-badge">
            <span class="security-badge-icon">🔒</span>
            <span class="security-badge-text">End-to-end encrypted link</span>
          </div>
          <div class="security-badge">
            <span class="security-badge-icon">⏱</span>
            <span class="security-badge-text">Expires in 15 minutes</span>
          </div>
          <div class="security-badge">
            <span class="security-badge-icon">✓</span>
            <span class="security-badge-text">One-time use only</span>
          </div>
          <div class="security-badge">
            <span class="security-badge-icon">🛡</span>
            <span class="security-badge-text">No password stored in plain text</span>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  /* Theme Toggle */
  let dark = false;
  function toggleTheme() {
    dark = !dark;
    document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
    document.getElementById('themeBtn').textContent = dark ? '☀️' : '🌙';
  }

  /* Form Logic */
  function sendReset(){
    const email = document.getElementById('emailInput').value.trim();
    const btn = document.getElementById('submitBtn');
    
    if(!email){
      document.getElementById('emailInput').focus();
      return;
    }
    
    btn.disabled = true;
    btn.textContent = 'Sending...';
    
    // Simulate API call
    setTimeout(() => {
      document.getElementById('formState').style.display = 'none';
      document.getElementById('successEmail').textContent = email;
      document.getElementById('successState').classList.add('show');
    }, 1200);
  }

  function resend(){
    const el = document.querySelector('.resend-link a');
    const originalText = el.textContent;
    el.textContent = 'Sent!';
    el.style.color = 'var(--accent)';
    setTimeout(() => {
      el.textContent = originalText;
      el.style.color = '';
    }, 3000);
  }
</script>
</body>
</html>