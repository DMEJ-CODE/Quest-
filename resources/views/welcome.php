<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Quest — Q&A Platform</title>

  <!-- Original favicon / icons -->
  <link rel="icon" href="/assets/quest/favicon.ico" sizes="any">
  <link rel="icon" href="/assets/quest/favicon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="/assets/quest/apple-touch-icon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
      /* Hauteur navbar unifiée */
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
       BASE & RESET
    ============================================================ */
    html {
      scroll-behavior: smooth;
      font-size: 16px;
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

    /* noise texture */
    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
      pointer-events: none;
      z-index: 9999;
      opacity: .5;
    }

    /* ============================================================
       NAVBAR (Optimized for touch & sizing)
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
      /* Au-dessus du toggler */
    }

    .nav-logo .logo-img {
      width: 70px;
      height: 70px;
      border-radius: 10px;
      object-fit: cover;
    }

    /* Desktop Links */
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

    /* Buttons */
    .btn-login {
      padding: 8px 18px;
      border-radius: 50px;
      font-size: .85rem;
      font-weight: 600;
      color: var(--txt2);
      background: transparent;
      border: 1.5px solid var(--g500);
      transition: all var(--ease);
      white-space: nowrap;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .btn-login:hover {
      color: var(--accent);
      background: var(--bg3);
      border-color: var(--accent);
    }

    .btn-signup {
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
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .btn-signup:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 22px var(--sh2);
    }

    .theme-btn {
      width: 48px;
      height: 48px;
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

    .theme-btn:active {
      transform: scale(0.95);
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

    /* Mobile Offcanvas */
    .offcanvas {
      background: var(--card) !important;
      width: 85% !important;
      /* Plus large sur mobile */
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
      transition: all var(--ease);
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
       HERO (Mobile First Responsive)
    ============================================================ */
    .hero-section {
      min-height: 100vh;
      /* Fallback */
      min-height: 100dvh;
      /* Mobile viewport fix */
      padding-top: var(--nav-h);
      position: relative;
      overflow: hidden;
      background: var(--bg);
      display: flex;
      align-items: center;
    }

    .hero-blob1 {
      position: absolute;
      top: -10%;
      left: -20%;
      width: 80vw;
      height: 80vw;
      max-width: 700px;
      max-height: 700px;
      background: radial-gradient(circle, rgba(34, 197, 94, .13) 0%, transparent 65%);
      border-radius: 50%;
      pointer-events: none;
      animation: blobDrift 12s ease-in-out infinite alternate;
    }

    .hero-blob2 {
      position: absolute;
      bottom: -15%;
      right: -20%;
      width: 70vw;
      height: 70vw;
      max-width: 580px;
      max-height: 580px;
      background: radial-gradient(circle, rgba(74, 222, 128, .09) 0%, transparent 65%);
      border-radius: 50%;
      pointer-events: none;
      animation: blobDrift 9s ease-in-out infinite alternate-reverse;
    }

    @keyframes blobDrift {
      from {
        transform: translate(0, 0) scale(1)
      }

      to {
        transform: translate(30px, 20px) scale(1.06)
      }
    }

    .hero-grid {
      position: absolute;
      inset: 0;
      background-image: linear-gradient(var(--bdr) 1px, transparent 1px), linear-gradient(90deg, var(--bdr) 1px, transparent 1px);
      background-size: 60px 60px;
      opacity: .15;
      pointer-events: none;
    }

    .hero-inner {
      position: relative;
      z-index: 2;
      width: 100%;
    }

    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--bg3);
      border: 1px solid var(--bdr);
      border-radius: 100px;
      padding: 5px 12px 5px 4px;
      margin-bottom: 1rem;
    }

    .ey-dot {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--g700));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
    }

    .ey-txt {
      font-size: .7rem;
      font-weight: 700;
      color: var(--g700);
      text-transform: uppercase;
      letter-spacing: .07em;
    }

    [data-bs-theme="dark"] .ey-txt {
      color: var(--g300);
    }

    .hero-kicker {
      font-size: .8rem;
      color: var(--txt4);
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: .5rem;
      justify-content: center;
      /* Centered on mobile */
      margin-bottom: 1rem;
    }

    @media(min-width: 992px) {
      .hero-kicker {
        justify-content: flex-start;
      }
    }

    .k-num {
      font-family: var(--ff);
      font-weight: 800;
      font-size: 1rem;
      color: var(--txt);
    }

    .hero-h1 {
      font-family: var(--ff);
      font-weight: 800;
      font-size: clamp(2.2rem, 5vw, 5.5rem);
      /* Ajusted clamp for better mobile start */
      line-height: 1.05;
      letter-spacing: -.03em;
      color: var(--txt);
      margin-bottom: 1rem;
    }

    .hero-h1 em {
      font-style: normal;
      color: var(--accent);
    }

    .hero-h1 sup {
      font-size: .35em;
      vertical-align: super;
      color: var(--accent);
    }

    .hero-sub {
      font-size: 1rem;
      color: var(--txt3);
      line-height: 1.6;
      max-width: 500px;
      margin-bottom: 1.5rem;
    }

    .btn-hero {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px 24px;
      border-radius: 50px;
      font-size: .95rem;
      font-weight: 700;
      color: #fff !important;
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      box-shadow: 0 8px 28px var(--sh2);
      border: none;
      transition: all var(--ease);
      width: 100%;
      /* Full width on mobile */
    }

    @media(min-width: 576px) {
      .btn-hero {
        width: auto;
      }
    }

    .btn-hero:hover {
      transform: translateY(-2px);
      box-shadow: 0 14px 40px var(--sh2);
    }

    .btn-hero-ghost {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 12px 24px;
      border-radius: 50px;
      font-size: .95rem;
      font-weight: 600;
      color: var(--txt2) !important;
      background: var(--card);
      border: 1.5px solid var(--bdr2);
      transition: all var(--ease);
      width: 100%;
      /* Full width on mobile */
    }

    @media(min-width: 576px) {
      .btn-hero-ghost {
        width: auto;
      }
    }

    .btn-hero-ghost:hover {
      border-color: var(--accent);
      color: var(--accent) !important;
    }

    /* avatar stack */
    .av-stack {
      display: flex;
      justify-content: center;
    }

    /* Centered on mobile */
    @media(min-width: 992px) {
      .av-stack {
        justify-content: flex-start;
      }
    }

    .av {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      border: 2px solid var(--bg);
      margin-left: -8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 700;
      color: #fff;
    }

    .av:first-child {
      margin-left: 0;
    }

    .av1 {
      background: linear-gradient(135deg, #4ade80, #16a34a);
    }

    .av2 {
      background: linear-gradient(135deg, #22c55e, #0f4025);
    }

    .av3 {
      background: linear-gradient(135deg, #86efac, #22c55e);
    }

    .av4 {
      background: linear-gradient(135deg, #bbf7d0, #16a34a);
    }

    /* Social Proof Mobile Center */
    .hero-social-proof {
      margin-top: 1.5rem;
      text-align: center;
    }

    @media(min-width: 992px) {
      .hero-social-proof {
        text-align: left;
      }
    }

    /* hero ui card (Hidden on mobile to save space/complexity) */
    .hero-ui {
      position: relative;
      width: 100%;
      max-width: 380px;
      height: 480px;
      margin: 0 auto;
    }

    .hc-main {
      position: absolute;
      inset: 0;
      background: linear-gradient(155deg, var(--g100) 0%, var(--g200) 45%, var(--g300) 100%);
      border-radius: 32px;
      box-shadow: 0 40px 90px rgba(22, 163, 74, .28), 0 0 0 1px rgba(22, 163, 74, .12);
      overflow: hidden;
    }

    [data-bs-theme="dark"] .hc-main {
      background: linear-gradient(155deg, #091e10 0%, #0e3520 45%, #144d2c 100%);
    }

    .hc-body {
      padding: 1.5rem;
      height: 100%;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .hc-q {
      background: var(--card);
      border-radius: 16px;
      padding: 1rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, .08);
    }

    .hc-qlbl {
      font-size: .6rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .1em;
      color: var(--accent);
      margin-bottom: 4px;
    }

    .hc-qtxt {
      font-size: .85rem;
      font-weight: 700;
      color: var(--txt);
      line-height: 1.4;
    }

    .hc-chips {
      display: flex;
      flex-direction: column;
      gap: 8px;
      flex: 1;
    }

    .hc-chip {
      background: var(--card);
      border-radius: 8px;
      padding: 8px 10px;
      display: flex;
      align-items: flex-start;
      gap: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, .07);
    }

    .hc-chip:nth-child(1) {
      animation: chipF 3.2s ease-in-out infinite;
    }

    .hc-chip:nth-child(2) {
      animation: chipF 3.2s .6s ease-in-out infinite;
    }

    .hc-chip:nth-child(3) {
      animation: chipF 3.2s 1.2s ease-in-out infinite;
    }

    @keyframes chipF {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-5px)
      }
    }

    .chip-av {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      font-weight: 700;
      color: #fff;
      background: linear-gradient(135deg, var(--g400), var(--g700));
    }

    .chip-nm {
      font-size: .6rem;
      font-weight: 700;
      color: var(--txt4);
      margin-bottom: 2px;
      text-transform: uppercase;
      letter-spacing: .04em;
    }

    .chip-tx {
      font-size: .75rem;
      color: var(--txt2);
      line-height: 1.35;
    }

    .chip-vt {
      font-size: .7rem;
      font-weight: 700;
      color: var(--accent);
      margin-top: 2px;
    }

    /* floating cards */
    .fc {
      position: absolute;
      background: var(--card);
      border-radius: 16px;
      padding: 10px 14px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, .14);
      border: 1px solid var(--bdr);
    }

    .fc-tl {
      top: 30px;
      left: -140px;
      min-width: 140px;
      animation: fcA 5s ease-in-out infinite;
    }

    .fc-br {
      bottom: 50px;
      right: -140px;
      min-width: 140px;
      animation: fcA 5s 1.8s ease-in-out infinite;
    }

    .fc-mid {
      right: -110px;
      top: 50%;
      animation: fcB 5s .9s ease-in-out infinite;
    }

    @keyframes fcA {

      0%,
      100% {
        transform: translateY(0) rotate(-1.5deg)
      }

      50% {
        transform: translateY(-10px) rotate(1.5deg)
      }
    }

    @keyframes fcB {

      0%,
      100% {
        transform: translateY(-50%) rotate(-1deg)
      }

      50% {
        transform: translateY(calc(-50% - 10px)) rotate(1deg)
      }
    }

    .fc-lbl {
      font-size: .6rem;
      color: var(--txt4);
      margin-bottom: 2px;
    }

    .fc-val {
      font-family: var(--ff);
      font-weight: 800;
      font-size: 1.2rem;
      color: var(--txt);
      line-height: 1;
    }

    .fc-sub {
      font-size: .65rem;
      color: var(--accent);
      font-weight: 600;
      margin-top: 2px;
    }

    .fc-tag {
      position: absolute;
      right: -140px;
      top: 44%;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: .7rem;
      font-weight: 700;
      color: #fff;
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      border-radius: 8px;
      padding: 7px 10px;
      box-shadow: 0 6px 18px var(--sh2);
      animation: fcB 4.5s 1.2s ease-in-out infinite;
      white-space: nowrap;
    }

    /* ============================================================
       SHARED COMPONENTS
    ============================================================ */
    .tag-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--bg3);
      border: 1px solid var(--bdr);
      border-radius: 100px;
      padding: 5px 14px;
      font-size: .7rem;
      font-weight: 700;
      color: var(--g700);
      text-transform: uppercase;
      letter-spacing: .07em;
    }

    [data-bs-theme="dark"] .tag-badge {
      color: var(--g300);
    }

    .section-h2 {
      font-family: var(--ff);
      font-weight: 800;
      font-size: clamp(1.5rem, 3.5vw, 3rem);
      letter-spacing: -.03em;
      line-height: 1.1;
      color: var(--txt);
    }

    .section-lead {
      font-size: .95rem;
      color: var(--txt3);
      line-height: 1.7;
      max-width: 560px;
    }

    .benefit-row {
      display: flex;
      align-items: flex-start;
      gap: .8rem;
      font-size: .9rem;
      color: var(--txt2);
      line-height: 1.6;
    }

    .b-check {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      flex-shrink: 0;
      margin-top: 3px;
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      color: #fff;
    }

    /* ============================================================
       LOGO STRIP
    ============================================================ */
    .logo-strip {
      background: var(--bg2);
      border-top: 1px solid var(--bdr);
      border-bottom: 1px solid var(--bdr);
      overflow: hidden;
      padding: 1.5rem 0;
    }

    .logo-strip-lbl {
      text-align: center;
      font-size: .7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: .12em;
      color: var(--txt4);
      margin-bottom: 1rem;
    }

    .marquee {
      display: flex;
      gap: 3rem;
      animation: mq 26s linear infinite;
      width: max-content;
    }

    .marquee:hover {
      animation-play-state: paused;
    }

    .mq-row {
      display: flex;
      gap: 3rem;
    }

    @keyframes mq {
      from {
        transform: translateX(0)
      }

      to {
        transform: translateX(-50%)
      }
    }

    .li {
      font-family: var(--ff);
      font-weight: 800;
      font-size: clamp(0.8rem, 1.5vw, 1.1rem);
      color: var(--txt4);
      opacity: .5;
      white-space: nowrap;
      transition: opacity var(--ease), color var(--ease);
    }

    .li:hover {
      opacity: 1;
      color: var(--accent);
    }

    /* ============================================================
       FEATURES
    ============================================================ */
    .feat-card {
      background: var(--card);
      border: 1px solid var(--bdr);
      border-radius: 20px;
      padding: 1.5rem;
      position: relative;
      overflow: hidden;
      transition: all var(--ease);
      height: 100%;
    }

    .feat-card::before {
      content: '';
      position: absolute;
      inset: -1px;
      border-radius: inherit;
      padding: 1px;
      background: linear-gradient(135deg, var(--accent) 0%, transparent 60%);
      -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      opacity: 0;
      transition: opacity var(--ease);
    }

    .feat-card:hover::before {
      opacity: 1;
    }

    .feat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 24px 60px var(--sh);
    }

    .feat-card.dark-card {
      background: linear-gradient(135deg, var(--g900) 0%, var(--g700) 100%);
      border-color: transparent;
    }

    .feat-card.dark-card .feat-title,
    .feat-card.dark-card .feat-desc {
      color: #fff;
    }

    .feat-card.dark-card .feat-desc {
      color: rgba(255, 255, 255, .7);
    }

    .feat-card.dark-card .feat-lnk {
      color: var(--g300);
    }

    .feat-card.dark-card::before {
      display: none;
    }

    .feat-icon {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      background: var(--bg3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      margin-bottom: 1rem;
      transition: transform var(--ease);
    }

    .feat-card:hover .feat-icon {
      transform: scale(1.1) rotate(-4deg);
    }

    .feat-title {
      font-family: var(--ff);
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--txt);
      margin-bottom: .5rem;
    }

    .feat-desc {
      font-size: .9rem;
      color: var(--txt3);
      line-height: 1.65;
    }

    .feat-lnk {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-size: .8rem;
      font-weight: 700;
      color: var(--accent);
      margin-top: .9rem;
      transition: gap var(--ease);
    }

    .feat-lnk:hover {
      gap: 9px;
    }

    /* ============================================================
       STATS
    ============================================================ */
    .stats-section {
      background: linear-gradient(135deg, var(--g700) 0%, var(--g900) 100%);
      position: relative;
      overflow: hidden;
      padding: 3rem 0;
    }

    .stats-section::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -10%;
      width: 70%;
      height: 200%;
      background: radial-gradient(ellipse, rgba(74, 222, 128, .15) 0%, transparent 60%);
      pointer-events: none;
    }

    .stat-num {
      font-family: var(--ff);
      font-weight: 800;
      font-size: clamp(1.8rem, 4vw, 3.2rem);
      line-height: 1.1;
      color: #fff;
      margin-bottom: 0.25rem;
    }

    .stat-lbl {
      font-size: .8rem;
      color: rgba(255, 255, 255, .65);
      font-weight: 500;
    }

    /* ============================================================
       SHOWCASE
    ============================================================ */
    .sc-card {
      background: var(--card);
      border-radius: 20px;
      border: 1px solid var(--bdr);
      overflow: hidden;
      box-shadow: 0 20px 50px var(--sh);
    }

    .sc-card-hd {
      background: linear-gradient(135deg, var(--g800), var(--g600));
      padding: 1rem 1.2rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .sc-hd-icon {
      width: 36px;
      height: 36px;
      background: rgba(255, 255, 255, .15);
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .sc-hd-t {
      font-family: var(--ff);
      font-weight: 700;
      font-size: .9rem;
      color: #fff;
    }

    .sc-hd-s {
      font-size: .7rem;
      color: rgba(255, 255, 255, .7);
    }

    .sc-card-bd {
      padding: 1.25rem 1.2rem;
    }

    .qa-thread {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .qa-row {
      display: flex;
      gap: 10px;
      align-items: flex-start;
    }

    .qa-av {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      flex-shrink: 0;
      background: linear-gradient(135deg, var(--g400), var(--g700));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 700;
      color: #fff;
    }

    .qa-bubble {
      background: var(--bg3);
      border-radius: 8px;
      padding: .6rem .9rem;
      font-size: .8rem;
      color: var(--txt2);
      line-height: 1.5;
    }

    .qa-bubble.ans {
      background: linear-gradient(135deg, var(--g100), var(--g200));
      color: var(--g900);
    }

    [data-bs-theme="dark"] .qa-bubble.ans {
      background: linear-gradient(135deg, #0a2d18, #155c30);
      color: var(--g200);
    }

    .qa-nm {
      font-size: .65rem;
      font-weight: 700;
      color: var(--txt4);
      text-transform: uppercase;
      letter-spacing: .04em;
    }

    .qa-badge {
      font-size: .6rem;
      font-weight: 700;
      color: var(--accent);
      background: var(--bg3);
      border-radius: 100px;
      padding: 1px 6px;
    }

    .qa-vt {
      font-size: .7rem;
      font-weight: 700;
      color: var(--accent);
    }

    .sc-badge {
      position: absolute;
      background: var(--card);
      border-radius: 12px;
      padding: .5rem .8rem;
      box-shadow: 0 8px 30px rgba(0, 0, 0, .12);
      border: 1px solid var(--bdr);
      display: flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
      font-size: .75rem;
      font-weight: 600;
      color: var(--txt2);
      animation: scbf 4s ease-in-out infinite;
      z-index: 10;
    }

    @keyframes scbf {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-8px)
      }
    }

    /* ============================================================
       HOW IT WORKS
    ============================================================ */
    .how-num {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      color: #fff;
      font-family: var(--ff);
      font-weight: 800;
      font-size: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 10px 30px var(--sh2);
      position: relative;
      margin: 0 auto 1rem auto;
    }

    .how-num::after {
      content: '';
      position: absolute;
      inset: -4px;
      border-radius: 50%;
      border: 2px dashed var(--accent);
      opacity: .35;
      animation: spin 20s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg)
      }
    }

    .how-si {
      position: absolute;
      bottom: -5px;
      right: -5px;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: var(--card);
      border: 2px solid var(--bdr);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
    }

    .how-connector {
      position: absolute;
      top: 30px;
      /* Ajusté pour mobile */
      left: 15%;
      right: 15%;
      height: 2px;
      background: linear-gradient(90deg, var(--accent), var(--g300), var(--accent));
      opacity: .5;
      z-index: 0;
    }

    @media(min-width: 992px) {
      .how-connector {
        top: 40px;
        left: calc(12.5% + 30px);
        right: calc(12.5% + 30px);
      }

      .how-num {
        width: 70px;
        height: 70px;
        font-size: 1.7rem;
      }
    }

    /* ============================================================
       TOPICS
    ============================================================ */
    .topic-card {
      background: var(--card);
      border: 1px solid var(--bdr);
      border-radius: 14px;
      padding: 1rem;
      display: flex;
      align-items: center;
      gap: .8rem;
      transition: all var(--ease);
      cursor: pointer;
      height: 100%;
    }

    .topic-card:hover {
      border-color: var(--accent);
      box-shadow: 0 8px 30px var(--sh);
      transform: translateY(-3px);
    }

    .topic-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      flex-shrink: 0;
    }

    .t-nm {
      font-family: var(--ff);
      font-weight: 700;
      font-size: .85rem;
      color: var(--txt);
      margin-bottom: 1px;
    }

    .t-ct {
      font-size: .7rem;
      color: var(--txt4);
    }

    /* Gradients Icons */
    .ti1 {
      background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    }

    .ti2 {
      background: linear-gradient(135deg, #fce7f3, #fbcfe8);
    }

    .ti3 {
      background: linear-gradient(135deg, #fef9c3, #fef08a);
    }

    .ti4 {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
    }

    .ti5 {
      background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    }

    .ti6 {
      background: linear-gradient(135deg, #ffedd5, #fed7aa);
    }

    .ti7 {
      background: linear-gradient(135deg, #f3e8ff, #e9d5ff);
    }

    .ti8 {
      background: linear-gradient(135deg, #cffafe, #a5f3fc);
    }

    .ti9 {
      background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    }

    .ti10 {
      background: linear-gradient(135deg, #fef2f2, #fde8d8);
    }

    .ti11 {
      background: linear-gradient(135deg, #eff6ff, #dbeafe);
    }

    /* ============================================================
       TESTIMONIALS
    ============================================================ */
    .test-card {
      background: var(--card);
      border: 1px solid var(--bdr);
      border-radius: 20px;
      padding: 1.5rem;
      transition: all var(--ease);
      height: 100%;
    }

    .test-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 50px var(--sh);
    }

    .test-card.ft {
      background: linear-gradient(135deg, var(--g900), var(--g700));
      border-color: transparent;
    }

    .test-card.ft .t-quote,
    .test-card.ft .t-name {
      color: #fff;
    }

    .test-card.ft .t-role {
      color: rgba(255, 255, 255, .65);
    }

    .t-quote {
      font-size: .9rem;
      color: var(--txt2);
      line-height: 1.65;
      margin-bottom: 1.2rem;
      font-style: italic;
    }

    .t-av {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--g300), var(--g700));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 13px;
      font-weight: 800;
      color: #fff;
      flex-shrink: 0;
    }

    .t-name {
      font-family: var(--ff);
      font-weight: 700;
      font-size: .9rem;
      color: var(--txt);
    }

    .t-role {
      font-size: .75rem;
      color: var(--txt3);
    }

    /* ============================================================
       PRICING
    ============================================================ */
    .price-card {
      background: var(--card);
      border: 1px solid var(--bdr);
      border-radius: 24px;
      padding: 1.5rem;
      position: relative;
      transition: all var(--ease);
      height: 100%;
    }

    .price-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 20px 50px var(--sh);
    }

    .price-card.pop {
      background: linear-gradient(160deg, var(--g900) 0%, var(--g700) 100%);
      border-color: transparent;
    }

    .price-card.pop::after {
      content: 'Most Popular';
      position: absolute;
      top: -1px;
      left: 50%;
      transform: translateX(-50%);
      background: linear-gradient(90deg, var(--accent), var(--accent-d));
      color: #fff;
      font-size: .65rem;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: .08em;
      border-radius: 0 0 8px 8px;
      padding: 4px 12px;
    }

    .p-plan {
      font-family: var(--ff);
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--txt);
      margin-bottom: .3rem;
    }

    .price-card.pop .p-plan {
      color: #fff;
    }

    .p-desc {
      font-size: .85rem;
      color: var(--txt3);
      margin-bottom: 1.2rem;
    }

    .price-card.pop .p-desc {
      color: rgba(255, 255, 255, .65);
    }

    .p-num {
      font-family: var(--ff);
      font-weight: 800;
      font-size: 2.5rem;
      color: var(--txt);
      line-height: 1;
    }

    .price-card.pop .p-num,
    .price-card.pop .p-cur {
      color: #fff;
    }

    .p-cur {
      font-size: 1rem;
      font-weight: 700;
      color: var(--txt);
      line-height: 2;
    }

    .p-per {
      font-size: .85rem;
      color: var(--txt3);
      margin-bottom: .2rem;
    }

    .price-card.pop .p-per {
      color: rgba(255, 255, 255, .55);
    }

    .p-div {
      border: none;
      border-top: 1px solid var(--bdr);
      margin: 1rem 0;
    }

    .price-card.pop .p-div {
      border-color: rgba(255, 255, 255, .15);
    }

    .p-fi {
      display: flex;
      align-items: center;
      gap: .6rem;
      font-size: .85rem;
      color: var(--txt2);
      margin-bottom: 0.6rem;
    }

    .price-card.pop .p-fi {
      color: rgba(255, 255, 255, .85);
    }

    .p-chk {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: var(--bg3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 9px;
      color: var(--accent);
      flex-shrink: 0;
    }

    .price-card.pop .p-chk {
      background: rgba(255, 255, 255, .15);
      color: var(--g300);
    }

    .p-fi.muted {
      color: var(--txt4);
      text-decoration: line-through;
    }

    .price-card.pop .p-fi.muted {
      color: rgba(255, 255, 255, .3);
    }

    .btn-plan {
      display: block;
      width: 100%;
      padding: 12px;
      border-radius: 12px;
      font-size: .9rem;
      font-weight: 700;
      text-align: center;
      transition: all var(--ease);
      margin-top: 1.5rem;
    }

    .btn-plan-ol {
      color: var(--accent);
      background: transparent;
      border: 1.5px solid var(--accent);
    }

    .btn-plan-ol:hover {
      background: var(--accent);
      color: #fff;
    }

    .btn-plan-s {
      color: var(--g900);
      background: #fff;
      box-shadow: 0 4px 14px rgba(0, 0, 0, .15);
    }

    .btn-plan-s:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, .2);
    }

    .price-toggle {
      display: flex;
      align-items: center;
      gap: .8rem;
      justify-content: center;
      font-size: .9rem;
      font-weight: 500;
      color: var(--txt3);
      margin-top: 1.5rem;
    }

    .tgl {
      position: relative;
      width: 48px;
      height: 26px;
      cursor: pointer;
      display: inline-block;
    }

    .tgl input {
      opacity: 0;
      width: 0;
      height: 0;
      position: absolute;
    }

    .tgl-track {
      position: absolute;
      inset: 0;
      background: var(--bdr2);
      border-radius: 100px;
      transition: background var(--ease);
    }

    .tgl input:checked+.tgl-track {
      background: var(--accent);
    }

    .tgl-knob {
      position: absolute;
      top: 3px;
      left: 3px;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: #fff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, .2);
      transition: transform var(--ease);
    }

    .tgl input:checked~.tgl-knob {
      transform: translateX(22px);
    }

    .save-pill {
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      color: #fff;
      font-size: .65rem;
      font-weight: 700;
      border-radius: 100px;
      padding: 2px 8px;
    }

    /* ============================================================
       FAQ
    ============================================================ */
    .faq-item {
      background: var(--card);
      border: 1px solid var(--bdr);
      border-radius: 12px;
      overflow: hidden;
      transition: border-color var(--ease);
      margin-bottom: 0.75rem;
    }

    .faq-item.open {
      border-color: var(--accent);
    }

    .faq-q {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 1.25rem;
      cursor: pointer;
      gap: 1rem;
    }

    .faq-qt {
      font-family: var(--ff);
      font-weight: 700;
      font-size: .95rem;
      color: var(--txt);
      text-align: left;
    }

    .faq-ch {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: var(--bg3);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      flex-shrink: 0;
      transition: all var(--ease);
      color: var(--txt);
    }

    .faq-item.open .faq-ch {
      background: var(--accent);
      color: #fff;
      transform: rotate(180deg);
    }

    .faq-a {
      max-height: 0;
      overflow: hidden;
      transition: max-height .4s cubic-bezier(.4, 0, .2, 1);
    }

    .faq-item.open .faq-a {
      max-height: 300px;
    }

    .faq-ai {
      padding: 0 1.25rem 1.25rem;
      font-size: .9rem;
      color: var(--txt3);
      line-height: 1.7;
      border-top: 1px solid var(--bdr);
    }

    .faq-ai p {
      padding-top: .8rem;
      margin: 0;
    }

    /* ============================================================
       CTA
    ============================================================ */
    .cta-box {
      background: linear-gradient(135deg, var(--g900) 0%, var(--g700) 100%);
      border-radius: 32px;
      padding: 3rem 1.5rem;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    @media(min-width: 768px) {
      .cta-box {
        border-radius: 48px;
        padding: 4rem 2rem;
      }
    }

    .cta-blob1 {
      position: absolute;
      top: -40%;
      left: -10%;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(74, 222, 128, .18) 0%, transparent 65%);
      border-radius: 50%;
      pointer-events: none;
    }

    .cta-blob2 {
      position: absolute;
      bottom: -40%;
      right: -10%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(22, 197, 94, .12) 0%, transparent 65%);
      border-radius: 50%;
      pointer-events: none;
    }

    .cta-box .tag-badge {
      background: rgba(255, 255, 255, .15);
      border-color: rgba(255, 255, 255, .25);
      color: rgba(255, 255, 255, .9);
      position: relative;
    }

    .cta-box h2 {
      font-family: var(--ff);
      font-weight: 800;
      font-size: clamp(1.5rem, 4vw, 2.5rem);
      color: #fff;
      letter-spacing: -.03em;
      margin-bottom: .6rem;
      position: relative;
    }

    .cta-box>p {
      color: rgba(255, 255, 255, .72);
      font-size: .95rem;
      line-height: 1.6;
      max-width: 560px;
      margin: 0 auto 2rem;
      position: relative;
    }

    .btn-cta-w {
      padding: 12px 28px;
      border-radius: 14px;
      font-size: .95rem;
      font-weight: 700;
      background: #fff;
      color: var(--g800) !important;
      box-shadow: 0 6px 20px rgba(0, 0, 0, .2);
      border: none;
      transition: all var(--ease);
      width: 100%;
      margin-bottom: 1rem;
      display: inline-flex;
      justify-content: center;
    }

    @media(min-width: 576px) {
      .btn-cta-w {
        width: auto;
        margin-bottom: 0;
      }
    }

    .btn-cta-w:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, .3);
    }

    .btn-cta-gw {
      padding: 12px 28px;
      border-radius: 14px;
      font-size: .95rem;
      font-weight: 600;
      background: transparent;
      color: #fff !important;
      border: 1.5px solid rgba(255, 255, 255, .45);
      transition: all var(--ease);
      width: 100%;
      display: inline-flex;
      justify-content: center;
    }

    @media(min-width: 576px) {
      .btn-cta-gw {
        width: auto;
      }
    }

    .btn-cta-gw:hover {
      border-color: #fff;
      background: rgba(255, 255, 255, .1);
    }

    /* ============================================================
       FOOTER
    ============================================================ */
    footer {
      background: var(--bg2);
      border-top: 1px solid var(--bdr);
      padding-bottom: 1rem;
    }

    .soc-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--bg3);
      border: 1px solid var(--bdr);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 15px;
      transition: all var(--ease);
    }

    .soc-btn:hover {
      background: var(--accent);
      border-color: var(--accent);
      transform: translateY(-2px);
    }

    .foot-h {
      font-family: var(--ff);
      font-weight: 700;
      font-size: .9rem;
      color: var(--txt);
      margin-bottom: 1rem;
    }

    .foot-lnk {
      font-size: .85rem;
      color: var(--txt3);
      display: block;
      transition: color var(--ease);
      padding: 0.25rem 0;
    }

    .foot-lnk:hover {
      color: var(--accent);
    }

    .foot-bot {
      border-top: 1px solid var(--bdr);
      padding: 1.25rem 0;
    }

    .foot-fine {
      font-size: .75rem;
      color: var(--txt4);
      margin-bottom: 0.25rem;
    }

    /* ============================================================
       REVEAL ANIMATIONS
    ============================================================ */
    .reveal {
      opacity: 0;
      transform: translateY(25px);
      transition: opacity .6s ease, transform .6s ease;
    }

    .reveal.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .rl {
      opacity: 0;
      transform: translateX(-25px);
      transition: opacity .6s ease, transform .6s ease;
    }

    .rl.visible {
      opacity: 1;
      transform: translateX(0);
    }

    .rr {
      opacity: 0;
      transform: translateX(25px);
      transition: opacity .6s ease, transform .6s ease;
    }

    .rr.visible {
      opacity: 1;
      transform: translateX(0);
    }

    /* ============================================================
       SECTION SPACING (Responsive)
    ============================================================ */
    .section-pad {
      padding-top: 4rem;
      padding-bottom: 4rem;
    }

    @media(min-width: 992px) {
      .section-pad {
        padding-top: 6rem;
        padding-bottom: 6rem;
      }
    }

    /* Extra small adjustments */
    @media(max-width: 360px) {
      .hero-h1 {
        font-size: 2rem;
      }

      .btn-hero,
      .btn-hero-ghost {
        padding: 10px 16px;
        font-size: 0.9rem;
      }

      .nav-logo span {
        display: none;
      }

      /* Hide text on very small screens, keep icon */
      .nav-logo .logo-img {
        margin: 0;
      }
    }

    /* --- Custom icon colors --- */
    .feat-icon .fa-robot {
      color: #8b5cf6;
    }

    /* Purple */
    .feat-icon .fa-globe {
      color: #3b82f6;
    }

    /* Blue */
    .feat-icon .fa-bolt {
      color: #f59e0b;
    }

    /* Yellow/Orange */
    .feat-icon .fa-trophy {
      color: #eab308;
    }

    /* Yellow */
    .feat-icon .fa-magnifying-glass {
      color: #10b981;
    }

    /* Green */
    .feat-icon .fa-lock {
      color: #ef4444;
    }

    /* Red */

    /* Topic icons (already have a colored background, so white or slightly tinted works best) */
    .topic-icon i {
      color: #ffffff;
    }

    /* Stats & Hero */
    .fa-star {
      color: #facc15;
    }

    .fa-bolt {
      color: #facc15;
    }

    .fa-sparkles {
      color: #fbbf24;
    }

    .fa-fire {
      color: #ef4444;
    }

    .fa-check {
      color: #10b981;
    }

    .fa-caret-up {
      color: #22c55e;
    }

    .fa-lightbulb {
      color: #f59e0b;
    }

    .fa-users {
      color: #3b82f6;
    }

    .fa-comment-dots {
      color: #8b5cf6;
    }

    /* "How it works" icons */
    .how-si .fa-pen-nib {
      color: #3b82f6;
    }

    .how-si .fa-robot {
      color: #8b5cf6;
    }

    .how-si .fa-user-tie {
      color: #10b981;
    }

    .how-si .fa-trophy {
      color: #f59e0b;
    }

    /* Contact Section Styles */
    .contact-section {
      padding: 5rem 0;
      background: var(--bg);
      position: relative;
    }

    .contact-card {
      background: var(--card);
      border: 1px solid var(--bdr);
      border-radius: 24px;
      padding: 3rem;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
    }

    .contact-info-itm {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 1.5rem;
    }

    .contact-info-itm i {
      font-size: 1.5rem;
      color: var(--accent);
      width: 40px;
      height: 40px;
      background: var(--bg3);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .contact-input {
      width: 100%;
      border: 1.5px solid var(--bdr2);
      background: var(--bg);
      padding: 12px 16px;
      border-radius: 12px;
      font-size: .95rem;
      color: var(--txt);
      transition: all var(--ease);
      margin-bottom: 1rem;
    }

    .contact-input:focus {
      border-color: var(--accent);
      outline: none;
      box-shadow: 0 0 0 4px var(--sh);
    }
  </style>
</head>

<body>

  <!-- ================================================================ NAVBAR -->
  <nav class="quest-navbar" id="nav">
    <div class="container-xl h-100">
      <div class="d-flex align-items-center justify-content-between h-100 gap-3">

        <!-- Logo -->
        <a href="/" class="nav-logo flex-shrink-0">
          <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img">
          <span>Quest<sup>+</sup></span>
        </a>

        <!-- Desktop links (lg+) -->
        <ul class="d-none d-lg-flex align-items-center gap-4 list-unstyled mb-0 mx-auto">
          <li><a href="#features" class="nav-link-q">Features</a></li>
          <li><a href="#how" class="nav-link-q">How it Works</a></li>
          <li><a href="#topics" class="nav-link-q">Topics</a></li>
          <li><a href="#pricing" class="nav-link-q">Pricing</a></li>
          <li><a href="#faq" class="nav-link-q">FAQ</a></li>
          <li><a href="#contact" class="nav-link-q">Contact Us</a></li>
          <li>
            <a href="/reviews" class="nav-link-q" style="color:var(--accent)!important;display:inline-flex;align-items:center;gap:5px">
              <i class="fa-solid fa-star" style="font-size:.75rem"></i> Reviews
            </a>
          </li>
        </ul>

        <!-- Right actions -->
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
          <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" aria-label="Toggle Theme"><i
              class="fa-solid fa-moon"></i></button>
          <?php if(isset($_SESSION['user_id'])): ?>
            <a href="/dashboard" class="btn-signup d-none d-sm-inline-block">Dashboard <i class="fa-solid fa-arrow-right ms-1"></i></a>
          <?php else: ?>
            <a href="/login" class="btn-login  d-none d-md-inline-block">Log In</a>
            <a href="/register" class="btn-signup d-none d-sm-inline-block">Get Started →</a>
          <?php endif; ?>
          <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu"
            aria-label="Open Menu">
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
      <!-- Padding bottom for fixed footer -->
      <a href="#features" class="mob-link" data-bs-dismiss="offcanvas">Features</a>
      <a href="#how" class="mob-link" data-bs-dismiss="offcanvas">How it Works</a>
      <a href="#topics" class="mob-link" data-bs-dismiss="offcanvas">Topics</a>
      <a href="#pricing" class="mob-link" data-bs-dismiss="offcanvas">Pricing</a>
      <a href="#faq" class="mob-link" data-bs-dismiss="offcanvas">FAQ</a>
      <a href="/reviews" class="mob-link" data-bs-dismiss="offcanvas" style="color:var(--accent);font-weight:700">
        <i class="fa-solid fa-star me-2" style="font-size:.85rem"></i>Community Reviews
      </a>

      <div class="mob-btns d-grid gap-2">
        <?php if(isset($_SESSION['user_id'])): ?>
          <a href="/dashboard" class="btn-hero text-center">Dashboard <i class="fa-solid fa-arrow-right ms-1"></i></a>
        <?php else: ?>
          <a href="/login" class="btn-hero-ghost text-center">Log In</a>
          <a href="/register" class="btn-hero text-center">Get Started →</a>
        <?php endif; ?>
      </div>
    </div>
  </div>


  <!-- ================================================================ HERO -->
  <section class="hero-section" id="home">
    <div class="hero-blob1"></div>
    <div class="hero-blob2"></div>
    <div class="hero-grid"></div>

    <div class="container-xl hero-inner">
      <div class="row align-items-center g-4 g-lg-5">

        <!-- Left: Text Content -->
        <div class="col-12 col-lg-6 text-center text-lg-start">
          <div class="hero-eyebrow">
            <div class="ey-dot"><i class="fa-solid fa-sparkles"></i></div>
            <span class="ey-txt">AI-Powered Q&amp;A Platform</span>
          </div>
          <div class="hero-kicker justify-content-center justify-content-lg-start">
            <span class="k-num">2M+</span>
            <span>Users · Rated #1 Knowledge Platform 2025</span>
          </div>
          <h1 class="hero-h1">Ask all<br><em>Quest<sup>+</sup></em></h1>
          <p class="hero-sub mx-auto mx-lg-0">Get instant, AI-verified answers from a global community of 2 million
            experts. Ask anything — get accurate, sourced answers up to 10× faster than traditional forums.</p>

          <div class="d-flex flex-column flex-sm-row gap-3 mb-4 justify-content-center justify-content-lg-start">
            <a href="/register" class="btn-hero">Start for Free →</a>
            <a href="#how" class="btn-hero-ghost">▶ &nbsp;See How It Works</a>
          </div>

          <div class="hero-social-proof">
            <div class="av-stack mb-2">
              <div class="av av1">A</div>
              <div class="av av2">K</div>
              <div class="av av3">M</div>
              <div class="av av4">R</div>
            </div>
            <div>
              <div style="color:#fbbf24;font-size:.85rem;letter-spacing:1px">★★★★★</div>
              <p class="mb-0" style="font-size:.8rem;color:var(--txt3)"><strong style="color:var(--txt)">2M+
                  members</strong> sharing knowledge daily</p>
            </div>
          </div>
        </div>

        <!-- Right: Hero Visual (Hidden on mobile/tablet to ensure clean text layout) -->
        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
          <div class="hero-ui">
            <div class="fc fc-tl">
              <div class="fc-lbl">Questions today</div>
              <div class="fc-val">48K</div>
              <div class="fc-sub">↑ 12% vs yesterday</div>
            </div>
            <div class="fc fc-mid">
              <div class="fc-lbl">Avg response</div>
              <div class="fc-val">3m</div>
              <div class="fc-sub"><i class="fa-solid fa-bolt"></i> lightning fast</div>
            </div>
            <div class="fc fc-br">
              <div class="fc-lbl">Accuracy rate</div>
              <div class="fc-val">98%</div>
              <div class="fc-sub"><i class="fa-solid fa-check"></i> AI verified</div>
            </div>
            <div class="fc-tag"><i class="fa-solid fa-check"></i> AI Verified Answer</div>
            <div class="hc-main">
              <div class="hc-body">
                <div class="hc-q">
                  <div class="hc-qlbl"><i class="fa-solid fa-fire"></i> Trending Now</div>
                  <div class="hc-qtxt">How does transformer attention work in modern LLMs like GPT-4?</div>
                </div>
                <div class="hc-chips">
                  <div class="hc-chip">
                    <div class="chip-av">K</div>
                    <div>
                      <div class="chip-nm">Karim · ML Engineer</div>
                      <div class="chip-tx">Uses Q, K, V matrices to compute weighted context across all tokens...</div>
                      <div class="chip-vt"><i class="fa-solid fa-caret-up"></i> 248 votes</div>
                    </div>
                  </div>
                  <div class="hc-chip">
                    <div class="chip-av">M</div>
                    <div>
                      <div class="chip-nm">Maya · PhD Researcher</div>
                      <div class="chip-tx">Think of it as a dynamic lookup where relevance is learned...</div>
                      <div class="chip-vt"><i class="fa-solid fa-caret-up"></i> 193 votes</div>
                    </div>
                  </div>
                  <div class="hc-chip">
                    <div class="chip-av">R</div>
                    <div>
                      <div class="chip-nm">Raj · Software Dev</div>
                      <div class="chip-tx">Self-attention lets each position attend to all prior positions...</div>
                      <div class="chip-vt"><i class="fa-solid fa-caret-up"></i> 141 votes</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


  <!-- ================================================================ LOGO STRIP -->
  <section class="logo-strip">
    <p class="logo-strip-lbl">Trusted by teams at</p>
    <div style="overflow:hidden;mask:linear-gradient(90deg,transparent,#fff 5%,#fff 95%,transparent); padding: 0 20px;">
      <div class="marquee">
        <div class="mq-row">
          <span class="li">Rakuten</span><span class="li">Monday.com</span><span class="li">m.Media Group</span>
          <span class="li">Disney+</span><span class="li">Dropbox</span><span class="li">Notion</span>
          <span class="li">Stripe</span><span class="li">Figma</span><span class="li">Vercel</span><span
            class="li">Linear</span>
        </div>
        <div class="mq-row" aria-hidden="true">
          <span class="li">Rakuten</span><span class="li">Monday.com</span><span class="li">m.Media Group</span>
          <span class="li">Disney+</span><span class="li">Dropbox</span><span class="li">Notion</span>
          <span class="li">Stripe</span><span class="li">Figma</span><span class="li">Vercel</span><span
            class="li">Linear</span>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================================ LATEST QUESTIONS -->
  <section class="section-pad" style="background:var(--bg2)">
    <div class="container-xl">
      <div class="row align-items-end justify-content-between mb-5 reveal">
        <div class="col-lg-6">
          <span class="tag-badge"><i class="fa-solid fa-fire text-danger"></i> Trending</span>
          <h2 class="section-h2 mt-3">Latest from the Community</h2>
          <p class="section-lead mb-0">Join the discussion on the most recent topics and share your expertise.</p>
        </div>
        <div class="col-lg-auto mt-4 mt-lg-0">
          <a href="/questions" class="btn-hero-ghost">View All Questions <i class="fa-solid fa-arrow-right ms-1"></i></a>
        </div>
      </div>

      <div class="row g-4">
        <?php if (!empty($questions)): ?>
          <?php foreach ($questions as $q): ?>
            <div class="col-12 col-md-6 col-lg-4 reveal">
              <a href="/questions/<?= $q['id'] ?>" class="text-decoration-none">
                <div class="feat-card h-100 transition-all hover-up" style="background: var(--card); border: 1px solid var(--bdr);">
                  <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="smaller text-muted"><i class="far fa-clock me-1"></i> <?= date('M d', strtotime($q['created_at'])) ?></span>
                    <span class="badge rounded-pill bg-primary-subtle text-primary smaller px-3 py-1 border border-primary-subtle">
                      <?= $q['answers_count'] ?? 0 ?> answers
                    </span>
                  </div>
                  <h4 class="feat-title line-clamp-2" style="font-size: 1.15rem;"><?= htmlspecialchars($q['title']) ?></h4>
                  <p class="feat-desc smaller line-clamp-3 mb-4">
                    <?= htmlspecialchars(mb_strimwidth($q['description'], 0, 120, "...")) ?>
                  </p>
                  <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar-xs bg-light border rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px;">
                        <i class="fas fa-user-circle text-primary" style="font-size: 14px;"></i>
                      </div>
                      <span class="smaller fw-bold text-dark"><?= htmlspecialchars($q['author_name'] ?? 'Uknown') ?></span>
                    </div>
                    <div class="smaller text-muted">
                      <i class="fas fa-eye me-1"></i> <?= $q['views'] ?? 0 ?>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="col-12 text-center py-5">
            <p class="text-muted">No questions found. Be the first to ask!</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <style>
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .hover-up:hover { transform: translateY(-5px); box-shadow: 0 15px 35px var(--sh) !important; border-color: var(--accent) !important; }
    .transition-all { transition: all 0.3s ease; }
    .bg-primary-subtle { background-color: #f0fdf4 !important; }
  </style>


  <!-- ================================================================ FEATURES -->
  <section class="section-pad" id="features" style="background:var(--bg)">
    <div class="container-xl">
      <div class="row align-items-start justify-content-between gy-3 mb-5 reveal">
        <div class="col-12 text-center text-md-start">
          <span class="tag-badge"><i class="fa-solid fa-sparkles"></i> Features</span>
          <h2 class="section-h2 mt-3">Everything you need to grow your knowledge</h2>
        </div>
        <div class="col-12 text-center text-md-start mt-2">
          <p class="section-lead mx-auto mx-md-0 mb-0">Quest combines AI speed with human expertise — delivering
            accurate, community-verified answers across any topic in seconds. No fluff, just facts.</p>
        </div>
      </div>
      <div class="row g-3 g-lg-4">
        <div class="col-12 col-sm-6 col-xl-4 reveal">
          <div class="feat-card">
            <div class="feat-icon"><i class="fa-solid fa-robot"></i></div>
            <h3 class="feat-title">AI-Assisted Answers</h3>
            <p class="feat-desc">Our AI instantly surfaces the most relevant answers while human experts verify
              accuracy.</p><a class="feat-lnk" href="#">Learn more →</a>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 reveal">
          <div class="feat-card">
            <div class="feat-icon"><i class="fa-solid fa-globe"></i></div>
            <h3 class="feat-title">Global Expert Network</h3>
            <p class="feat-desc">Connect with 2M+ verified professionals across 200+ disciplines. Real credentials, real
              accountability.</p><a class="feat-lnk" href="#">Explore experts →</a>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 reveal">
          <div class="feat-card dark-card">
            <div class="feat-icon"><i class="fa-solid fa-bolt"></i></div>
            <h3 class="feat-title">Lightning Fast</h3>
            <p class="feat-desc">Average response under 3 minutes. Smart routing delivers your question to the right
              expert instantly.</p><a class="feat-lnk" href="#">See benchmarks →</a>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 reveal">
          <div class="feat-card">
            <div class="feat-icon"><i class="fa-solid fa-trophy"></i></div>
            <h3 class="feat-title">Reputation &amp; Rewards</h3>
            <p class="feat-desc">Earn points, badges, and recognition for quality contributions. Amplify your expertise.
            </p><a class="feat-lnk" href="#">View leaderboard →</a>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 reveal">
          <div class="feat-card">
            <div class="feat-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
            <h3 class="feat-title">Semantic Search</h3>
            <p class="feat-desc">Search that understands intent and meaning — not just keywords. Find existing answers
              fast.</p><a class="feat-lnk" href="#">Try search →</a>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 reveal">
          <div class="feat-card">
            <div class="feat-icon"><i class="fa-solid fa-lock"></i></div>
            <h3 class="feat-title">Private Team Spaces</h3>
            <p class="feat-desc">Build closed knowledge hubs for your team. Internal FAQs and expert channels are fully
              encrypted.</p><a class="feat-lnk" href="#">For teams →</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ================================================================ STATS -->
  <section class="stats-section section-pad">
    <div class="container-xl position-relative">
      <div class="row g-4 g-lg-5 text-center">
          <div class="col-6 col-lg-3 reveal">
            <div class="border-end border-white border-opacity-10 h-100 d-flex flex-column justify-content-center pe-lg-3">
              <span style="font-size:1.5rem;display:block;margin-bottom:.5rem"><i class="fa-solid fa-users"></i></span>
              <div class="stat-num"><?php echo number_format($stats['users'] ?? 2450); ?></div>
              <div class="stat-lbl">Active Users</div>
            </div>
          </div>
          <div class="col-6 col-lg-3 reveal">
            <div class="border-end border-white border-opacity-10 h-100 d-flex flex-column justify-content-center pe-lg-3">
              <span style="font-size:1.5rem;display:block;margin-bottom:.5rem"><i class="fa-solid fa-circle-question"></i></span>
              <div class="stat-num"><?php echo number_format($stats['questions'] ?? 1280); ?></div>
              <div class="stat-lbl">Questions Asked</div>
            </div>
          </div>
          <div class="col-6 col-lg-3 reveal">
            <div class="border-end border-white border-opacity-10 h-100 d-flex flex-column justify-content-center pe-lg-3">
              <span style="font-size:1.5rem;display:block;margin-bottom:.5rem"><i class="fa-solid fa-reply-all"></i></span>
              <div class="stat-num"><?php echo number_format($stats['answers'] ?? 850); ?></div>
              <div class="stat-lbl">Expert Replies</div>
            </div>
          </div>
        <div class="col-6 col-lg-3 reveal">
          <div class="h-100 d-flex flex-column justify-content-center">
            <span style="font-size:1.5rem;display:block;margin-bottom:.5rem"><i class="fa-solid fa-star"></i></span>
            <div class="stat-num">98%</div>
            <div class="stat-lbl">Satisfaction</div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ================================================================ SHOWCASE 1 -->
  <section class="section-pad" style="background:var(--bg)">
    <div class="container-xl">
      <div class="row align-items-center g-5 flex-column-reverse flex-lg-row">
        <div class="col-12 col-lg-6 rl">
          <div class="position-relative pb-4">
            <div class="sc-card">
              <div class="sc-card-hd">
                <div class="sc-hd-icon"><i class="fa-solid fa-lightbulb"></i></div>
                <div>
                  <div class="sc-hd-t">Live Q&amp;A Thread</div>
                  <div class="sc-hd-s">Machine Learning · 3 answers · 2 min ago</div>
                </div>
              </div>
              <div class="sc-card-bd">
                <div class="qa-thread">
                  <div class="qa-row">
                    <div class="qa-av">U</div>
                    <div>
                      <div class="qa-bubble">What's the difference between supervised and unsupervised learning?</div>
                      <div class="d-flex align-items-center gap-2 mt-1"><span class="qa-nm">user_quest</span><span
                          class="qa-badge">Beginner</span></div>
                    </div>
                  </div>
                  <div class="qa-row">
                    <div class="qa-av" style="background:linear-gradient(135deg,#4ade80,#16a34a)">K</div>
                    <div>
                      <div class="qa-bubble ans">Supervised learning uses labeled data — you tell the model the right
                        answers during training.</div>
                      <div class="d-flex align-items-center gap-2 mt-1"><span class="qa-nm">Karim A.</span><span
                          class="qa-badge"><i class="fa-solid fa-check"></i> Top Expert</span><span class="qa-vt"><i
                            class="fa-solid fa-caret-up"></i> 342</span></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="sc-badge d-none d-md-flex" style="bottom:0;right:1.5rem"><i class="fa-solid fa-bolt"></i> Answer
              accepted in <strong style="color:var(--accent)">1m 42s</strong></div>
            <div class="sc-badge d-md-none"
              style="bottom:-15px;left:50%;transform:translateX(-50%);width: max-content;"><i
                class="fa-solid fa-bolt"></i> Accepted in <strong style="color:var(--accent)">1m 42s</strong></div>
          </div>
        </div>
        <div class="col-12 col-lg-6 rr text-center text-lg-start">
          <span class="tag-badge"><i class="fa-solid fa-brain"></i> Smart Answers</span>
          <h2 class="section-h2 mt-3 mb-3">AI + humans, working together in real time</h2>
          <p class="section-lead mx-auto mx-lg-0">Quest's AI pre-processes every question, identifies context, and
            matches it with the most qualified expert.</p>
          <div class="d-flex flex-column gap-3 mt-4 mx-auto mx-lg-0" style="max-width: 400px;">
            <div class="benefit-row">
              <div class="b-check"><i class="fa-solid fa-check"></i></div>AI drafts an initial answer within seconds
            </div>
            <div class="benefit-row">
              <div class="b-check"><i class="fa-solid fa-check"></i></div>Domain experts review and enhance the response
            </div>
            <div class="benefit-row">
              <div class="b-check"><i class="fa-solid fa-check"></i></div>Community votes surface the best answers
            </div>
            <div class="benefit-row">
              <div class="b-check"><i class="fa-solid fa-check"></i></div>Sources are cited and fact-checked
              automatically
            </div>
          </div>
          <div class="mt-4"><a href="/register" class="btn-hero w-100 w-lg-auto">Try It Free →</a></div>
        </div>
      </div>
    </div>
  </section>


  <!-- ================================================================ SHOWCASE 2 -->
  <section class="section-pad" style="background:var(--bg2)">
    <div class="container-xl">
      <div class="row align-items-center g-5">
        <div class="col-12 col-lg-6 rl text-center text-lg-start order-2 order-lg-1">
          <span class="tag-badge"><i class="fa-solid fa-building"></i> Teams &amp; Enterprise</span>
          <h2 class="section-h2 mt-3 mb-3">Build a living knowledge base for your team</h2>
          <p class="section-lead mx-auto mx-lg-0">Stop losing institutional knowledge in Slack threads. Quest gives
            every team a searchable, intelligent knowledge hub.</p>
          <div class="d-flex flex-column gap-3 mt-4 mx-auto mx-lg-0" style="max-width: 400px;">
            <div class="benefit-row">
              <div class="b-check"><i class="fa-solid fa-check"></i></div>Private, encrypted team workspace
            </div>
            <div class="benefit-row">
              <div class="b-check"><i class="fa-solid fa-check"></i></div>Onboarding FAQ builder with AI
            </div>
            <div class="benefit-row">
              <div class="b-check"><i class="fa-solid fa-check"></i></div>Analytics on knowledge gaps
            </div>
            <div class="benefit-row">
              <div class="b-check"><i class="fa-solid fa-check"></i></div>SSO, audit logs, and compliance
            </div>
          </div>
          <div class="d-flex flex-wrap gap-3 mt-4 justify-content-center justify-content-lg-start">
            <a href="/register" class="btn-hero">Start Free Trial →</a>
            <a href="#" class="btn-hero-ghost">Book a Demo</a>
          </div>
        </div>
        <div class="col-12 col-lg-6 rr order-1 order-lg-2">
          <div class="position-relative pt-3">
            <div class="sc-card">
              <div class="sc-card-hd">
                <div class="sc-hd-icon"><i class="fa-solid fa-building"></i></div>
                <div>
                  <div class="sc-hd-t">Acme Corp · Team Space</div>
                  <div class="sc-hd-s">142 members · Private</div>
                </div>
              </div>
              <div class="sc-card-bd">
                <div class="d-flex flex-column gap-2">
                  <div
                    style="background:var(--bg3);border-radius:8px;padding:.8rem 1rem;border-left:3px solid var(--accent)">
                    <div
                      style="font-size:.7rem;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.05em;margin-bottom:3px">
                      <i class="fa-solid fa-thumbtack"></i> Pinned
                    </div>
                    <div style="font-size:.85rem;font-weight:600;color:var(--txt)">How do I request time off in the HR
                      portal?</div>
                    <div style="font-size:.72rem;color:var(--txt4);margin-top:3px">Answered by HR Team · 48 views</div>
                  </div>
                  <div style="background:var(--bg3);border-radius:8px;padding:.8rem 1rem">
                    <div style="font-size:.85rem;font-weight:600;color:var(--txt);margin-bottom:3px">What's our
                      deployment process?</div>
                    <div style="font-size:.72rem;color:var(--txt4)">Answered by DevOps · 120 views</div>
                  </div>
                  <div
                    style="background:linear-gradient(135deg,var(--g100),var(--g200));border-radius:8px;padding:.8rem 1rem;display:flex;align-items:center;gap:.6rem">
                    <span style="font-size:1.1rem"><i class="fa-solid fa-robot"></i></span>
                    <span style="font-size:.8rem;color:var(--g800);font-weight:500">AI detected 3 knowledge gaps.
                      <strong>Draft answers?</strong></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="sc-badge d-none d-md-flex" style="top:0;left:1.5rem"><i class="fa-solid fa-lock"></i> End-to-end
              <strong style="color:var(--accent)">encrypted</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ================================================================ HOW IT WORKS -->
  <section class="section-pad" id="how" style="background:var(--bg)">
    <div class="container-xl">
      <div class="text-center reveal mb-5">
        <span class="tag-badge"><i class="fa-solid fa-sparkles"></i> Process</span>
        <h2 class="section-h2 mt-3">From question to answer in 4 steps</h2>
        <p class="section-lead mx-auto mt-3">Our intelligent pipeline ensures every question reaches the right expert,
          gets verified by AI, and rises to the surface.</p>
      </div>
      <div class="row g-4 g-lg-5 position-relative">
        <div class="how-connector d-none d-lg-block"></div>
        <div class="col-6 col-lg-3 reveal">
          <div class="text-center position-relative" style="z-index:1">
            <div class="how-num">1<div class="how-si"><i class="fa-solid fa-pen-nib"></i></div>
            </div>
            <h3 style="font-family:var(--ff);font-weight:700;font-size:1rem;color:var(--txt)">Ask Naturally</h3>
            <p style="font-size:.85rem;color:var(--txt3);line-height:1.6">Type your question in plain language. Our AI
              understands context.</p>
          </div>
        </div>
        <div class="col-6 col-lg-3 reveal">
          <div class="text-center position-relative" style="z-index:1">
            <div class="how-num">2<div class="how-si"><i class="fa-solid fa-robot"></i></div>
            </div>
            <h3 style="font-family:var(--ff);font-weight:700;font-size:1rem;color:var(--txt)">Answers by other uers</h3>
            <p style="font-size:.85rem;color:var(--txt3);line-height:1.6">Our AI drafts an initial response from its
              knowledge base instantly.</p>
          </div>
        </div>
        <div class="col-6 col-lg-3 reveal">
          <div class="text-center position-relative" style="z-index:1">
            <div class="how-num">3<div class="how-si"><i class="fa-solid fa-user-tie"></i></div>
            </div>
            <h3 style="font-family:var(--ff);font-weight:700;font-size:1rem;color:var(--txt)">Expert Review</h3>
            <p style="font-size:.85rem;color:var(--txt3);line-height:1.6">Domain-verified experts refine and fact-check
              the answer.</p>
          </div>
        </div>
        <div class="col-6 col-lg-3 reveal">
          <div class="text-center position-relative" style="z-index:1">
            <div class="how-num">4<div class="how-si"><i class="fa-solid fa-trophy"></i></div>
            </div>
            <h3 style="font-family:var(--ff);font-weight:700;font-size:1rem;color:var(--txt)">Community Ranks</h3>
            <p style="font-size:.85rem;color:var(--txt3);line-height:1.6">The community upvotes the best answers to the
              top.</p>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ================================================================ TOPICS -->
  <section class="section-pad" id="topics" style="background:var(--bg2)">
    <div class="container-xl">
      <div class="text-center reveal mb-5">
        <span class="tag-badge"><i class="fa-solid fa-book"></i> Topics</span>
        <h2 class="section-h2 mt-3">Explore thousands of categories</h2>
        <p class="section-lead mx-auto mt-3">From quantum physics to cooking techniques — Quest covers every domain with
          verified experts ready to help.</p>
      </div>
      <div class="row g-3">
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti1"><i class="fa-solid fa-laptop-code"></i></div>
            <div>
              <div class="t-nm">Tech</div>
              <div class="t-ct">1.2M q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti2"><i class="fa-solid fa-microscope"></i></div>
            <div>
              <div class="t-nm">Science</div>
              <div class="t-ct">840K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti3"><i class="fa-solid fa-ruler-combined"></i></div>
            <div>
              <div class="t-nm">Math</div>
              <div class="t-ct">620K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti4"><i class="fa-solid fa-scale-balanced"></i></div>
            <div>
              <div class="t-nm">Law</div>
              <div class="t-ct">380K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti5"><i class="fa-solid fa-hospital"></i></div>
            <div>
              <div class="t-nm">Medicine</div>
              <div class="t-ct">510K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti6"><i class="fa-solid fa-chart-simple"></i></div>
            <div>
              <div class="t-nm">Business</div>
              <div class="t-ct">720K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti7"><i class="fa-solid fa-landmark"></i></div>
            <div>
              <div class="t-nm">History</div>
              <div class="t-ct">290K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti8"><i class="fa-solid fa-palette"></i></div>
            <div>
              <div class="t-nm">Arts</div>
              <div class="t-ct">410K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti9"><i class="fa-solid fa-earth-americas"></i></div>
            <div>
              <div class="t-nm">Langs</div>
              <div class="t-ct">350K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti10"><i class="fa-solid fa-seedling"></i></div>
            <div>
              <div class="t-nm">Eco</div>
              <div class="t-ct">180K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card">
            <div class="topic-icon ti11"><i class="fa-solid fa-circle-question"></i></div>
            <div>
              <div class="t-nm">Philo</div>
              <div class="t-ct">220K q</div>
            </div>
          </div>
        </div>
        <div class="col-4 col-md-3 col-lg-2 reveal">
          <div class="topic-card"
            style="background:linear-gradient(135deg,var(--g900),var(--g700));border-color:transparent">
            <div class="topic-icon" style="background:rgba(255,255,255,.12)"><i class="fa-solid fa-plus"></i></div>
            <div>
              <div class="t-nm" style="color:#fff">200+</div>
              <div class="t-ct" style="color:rgba(255,255,255,.6)">More</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ================================================================ COMMUNITY REVIEWS -->
  <section class="section-pad" id="reviews" style="background:var(--bg)">
    <style>
      /* ---- Review Section Styles ---- */
      .review-avg-banner {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        background: var(--card);
        border: 1px solid var(--bdr);
        border-radius: 20px;
        padding: 1.25rem 2rem;
        margin-bottom: 2.5rem;
        flex-wrap: wrap;
      }
      .review-avg-score {
        font-family: var(--ff);
        font-size: 3rem;
        font-weight: 800;
        color: var(--txt);
        line-height: 1;
      }
      .review-avg-stars { font-size: 1.4rem; color: #fbbf24; letter-spacing: 2px; }
      .review-avg-sub   { font-size: .85rem; color: var(--txt3); }
      .review-avg-sep   { width: 1px; height: 40px; background: var(--bdr2); }

      /* Dynamic review cards */
      .rev-card {
        background: var(--card);
        border: 1px solid var(--bdr);
        border-radius: 20px;
        padding: 1.5rem;
        height: 100%;
        transition: transform var(--ease), box-shadow var(--ease);
        position: relative;
        overflow: hidden;
      }
      .rev-card::before {
        content: '"';
        position: absolute;
        top: -10px; right: 16px;
        font-size: 5rem;
        font-family: Georgia, serif;
        color: var(--bdr);
        line-height: 1;
        pointer-events: none;
      }
      .rev-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px var(--sh); }
      .rev-card.featured {
        background: linear-gradient(135deg, var(--g700), var(--g900));
        border-color: transparent;
        color: #fff;
      }
      .rev-card.featured::before { color: rgba(255,255,255,.12); }
      .rev-stars { font-size: 13px; color: #fbbf24; letter-spacing: 1px; margin-bottom: .75rem; }
      .rev-card.featured .rev-stars { color: #fde68a; }
      .rev-message {
        font-size: .9rem;
        line-height: 1.65;
        color: var(--txt2);
        margin-bottom: 1.25rem;
        font-style: italic;
      }
      .rev-card.featured .rev-message { color: rgba(255,255,255,.85); }
      .rev-avatar {
        width: 36px; height: 36px; border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--g700));
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: .85rem; color: #fff; flex-shrink: 0;
      }
      .rev-name { font-weight: 700; font-size: .9rem; color: var(--txt); }
      .rev-card.featured .rev-name { color: #fff; }
      .rev-date { font-size: .75rem; color: var(--txt4); }
      .rev-card.featured .rev-date { color: rgba(255,255,255,.55); }

      /* Inline review form */
      .review-form-box {
        background: var(--card);
        border: 1px solid var(--bdr);
        border-radius: 24px;
        padding: 2rem;
        margin-top: 3rem;
      }
      .review-form-box h4 {
        font-family: var(--ff);
        font-weight: 800;
        font-size: 1.2rem;
        color: var(--txt);
        margin-bottom: .5rem;
      }
      .star-picker { display: flex; gap: 6px; margin: .75rem 0 1.25rem; flex-direction: row-reverse; justify-content: flex-end; }
      .star-picker input { display: none; }
      .star-picker label {
        font-size: 2rem; cursor: pointer; color: var(--bdr2);
        transition: color .15s, transform .15s;
      }
      .star-picker label:hover,
      .star-picker label:hover ~ label,
      .star-picker input:checked ~ label { color: #fbbf24; }
      .star-picker label:hover { transform: scale(1.2); }
      .review-textarea {
        width: 100%;
        background: var(--bg2);
        border: 1.5px solid var(--bdr);
        border-radius: 12px;
        padding: .85rem 1rem;
        font-size: .9rem;
        color: var(--txt);
        resize: vertical;
        min-height: 100px;
        font-family: var(--fb);
        transition: border-color var(--ease), box-shadow var(--ease);
        outline: none;
      }
      .review-textarea:focus { border-color: var(--accent); box-shadow: 0 0 0 3px var(--sh); }
      .review-textarea::placeholder { color: var(--txt4); }
      .btn-submit-review {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 24px; border-radius: 50px;
        background: linear-gradient(135deg, var(--accent), var(--accent-d));
        color: #fff; font-weight: 700; font-size: .9rem;
        border: none; cursor: pointer;
        transition: all var(--ease);
        box-shadow: 0 4px 14px var(--sh);
      }
      .btn-submit-review:hover { transform: translateY(-2px); box-shadow: 0 8px 24px var(--sh2); }
      .btn-see-all {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 28px; border-radius: 50px;
        border: 2px solid var(--accent); color: var(--accent);
        font-weight: 700; font-size: .9rem; background: transparent;
        transition: all var(--ease);
      }
      .btn-see-all:hover { background: var(--accent); color: #fff; transform: translateY(-2px); box-shadow: 0 8px 24px var(--sh); }
      .review-login-prompt {
        background: var(--bg2); border: 1.5px dashed var(--bdr);
        border-radius: 16px; padding: 1.25rem 1.5rem;
        text-align: center; margin-top: 3rem;
      }
      .char-count { font-size: .75rem; color: var(--txt4); text-align: right; margin-top: 4px; }
      .flash-alert {
        padding: .75rem 1rem; border-radius: 12px; margin-bottom: 1rem;
        font-size: .9rem; font-weight: 600;
      }
      .flash-success { background: var(--g100); color: var(--g700); border: 1px solid var(--g300); }
      .flash-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }
      [data-bs-theme="dark"] .flash-success { background: rgba(34,197,94,.15); color: var(--g300); border-color: rgba(34,197,94,.3); }
      [data-bs-theme="dark"] .flash-error   { background: rgba(239,68,68,.15); color: #fca5a5; border-color: rgba(239,68,68,.3); }
      .no-reviews-badge {
        background: var(--bg2);
        border: 1.5px dashed var(--bdr);
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        color: var(--txt3);
      }
    </style>

    <div class="container-xl">

      <!-- Section Header -->
      <div class="text-center reveal mb-4">
        <span class="tag-badge"><i class="fa-solid fa-star"></i> Community Reviews</span>
        <h2 class="section-h2 mt-3">What our users say</h2>
        <p class="section-lead mx-auto mt-3">Real reviews from real users — no filters, no fakes.</p>
      </div>

      <!-- Flash message (from review submit on homepage) -->
      <?php if (!empty($flash)): ?>
        <div class="flash-alert flash-<?= htmlspecialchars($flash['type']) ?> reveal mb-3">
          <?= htmlspecialchars($flash['message']) ?>
        </div>
      <?php endif; ?>

      <!-- Average Rating Banner -->
      <?php
        $avg   = isset($reviewStats) ? (float)($reviewStats['avg'] ?? 0) : 0;
        $total = isset($reviewStats) ? (int)($reviewStats['total'] ?? 0) : 0;
        $fullStars  = floor($avg);
        $halfStar   = ($avg - $fullStars) >= 0.5 ? 1 : 0;
        $emptyStars = 5 - $fullStars - $halfStar;
      ?>
      <div class="review-avg-banner reveal">
        <div class="text-center">
          <div class="review-avg-score"><?= $avg > 0 ? number_format($avg, 1) : '—' ?></div>
          <div class="review-avg-stars mt-1">
            <?php for($i=0;$i<$fullStars;$i++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
            <?php if($halfStar): ?><i class="fa-solid fa-star-half-stroke"></i><?php endif; ?>
            <?php for($i=0;$i<$emptyStars;$i++): ?><i class="fa-regular fa-star" style="color:var(--bdr2)"></i><?php endfor; ?>
          </div>
        </div>
        <div class="review-avg-sep d-none d-sm-block"></div>
        <div>
          <div style="font-weight:700;color:var(--txt);font-size:1.05rem">
            <?= $total > 0 ? number_format($total) . ' ' . ($total === 1 ? 'review' : 'reviews') : 'No reviews yet' ?>
          </div>
          <div class="review-avg-sub mt-1">Be the first to share your experience!</div>
        </div>
      </div>

      <!-- Review Cards -->
      <?php if (!empty($latestReviews)): ?>
        <div class="row g-4">
          <?php foreach ($latestReviews as $i => $rev):
            $name    = htmlspecialchars($rev['user_name'] ?? 'User');
            $initial = strtoupper(substr($name, 0, 1));
            $msg     = htmlspecialchars($rev['message']);
            $rating  = (int)($rev['rating'] ?? 5);
            $date    = isset($rev['created_at']) ? date('M j, Y', strtotime($rev['created_at'])) : '';
            $isFeat  = ($i === 1);
          ?>
          <div class="col-12 col-md-6 col-lg-4 reveal">
            <div class="rev-card <?= $isFeat ? 'featured' : '' ?>">
              <div class="rev-stars">
                <?php for($s=1;$s<=5;$s++) echo $s<=$rating?'★':'☆'; ?>
              </div>
              <p class="rev-message">"<?= $msg ?>"</p>
              <div class="d-flex align-items-center gap-2">
                <div class="rev-avatar"><?= $initial ?></div>
                <div>
                  <div class="rev-name"><?= $name ?></div>
                  <div class="rev-date"><?= $date ?></div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="no-reviews-badge reveal">
          <i class="fa-regular fa-star fa-2x mb-3" style="color:var(--accent)"></i>
          <p class="mb-0 fw-600">No reviews yet — be the first to share your experience!</p>
        </div>
      <?php endif; ?>

      <!-- See All Reviews Button -->
      <div class="text-center mt-4 reveal">
        <a href="/reviews" class="btn-see-all">
          See all reviews <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>

      <!-- ---- Inline Review Form ---- -->
      <?php if (isset($_SESSION['user_id']) && empty($userReview)): ?>
        <div class="review-form-box reveal">
          <h4><?= !empty($userReview) ? '✏️ Update Your Review' : '⭐ Share Your Experience' ?></h4>
          <p style="color:var(--txt3);font-size:.88rem;margin-bottom:0">
            <?= !empty($userReview) ? 'You have already reviewed Quest — you can update it anytime.' : 'How has Quest been for you? Your feedback helps us improve.' ?>
          </p>

          <?php if (!empty($userReview)): ?>
            <div style="background:var(--bg2);border-radius:12px;padding:.75rem 1rem;margin:.75rem 0;font-size:.85rem;color:var(--txt3)">
              <i class="fa-solid fa-circle-check" style="color:var(--accent)"></i>
              Your current rating: <strong style="color:var(--txt)"><?= (int)$userReview['rating'] ?> / 5 stars</strong>
            </div>
          <?php endif; ?>

          <form action="/reviews/store" method="POST" id="homeReviewForm">
            <!-- Star Picker -->
            <div class="star-picker" id="homeStarPicker">
              <?php
                $cur = isset($userReview['rating']) ? (int)$userReview['rating'] : 0;
                for ($s = 5; $s >= 1; $s--): ?>
                <input type="radio" name="rating" id="hsr<?= $s ?>" value="<?= $s ?>" <?= $cur===$s?'checked':'' ?> required>
                <label for="hsr<?= $s ?>" title="<?= $s ?> star<?= $s>1?'s':'' ?>">★</label>
              <?php endfor; ?>
            </div>

            <textarea
              name="message"
              class="review-textarea"
              id="homeReviewMsg"
              placeholder="Tell us what you love (or what we can do better)…"
              maxlength="1000"
              required
            ><?= !empty($userReview) ? htmlspecialchars($userReview['message']) : '' ?></textarea>
            <div class="char-count"><span id="homeCharCount"><?= !empty($userReview) ? strlen($userReview['message']) : 0 ?></span> / 1000</div>

            <div class="d-flex align-items-center gap-3 flex-wrap mt-3">
              <button type="submit" class="btn-submit-review" id="homeReviewSubmit">
                <i class="fa-solid fa-paper-plane"></i>
                <?= !empty($userReview) ? 'Update Review' : 'Submit Review' ?>
              </button>
              <span style="font-size:.8rem;color:var(--txt4)">Max 1 000 characters</span>
            </div>
          </form>
        </div>

      <?php else: ?>
        <!-- Guest prompt -->
        <div class="review-login-prompt reveal">
          <i class="fa-solid fa-star fa-lg mb-2" style="color:var(--accent)"></i>
          <p class="mb-3" style="color:var(--txt2);font-weight:600">Want to share your experience with Quest?</p>
          <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="/login"    class="btn-hero"       style="width:auto;padding:10px 24px">Login to Review</a>
            <a href="/register" class="btn-hero-ghost" style="width:auto;padding:10px 24px">Create Account</a>
          </div>
        </div>
      <?php endif; ?>

    </div>
  </section>

  <script>
  // Char counter for home review textarea
  (function(){
    const ta  = document.getElementById('homeReviewMsg');
    const cnt = document.getElementById('homeCharCount');
    if (ta && cnt) {
      ta.addEventListener('input', () => { cnt.textContent = ta.value.length; });
    }
  })();
  </script>


  <!-- ================================================================ PRICING -->
  <section class="section-pad" id="pricing" style="background:var(--bg2)">
    <div class="container-xl">
      <div class="text-center reveal mb-2">
        <span class="tag-badge"><i class="fa-solid fa-credit-card"></i> Pricing</span>
        <h2 class="section-h2 mt-3">Simple, transparent pricing</h2>
        <p class="section-lead mx-auto mt-3">Start free. Scale as you grow. No surprise charges.</p>
        <div class="price-toggle mt-3">
          <span>Monthly</span>
          <label class="tgl">
            <input type="checkbox" id="billingTgl" onchange="toggleBilling()">
            <div class="tgl-track"></div>
            <div class="tgl-knob"></div>
          </label>
          <span>Annual <span class="save-pill">Save 30%</span></span>
        </div>
      </div>
      <div class="row g-4 mt-3 align-items-stretch">
        <div class="col-12 col-lg-4 reveal">
          <div class="price-card">
            <div class="p-plan">Free</div>
            <div class="p-desc">Perfect for individuals</div>
            <div class="d-flex align-items-end gap-1 mb-3"><span class="p-cur">$</span><span class="p-num"
                id="p0">0</span><span class="p-per">/mo</span></div>
            <hr class="p-div">
            <div class="d-flex flex-column gap-2 mb-4">
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>100 questions/mo
              </div>
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>Access to all topics
              </div>
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>Basic AI assistance
              </div>
            </div>
            <a href="/register" class="btn-plan btn-plan-ol">Get Started</a>
          </div>
        </div>
        <div class="col-12 col-lg-4 reveal">
          <div class="price-card pop">
            <div class="p-plan">Pro</div>
            <div class="p-desc">For power users</div>
            <div class="d-flex align-items-end gap-1 mb-3"><span class="p-cur">$</span><span class="p-num"
                id="p1">19</span><span class="p-per">/mo</span></div>
            <hr class="p-div">
            <div class="d-flex flex-column gap-2 mb-4">
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>Unlimited questions
              </div>
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>Advanced AI (GPT-4)
              </div>
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>Priority routing
              </div>
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>1 private team space
              </div>
            </div>
            <a href="/register" class="btn-plan btn-plan-s">Start 30-Day Trial</a>
          </div>
        </div>
        <div class="col-12 col-lg-4 reveal">
          <div class="price-card">
            <div class="p-plan">Enterprise</div>
            <div class="p-desc">For organizations</div>
            <div class="d-flex align-items-end gap-1 mb-3"><span class="p-cur">$</span><span class="p-num"
                id="p2">79</span><span class="p-per">/mo</span></div>
            <hr class="p-div">
            <div class="d-flex flex-column gap-2 mb-4">
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>Everything in Pro
              </div>
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>Unlimited team spaces
              </div>
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>SSO &amp; SAML
              </div>
              <div class="p-fi">
                <div class="p-chk"><i class="fa-solid fa-check"></i></div>Dedicated support
              </div>
            </div>
            <a href="#" class="btn-plan btn-plan-ol">Book a Demo</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ================================================================ FAQ -->
  <section class="section-pad" id="faq" style="background:var(--bg)">
    <div class="container-xl">
      <div class="text-center reveal mb-5">
        <span class="tag-badge">❓ FAQ</span>
        <h2 class="section-h2 mt-3">Frequently asked questions</h2>
        <p class="section-lead mx-auto mt-3">Can't find your answer here? Ask it on Quest — the platform will have an
          answer within minutes.</p>
      </div>
      <div class="row g-3 justify-content-center">
        <div class="col-12 col-lg-8 reveal">
          <div class="faq-item" onclick="toggleFaq(this)">
            <div class="faq-q"><span class="faq-qt">How does Quest verify experts?</span><span class="faq-ch">▼</span>
            </div>
            <div class="faq-a">
              <div class="faq-ai">
                <p>All experts go through credential verification including LinkedIn profile checks, peer review by
                  existing verified experts, and domain-specific knowledge tests. We monitor answer quality over time.
                </p>
              </div>
            </div>
          </div>
          <div class="faq-item" onclick="toggleFaq(this)">
            <div class="faq-q"><span class="faq-qt">Is my private team data safe?</span><span class="faq-ch">▼</span>
            </div>
            <div class="faq-a">
              <div class="faq-ai">
                <p>Absolutely. Team spaces are end-to-end encrypted and completely isolated from the public platform.
                  Your data is never used to train our AI models. We are SOC 2 Type II compliant and GDPR ready.</p>
              </div>
            </div>
          </div>
          <div class="faq-item" onclick="toggleFaq(this)">
            <div class="faq-q"><span class="faq-qt">Can I use Quest for free forever?</span><span
                class="faq-ch">▼</span></div>
            <div class="faq-a">
              <div class="faq-ai">
                <p>Yes! The Free plan is genuinely free with no time limit. You get 100 questions per month, full access
                  to public topics, and basic AI assistance.</p>
              </div>
            </div>
          </div>
          <div class="faq-item" onclick="toggleFaq(this)">
            <div class="faq-q"><span class="faq-qt">How fast will I get an answer?</span><span class="faq-ch">▼</span>
            </div>
            <div class="faq-a">
              <div class="faq-ai">
                <p>The AI provides an initial response within seconds. Expert-reviewed answers typically arrive within 3
                  minutes for common topics. Complex or niche questions may take up to 30 minutes.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ================================================================ CTA -->
  <section class="section-pad" style="background:var(--bg2)">
    <div class="container-xl">
      <div class="cta-box reveal">
        <div class="cta-blob1"></div>
        <div class="cta-blob2"></div>
        <span class="tag-badge"><i class="fa-solid fa-rocket"></i> Join the Movement</span>
        <h2 class="mt-3">Start your Quest today</h2>
        <p>Join 2 million curious minds. Sign up free — no credit card required. Your first 30 days of Pro are on us.
        </p>
        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center align-items-center">
          <?php if(isset($_SESSION['user_id'])): ?>
            <a href="/dashboard" class="btn-cta-w">Go to Dashboard <i class="fa-solid fa-arrow-right ms-1"></i></a>
          <?php else: ?>
            <a href="/register" class="btn-cta-w">Get Started Free →</a>
            <a href="/login" class="btn-cta-gw">Already have an account?</a>
          <?php endif; ?>
        </div>
        <p style="font-size:.75rem;color:rgba(255,255,255,.4);position:relative;margin-top:1.2rem;margin-bottom:0">No
          credit card required · Cancel anytime · 30-day free Pro trial</p>
      </div>
    </div>
  </section>



  <!-- ================================================================ CONTACT US -->
  <section id="contact" class="contact-section">
    <div class="container-xl">
      <div class="text-center mb-5 reveal">
        <div class="hero-eyebrow">
          <div class="ey-dot"><i class="fa-solid fa-envelope"></i></div><span class="ey-txt">Get in Touch</span>
        </div>
        <h2 class="hero-h1 mb-3" style="font-size: clamp(2rem, 4vw, 3rem);">Contact <em>Us</em></h2>
        <p class="mx-auto" style="max-width: 500px; color: var(--txt3);">Have questions or need support? We're here to
          help. Reach out to our team and we'll get back to you as soon as possible.</p>
      </div>
      <div class="row justify-content-center reveal">
        <div class="col-lg-10">
          <div class="contact-card">
            <div class="row g-5">
              <div class="col-md-5">
                <h3 class="mb-4" style="font-family: var(--ff); font-weight: 700;">Contact Information</h3>
                <div class="contact-info-itm">
                  <i class="fa-solid fa-location-dot"></i>
                  <div>
                    <h6 class="mb-1" style="font-weight: 700; color: var(--txt);">Location</h6>
                    <p class="mb-0" style="color: var(--txt3); font-size: .9rem;">+237 Cameroon <br>Yaounde</p>
                  </div>
                </div>
                <div class="contact-info-itm">
                  <i class="fa-solid fa-phone"></i>
                  <div>
                    <h6 class="mb-1" style="font-weight: 700; color: var(--txt);">Phone Number</h6>
                    <p class="mb-0" style="color: var(--txt3); font-size: .9rem;">+237 658-810-415</p>
                  </div>
                </div>
                <div class="contact-info-itm">
                  <i class="fa-solid fa-envelope-open"></i>
                  <div>
                    <h6 class="mb-1" style="font-weight: 700; color: var(--txt);">Email Address</h6>
                    <p class="mb-0" style="color: var(--txt3); font-size: .9rem;">djoudaeric08@gmail.com</p>
                  </div>

                </div>

                <div class="contact-info-itm d-block pt-5">
                  <p>forword to the web site fore more information</p>
                  <a href="https://dmejcode.com" target="_blank" rel="noopener noreferrer" class="text-decoration-underline text-primary fw-bold d-flex align-items-center">
                    <img width="30px" src="../assets/dmejlogo.png" alt="" class="me-2">D-MEJ CODE+
                  </a>
                </div>
              </div>
              <div class="col-md-7">
                <form onsubmit="event.preventDefault(); alert('Message sent successfully!'); this.reset();">
                  <div class="row">
                    <div class="col-sm-6">
                      <input type="text" class="contact-input" placeholder="Your Name" required>
                    </div>
                    <div class="col-sm-6">
                      <input type="email" class="contact-input" placeholder="Your@email.com" required>
                    </div>
                  </div>
                  <input type="text" class="contact-input" placeholder="Subject" required>
                  <textarea class="contact-input" rows="4" placeholder="Your Message" required
                    style="resize: none;"></textarea>
                  <button type="submit" class="btn-hero w-100 rounded-pill" style="border-radius: 12px;">Send Message <i
                      class="fa-solid fa-paper-plane ms-2"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================================================================ FOOTER -->
  <footer class="pt-5">
    <div class="container-xl">
      <div class="row g-4 pb-5">
        <!-- Brand -->
        <div class="col-12 col-sm-6 col-lg-4">
          <a href="/" class="nav-logo d-inline-flex mb-3">
            <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img">
            <span>Quest<sup>+</sup></span>
          </a>
          <p style="font-size:.85rem;color:var(--txt3);line-height:1.6;max-width:280px">The world's most collaborative
            Q&amp;A platform — powered by AI, verified by humans.</p>
          <div class="d-flex gap-2 mt-3">
            <a href="#" class="soc-btn" aria-label="Twitter">
              <i class="fab fa-x-twitter fw-bold"></i>
            </a>
            <a href="#" class="soc-btn">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#" class="soc-btn">
              <i class="fab fa-youtube"></i>
            </a>
            <a href="#" class="soc-btn">
              <i class="fab fa-discord"></i>
            </a>
          </div>
        </div>
        <!-- Links -->
        <div class="col-6 col-sm-3 col-lg-2 offset-lg-1">
          <h5 class="foot-h">Product</h5>
          <div class="d-flex flex-column gap-2">
            <a href="#" class="foot-lnk">Features</a>
            <a href="#pricing" class="foot-lnk">Pricing</a>
            <a href="#" class="foot-lnk">Enterprise</a>
            <a href="#" class="foot-lnk">API</a>
          </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-2">
          <h5 class="foot-h">Community</h5>
          <div class="d-flex flex-column gap-2">
            <a href="#topics" class="foot-lnk">Topics</a>
            <a href="#" class="foot-lnk">Leaderboard</a>
            <a href="#" class="foot-lnk">Blog</a>
            <a href="#" class="foot-lnk">Experts</a>
          </div>
        </div>
        <div class="col-6 col-sm-3 col-lg-2">
          <h5 class="foot-h">Company</h5>
          <div class="d-flex flex-column gap-2">
            <a href="#" class="foot-lnk">About</a>
            <a href="#" class="foot-lnk">Careers</a>
            <a href="#" class="foot-lnk">Press</a>
            <a href="#" class="foot-lnk">Privacy</a>
          </div>
        </div>
      </div>
      <div
        class="foot-bot d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-center text-md-start">
        <p class="foot-fine mb-0" style="font-size:15px;">© 2025 Quest all rights reserved.</p>
        <a href="#" class="foot-fine">
          <h6 class="gap-2 d-flex"> <span class="mt-2">By</span>
            <img width="30px" src="../assets/dmejlogo.png" alt=""><span class="mt-2">D-MEJ CODE+</span>
          </h6>
        </a>
        <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-md-start">
          <a href="#" class="foot-fine">Privacy Policy</a>

          <a href="#" class="foot-fine">Terms of Service</a>
          <a href="#" class="foot-fine">Cookie Settings</a>
        </div>
        <p class="foot-fine mb-0 d-flex align-items-center gap-1" style="font-size:15px;">
          Build with mush
          <i class="fas fa-heart text-danger fs-5 ms-2"></i>
          <span class="mx-2">&</span>
          <i class="fas fa-coffee text-warning fs-5"></i>
        </p>
      </div>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    /* Theme */
    let dark = false;
    function toggleTheme() {
      dark = !dark;
      document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
      document.getElementById('themeBtn').innerHTML = dark ? '<i class="fa-solid fa-sun"></i>' : '<i class="fa-solid fa-moon"></i>';
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
    }, { passive: true });

    /* Scroll reveal */
    const ro = new IntersectionObserver(entries => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          e.target.classList.add('visible');
          ro.unobserve(e.target);
        }
      });
    }, { threshold: .1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.reveal,.rl,.rr').forEach(el => ro.observe(el));

    /* Smooth scroll */
    document.querySelectorAll('a[href^="#"]').forEach(a => {
      a.addEventListener('click', e => {
        const id = a.getAttribute('href').slice(1);
        const t = document.getElementById(id);
        if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
      });
    });

    /* FAQ */
    function toggleFaq(item) {
      const wasOpen = item.classList.contains('open');
      // Close all others
      document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
      // Toggle clicked
      if (!wasOpen) item.classList.add('open');
    }

    /* Pricing toggle */
    const moPrices = { p0: 0, p1: 19, p2: 79 };
    const anPrices = { p0: 0, p1: 13, p2: 55 };
    function toggleBilling() {
      const ann = document.getElementById('billingTgl').checked;
      const pr = ann ? anPrices : moPrices;
      Object.keys(pr).forEach(id => {
        const el = document.getElementById(id);
        el.style.opacity = '0';
        setTimeout(() => {
          el.innerHTML = pr[id];
          el.style.opacity = '1';
        }, 200);
      });
    }
  </script>
</body>

</html>