<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'Quest — Dashboard' ?></title>
  <script>
    // Initial theme from localStorage (persist dark/light)
    (function() {
      const savedTheme = localStorage.getItem('questTheme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', savedTheme);
    })();
    // Global User Role for JS logic
    window.QUEST_USER_ROLE = '<?= $_SESSION['user_role'] ?? 'user' ?>';
  </script>
  <link rel="icon" href="/assets/quest/favicon.ico" sizes="any">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/assets/quest/dashboard.css">
  <link rel="stylesheet" href="/assets/quest/forms.css">
  <link rel="stylesheet" href="/assets/quest/components.css">
  <link rel="stylesheet" href="/assets/quest/utilities.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* ================================================================
       DESIGN TOKENS — identical to all Quest pages
    ================================================================ */
    :root {
      --g100:#dcfce7; --g200:#bbf7d0; --g300:#86efac; --g400:#4ade80;
      --g500:#22c55e; --g600:#16a34a; --g700:#15803d; --g800:#166534; --g900:#14532d;
      --accent:#22c55e; --accent-d:#16a34a; --accent-l:#4ade80;
      --bg:#f6fefa;   --bg2:#edfbf3;  --bg3:#f0fdf4;
      --card:#ffffff;
      --txt:#071a0e;  --txt2:#374151; --txt3:#6b7280; --txt4:#9ca3af;
      --bdr:#c6f6d5;  --bdr2:#e5e7eb;
      --sh:rgba(22,163,74,.10);  --sh2:rgba(22,163,74,.22);
      --ff:'Syne', sans-serif;
      --fb:'DM Sans', sans-serif;
      --ease:.26s cubic-bezier(.4,0,.2,1);
      /* layout */
      --sbi: 62px;    /* icon strip */
      --sbn: 218px;   /* nav panel  */
      --top: 62px;    /* topbar     */
    }
    [data-bs-theme="dark"] {
      --bg:#040d07; --bg2:#071209; --bg3:#0a1a0f; --card:#0d1f12;
      --txt:#ecfdf5; --txt2:#d1fae5; --txt3:#86efac; --txt4:#4ade80;
      --bdr:#1a3a24; --bdr2:#1e3326;
      --sh:rgba(0,0,0,.45); --sh2:rgba(0,0,0,.6);

      /* Global Bootstrap dark-mode overrides */
      .bg-white, .card, .bg-card-custom { background-color: var(--card) !important; color: var(--txt) !important; }
      .bg-light { background-color: var(--bg3) !important; color: var(--txt2) !important; }
      .text-dark { color: var(--txt) !important; }
      .text-secondary { color: var(--txt3) !important; }
      .text-muted { color: var(--txt4) !important; }
      .border, .border-bottom, .border-top, .border-start, .border-end { border-color: var(--bdr) !important; }
      .btn-light { background-color: var(--bg3) !important; border-color: var(--bdr) !important; color: var(--txt) !important; }
      .btn-light:hover { background-color: var(--bdr) !important; color: var(--accent) !important; }
      input.form-control, textarea.form-control { background-color: var(--bg3) !important; border-color: var(--bdr) !important; color: var(--txt) !important; }
      input.form-control:focus { background-color: var(--card) !important; border-color: var(--accent) !important; }
      .breadcrumb-item.active { color: var(--txt3) !important; }
    }

    /* ================================================================
       BASE
    ================================================================ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }
    body {
      font-family: var(--fb);
      background: var(--bg);
      color: var(--txt);
      overflow: hidden; /* prevent double scroll */
      transition: background var(--ease), color var(--ease);
    }
    a { text-decoration: none; color: inherit; }
    button { cursor: pointer; border: none; font-family: var(--fb); outline: none; background: none; }

    /* noise grain */
    body::before {
      content: ''; position: fixed; inset: 0; z-index: 9999; pointer-events: none; opacity: .5;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.025'/%3E%3C/svg%3E");
    }

    ::-webkit-scrollbar { width: 4px; height: 4px; }
    ::-webkit-scrollbar-thumb { background: var(--bdr); border-radius: 10px; }

    /* ================================================================
       ROOT GRID
       ┌─────────┬──────────────┬──────────────────────────────┐
       │ SBI 62px│ SBN 218px    │ MAIN (flex-1)                │
       │ icon    │ nav panel    │ topbar + scrollable content  │
       └─────────┴──────────────┴──────────────────────────────┘
    ================================================================ */
    .app {
      display: grid;
      grid-template-columns: var(--sbi) var(--sbn) 1fr;
      grid-template-rows: 1fr;
      height: 100vh;
      width: 100vw;
    }

    /* ================================================================
       SIDEBAR 1 — ICON STRIP
    ================================================================ */
    .sbi {
      grid-column: 1;
      grid-row: 1;
      background: var(--card);
      border-right: 1px solid var(--bdr);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: .8rem 0;
      gap: .12rem;
      overflow: hidden;
      z-index: 30;
    }

    .sbi-logo {
      width: 50px; height: 50px;
      border-radius: 9px; overflow: hidden;
      margin-bottom: .7rem; flex-shrink: 0;
    }
    .sbi-logo img { width: 100%; height: 100%; object-fit: cover; }

    .sbi-btn {
      width: 45px; height: 45px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 23px; color: var(--txt4);
      transition: all var(--ease); position: relative; cursor: pointer;
    }
    .sbi-btn:hover { background: var(--bg3); color: var(--txt); }
    .sbi-btn.active { background: var(--g100); color: var(--accent-d); }
    .sbi-dot {
      position: absolute; top: 6px; right: 6px;
      width: 7px; height: 7px; border-radius: 50%;
      background: var(--accent); border: 1.5px solid var(--card);
    }
    .sbi-sep { width: 28px; height: 1px; background: var(--bdr); margin: .3rem 0; flex-shrink: 0; }
    .sbi-spacer { flex: 1; }
    .sbi-submenu {
      position: fixed; left: var(--sbi); top: 0; bottom: 0; width: 0;
      background: var(--card); border-right: 1px solid var(--bdr);
      overflow-y: auto; transition: none;
      z-index: 31; flex-direction: column; display: none;
    }
    .sbi-submenu.open {
      width: 200px;
      display: flex;
    }
    .sbi-submenu-header {
      padding: 1rem; border-bottom: 1px solid var(--bdr);
      display: flex; align-items: center; gap: 10px; flex-shrink: 0;
    }
    .sbi-submenu-close {
      margin-left: auto; background: none; border: none; font-size: 18px;
      color: var(--txt4); cursor: pointer; padding: 5px;
    }
    .sbi-submenu-item {
      padding: .7rem 1rem; display: flex; align-items: center; gap: 10px;
      color: var(--txt3); cursor: pointer; border-left: 3px solid transparent;
      transition: all var(--ease);
    }
    .sbi-submenu-item:hover {
      background: var(--bg3); color: var(--txt);
    }
    .sbi-submenu-item.active {
      background: var(--bg2); color: var(--accent-d); border-left-color: var(--accent-d);
    }
    .sbi-submenu-icon {
      width: 20px; text-align: center; flex-shrink: 0;
    }
    .sbi-submenu-text {
      font-size: .85rem; font-weight: 500;
    }

    /* ================================================================
       SIDEBAR 2 — NAV PANEL
    ================================================================ */
    .sbn {
      grid-column: 2;
      grid-row: 1;
      background: var(--card);
      border-right: 1px solid var(--bdr);
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      z-index: 29;
    }

    /* search box at top of nav — like Salesforce */
    .sbn-searchbox {
      display: flex; align-items: center; gap: 7px;
      margin: .9rem .85rem .4rem;
      background: var(--bg3); border: 1px solid var(--bdr);
      border-radius: 10px; padding: .42rem .82rem;
      transition: border-color var(--ease); flex-shrink: 0;
    }
    .sbn-searchbox:focus-within { border-color: var(--accent); }
    .sbn-searchbox input {
      border: none; background: transparent; outline: none;
      font-size: .82rem; color: var(--txt); font-family: var(--fb); width: 100%;
    }
    .sbn-searchbox input::placeholder { color: var(--txt4); }
    .sbn-kbd {
      background: var(--bdr); border-radius: 5px;
      padding: 1px 6px; font-size: .63rem; color: var(--txt4);
      white-space: nowrap; font-family: var(--ff); flex-shrink: 0;
    }

    /* overview title */
    .sbn-heading {
      font-family: var(--ff); font-weight: 700; font-size: .88rem;
      color: var(--txt); padding: .3rem 1rem .1rem; flex-shrink: 0;
    }

    /* section label */
    .sbn-lbl {
      font-size: .6rem; font-weight: 700;
      text-transform: uppercase; letter-spacing: .1em; color: var(--txt4);
      padding: .72rem 1rem .18rem; flex-shrink: 0;
    }

    /* nav link */
    .sbn-link {
      display: flex; align-items: center; gap: 9px;
      padding: .57rem 1rem;
      font-size: .845rem; font-weight: 500; color: var(--txt3);
      transition: all var(--ease); position: relative; flex-shrink: 0;
    }
    .sbn-link:hover { background: var(--bg3); color: var(--txt); }
    .sbn-link.active { background: var(--bg2); color: var(--accent-d); font-weight: 700; }
    .sbn-link.active::before {
      content: ''; position: absolute; left: 0; top: 0; bottom: 0;
      width: 3px; background: var(--accent-d); border-radius: 0 3px 3px 0;
    }
    .sbn-icon { font-size: 14px; width: 16px; text-align: center; flex-shrink: 0; }
    .sbn-badge {
      margin-left: auto; background: var(--accent); color: #fff;
      font-size: .6rem; font-weight: 700; border-radius: 100px; padding: 1px 6px;
    }

    /* promo card at nav bottom */
    .sbn-promo {
      margin: auto .85rem .9rem;
      background: linear-gradient(145deg, var(--g700), var(--g900));
      border-radius: 16px; padding: 1rem .9rem;
      color: #fff; text-align: center; flex-shrink: 0;
    }
    .sbn-promo .p-ico { font-size: 1.4rem; margin-bottom: .4rem; display: block; }
    .sbn-promo h6 { font-family: var(--ff); font-size: .8rem; font-weight: 700; margin-bottom: .2rem; }
    .sbn-promo p  { font-size: .67rem; opacity: .72; margin-bottom: .7rem; line-height: 1.4; }
    .sbn-promo button {
      width: 100%; padding: .4rem; border-radius: 8px;
      background: var(--accent); color: #fff;
      font-size: .77rem; font-weight: 700; transition: all var(--ease);
    }
    .sbn-promo button:hover { background: var(--accent-l); }

    /* ================================================================
       MAIN COLUMN
    ================================================================ */
    .main-col {
      grid-column: 3;
      grid-row: 1;
      display: flex;
      flex-direction: column;
      overflow: hidden;
    }

    /* ================================================================
       TOPBAR — same Quest style as landing / login / register
    ================================================================ */
    .topbar {
      height: var(--top);
      flex-shrink: 0;
      background: rgba(246,254,250,.92);
      backdrop-filter: blur(24px) saturate(180%);
      border-bottom: 1px solid var(--bdr);
      display: flex; align-items: center;
      padding: 0 1.5rem; gap: .9rem;
      z-index: 20;
      transition: box-shadow var(--ease);
    }
    [data-bs-theme="dark"] .topbar { background: rgba(4,13,7,.92); }
    .topbar.scrolled { box-shadow: 0 4px 24px var(--sh); }

    .tb-meta {
      display: flex; align-items: center; gap: 6px;
      font-size: .77rem; color: var(--txt4); flex-shrink: 0;
    }
    .tb-meta strong { color: var(--txt2); font-weight: 600; }

    .tb-pill {
      display: inline-flex; align-items: center; gap: 5px;
      padding: .35rem .82rem; border-radius: 50px;
      font-size: .76rem; font-weight: 600; color: var(--txt2);
      background: var(--card); border: 1px solid var(--bdr2);
      transition: all var(--ease); white-space: nowrap;
    }
    .tb-pill:hover { border-color: var(--accent); color: var(--accent); }

    .btn-share {
      display: inline-flex; align-items: center; gap: 5px;
      padding: .4rem .95rem; border-radius: 50px;
      font-size: .8rem; font-weight: 700; color: #fff;
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      box-shadow: 0 3px 12px var(--sh); border: none;
      transition: all var(--ease); white-space: nowrap;
    }
    .btn-share:hover { transform: translateY(-1px); box-shadow: 0 5px 18px var(--sh2); }

    .tb-right { margin-left: auto; display: flex; align-items: center; gap: .55rem; }

    .theme-btn {
      width: 34px; height: 34px; border-radius: 50%;
      background: var(--bg3); border: 1px solid var(--bdr);
      display: flex; align-items: center; justify-content: center;
      font-size: 15px; cursor: pointer; flex-shrink: 0;
      transition: all var(--ease);
    }
    .theme-btn:hover { background: var(--bdr); transform: rotate(20deg); }

    .tb-icon {
      width: 34px; height: 34px; border-radius: 50%;
      background: var(--bg3); border: 1px solid var(--bdr);
      display: flex; align-items: center; justify-content: center;
      font-size: 14px; color: var(--txt3); cursor: pointer; flex-shrink: 0;
      transition: all var(--ease);
    }
    .tb-icon:hover { background: var(--bdr); color: var(--txt); }

    .user-chip { display: flex; align-items: center; gap: 8px; cursor: pointer; flex-shrink: 0; }
    .user-av {
      width: 34px; height: 34px; border-radius: 50%;
      background: linear-gradient(135deg, var(--g400), var(--g700));
      display: flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 700; color: #fff;
    }
    .user-name { font-family: var(--ff); font-size: .8rem; font-weight: 700; color: var(--txt); line-height: 1.1; }
    .user-email { font-size: .66rem; color: var(--txt4); }

    /* hamburger — only mobile */
    .ham { display: none; padding: 6px 9px; border-radius: 8px; background: var(--bg3); border: 1px solid var(--bdr); font-size: 17px; color: var(--txt3); flex-shrink: 0; }

    /* ================================================================
       SCROLLABLE CONTENT AREA
    ================================================================ */
    .content {
      flex: 1;
      overflow-y: auto;
      padding: 1.6rem 1.7rem;
    }

    /* ================================================================
       QUEST CARD — same as all other pages
    ================================================================ */
    .q-card {
      background: var(--card);
      border: 1px solid var(--bdr);
      border-radius: 18px;
      padding: 1.25rem 1.3rem;
      height: 100%;
      transition: box-shadow var(--ease), transform var(--ease);
    }
    .q-card:hover { box-shadow: 0 10px 36px var(--sh); transform: translateY(-2px); }
    .q-card.dark-card {
      background: linear-gradient(145deg, var(--g800), var(--g900));
      border-color: transparent; color: #fff;
    }
    .q-card.dark-card:hover { box-shadow: 0 10px 36px var(--sh2); }

    /* card header */
    .card-lbl {
      font-family: var(--ff); font-weight: 700; font-size: .85rem; color: var(--txt);
    }
    .dark-card .card-lbl { color: rgba(255,255,255,.75); }
    .card-3dot { font-size: 18px; color: var(--txt4); padding: 0 3px; line-height: 1; transition: color var(--ease); }
    .card-3dot:hover { color: var(--txt); }

    /* stat number */
    .stat-num {
      font-family: var(--ff); font-weight: 800;
      font-size: clamp(1.45rem,2.2vw,2rem);
      color: var(--txt); line-height: 1; margin: .35rem 0 .4rem;
    }
    .dark-card .stat-num { color: #fff; }

    /* trend badges */
    .trend {
      display: inline-flex; align-items: center; gap: 4px;
      font-size: .7rem; font-weight: 600; border-radius: 6px; padding: 2px 7px;
    }
    .t-up   { background: var(--g100); color: var(--g700); }
    .t-down { background: #fee2e2; color: #dc2626; }
    .t-flat { background: var(--bdr2); color: var(--txt4); }
    .dark-card .t-up { background: rgba(255,255,255,.18); color: #fff; }

    /* section title */
    .sec-title {
      font-family: var(--ff); font-weight: 700; font-size: .88rem; color: var(--txt);
    }
    .dark-card .sec-title { color: rgba(255,255,255,.8); }

    /* big number */
    .big-num {
      font-family: var(--ff); font-weight: 800;
      font-size: clamp(1.5rem,2.5vw,2.1rem); color: var(--txt); line-height: 1;
    }

    /* segmented bar */
    .seg-bar { height: 9px; border-radius: 100px; display: flex; gap: 2px; overflow: hidden; }
    .seg { height: 100%; border-radius: 100px; }

    /* mini stat */
    .mini-lbl { font-size: .68rem; color: var(--txt4); margin-bottom: 2px; display: flex; align-items: center; gap: 5px; }
    .mini-num { font-family: var(--ff); font-weight: 700; font-size: .95rem; color: var(--txt); }
    .dot-sm { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

    /* ================================================================
       BAR CHART — CSS only
    ================================================================ */
    .chart-y {
      display: flex; flex-direction: column;
      justify-content: space-between; align-items: flex-end; padding-bottom: 20px;
    }
    .chart-y span { font-size: .6rem; color: var(--txt4); }

    .chart-bars {
      display: flex; align-items: flex-end; gap: 5px; height: 160px; flex: 1;
    }
    .bar-grp { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 4px; }
    .bar-pair { display: flex; align-items: flex-end; gap: 2px; width: 100%; }
    .bar-s {
      flex: 1; border-radius: 5px 5px 0 0; min-width: 7px;
      position: relative; transition: opacity var(--ease);
    }
    .bar-s:hover { opacity: .75; }
    .bar-s.bl { background: var(--g200); }
    .bar-s.bd { background: var(--g700); }
    .bar-s.bs {
      background: repeating-linear-gradient(-45deg, var(--bdr) 0, var(--bdr) 2px, transparent 2px, transparent 8px);
      border: 1px solid var(--bdr); border-bottom: none;
    }
    .bar-lbl { font-size: .59rem; color: var(--txt4); font-weight: 500; }

    .bar-tip {
      position: absolute; top: -34px; left: 50%; transform: translateX(-50%);
      background: var(--txt); color: #fff;
      border-radius: 8px; padding: 4px 8px;
      font-size: .63rem; font-weight: 700; white-space: nowrap;
      box-shadow: 0 4px 12px rgba(0,0,0,.2); pointer-events: none;
      z-index: 5;
    }
    .bar-tip::after {
      content: ''; position: absolute; top: 100%; left: 50%; transform: translateX(-50%);
      border: 4px solid transparent; border-top-color: var(--txt);
    }

    .legend-dot { width: 10px; height: 10px; border-radius: 3px; flex-shrink: 0; }

    /* ================================================================
       QUESTION FEED
    ================================================================ */
    .q-item {
      display: flex; align-items: flex-start; gap: 9px;
      padding: .57rem 0; border-bottom: 1px solid var(--bdr2); cursor: pointer;
      transition: background var(--ease);
    }
    .q-item:last-child { border-bottom: none; padding-bottom: 0; }
    .q-item:hover { background: var(--bg3); margin: 0 -.4rem; padding: .57rem .4rem; border-radius: 8px; }
    .q-av {
      width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
      font-size: 11px; font-weight: 700; color: #fff;
    }
    .q-title { font-size: .79rem; font-weight: 600; color: var(--txt); line-height: 1.35; margin-bottom: 2px; }
    .q-sub   { font-size: .67rem; color: var(--txt4); display: flex; align-items: center; gap: 5px; flex-wrap: wrap; }
    .vtag {
      font-size: .62rem; font-weight: 700; color: var(--g700);
      background: var(--g100); border-radius: 100px; padding: 1px 7px;
    }
    [data-bs-theme="dark"] .vtag { color: var(--g300); background: rgba(34,197,94,.15); }
    .vote-col { margin-left: auto; flex-shrink: 0; text-align: center; min-width: 32px; }
    .vote-num { font-family: var(--ff); font-weight: 800; font-size: .83rem; color: var(--accent-d); display: block; }
    .vote-sub { font-size: .57rem; color: var(--txt4); }

    /* ================================================================
       TAG PILLS — same as landing page
    ================================================================ */
    .tag-pill {
      display: inline-flex; align-items: center; gap: 4px;
      background: var(--bg3); border: 1px solid var(--bdr);
      border-radius: 100px; padding: 4px 11px;
      font-size: .69rem; font-weight: 700; color: var(--g700);
      text-transform: uppercase; letter-spacing: .05em;
      cursor: pointer; transition: all var(--ease);
    }
    [data-bs-theme="dark"] .tag-pill { color: var(--g300); }
    .tag-pill:hover { background: var(--g100); border-color: var(--accent); transform: translateY(-1px); }
    .tag-cnt { color: var(--txt4); font-weight: 400; text-transform: none; letter-spacing: 0; }

    /* ================================================================
       MEMBERS
    ================================================================ */
    .mem-row {
      display: flex; align-items: center; gap: 9px;
      padding: .5rem 0; border-bottom: 1px solid var(--bdr2);
    }
    .mem-row:last-child { border-bottom: none; padding-bottom: 0; }
    .mem-av {
      width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0;
      display: flex; align-items: center; justify-content: center;
      font-size: 11px; font-weight: 700; color: #fff;
    }
    .mem-name { font-size: .78rem; font-weight: 600; color: var(--txt); }
    .mem-sub  { font-size: .66rem; color: var(--txt4); }
    .pill-xs  { margin-left: auto; flex-shrink: 0; font-size: .61rem; font-weight: 700; border-radius: 100px; padding: 2px 8px; }
    .px-g { background: var(--g100); color: var(--g700); }
    .px-a { background: #fef3c7; color: #b45309; }
    .px-p { background: #fce7f3; color: #be185d; }

    /* ================================================================
       SMALL BUTTONS
    ================================================================ */
    .btn-q {
      display: inline-flex; align-items: center; gap: 5px;
      padding: .52rem 1.05rem; border-radius: 50px;
      font-size: .82rem; font-weight: 700; color: #fff;
      background: linear-gradient(135deg, var(--accent), var(--accent-d));
      box-shadow: 0 4px 14px var(--sh); border: none;
      transition: all var(--ease);
    }
    .btn-q:hover { transform: translateY(-1px); box-shadow: 0 6px 20px var(--sh2); }

    .btn-q-ol {
      display: inline-flex; align-items: center; gap: 5px;
      padding: .5rem 1rem; border-radius: 50px;
      font-size: .82rem; font-weight: 600; color: var(--txt2);
      background: var(--card); border: 1.5px solid var(--bdr2);
      transition: all var(--ease);
    }
    .btn-q-ol:hover { border-color: var(--accent); color: var(--accent); }

    .btn-xs {
      display: inline-flex; align-items: center; gap: 3px;
      padding: .25rem .7rem; border-radius: 8px;
      font-size: .7rem; font-weight: 700; color: var(--txt3);
      border: 1.5px solid var(--bdr); transition: all var(--ease);
    }
    .btn-xs:hover { border-color: var(--accent); color: var(--accent); }

    /* ================================================================
       PAGE HEADER
    ================================================================ */
    .page-title {
      font-family: var(--ff); font-weight: 800;
      font-size: clamp(1.4rem,2.2vw,1.85rem);
      letter-spacing: -.03em; color: var(--txt); margin-bottom: .15rem;
    }
    .page-sub { font-size: .8rem; color: var(--txt4); }
    
    /* ================================================================
       QUEST FORMS & WRAPPERS
    ================================================================ */
    .form-wrapper {
      background: var(--card);
      border: 1px solid var(--bdr);
      border-radius: 20px;
      padding: 1.8rem;
    }
    .form-section-title {
      display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem;
    }
    .form-section-number {
      width: 28px; height: 28px; border-radius: 8px;
      background: var(--g100); color: var(--accent-d);
      display: flex; align-items: center; justify-content: center;
      font-size: .8rem; font-weight: 800; border: 1px solid var(--accent);
    }
    .form-section-title h3 {
      font-family: var(--ff); font-weight: 700; font-size: 1.05rem; color: var(--txt); margin: 0;
    }
    .form-group { margin-bottom: 1.2rem; }
    .form-label {
      font-size: .78rem; font-weight: 700; color: var(--txt3); margin-bottom: .45rem; display: block;
    }
    .form-control, .form-select, textarea {
      background: var(--bg3) !important;
      border: 1.5px solid var(--bdr) !important;
      border-radius: 12px !important;
      padding: .65rem .9rem !important;
      font-size: .88rem !important;
      color: var(--txt) !important;
      transition: all var(--ease) !important;
    }
    .form-control:focus, .form-select:focus {
      background: var(--card) !important;
      border-color: var(--accent) !important;
      box-shadow: 0 0 0 4px var(--g100) !important;
    }
    .form-text { font-size: .7rem; color: var(--txt4); margin-top: .3rem; display: block; }
    .form-actions {
      display: flex; align-items: center; gap: 10px; margin-top: 1.5rem;
      padding-top: 1.5rem; border-top: 1px solid var(--bdr2);
    }
    .divider { height: 1px; background: var(--bdr2); margin: 1.2rem 0; }
    .card-base {
      background: var(--card); border: 1px solid var(--bdr); border-radius: 20px; padding: 1.5rem;
    }
    .avatar-lg {
      width: 80px; height: 80px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 2.2rem; color: #fff; box-shadow: 0 8px 24px var(--sh);
      margin: 0 auto 1rem;
    }

    /* Empty States */
    .empty-state { text-align: center; padding: 4rem 1rem; }
    .empty-state-icon { font-size: 3.5rem; margin-bottom: 1.2rem; opacity: 0.18; }
    .empty-state-title { font-family: var(--ff); font-weight: 800; font-size: 1.2rem; color: var(--txt); margin-bottom: .6rem; }
    .empty-state-text { font-size: .88rem; color: var(--txt4); max-width: 320px; margin: 0 auto 1.5rem; line-height: 1.6; }
    
    /* Modern Lists */
    .list-group-modern { list-style: none; padding: 0; margin: 0; }
    .list-item {
      padding: .9rem 0; border-bottom: 1px solid var(--bdr2);
      display: flex; justify-content: space-between; align-items: center;
      transition: all var(--ease);
    }
    .list-item:hover { transform: translateX(4px); }
    .list-item:last-child { border-bottom: none; }

    /* ================================================================
       REVEAL — same as all Quest pages
    ================================================================ */
    .reveal { opacity: 0; transform: translateY(16px); transition: opacity .55s ease, transform .55s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* ================================================================
       RESPONSIVE
    ================================================================ */

    /* ── < 992 MOBILE REWRITES (LG Breakpoint) ── */
    @media (max-width: 991px) {
      .app { grid-template-columns: var(--sbi) 1fr; }
      
      /* Mobile Sidebar 2 as TOPBAR refinements */
      .sbn {
        position: fixed !important;
        top: var(--top) !important;
        left: var(--sbi) !important;
        right: 0 !important;
        bottom: auto !important;
        width: calc(100% - var(--sbi)) !important;
        height: 52px !important;
        transform: none !important;
        border-right: none !important;
        border-bottom: 1px solid var(--bdr);
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        overflow: visible !important; /* Allow hint arrow overlap */
        z-index: 1010 !important;
        padding: 0 !important;
        background: var(--card) !important;
        box-shadow: 0 4px 12px var(--sh);
      }
      
      .sbn-searchbox, .sbn-heading, .sbn-lbl, .sbn-promo, .sbn-kbd { display: none !important; }
      
      #sbn-content {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 0.5rem !important;
        width: 100% !important;
        overflow-x: auto !important;
        white-space: nowrap !important;
        padding: 0 45px 0 0.8rem !important; /* Space for arrow */
        -ms-overflow-style: none; scrollbar-width: none;
        animation: sbnBounce 1.4s ease-out 0.6s;
      }
      #sbn-content::-webkit-scrollbar { display: none; }

      .sbn-scroll-hint {
        position: absolute;
        right: 0; top: 0; bottom: 0;
        width: 50px;
        background: linear-gradient(to right, transparent, var(--card) 70%);
        display: flex; align-items: center; justify-content: flex-end;
        padding-right: 12px;
        color: var(--accent);
        pointer-events: none;
        z-index: 1020;
        transition: opacity 0.3s;
        animation: sbnPulse 2s infinite;
      }
      .sbn-scroll-hint.hidden { opacity: 0; }

      @keyframes sbnBounce {
        0%, 100% { transform: translateX(0); }
        20% { transform: translateX(-20px); }
        40% { transform: translateX(0); }
      }
      @keyframes sbnPulse {
        0%, 100% { transform: translateX(0); opacity: 0.4; }
        50% { transform: translateX(4px); opacity: 1; }
      }

      .sbn-link {
        padding: 8px 14px !important;
        font-size: 0.8rem !important;
        border-radius: 12px !important;
        white-space: nowrap !important;
        border: none !important;
        background: var(--bg3) !important;
        color: var(--txt2) !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        height: 34px !important;
      }
      .sbn-link.active { background: var(--g100) !important; color: var(--accent-d) !important; font-weight: 700 !important; }
      .sbn-link.active::before { display: none !important; }
      .sbn-icon { font-size: 13px; width: auto; }

      .app {
        display: block !important; /* Désactivation de la grille fixe 100vh sur mobile */
        height: auto !important;
        width: 100% !important;
        overflow-y: visible !important;
      }
      body { overflow-y: auto !important; height: auto !important; }
      
      .main-col {
        width: 100%;
        min-height: 100vh;
        padding-top: var(--top);
      }
      .content {
        padding: calc(52px + 1.25rem) 1.25rem 2rem !important; /* On ajuste le padding */
        height: auto !important;
        overflow-y: visible !important;
      }
      
      /* On s'assure que la topbar principale reste fixe en haut */
      .topbar {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030 !important;
        background: var(--card) !important;
        border-bottom: 1px solid var(--bdr);
        height: var(--top) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 0 1rem !important;
      }
      .ham { display: flex !important; }
      .tb-meta, .tb-pills { display: none !important; }
    }

    /* ── < 768 MOBILE REWRITES (MD Breakpoint) ── */
    @media (max-width: 767px) {
      .app { grid-template-columns: 1fr; }
      .sbi {
        position: fixed; top: 0; left: 0; bottom: 0;
        transform: translateX(-100%);
        transition: transform var(--ease);
        z-index: 1050;
      }
      .sbi.open { transform: translateX(0); }
      
      .sbn { 
        left: 0 !important; 
        width: 100% !important;
        z-index: 1010;
      }
      
      .main-col { grid-column: 1; }
      .topbar { padding: 0 1rem; gap: .6rem; }
      .btn-q-ol { display: none; }
    }

    /* ── < 576 SMALL MOBILE REWRITES (SM Breakpoint) ── */
    @media (max-width: 575px) {
      .content { padding: 1.25rem .75rem; padding-top: calc(52px + 1.25rem) !important; }
      .tb-right { gap: 0.4rem; }
      .tb-icon, .user-email, .btn-share { display: none !important; }
      .page-title { font-size: 1.3rem; }
      .stat-num { font-size: 1.4rem; }
    }

    /* mobile overlay */
    .mob-ov {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,.42); z-index: 39;
    }
    .mob-ov.show { display: block; }
  </style>
</head>
<body>

<!-- ================================================================
     FULL APP GRID
================================================================ -->
<div class="app">

  <!-- ============================================================
       SIDEBAR 1 — ICON STRIP
  ============================================================ -->
  <?php include __DIR__ . '/../Components/admin/sidebar-primary.php'; ?>

  <!-- SUBMENU REMOVED: Replaced by dynamic secondary sidebar -->
  <!-- ============================================================
       SIDEBAR 2 — NAV PANEL
  ============================================================ -->
  <?php include __DIR__ . '/../Components/admin/sidebar-nav.php'; ?>


  <!-- ============================================================
       MAIN COLUMN (topbar + scrollable content)
  ============================================================ -->
  <div class="main-col">

    <!-- ── TOPBAR ── -->
    <header class="topbar" id="topbar">
      <button class="ham" id="hamBtn" onclick="toggleNav()"><i class="fas fa-bars"></i></button>

      <div class="page-meta d-flex flex-column" style="margin-left: 0.5rem;">
        <h2 class="mb-0 fw-bolder text-dark" style="font-size: 1.15rem; letter-spacing: -0.02em; line-height: 1.2;">
            <?= htmlspecialchars($pageTitle ?? 'Dashboard') ?>
        </h2>
        <?php if(!empty($pageSubtitle)): ?>
            <span class="text-secondary fw-medium" style="font-size: 0.75rem; opacity: 0.8;">
                <?= htmlspecialchars($pageSubtitle) ?>
            </span>
        <?php endif; ?>
      </div>

      <!-- Global Search -->
      <div class="d-none d-xl-flex align-items-center flex-grow-1 mx-4">
        <form action="/dashboard/questions" method="GET" class="w-100 position-relative" style="max-width: 440px;">
          <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted opacity-50" style="font-size: 0.85rem;"></i>
          <input type="text" name="q" class="form-control border-0 bg-light rounded-pill px-5 fw-bold" placeholder="Search questions, users, tags..." style="font-size: 0.82rem; box-shadow: none; transition: all 0.2s; background:rgba(0,0,0,0.03) !important" id="globalSearch">
          <div class="position-absolute top-50 end-0 translate-middle-y me-2 d-none d-xxl-block">
             <span class="badge bg-white border text-muted fw-800" style="font-size:0.6rem; padding: 4px 7px; color:var(--txt4) !important">⌘K</span>
          </div>
        </form>
      </div>

      <div class="d-none d-lg-flex align-items-center gap-2 tb-pills ms-auto">
        <button class="tb-pill" data-bs-toggle="modal" data-bs-target="#widgetModal"><i class="fas fa-border-all"></i> Widget</button>
        <button class="tb-pill" data-bs-toggle="modal" data-bs-target="#filterModal"><i class="fas fa-sliders-h"></i> Filter</button>
        <button class="tb-pill" data-bs-toggle="modal" data-bs-target="#inviteModal"><i class="fas fa-users"></i> Invite Team</button>
      </div>

      <div class="tb-right">
        <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" title="Toggle Theme"><i class="fas fa-moon"></i></button>
        
        <!-- Notifications Dropdown -->
        <div class="dropdown">
          <div class="tb-icon position-relative" id="notifDrop" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
            <i class="fas fa-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.5rem; padding: 3px 5px; margin-top: 8px; margin-left: -8px;">3+</span>
          </div>
          <div class="dropdown-menu dropdown-menu-end p-0 border-0 shadow-lg mt-3" style="width: 320px; border-radius: 20px; overflow: hidden;">
            <div class="p-3 bg-light border-bottom d-flex justify-content-between align-items-center">
              <h6 class="mb-0 fw-800">Notifications</h6>
              <span class="badge bg-soft-accent text-accent small fw-800">2 New</span>
            </div>
            <div class="notif-list" style="max-height: 350px; overflow-y: auto;">
              <div class="dropdown-item p-3 border-bottom d-flex gap-3 align-items-start">
                <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width:36px; height:36px; flex-shrink:0">
                  <i class="fas fa-arrow-up small"></i>
                </div>
                <div>
                  <div class="text-dark fw-800 small text-wrap">Someone upvoted your question about "Centering Divs"</div>
                  <div class="text-muted smaller mt-1">2 minutes ago</div>
                </div>
              </div>
              <div class="dropdown-item p-3 border-bottom d-flex gap-3 align-items-start bg-light-accent">
                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width:36px; height:36px; flex-shrink:0">
                  <i class="fas fa-comment small"></i>
                </div>
                <div>
                  <div class="text-dark fw-800 small text-wrap">New answer received on "Laravel Routes"</div>
                  <div class="text-muted smaller mt-1">1 hour ago</div>
                </div>
              </div>
            </div>
            <a href="#" class="dropdown-item text-center py-3 text-accent fw-800 small border-top">View All Notifications</a>
          </div>
        </div>

        <!-- Messages Dropdown -->
        <div class="dropdown d-none d-sm-block">
          <div class="tb-icon" id="msgDrop" data-bs-toggle="dropdown" aria-expanded="false" title="Messages">
            <i class="fas fa-envelope"></i>
          </div>
          <div class="dropdown-menu dropdown-menu-end p-0 border-0 shadow-lg mt-3" style="width: 320px; border-radius: 20px; overflow: hidden;">
            <div class="p-3 bg-light border-bottom">
              <h6 class="mb-0 fw-800">Messages</h6>
            </div>
            <div class="msg-list">
              <div class="dropdown-item p-3 border-bottom d-flex gap-3 align-items-center">
                <div class="user-av sm">JD</div>
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <span class="fw-800 small text-dark">Jane Doe</span>
                    <span class="smaller text-muted">12:45 PM</span>
                  </div>
                  <div class="text-muted smaller text-truncate" style="max-width: 180px;">Hey! I saw your post about...</div>
                </div>
              </div>
            </div>
            <a href="#" class="dropdown-item text-center py-3 text-accent fw-800 small border-top">Start New Chat</a>
          </div>
        </div>

        <button class="btn-share" data-bs-toggle="modal" data-bs-target="#shareModal"><i class="fas fa-share-alt"></i> Share</button>
        <div class="user-chip">
          <?php
            $userName = $_SESSION['user_name'] ?? 'User';
            $userEmail = $_SESSION['user_email'] ?? 'user@quest.com';
            $initials = strtoupper(substr($userName, 0, 2));
            if (strpos($userName, ' ') !== false) {
                $parts = explode(' ', $userName);
                $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
            }
          ?>
          <div class="user-av"><?= htmlspecialchars($initials) ?></div>
          <div class="d-none d-md-block">
            <div class="user-name"><?= htmlspecialchars($userName) ?></div>
            <div class="user-email"><?= htmlspecialchars($userEmail) ?></div>
          </div>
        </div>
      </div>
    </header>

    <!-- ── SCROLLABLE CONTENT ── -->
    <div class="content" id="mainContent">
      <?php
      if (!empty($pageBody)) {
          echo $pageBody;
      } else {
          include __DIR__ . '/../admin/dashboard.php';
      }
      ?>
    </div><!-- /content -->
  </div><!-- /main-col -->

</div><!-- /app -->

<!-- mobile overlay -->
<div class="mob-ov" id="mobOv" onclick="closeAll()"></div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/quest/sidebar.js?v=<?= time() ?>"></script>

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
/* Premium Toast Animations & Styling */
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

/* Auto-remove animation class via JS */
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


<!-- ================================================================
     QUEST MODALS (Widget, Filter, Invite)
================================================================ -->

<!-- 1. WIDGET MODAL -->
<div class="modal fade quest-modal" id="widgetModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-800"><i class="fas fa-border-all me-2 text-accent"></i> Manage Widgets</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4">
        <p class="text-secondary small mb-4">Customize your dashboard by toggling visible widgets.</p>
        <div class="d-flex flex-column gap-3">
          <div class="widget-toggle-item p-3 rounded-4 border bg-light d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
              <div class="ico-box rounded-3 bg-white border shadow-sm p-2" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;color:var(--accent)">
                <i class="fas fa-chart-pie"></i>
              </div>
              <div>
                <div class="fw-bold small">Statistics Cards</div>
                <div class="text-muted" style="font-size:0.7rem">Real-time engagement metrics</div>
              </div>
            </div>
            <div class="form-check form-switch p-0 m-0">
              <input class="form-check-input ms-0" type="checkbox" checked style="width: 2.8em; height: 1.4em; cursor:pointer" onchange="showToast('Widget visibility updated')">
            </div>
          </div>
          
          <div class="widget-toggle-item p-3 rounded-4 border bg-light d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
              <div class="ico-box rounded-3 bg-white border shadow-sm p-2" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;color:var(--g700)">
                <i class="fas fa-stream"></i>
              </div>
              <div>
                <div class="fw-bold small">Activity Feed</div>
                <div class="text-muted" style="font-size:0.7rem">Recent events and interactions</div>
              </div>
            </div>
            <div class="form-check form-switch p-0 m-0">
              <input class="form-check-input ms-0" type="checkbox" checked style="width: 2.8em; height: 1.4em; cursor:pointer" onchange="showToast('Widget visibility updated')">
            </div>
          </div>

          <div class="widget-toggle-item p-3 rounded-4 border bg-light d-flex align-items-center justify-content-between opacity-50">
            <div class="d-flex align-items-center gap-3">
              <div class="ico-box rounded-3 bg-white border shadow-sm p-2" style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;color:#f59e0b">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <div>
                <div class="fw-bold small">Event Calendar</div>
                <div class="text-muted" style="font-size:0.7rem">Coming soon</div>
              </div>
            </div>
            <div class="form-check form-switch p-0 m-0">
              <input class="form-check-input ms-0" type="checkbox" disabled style="width: 2.8em; height: 1.4em;">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer border-0 pt-0">
        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-q rounded-pill px-4" onclick="showToast('Settings saved successfully','success')">Save Layout</button>
      </div>
    </div>
  </div>
</div>

<!-- 2. FILTER MODAL -->
<div class="modal fade quest-modal" id="filterModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-800"><i class="fas fa-sliders-h me-2 text-accent"></i> Content Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4">
        <div class="mb-4">
          <label class="form-label fw-700 small text-uppercase mb-3 opacity-75">Category</label>
          <div class="d-flex flex-wrap gap-2">
            <input type="radio" class="btn-check" name="cat-filter" id="cat-all" checked>
            <label class="btn btn-outline-secondary rounded-pill btn-sm px-3 fw-600" for="cat-all">All</label>
            
            <input type="radio" class="btn-check" name="cat-filter" id="cat-tech">
            <label class="btn btn-outline-secondary rounded-pill btn-sm px-3 fw-600" for="cat-tech">Tech</label>
            
            <input type="radio" class="btn-check" name="cat-filter" id="cat-design">
            <label class="btn btn-outline-secondary rounded-pill btn-sm px-3 fw-600" for="cat-design">Design</label>
            
            <input type="radio" class="btn-check" name="cat-filter" id="cat-business">
            <label class="btn btn-outline-secondary rounded-pill btn-sm px-3 fw-600" for="cat-business">Business</label>
          </div>
        </div>
        
        <div class="mb-4">
          <label class="form-label fw-700 small text-uppercase mb-3 opacity-75">Time Range</label>
          <select class="form-select border-0 bg-light rounded-4 fw-bold p-3" style="font-size: 0.9rem;">
            <option selected>Last 24 Hours</option>
            <option>Last 7 Days</option>
            <option>This Month</option>
            <option>Year to Date</option>
            <option>All Time</option>
          </select>
        </div>

        <div class="mb-2">
          <label class="form-label fw-700 small text-uppercase mb-3 opacity-75">Sort By</label>
          <div class="row g-2" id="sortOptions">
            <div class="col-6">
              <div class="p-3 border rounded-4 bg-light text-center cursor-pointer active-sort border-accent shadow-sm bg-white" onclick="toggleSort(this)">
                <i class="fas fa-fire-alt d-block mb-1 text-accent"></i>
                <span class="small fw-bold">Trending</span>
              </div>
            </div>
            <div class="col-6">
              <div class="p-3 border rounded-4 bg-light text-center cursor-pointer" onclick="toggleSort(this)">
                <i class="fas fa-clock d-block mb-1"></i>
                <span class="small fw-bold text-muted">Latest First</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer border-0 pt-0">
        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Clear</button>
        <button type="button" class="btn btn-q rounded-pill px-4" onclick="applyFilters()">Apply Filters</button>
      </div>
    </div>
  </div>
</div>

<!-- 3. INVITE MODAL -->
<div class="modal fade quest-modal" id="inviteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 overflow-hidden">
      <div class="modal-header border-0 pb-0 bg-light-accent p-4">
        <div>
          <h5 class="modal-title fw-800"><i class="fas fa-users-plus me-2"></i> Invite Team Members</h5>
          <p class="text-muted small mb-0 mt-1">Collaborate with your team on Quest.</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="mb-4">
          <label class="form-label fw-700 small mb-2">Email Address</label>
          <div class="input-group shadow-sm rounded-4 overflow-hidden border">
            <span class="input-group-text border-0 bg-white ps-3"><i class="fas fa-envelope text-muted"></i></span>
            <input type="email" class="form-control border-0 py-3 ps-2" placeholder="colleague@company.com" style="box-shadow:none">
          </div>
        </div>
        
        <div>
          <label class="form-label fw-700 small mb-2">Assign Role</label>
          <div class="row g-2">
            <div class="col-6">
              <input type="radio" class="btn-check" name="role" id="role-member" checked>
              <label class="btn btn-outline-light border px-3 py-3 rounded-4 w-100 text-start" for="role-member">
                <span class="d-block fw-bold text-dark small">Member</span>
                <span class="d-block text-muted" style="font-size:0.65rem">Full access to projects</span>
              </label>
            </div>
            <div class="col-6">
              <input type="radio" class="btn-check" name="role" id="role-admin">
              <label class="btn btn-outline-light border px-3 py-3 rounded-4 w-100 text-start" for="role-admin">
                <span class="d-block fw-bold text-dark small">Admin</span>
                <span class="d-block text-muted" style="font-size:0.65rem">Manage everything</span>
              </label>
            </div>
          </div>
        </div>
        
        <div class="mt-4 p-3 rounded-4 bg-light border-dashed d-flex align-items-center gap-3">
          <div class="user-av sm">JD</div>
          <div class="user-av sm bg-secondary">AM</div>
          <div class="user-av sm border text-muted bg-white">+4</div>
          <div class="ms-auto"><span class="badge bg-soft-accent text-accent fw-bold rounded-pill">6 active</span></div>
        </div>
      </div>
      <div class="modal-footer border-0 p-4 pt-0">
        <button type="button" class="btn btn-q w-100 py-3 rounded-4 fw-800" onclick="sendInvite()">Send Invitation Link</button>
      </div>
    </div>
  </div>
</div>

<!-- 4. SHARE MODAL -->
<div class="modal fade quest-modal" id="shareModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-800"><i class="fas fa-share-alt me-2 text-accent"></i> Share Page</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4">
        <div class="d-flex justify-content-between gap-2 mb-4">
          <button class="btn btn-outline-light border rounded-4 p-3 flex-grow-1 d-flex flex-column align-items-center gap-2 transition-hover text-dark bg-white shadow-sm" style="transition:all 0.3s" onclick="showToast('Link copied to clipboard','success')">
             <i class="fas fa-link text-primary" style="font-size:1.5rem"></i>
             <span class="smaller fw-bold">Copy Link</span>
          </button>
          <button class="btn btn-outline-light border rounded-4 p-3 flex-grow-1 d-flex flex-column align-items-center gap-2 transition-hover text-dark bg-white shadow-sm" style="transition:all 0.3s" onclick="showToast('Opening Twitter...','info')">
             <i class="fab fa-twitter text-info" style="font-size:1.5rem"></i>
             <span class="smaller fw-bold">Twitter</span>
          </button>
        </div>
        <div class="input-group shadow-sm border rounded-4 overflow-hidden">
          <input type="text" class="form-control border-0 bg-light small ps-3" value="https://quest.app/p/<?= urlencode($pageTitle ?? 'dashboard') ?>" readonly style="background:var(--bg3) !important">
          <button class="btn btn-q-ol border-0 px-3 fw-800 smaller" style="font-size:0.7rem" onclick="showToast('Direct link copied','success')">Copy</button>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Quest Modal Customization */
.quest-modal .modal-content {
    background: var(--card);
    border-radius: 24px;
    box-shadow: 0 25px 80px rgba(0,0,0,0.15) !important;
    backdrop-filter: blur(10px);
}
[data-bs-theme="dark"] .quest-modal .modal-content {
    background: rgba(15, 23, 42, 0.95);
    border: 1px solid var(--bdr) !important;
}
.quest-modal .modal-header .btn-close {
    background-color: var(--bg3);
    border-radius: 50%;
    opacity: 0.8;
    padding: 10px;
    font-size: 0.7rem;
}
.quest-modal .form-control:focus, .quest-modal .form-select:focus {
    background-color: #fff;
    border-color: var(--accent);
}
[data-bs-theme="dark"] .quest-modal .bg-light { background-color: rgba(255,255,255,0.05) !important; }
[data-bs-theme="dark"] .quest-modal .text-dark { color: #fff !important; }
[data-bs-theme="dark"] .quest-modal .border { border-color: var(--bdr) !important; }

.ico-box { transition: transform 0.2s; }
.widget-toggle-item:hover .ico-box { transform: scale(1.1); }
.cursor-pointer { cursor: pointer; }
.bg-soft-accent { background: rgba(34,197,94,0.1); }
.text-accent { color: var(--accent); }
.fw-800 { font-weight: 800; }
.fw-700 { font-weight: 700; }
.fw-600 { font-weight: 600; }
.border-dashed { border: 2px dashed var(--bdr); }
.user-av.sm { width: 30px; height: 30px; font-size: 10px; }

.btn-check:checked + .btn-outline-secondary {
    background-color: var(--accent) !important;
    border-color: var(--accent) !important;
    color: #fff !important;
}
.btn-check:checked + .btn-outline-light {
    border-color: var(--accent) !important;
    background: rgba(34,197,94,0.03) !important;
}
</style>

<script>
    // Define the global toast function
    window.questShowToast = function(message, type = 'success') {
        const toastContainer = document.body;
        const toastId = 'toast-' + Date.now();
        
        const toastOuter = document.createElement('div');
        toastOuter.id = toastId;
        toastOuter.className = `flash-toast ${type}`;
        
        const icon = type === 'success' ? 'fa-check-circle' : (type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle');
        
        toastOuter.innerHTML = `
            <div class="toast-icn"><i class="fas ${icon}"></i></div>
            <div class="toast-txt">${message}</div>
            <div class="toast-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></div>
        `;
        
        toastContainer.appendChild(toastOuter);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            const toast = document.getElementById(toastId);
            if (toast) toast.remove();
        }, 5000);
    };

    /* Toast Global function accessor */
    function showToast(msg, type='success') {
        // We already have a toast system in app.php, let's use it if it exists or trigger a similar one
        if(typeof window.questShowToast === 'function') {
            window.questShowToast(msg, type);
        } else {
            alert(msg); // Fallback
        }
    }
            <button class="toast-cls" onclick="document.getElementById('${toastId}').remove()"><i class="fas fa-times"></i></button>
        `;
        
        document.body.appendChild(toastOuter);
        
        // Modal auto-close
        const activeModal = document.querySelector('.modal.show');
        if (activeModal) {
            bootstrap.Modal.getInstance(activeModal).hide();
        }

        setTimeout(() => {
            if(document.getElementById(toastId)) {
                toastOuter.classList.add('toast-hiding');
                setTimeout(() => toastOuter.remove(), 400);
            }
        }, 4000);
    };
    // Sorting toggle logic
    window.toggleSort = function(el) {
        document.querySelectorAll('#sortOptions .rounded-4').forEach(item => {
            item.classList.remove('active-sort', 'border-accent', 'shadow-sm', 'bg-white');
            item.querySelector('span').classList.add('text-muted');
            const icon = item.querySelector('i');
            if(icon.classList.contains('fa-fire-alt')) icon.classList.remove('text-accent');
        });
        
        el.classList.add('active-sort', 'border-accent', 'shadow-sm', 'bg-white');
        el.querySelector('span').classList.remove('text-muted');
        const activeIcon = el.querySelector('i');
        if(activeIcon.classList.contains('fa-fire-alt')) activeIcon.classList.add('text-accent');
    };

    window.applyFilters = function() {
        showToast('Processing requested filters...', 'info');
        setTimeout(() => {
            showToast('Filters synchronized with dashboard', 'success');
        }, 800);
    };

    window.sendInvite = function() {
        const emailInput = document.querySelector('#inviteModal input[type="email"]');
        const email = emailInput.value || 'colleague@company.com';
        showToast(`Sending invitation to ${email}...`, 'info');
        setTimeout(() => {
            showToast(`Invitation sent successfully to ${email}`, 'success');
            emailInput.value = '';
        }, 1200);
    };
</script>

<style>
.active-sort { transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
</style>