<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <script>
    (function() {
      const savedTheme = localStorage.getItem('questTheme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
    })();
  </script>
  <title><?php echo $title ?? 'Quest - Auth'; ?></title>

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
      --sh:rgba(0,0,0,.5);--sh2:rgba(0,0,0,.7);

      .bg-white, .btn-light { background-color: var(--card) !important; color: var(--txt) !important; }
      .bg-light { background-color: var(--bg3) !important; color: var(--txt2) !important; }
      .text-dark { color: var(--txt) !important; }
      .text-secondary { color: var(--txt3) !important; }
      .border, .border-bottom { border-color: var(--bdr) !important; }
      input.form-input { background: var(--bg3) !important; border-color: var(--bdr) !important; color: var(--txt) !important; }
      input.form-input:focus { background: var(--card) !important; }
      .q-divider::before, .q-divider::after { background: var(--bdr) !important; }
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
      flex-direction:column;
      transition:background var(--ease),color var(--ease);
      position:relative; overflow-x: hidden;
    }
    a { text-decoration:none;color:inherit; }
    button { cursor:pointer; border:none; font-family: inherit; }

    /* Ambient blobs */
    body::before {
      content:'';position:fixed;top:-15%;left:-10%;width:60vw;height:60vw;max-width:500px;max-height:500px;
      background:radial-gradient(circle,rgba(34,197,94,.1) 0%,transparent 70%);border-radius:50%;pointer-events:none;z-index:0;
      animation:blobDrift 14s ease-in-out infinite alternate;
    }
    body::after {
      content:'';position:fixed;bottom:-15%;right:-10%;width:50vw;height:50vw;max-width:400px;max-height:400px;
      background:radial-gradient(circle,rgba(74,222,128,.07) 0%,transparent 70%);border-radius:50%;pointer-events:none;z-index:0;
      animation:blobDrift 10s ease-in-out infinite alternate-reverse;
    }
    @keyframes blobDrift{from{transform:translate(0,0) scale(1)}to{transform:translate(20px,15px) scale(1.05)}}

    /* ============================================================
       NAVBAR (Simplified for Auth Page)
    ============================================================ */
    .quest-navbar {
      position:fixed;top:0;left:0;right:0;z-index:200;height:var(--nav-h);
      background:rgba(246,254,250,.92);
      backdrop-filter:blur(20px) saturate(180%);
      border-bottom:1px solid var(--bdr);
      transition:background var(--ease),box-shadow var(--ease), padding var(--ease);
    }
    [data-bs-theme="dark"] .quest-navbar { background:rgba(4,13,7,.92); }

    .nav-logo {
      display:flex;align-items:center;gap:10px;
      font-family:var(--ff);font-weight:800;font-size:1.25rem;
      color:var(--txt);letter-spacing:-.02em;
    }
    .nav-logo .logo-img { width:70px;height:70px;border-radius:12px; object-fit: cover; }

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
      padding-top:calc(var(--nav-h) + 1rem);
      padding-bottom: 1rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    @media(min-width: 768px) {
      .page-wrapper { padding-top: var(--nav-h); padding-bottom: 2rem; }
    }

    /* ============================================================
       AUTH CARD (Split Layout)
    ============================================================ */
    .auth-container {
      background:var(--card);
      border:1px solid var(--bdr);
      border-radius:24px;
      box-shadow:0 20px 60px rgba(0,0,0,.08),0 0 0 1px var(--bdr);
      width:100%;
      max-width:480px;
      overflow:hidden;
      animation:slideUp .5s ease forwards;
      margin: 0 auto;
      position: relative;
      min-height: 520px; /* Consistent minimum height across all pages */
    }

    @media(min-width: 992px) {
      .auth-container {
        display:grid;
        grid-template-columns: 1fr 1fr;
        max-width:900px; /* Reduced from 1000px to make it less wide on large screens */
        border-radius:32px;
        box-shadow:0 32px 80px rgba(0,0,0,.1),0 0 0 1px var(--bdr);
        min-height: 520px; /* Minimum height for consistency, allows content to expand if needed */
      }
    }

    @media(min-width: 1200px) {
      .auth-container {
        max-width:800px; /* Further limit on very large screens */
      }
    }

    @keyframes slideUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}

    /* ============================================================
       FORM SIDE
    ============================================================ */
    .auth-form-side {
      padding:1.5rem;
      display:flex;flex-direction:column;justify-content:space-between;
      min-height: auto;
    }
    @media(min-width: 576px) { .auth-form-side { padding: 2rem; } }
    @media(min-width: 992px) { .auth-form-side { padding: 2.5rem; } }

    .auth-header { margin-bottom:1.5rem; text-align: center; }
    @media(min-width: 992px) { .auth-header { text-align: left; margin-bottom: 2rem; } }

    .forgot-icon-wrap, .login-icon-wrap, .register-icon-wrap {
      width:64px;height:64px;border-radius:50%;
      background:linear-gradient(135deg,var(--g100),var(--g200));
      display:flex;align-items:center;justify-content:center;font-size:28px;
      margin:0 auto 1.2rem auto; box-shadow: 0 8px 24px var(--sh);
    }
    [data-bs-theme="dark"] .forgot-icon-wrap, [data-bs-theme="dark"] .login-icon-wrap, [data-bs-theme="dark"] .register-icon-wrap {
      background:linear-gradient(135deg,#0a2d18,#155c30);
    }
    @media(min-width: 992px) { .forgot-icon-wrap, .login-icon-wrap, .register-icon-wrap { margin: 0 0 1.2rem 0; } }

    .auth-title {
      font-family:var(--ff);font-weight:800;
      font-size:clamp(1.5rem, 3vw, 2rem); /* Reduced max size */
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
      font-size:1rem;
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
    .btn-submit:hover { transform:translateY(-2px);box-shadow:0 10px 28px rgba(22,163,74,.5); }
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

    /* Social Buttons */
    .btn-social {
      padding: 12px;
      border-radius: 50px;
      border: 1.5px solid var(--bdr2);
      background: var(--bg3);
      color: var(--txt);
      font-size: 0.9rem;
      font-weight: 600;
      transition: all var(--ease);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .btn-social:hover {
      background: var(--bdr);
      border-color: var(--accent);
    }

    /* Custom Checkboxes */
    .form-check-input {
      display: none;
    }
    .form-check-label {
      position: relative;
      padding-left: 30px;
      cursor: pointer;
      font-size: 0.85rem;
      color: var(--txt3);
    }
    .form-check-label::before {
      content: '';
      position: absolute;
      left: 0;
      top: 2px;
      width: 18px;
      height: 18px;
      border: 2px solid var(--bdr2);
      border-radius: 4px;
      background: var(--bg3);
      transition: all var(--ease);
    }
    .form-check-input:checked + .form-check-label::before {
      background: var(--accent);
      border-color: var(--accent);
    }
    .form-check-input:checked + .form-check-label::after {
      content: '✓';
      position: absolute;
      left: 3px;
      top: 1px;
      color: white;
      font-size: 12px;
      font-weight: bold;
    }

    /* ============================================================
       VISUAL SIDE (Desktop Only)
    ============================================================ */
    .auth-visual-side {
      display:none;
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
      padding:2.5rem;height:100%;
      display:flex;flex-direction:column;
      justify-content:center;align-items:center;gap:1.5rem;text-align:center;
    }
    .visual-big-icon {
      font-size:4rem; /* Reduced from 5rem */
      line-height:1;animation:float 3s ease-in-out infinite;
    }
    @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
    .visual-title {
      font-family:var(--ff);font-weight:800;font-size:1.4rem;color:var(--txt);
      letter-spacing:-.02em;
    }
    .visual-sub {
      font-size:.9rem;color:var(--txt3);line-height:1.65;max-width:260px; /* Reduced */
    }
    .security-badges { display:flex;flex-direction:column;gap:1rem;width:100%; max-width: 280px; }
    .security-badge {
      background:var(--card);border-radius:12px;
      padding:1rem 1.2rem;display:flex;align-items:center;gap:1rem;
      box-shadow:0 4px 16px rgba(0,0,0,.08); border: 1px solid rgba(255,255,255,0.2);
    }
    .security-badge-icon { font-size:18px;flex-shrink:0; } /* Reduced */
    .security-badge-text {
      font-size:.8rem;color:var(--txt2);font-weight:500; line-height: 1.3;
    }
  </style>
</head>
<body>

<!-- ============================================================ TOP NAVBAR -->
<nav class="quest-navbar" id="nav">
  <div class="container-xl h-100 d-flex align-items-center justify-content-between">
    <a class="nav-logo" href="/">
      <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img">
      <span>Quest<sup>+</sup></span>
    </a>
    <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" aria-label="Toggle Theme">🌙</button>
  </div>
</nav>

<!-- ============================================================ PAGE WRAPPER -->
<div class="page-wrapper">
  <div class="auth-container">
    <?php echo $pageBody ?? ''; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function applyTheme(theme) {
    document.documentElement.setAttribute('data-bs-theme', theme);
    const btn = document.getElementById('themeBtn');
    if (btn) btn.textContent = theme === 'dark' ? '☀️' : '🌙';
    localStorage.setItem('questTheme', theme);
  }

  function toggleTheme() {
    const current = document.documentElement.getAttribute('data-bs-theme') || 'light';
    const next = current === 'dark' ? 'light' : 'dark';
    applyTheme(next);
  }

  // Pre-set button state
  document.addEventListener('DOMContentLoaded', () => {
    const theme = document.documentElement.getAttribute('data-bs-theme');
    const btn = document.getElementById('themeBtn');
    if (btn) btn.textContent = theme === 'dark' ? '☀️' : '🌙';
  });

  /* Register Steps */
  function nextStep() {
    document.getElementById('step1').style.display = 'none';
    document.getElementById('step2').style.display = 'block';
  }
  function prevStep() {
    document.getElementById('step2').style.display = 'none';
    document.getElementById('step1').style.display = 'block';
  }

  /* Register Validation */
  function validateRegister() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const terms = document.getElementById('terms').checked;

    if (password !== confirmPassword) {
      alert('Passwords do not match.');
      return false;
    }
    if (!terms) {
      alert('Please accept the Terms and Privacy Policy.');
      return false;
    }
    return true;
  }
</script>

<!-- ================================================================
     FLASH TOAST SYSTEM
================================================================ -->
<?php if (isset($flash) && $flash): ?>
<div id="questToast" class="flash-toast <?= $flash['type'] ?>">
    <div class="toast-icn">
        <i class="fas <?= $flash['type'] === 'success' ? 'fa-check-circle' : ($flash['type'] === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle') ?>"></i>
    </div>
    <div class="toast-txt"><?= htmlspecialchars($flash['message']) ?></div>
    <button class="toast-cls" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
</div>

<style>
.flash-toast {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: var(--card);
    border: 1px solid var(--bdr);
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12);
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 20px;
    min-width: 300px;
    max-width: 400px;
    z-index: 9999;
    animation: toastSlideUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
}
@keyframes toastSlideUp {
    from { opacity: 0; transform: translateY(40px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
@keyframes toastFadeOut {
    to { opacity: 0; transform: translateY(-10px); }
}
.flash-toast.success .toast-icn { color: #10b981; }
.flash-toast.error .toast-icn { color: #ef4444; }
.flash-toast.info .toast-icn { color: #3b82f6; }
.flash-toast.warning .toast-icn { color: #f59e0b; }

.toast-icn { font-size: 1.5rem; }
.toast-txt { font-weight: 600; font-size: 0.9rem; color: var(--txt); flex: 1; line-height: 1.3; }
.toast-cls { background: none; border: none; font-size: 1rem; color: var(--txt4); cursor: pointer; transition: color 0.2s; }
.toast-cls:hover { color: var(--txt2); }

.toast-hiding {
    animation: toastFadeOut 0.4s ease forwards !important;
}

[data-bs-theme="dark"] .flash-toast {
    background: var(--bg2);
    box-shadow: 0 10px 40px rgba(0,0,0,0.4);
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toast = document.getElementById('questToast');
        if (toast) {
            setTimeout(() => {
                toast.classList.add('toast-hiding');
                setTimeout(() => toast.remove(), 400);
            }, 5000);
        }
    });
</script>
<?php endif; ?>

</body>
</html>