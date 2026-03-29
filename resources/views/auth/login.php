<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Quest — Log In</title>

  <!-- Favicon -->
  <link rel="icon" href="/assets/quest/favicon.ico" sizes="any">
  <link rel="icon" href="/assets/quest/favicon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="/assets/quest/apple-touch-icon.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/quest/forms.css">
  <link rel="stylesheet" href="/assets/quest/components.css">
  <link rel="stylesheet" href="/assets/quest/utilities.css">

  <style>
    /* ============================================================
       DESIGN TOKENS
    ============================================================ */
    :root {
      --g100: #dcfce7;
      --g200: #bbf7d0;
      --g300: #86efac;
      --g400: #4ade80;
      --g500: #22c55e;
      --g600: #16a34a;
      --g700: #15803d;
      --g800: #166534;
      --g900: #14532d;
      --accent: #22c55e;
      --accent-d: #16a34a;
      --accent-l: #4ade80;
      --bg: #f6fefa;
      --bg2: #edfbf3;
      --bg3: #f0fdf4;
      --card: #ffffff;
      --txt: #071a0e;
      --txt2: #374151;
      --txt3: #6b7280;
      --txt4: #9ca3af;
      --bdr: #c6f6d5;
      --bdr2: #e5e7eb;
      --sh: rgba(22, 163, 74, .12);
      --sh2: rgba(22, 163, 74, .22);
      --ff: 'Syne', sans-serif;
      --fb: 'DM Sans', sans-serif;
      --ease: .28s cubic-bezier(.4, 0, .2, 1);
      --nav-h: 70px;
    }

    [data-bs-theme="dark"] {
      --bg: #040d07;
      --bg2: #071209;
      --bg3: #0a1a0f;
      --card: #0d1f12;
      --txt: #ecfdf5;
      --txt2: #d1fae5;
      --txt3: #86efac;
      --txt4: #4ade80;
      --bdr: #1a3a24;
      --bdr2: #1e3326;
      --sh: rgba(34, 197, 94, .18);
      --sh2: rgba(34, 197, 94, .28);
    }

    /* ============================================================
       BASE
    ============================================================ */
    html,
    body {
      height: 100%;
    }

    body {
      font-family: var(--fb);
      background: var(--bg);
      color: var(--txt);
      overflow-x: hidden;
      transition: background var(--ease), color var(--ease);
      -webkit-font-smoothing: antialiased;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    /* Noise grain */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 9999;
      opacity: .5;
    }

    /* Ambient blobs (responsive sizes) */
    .blob1,
    .blob2 {
      position: fixed;
      border-radius: 50%;
      pointer-events: none;
      z-index: 0;
    }

    .blob1 {
      top: -15%;
      left: -10%;
      width: 80vw;
      height: 80vw;
      max-width: 600px;
      max-height: 600px;
      background: radial-gradient(circle, rgba(34, 197, 94, .11) 0%, transparent 70%);
      animation: blobDrift 14s ease-in-out infinite alternate;
    }

    .blob2 {
      bottom: -15%;
      right: -10%;
      width: 70vw;
      height: 70vw;
      max-width: 500px;
      max-height: 500px;
      background: radial-gradient(circle, rgba(74, 222, 128, .08) 0%, transparent 70%);
      animation: blobDrift 10s ease-in-out infinite alternate-reverse;
    }

    @keyframes blobDrift {
      from {
        transform: translate(0, 0) scale(1)
      }

      to {
        transform: translate(24px, 18px) scale(1.07)
      }
    }

    /* ============================================================
       NAVBAR (Responsive Optimized)
    ============================================================ */
    .quest-navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 200;
      height: var(--nav-h);
      background: rgba(246, 254, 250, .92);
      backdrop-filter: blur(24px) saturate(180%);
      border-bottom: 1px solid var(--bdr);
      transition: background var(--ease), box-shadow var(--ease), padding var(--ease);
    }

    [data-bs-theme="dark"] .quest-navbar {
      background: rgba(4, 13, 7, .92);
    }

    .quest-navbar.scrolled {
      box-shadow: 0 4px 30px var(--sh);
    }

    .nav-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-family: var(--ff);
      font-weight: 800;
      font-size: 1.25rem;
      color: var(--txt);
      letter-spacing: -.02em;
      z-index: 201;
    }

    .nav-logo .logo-img {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      object-fit: cover;
    }

    .nav-link-q {
      font-size: .9rem;
      font-weight: 600;
      color: var(--txt3) !important;
      position: relative;
      padding: 8px 0 !important;
      transition: color var(--ease);
    }

    .nav-link-q::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 2px;
      background: var(--accent);
      border-radius: 2px;
      transform: scaleX(0);
      transition: transform var(--ease);
    }

    .nav-link-q:hover {
      color: var(--accent) !important;
    }

    .nav-link-q:hover::after {
      transform: scaleX(1);
    }

    .btn-login-nav {
      padding: 8px 18px;
      border-radius: 50px;
      font-size: .85rem;
      font-weight: 600;
      color: var(--txt2);
      background: transparent;
      border: 1.5px solid var(--g500);
      transition: all var(--ease);
      white-space: nowrap;
    }

    .btn-login-nav:hover {
      color: var(--accent);
      background: var(--bg3);
      border-color: var(--accent);
    }

    .btn-signup-nav {
      padding: 9px 20px;
      border-radius: 50px;
      font-size: .85rem;
      font-weight: 700;
      color: #fff !important;
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      box-shadow: 0 4px 14px var(--sh);
      border: none;
      transition: all var(--ease);
      white-space: nowrap;
    }

    .btn-signup-nav:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 22px var(--sh2);
    }

    .theme-btn {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: var(--bg3);
      border: 1px solid var(--bdr);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      cursor: pointer;
      flex-shrink: 0;
      transition: all var(--ease);
    }

    .theme-btn:hover {
      background: var(--bdr);
      transform: rotate(15deg);
    }

    .navbar-toggler {
      border: none;
      box-shadow: none !important;
      padding: 8px;
      margin-left: 10px;
    }

    .navbar-toggler-icon {
      width: 24px;
      height: 24px;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2807, 26, 14, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* Offcanvas Mobile */
    .offcanvas {
      background: var(--card) !important;
      width: 85% !important;
      max-width: 320px;
    }

    [data-bs-theme="dark"] .offcanvas {
      border-right: 1px solid var(--bdr);
    }

    .offcanvas-header {
      border-bottom: 1px solid var(--bdr);
      padding: 1rem 1.25rem;
    }

    .offcanvas-body {
      padding: 0.5rem 1.25rem;
    }

    .mob-link {
      display: block;
      padding: 1rem 0;
      font-size: 1.05rem;
      font-weight: 600;
      color: var(--txt2);
      border-bottom: 1px solid var(--bdr);
      transition: color var(--ease);
      width: 100%;
      text-align: left;
      background: none;
      border: none;
    }

    .mob-link:hover {
      color: var(--accent);
      padding-left: 5px;
    }

    .mob-btns {
      padding: 1.5rem 1.25rem;
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: var(--card);
      border-top: 1px solid var(--bdr);
    }

    /* ============================================================
       PAGE LAYOUT
    ============================================================ */
    .page-wrapper {
      min-height: 100vh;
      padding-top: calc(var(--nav-h) + 1rem);
      /* navbar + spacing */
      display: flex;
      align-items: center;
      /* Centers vertically in remaining space */
      justify-content: center;
      position: relative;
      z-index: 1;
      padding-bottom: 2rem;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    @media(min-width: 768px) {
      .page-wrapper {
        padding-top: var(--nav-h);
      }
    }

    /* ============================================================
       AUTH CARD
    ============================================================ */
    .auth-card {
      background: var(--card);
      border: 1px solid var(--bdr);
      /* Less rounded on mobile for a more native feel */
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, .08), 0 0 0 1px var(--bdr);
      overflow: hidden;
      width: 100%;
      max-width: 1000px;
      /* Slightly wider on desktop */
      animation: slideUp .5s ease forwards;
      margin: 0 auto;
    }

    @media(min-width: 992px) {
      .auth-card {
        border-radius: 32px;
        box-shadow: 0 32px 80px rgba(0, 0, 0, .1), 0 0 0 1px var(--bdr);
      }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(24px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    /* ============================================================
       FORM SIDE (Responsive)
    ============================================================ */
    .form-side {
      padding: 2rem;
      /* Mobile padding */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: auto;
      /* Let content define height on mobile */
    }

    @media(min-width: 576px) {
      .form-side {
        padding: 3rem;
      }
    }

    @media(min-width: 992px) {
      .form-side {
        padding: 3.5rem;
        min-height: 600px;
      }

      /* Desktop height */
    }

    .auth-title {
      font-family: var(--ff);
      font-weight: 800;
      font-size: clamp(1.5rem, 4vw, 2.2rem);
      /* Fluid typography */
      letter-spacing: -.03em;
      color: var(--txt);
      margin-bottom: .25rem;
    }

    .auth-sub {
      font-size: .9rem;
      color: var(--txt3);
      line-height: 1.55;
    }

    /* Inputs */
    .q-label {
      font-size: .75rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .06em;
      color: var(--txt4);
      margin-bottom: 6px;
      display: block;
    }

    .q-input {
      width: 100%;
      padding: 12px 16px;
      /* Slightly smaller padding on mobile */
      border-radius: 10px;
      border: 1.5px solid var(--bdr2);
      background: var(--bg3);
      color: var(--txt);
      font-size: 1rem;
      /* 16px prevents iOS zoom */
      font-family: var(--fb);
      transition: all var(--ease);
      outline: none;
    }

    @media(min-width: 576px) {
      .q-input {
        padding: 13px 16px;
      }
    }

    .q-input:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 3px rgba(34, 197, 94, .14);
      background: var(--card);
    }

    .q-input::placeholder {
      color: var(--txt4);
    }

    .input-wrap {
      position: relative;
    }

    .input-wrap .q-input {
      padding-right: 46px;
    }

    .eye-btn {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--txt4);
      cursor: pointer;
      font-size: 18px;
      user-select: none;
      transition: color var(--ease);
      background: none;
      border: none;
      padding: 5px;
    }

    .eye-btn:hover {
      color: var(--accent);
    }

    /* Submit Button */
    .btn-submit {
      width: 100%;
      padding: 14px;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: 700;
      color: #fff;
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      box-shadow: 0 6px 20px rgba(22, 163, 74, .4);
      border: none;
      transition: all var(--ease);
      font-family: var(--fb);
      letter-spacing: .01em;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(22, 163, 74, .5);
    }

    .btn-submit:active {
      transform: translateY(0);
    }

    /* Divider */
    .q-divider {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: .75rem;
      color: var(--txt4);
      margin: 0.5rem 0;
    }

    .q-divider::before,
    .q-divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--bdr2);
    }

    /* Social Buttons (Stacked on mobile for better touch targets) */
    .btn-social {
      padding: 12px;
      border-radius: 10px;
      border: 1.5px solid var(--bdr2);
      background: var(--card);
      color: var(--txt2);
      font-size: .9rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: all var(--ease);
      cursor: pointer;
      font-family: var(--fb);
      width: 100%;
    }

    .btn-social:hover {
      border-color: var(--accent);
      color: var(--accent);
      background: var(--bg3);
    }

    /* Remember / Forgot */
    .form-check-input:checked {
      background-color: var(--accent);
      border-color: var(--accent);
    }

    .form-check-label {
      font-size: .85rem;
      color: var(--txt3);
    }

    .q-link {
      color: var(--accent);
      font-weight: 600;
      font-size: .85rem;
      transition: opacity var(--ease);
    }

    .q-link:hover {
      opacity: .7;
      text-decoration: underline;
    }

    /* Switch & Footer */
    .auth-switch {
      text-align: center;
      font-size: .85rem;
      color: var(--txt3);
      margin-top: 0.5rem;
    }

    .auth-switch a {
      color: var(--accent);
      font-weight: 600;
    }

    .auth-foot {
      border-top: 1px solid var(--bdr);
      padding-top: 1rem;
      margin-top: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: .75rem;
    }

    .auth-foot span,
    .auth-foot a {
      font-size: .75rem;
      color: var(--txt4);
    }

    .auth-foot a:hover {
      color: var(--accent);
    }

    /* ============================================================
       VISUAL SIDE (Desktop only)
    ============================================================ */
    .visual-side {
      position: relative;
      overflow: hidden;
      background: linear-gradient(160deg, var(--g100) 0%, var(--g200) 50%, var(--g300) 100%);
      min-height: 400px;
      /* Minimum height for when it's hidden but structure exists if needed */
    }

    @media(min-width: 992px) {
      .visual-side {
        min-height: auto;
      }
    }

    [data-bs-theme="dark"] .visual-side {
      background: linear-gradient(160deg, #0a2d18 0%, #0f4025 55%, #155c30 100%);
    }

    /* dot pattern */
    .visual-side::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='30' cy='30' r='3' fill='%2322c55e' fill-opacity='0.07'/%3E%3C/svg%3E");
      pointer-events: none;
    }

    .visual-inner {
      position: relative;
      z-index: 2;
      padding: clamp(2rem, 4vw, 3rem);
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 1.1rem;
    }

    /* stat pill */
    .v-stat {
      background: var(--card);
      border-radius: 14px;
      padding: 1rem 1.4rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, .1);
      border: 1px solid rgba(255, 255, 255, .25);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .v-stat-lbl {
      font-size: .75rem;
      color: var(--txt3);
    }

    .v-stat-num {
      font-family: var(--ff);
      font-weight: 800;
      font-size: clamp(1.2rem, 2.5vw, 1.5rem);
      color: var(--txt);
      line-height: 1;
    }

    .v-badge {
      font-size: .7rem;
      font-weight: 600;
      color: var(--accent);
      background: var(--g100);
      border-radius: 100px;
      padding: 4px 10px;
      white-space: nowrap;
    }

    [data-bs-theme="dark"] .v-badge {
      background: rgba(34, 197, 94, .15);
    }

    /* qa cards */
    .v-card {
      background: var(--card);
      border-radius: 14px;
      padding: 1.1rem 1.3rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, .1);
      border: 1px solid rgba(255, 255, 255, .2);
      animation: vFloat 4s ease-in-out infinite;
    }

    .v-card:nth-child(2) {
      animation-delay: .6s;
    }

    .v-card:nth-child(3) {
      animation-delay: 1.2s;
    }

    @keyframes vFloat {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-6px)
      }
    }

    .v-tag {
      display: inline-block;
      font-size: .65rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .06em;
      color: var(--accent);
      background: var(--g100);
      border-radius: 4px;
      padding: 3px 8px;
      margin-bottom: 8px;
    }

    [data-bs-theme="dark"] .v-tag {
      background: rgba(34, 197, 94, .15);
    }

    .v-q {
      font-size: clamp(0.8rem, 1.2vw, 0.9rem);
      font-weight: 600;
      color: var(--txt);
      line-height: 1.45;
      margin-bottom: 10px;
    }

    .v-meta {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .v-av {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      flex-shrink: 0;
      background: linear-gradient(135deg, var(--g400), var(--g700));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 700;
      color: #fff;
    }

    .v-user {
      font-size: .75rem;
      color: var(--txt3);
      flex: 1;
    }

    .v-votes {
      font-size: .75rem;
      font-weight: 700;
      color: var(--accent);
    }
  </style>
</head>

<body>

  <!-- ambient -->
  <div class="blob1"></div>
  <div class="blob2"></div>

  <!-- ============================================================ NAVBAR -->
  <nav class="quest-navbar" id="nav">
    <div class="container-xl h-100">
      <div class="d-flex align-items-center justify-content-between h-100 gap-3">

        <!-- Logo -->
        <a href="/" class="nav-logo flex-shrink-0">
          <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img">
          <span>Quest</span>
        </a>

        <!-- Desktop nav links -->
        <ul class="d-none d-lg-flex align-items-center gap-4 list-unstyled mb-0 mx-auto">
          <li><a href="/#features" class="nav-link-q">Features</a></li>
          <li><a href="/#how" class="nav-link-q">How it Works</a></li>
          <li><a href="/#topics" class="nav-link-q">Topics</a></li>
          <li><a href="/#pricing" class="nav-link-q">Pricing</a></li>
          <li><a href="/#faq" class="nav-link-q">FAQ</a></li>
        </ul>

        <!-- Right actions -->
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
          <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" aria-label="Toggle Theme">🌙</button>
          <a href="/login" class="btn-login-nav  d-none d-md-inline-block">Log In</a>
          <a href="/register" class="btn-signup-nav d-none d-sm-inline-block">Get Started →</a>
          <button class="navbar-toggler d-lg-none" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-label="Open Menu">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </div>
  </nav>

  <!-- Mobile offcanvas -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="mobileMenuLabel" style="display:none;">Menu</h5>
      <a href="/" class="nav-logo">
        <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img">
        <span>Quest</span>
      </a>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column" style="padding-bottom: 140px;">
      <a href="/#features" class="mob-link" data-bs-dismiss="offcanvas">Features</a>
      <a href="/#how" class="mob-link" data-bs-dismiss="offcanvas">How it Works</a>
      <a href="/#topics" class="mob-link" data-bs-dismiss="offcanvas">Topics</a>
      <a href="/#pricing" class="mob-link" data-bs-dismiss="offcanvas">Pricing</a>
      <a href="/#faq" class="mob-link" data-bs-dismiss="offcanvas">FAQ</a>

      <div class="mob-btns d-grid gap-2">
        <a href="/login" class="btn-hero-ghost text-center" style="border:1.5px solid var(--bdr2); padding: 12px; border-radius: 50px;">Log In</a>
        <a href="/register" class="btn-signup-nav text-center py-3">Get Started →</a>
      </div>
    </div>
  </div>

  <!-- ============================================================ PAGE -->
  <div class="page-wrapper">
    <div class="container-xl px-0">
      <div class="auth-card">
        <div class="row g-0 h-100">

          <!-- ======= FORM SIDE (Full width on mobile/tablet, 5/12 on desktop) ======= -->
          <div class="col-12 col-lg-5">
            <div class="form-side">

              <!-- Header -->
              <div>
                <h1 class="auth-title">Welcome back</h1>
                <p class="auth-sub mb-0">Log in and continue your quest for knowledge</p>
              </div>

              <!-- Form -->
              <form method="POST" action="/login" class="d-flex flex-column gap-3 my-4">

                <!-- Email -->
                <div>
                  <label class="q-label" for="email">Email</label>
                  <input class="q-input" type="email" name="email" id="email" placeholder="you@example.com" required autocomplete="email">
                </div>

                <!-- Password -->
                <div>
                  <label class="q-label" for="password">Password</label>
                  <div class="input-wrap">
                    <input class="q-input" type="password" name="password" id="loginPass" placeholder="••••••••••••••••" required autocomplete="current-password">
                    <button type="button" class="eye-btn" onclick="togglePass('loginPass')" aria-label="Toggle password visibility">👁</button>
                  </div>
                </div>

                <!-- Remember / Forgot -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                  <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div>
                  <a href="/forgot" class="q-link">Forgot password?</a>
                  
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">Log In →</button>

                <!-- Divider -->
                <div class="q-divider"><span>or continue with</span></div>

                <!-- Social -->
                <!-- Stacked on mobile (col-12) for better touch targets -->
                <div class="row g-2">
                  <div class="col-12">
                    <button type="button" class="btn-social">🍎 Sign in with Apple</button>
                  </div>
                  <div class="col-12">
                    <button type="button" class="btn-social">G&nbsp; Sign in with Google</button>
                  </div>
                </div>

                <!-- Switch -->
                <p class="auth-switch mb-0">Don't have an account? <a href="/register">Sign up</a></p>

              </form>

              <!-- Footer -->
              <div class="auth-foot">
                <span>© 2025 Quest</span>
                <div class="d-flex gap-3">
                  <a href="#">Terms</a>
                  <a href="#">Privacy</a>
                </div>
              </div>

            </div>
          </div>

          <!-- ======= VISUAL SIDE (Hidden on mobile, visible on desktop) ======= -->
          <div class="col-lg-7 d-none d-lg-block">
            <div class="visual-side h-100">
              <div class="visual-inner">

                <!-- Stat bar -->
                <div class="v-stat">
                  <div>
                    <div class="v-stat-lbl">Questions answered today</div>
                    <div class="v-stat-num">48K</div>
                  </div>
                  <div class="v-badge">↑ 12% today</div>
                </div>

                <!-- QA cards -->
                <div class="v-card">
                  <span class="v-tag">🔥 Trending</span>
                  <p class="v-q">What's the difference between RAM and storage?</p>
                  <div class="v-meta">
                    <div class="v-av">A</div>
                    <span class="v-user">answered by Alex K.</span>
                    <span class="v-votes">▲ 842</span>
                  </div>
                </div>

                <div class="v-card">
                  <span class="v-tag">✓ Verified</span>
                  <p class="v-q">How do black holes form from stellar collapse?</p>
                  <div class="v-meta">
                    <div class="v-av">M</div>
                    <span class="v-user">answered by Maria S.</span>
                    <span class="v-votes">▲ 619</span>
                  </div>
                </div>

                <div class="v-card">
                  <span class="v-tag">⚡ Quick</span>
                  <p class="v-q">Best way to learn Spanish in 6 months?</p>
                  <div class="v-meta">
                    <div class="v-av">R</div>
                    <span class="v-user">answered by Raj P.</span>
                    <span class="v-votes">▲ 504</span>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div><!-- /row -->
      </div><!-- /auth-card -->
    </div><!-- /container -->
  </div><!-- /page-wrapper -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    /* Theme */
    let dark = false;

    function toggleTheme() {
      dark = !dark;
      document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
      document.getElementById('themeBtn').textContent = dark ? '☀️' : '🌙';
    }

    /* Navbar scroll shadow */
    window.addEventListener('scroll', () => {
      const nav = document.getElementById('nav');
      if (window.scrollY > 10) {
        nav.classList.add('scrolled');
        nav.style.paddingTop = '0px';
        nav.style.paddingBottom = '0px';
      } else {
        nav.classList.remove('scrolled');
        nav.style.paddingTop = '';
        nav.style.paddingBottom = '';
      }
    }, {
      passive: true
    });

    /* Password toggle */
    function togglePass(id) {
      const el = document.getElementById(id);
      el.type = el.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>

</html>