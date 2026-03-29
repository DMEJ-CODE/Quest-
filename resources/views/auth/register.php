<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Quest — Create Account</title>

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
      --nav-h: 80px;
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

    /* Ambient blobs (responsive) */
    .blob1,
    .blob2 {
      position: fixed;
      border-radius: 50%;
      pointer-events: none;
      z-index: 0;
    }

    .blob1 {
      top: -15%;
      right: -10%;
      width: 80vw;
      height: 80vw;
      max-width: 600px;
      max-height: 600px;
      background: radial-gradient(circle, rgba(34, 197, 94, .11) 0%, transparent 70%);
      animation: blobDrift 14s ease-in-out infinite alternate;
    }

    .blob2 {
      bottom: -15%;
      left: -10%;
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
      width: 40px;
      height: 40px;
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
       PAGE WRAPPER
    ============================================================ */
    .page-wrapper {
      min-height: 100vh;
      padding-top: calc(var(--nav-h) + 1rem);
      /* navbar + spacing */
      display: flex;
      align-items: center;
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
      border-radius: 24px;
      /* Less rounded on mobile */
      box-shadow: 0 20px 60px rgba(0, 0, 0, .08), 0 0 0 1px var(--bdr);
      overflow: hidden;
      width: 100%;
      max-width: 1000px;
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
       FORM SIDE
    ============================================================ */
    .form-side {
      padding: 1.5rem;
      /* Mobile padding */
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: auto;
    }

    @media(min-width: 576px) {
      .form-side {
        padding: 3rem;
      }
    }

    @media(min-width: 992px) {
      .form-side {
        padding: 3.5rem;
        min-height: 650px;
      }

      /* Taller for extra content */
    }

    .auth-title {
      font-family: var(--ff);
      font-weight: 800;
      font-size: clamp(1.5rem, 4vw, 2.2rem);
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
      border-radius: 10px;
      border: 1.5px solid var(--bdr2);
      background: var(--bg3);
      color: var(--txt);
      font-size: 1rem;
      /* Prevents iOS zoom */
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

    /* Password Strength */
    .strength-track {
      display: flex;
      gap: 4px;
      margin-top: 8px;
      /* Increased margin */
    }

    .s-bar {
      flex: 1;
      height: 4px;
      border-radius: 2px;
      background: var(--bdr2);
      transition: background .3s;
    }

    .s-bar.weak {
      background: #f87171;
    }

    .s-bar.medium {
      background: #fbbf24;
    }

    .s-bar.strong {
      background: var(--accent);
    }

    .strength-hint {
      font-size: .75rem;
      color: var(--txt4);
      margin-top: 4px;
      line-height: 1.3;
    }

    /* Submit */
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
      box-shadow: 0 10px 28px rgba(22, 163, 94, .5);
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

    /* Social Buttons */
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

    /* Terms & Switch */
    .form-check-input:checked {
      background-color: var(--accent);
      border-color: var(--accent);
    }

    .form-check-label {
      font-size: .85rem;
      color: var(--txt3);
      line-height: 1.4;
    }

    .q-link {
      color: var(--accent);
      font-weight: 600;
      transition: opacity var(--ease);
    }

    .q-link:hover {
      opacity: .7;
      text-decoration: underline;
    }

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
       VISUAL SIDE (Calendar & Meeting)
    ============================================================ */
    .visual-side {
      position: relative;
      overflow: hidden;
      background: linear-gradient(160deg, var(--g100) 0%, var(--g200) 50%, var(--g300) 100%);
      min-height: 400px;
    }

    @media(min-width: 992px) {
      .visual-side {
        min-height: auto;
      }
    }

    [data-bs-theme="dark"] .visual-side {
      background: linear-gradient(160deg, #0a2d18 0%, #0f4025 55%, #155c30 100%);
    }

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
      gap: 1.25rem;
    }

    /* Live Badge */
    .v-badge {
      background: var(--card);
      border-radius: 100px;
      padding: .5rem 1.1rem;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      box-shadow: 0 4px 16px rgba(0, 0, 0, .08);
      font-size: .8rem;
      font-weight: 600;
      color: var(--txt);
      align-self: center;
      white-space: nowrap;
    }

    .badge-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--accent);
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
        transform: scale(1)
      }

      50% {
        opacity: .6;
        transform: scale(1.25)
      }
    }

    /* Calendar Card */
    .v-cal {
      background: var(--card);
      border-radius: 16px;
      padding: 1.4rem 1.5rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, .1);
      border: 1px solid rgba(255, 255, 255, .2);
    }

    .v-cal-event {
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      border-radius: 12px;
      padding: 1rem 1.2rem;
      margin-bottom: 1rem;
      color: #fff;
    }

    .v-cal-event-lbl {
      font-size: .7rem;
      opacity: .9;
      margin-bottom: 4px;
      font-weight: 600;
    }

    .v-cal-event-title {
      font-weight: 700;
      font-size: 1rem;
      line-height: 1.2;
    }

    .v-cal-event-time {
      font-size: .8rem;
      opacity: .8;
      margin-top: 4px;
    }

    .v-cal-days {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 4px;
      margin-bottom: .5rem;
    }

    .v-cal-day-lbl {
      font-size: .7rem;
      font-weight: 700;
      color: var(--txt4);
      text-align: center;
      padding: 4px 0;
    }

    .v-cal-dates {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 4px;
    }

    .v-cal-date {
      font-size: .85rem;
      color: var(--txt3);
      text-align: center;
      padding: 8px 0;
      border-radius: 50%;
      cursor: pointer;
      transition: background var(--ease);
    }

    .v-cal-date:hover {
      background: var(--bg2);
    }

    .v-cal-date.today {
      background: var(--accent);
      color: #fff;
      font-weight: 700;
      box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4);
    }

    .v-cal-foot {
      font-size: .75rem;
      color: var(--txt4);
      margin-top: 1rem;
      text-align: center;
      font-weight: 500;
    }

    /* Meeting Card */
    .v-meeting {
      background: var(--card);
      border-radius: 16px;
      padding: 1.2rem 1.5rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, .1);
      border: 1px solid rgba(255, 255, 255, .2);
    }

    .v-meeting-lbl {
      font-size: .75rem;
      color: var(--txt4);
      margin-bottom: 4px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .v-meeting-title {
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--txt);
      margin-bottom: 4px;
      line-height: 1.2;
    }

    .v-meeting-time {
      font-size: .85rem;
      color: var(--txt3);
      margin-bottom: 1rem;
    }

    .v-avatars {
      display: flex;
      align-items: center;
    }

    .v-av {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      border: 2px solid var(--card);
      margin-left: -8px;
      background: linear-gradient(135deg, var(--g400), var(--g700));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 700;
      color: #fff;
      flex-shrink: 0;
    }

    .v-av:first-child {
      margin-left: 0;
    }

    .v-av.extra {
      background: var(--bg3);
      color: var(--txt3);
      font-size: 9px;
    }
  </style>
</head>

<body>

  <!-- ambient blobs -->
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

          <!-- ======= FORM SIDE ======= -->
          <div class="col-12 col-lg-5">
            <div class="form-side">

              <!-- Header -->
              <div>
                <h1 class="auth-title">Create an account</h1>
                <p class="auth-sub mb-0">Sign up and get a 30-day free Pro trial</p>
              </div>

              <!-- Form -->
              <form method="POST" action="/register" class="d-flex flex-column gap-3 my-4">

                <!-- Full name -->
                <div>
                  <label class="q-label" for="fullname">Full name</label>
                  <input class="q-input" type="text" name="name" id="fullname" placeholder="Amélie Laurent" required autocomplete="name">
                </div>

                <!-- Email -->
                <div>
                  <label class="q-label" for="email">Email</label>
                  <input class="q-input" type="email" name="email" id="email" placeholder="you@example.com" required autocomplete="email">
                </div>

                <!-- Password -->
                <div>
                  <label class="q-label" for="password">Password</label>
                  <div class="input-wrap">
                    <input class="q-input" type="password" name="password"
                      id="regPass" placeholder="••••••••••••••••" required autocomplete="new-password"
                      oninput="checkStrength(this.value)">
                    <button type="button" class="eye-btn" onclick="togglePass('regPass')" aria-label="Toggle password visibility">👁</button>
                  </div>
                  <!-- strength bars -->
                  <div class="strength-track">
                    <div class="s-bar" id="s1"></div>
                    <div class="s-bar" id="s2"></div>
                    <div class="s-bar" id="s3"></div>
                    <div class="s-bar" id="s4"></div>
                  </div>
                  <p class="strength-hint" id="strengthHint">Use 8+ characters, uppercase, numbers &amp; symbols</p>
                </div>

                <!-- Terms -->
                <div class="form-check d-flex gap-2">
                  <input class="form-check-input mt-0" type="checkbox" id="terms" required style="margin-top: 3px;">
                  <label class="form-check-label" for="terms">
                    I agree to the <a href="#" class="q-link">Terms</a> and <a href="#" class="q-link">Privacy Policy</a>
                  </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-submit">Create Account →</button>

                <!-- Divider -->
                <div class="q-divider"><span>or sign up with</span></div>

                <!-- Social -->
                <!-- Stacked on mobile (col-12) for better UX -->
               

                <!-- Switch -->
                <p class="auth-switch mb-0">Already have an account? <a href="/login">Sign in</a></p>

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

          <!-- ======= VISUAL SIDE (Hidden on mobile) ======= -->
          <div class="col-lg-7 d-none d-lg-block ">
            <div class="visual-side h-100">
              <div class="visual-inner">

                <!-- Live badge -->
                <div class="v-badge">
                  <div class="badge-dot"></div>
                  2,048 people joined this week
                </div>

                <!-- Calendar card -->
                <div class="v-cal">
                  <div class="v-cal-event">
                    <div class="v-cal-event-lbl">📅 TASK REVIEW WITH TEAM</div>
                    <div class="v-cal-event-title">Weekly Q&amp;A Challenge</div>
                    <div class="v-cal-event-time">09:30am – 10:00am</div>
                  </div>
                  <div class="v-cal-days">
                    <div class="v-cal-day-lbl">Sun</div>
                    <div class="v-cal-day-lbl">Mon</div>
                    <div class="v-cal-day-lbl">Tue</div>
                    <div class="v-cal-day-lbl">Wed</div>
                    <div class="v-cal-day-lbl">Thu</div>
                    <div class="v-cal-day-lbl">Fri</div>
                    <div class="v-cal-day-lbl">Sat</div>
                  </div>
                  <div class="v-cal-dates">
                    <div class="v-cal-date">22</div>
                    <div class="v-cal-date">23</div>
                    <div class="v-cal-date">24</div>
                    <div class="v-cal-date today">25</div>
                    <div class="v-cal-date">26</div>
                    <div class="v-cal-date">27</div>
                    <div class="v-cal-date">28</div>
                  </div>
                  <div class="v-cal-foot">📍 Daily Meeting</div>
                </div>

                <!-- Meeting card -->
                <div class="v-meeting">
                  <div class="v-meeting-lbl">Next Event</div>
                  <div class="v-meeting-title">Community Daily Meeting</div>
                  <div class="v-meeting-time">12:00pm – 01:00pm</div>
                  <div class="v-avatars">
                    <div class="v-av">A</div>
                    <div class="v-av">K</div>
                    <div class="v-av">M</div>
                    <div class="v-av">R</div>
                    <div class="v-av extra">+8</div>
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

    /* Password strength */
    function checkStrength(v) {
      const bars = [document.getElementById('s1'), document.getElementById('s2'),
        document.getElementById('s3'), document.getElementById('s4')
      ];
      const hint = document.getElementById('strengthHint');
      bars.forEach(b => b.className = 's-bar');

      if (!v.length) {
        hint.textContent = 'Use 8+ characters, uppercase, numbers & symbols';
        hint.style.color = 'var(--txt4)';
        return;
      }

      let score = 0;
      if (v.length >= 6) score++;
      if (v.length >= 10) score++;
      if (/[A-Z]/.test(v) && /[0-9]/.test(v)) score++;
      if (/[^A-Za-z0-9]/.test(v)) score++;

      const cls = score <= 1 ? 'weak' : score <= 2 ? 'medium' : 'strong';
      const label = score <= 1 ? 'Weak — add more characters' :
        score <= 2 ? 'Fair — try adding symbols' :
        'Strong password ✓';

      for (let i = 0; i < score; i++) bars[i].classList.add(cls);
      hint.textContent = label;
      hint.style.color = cls === 'weak' ? '#f87171' : cls === 'medium' ? '#fbbf24' : 'var(--accent)';
    }
  </script>
</body>

</html>