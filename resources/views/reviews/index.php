<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Community Reviews — Quest</title>
  <meta name="description" content="Read what Quest users say about the platform. Leave your own star rating and review.">

  <link rel="icon" href="/assets/quest/favicon.ico" sizes="any">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* ============================================================
       DESIGN TOKENS (match welcome.php)
    ============================================================ */
    :root {
      --g100:#dcfce7;--g200:#bbf7d0;--g300:#86efac;--g400:#4ade80;
      --g500:#22c55e;--g600:#16a34a;--g700:#15803d;--g800:#166534;--g900:#14532d;
      --accent:#22c55e;--accent-d:#16a34a;--accent-l:#4ade80;
      --bg:#f6fefa;--bg2:#edfbf3;--bg3:#f0fdf4;--card:#ffffff;
      --txt:#071a0e;--txt2:#374151;--txt3:#6b7280;--txt4:#9ca3af;
      --bdr:#c6f6d5;--bdr2:#e5e7eb;
      --sh:rgba(22,163,74,.12);--sh2:rgba(22,163,74,.22);
      --ff:'Syne',sans-serif;--fb:'DM Sans',sans-serif;
      --ease:.28s cubic-bezier(.4,0,.2,1);--nav-h:70px;
    }
    [data-bs-theme="dark"] {
      --bg:#040d07;--bg2:#071209;--bg3:#0a1a0f;--card:#0d1f12;
      --txt:#ecfdf5;--txt2:#d1fae5;--txt3:#86efac;--txt4:#4ade80;
      --bdr:#1a3a24;--bdr2:#1e3326;
      --sh:rgba(34,197,94,.18);--sh2:rgba(34,197,94,.28);
    }
    html { scroll-behavior:smooth; }
    body { font-family:var(--fb);background:var(--bg);color:var(--txt);overflow-x:hidden;-webkit-font-smoothing:antialiased; }
    a { text-decoration:none;color:inherit; }

    /* ---- Navbar ---- */
    .quest-navbar {
      position:fixed;top:0;left:0;right:0;z-index:200;height:var(--nav-h);
      background:rgba(246,254,250,.92);backdrop-filter:blur(24px) saturate(180%);
      border-bottom:1px solid var(--bdr);transition:background var(--ease),box-shadow var(--ease);
    }
    [data-bs-theme="dark"] .quest-navbar { background:rgba(4,13,7,.92); }
    .quest-navbar.scrolled { box-shadow:0 4px 30px var(--sh); }
    .nav-logo {
      display:flex;align-items:center;gap:10px;
      font-family:var(--ff);font-weight:800;font-size:1.25rem;color:var(--txt);
    }
    .nav-logo .logo-img { width:44px;height:44px;border-radius:10px;object-fit:cover; }
    .theme-btn {
      width:44px;height:44px;border-radius:50%;background:var(--bg3);border:1px solid var(--bdr);
      display:flex;align-items:center;justify-content:center;font-size:17px;cursor:pointer;
      transition:all var(--ease);
    }
    .theme-btn:hover { background:var(--bdr);transform:rotate(15deg); }
    .btn-back {
      display:inline-flex;align-items:center;gap:6px;
      padding:8px 18px;border-radius:50px;font-size:.85rem;font-weight:600;
      color:var(--txt2);background:transparent;border:1.5px solid var(--bdr2);
      transition:all var(--ease);
    }
    .btn-back:hover { border-color:var(--accent);color:var(--accent); }

    /* ---- Page Layout ---- */
    .page-wrap { padding-top:calc(var(--nav-h) + 2rem);padding-bottom:4rem;min-height:100vh; }

    /* ---- Page Header ---- */
    .page-header {
      background:linear-gradient(135deg,var(--g900) 0%,var(--g700) 60%,var(--g500) 100%);
      border-radius:24px;padding:2.5rem 2rem;margin-bottom:2rem;
      position:relative;overflow:hidden;color:#fff;
    }
    .page-header::before {
      content:'';position:absolute;top:-40px;right:-40px;width:200px;height:200px;
      background:radial-gradient(circle,rgba(255,255,255,.12) 0%,transparent 65%);
      border-radius:50%;pointer-events:none;
    }
    .ph-badge {
      display:inline-flex;align-items:center;gap:6px;
      background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);
      border-radius:100px;padding:4px 12px;font-size:.7rem;font-weight:700;
      text-transform:uppercase;letter-spacing:.07em;margin-bottom:.75rem;
    }
    .ph-title { font-family:var(--ff);font-weight:800;font-size:clamp(1.5rem,3vw,2.5rem);line-height:1.1;margin-bottom:.5rem; }
    .ph-sub   { font-size:.9rem;opacity:.78;max-width:480px; }

    /* ---- Rating Summary Card ---- */
    .rating-summary {
      background:var(--card);border:1px solid var(--bdr);border-radius:20px;
      padding:1.5rem;margin-bottom:1.5rem;
    }
    .rs-score {
      font-family:var(--ff);font-weight:800;font-size:3.5rem;
      color:var(--txt);line-height:1;
    }
    .rs-stars { font-size:1.25rem;color:#fbbf24;letter-spacing:2px; }
    .rs-count { font-size:.85rem;color:var(--txt3);margin-top:4px; }
    .bar-row { display:flex;align-items:center;gap:8px;margin-bottom:6px; }
    .bar-lbl { font-size:.8rem;color:var(--txt3);width:32px;flex-shrink:0;text-align:right; }
    .bar-track {
      flex:1;height:8px;border-radius:4px;background:var(--bdr2);overflow:hidden;
    }
    .bar-fill { height:100%;border-radius:4px;background:linear-gradient(90deg,var(--accent),var(--accent-l));transition:width .6s ease; }
    .bar-cnt  { font-size:.75rem;color:var(--txt4);width:28px;flex-shrink:0; }

    /* ---- Write Review Form ---- */
    .review-form-card {
      background:var(--card);border:1px solid var(--bdr);border-radius:20px;
      padding:1.5rem;margin-bottom:1.5rem;
    }
    .rfc-title {
      font-family:var(--ff);font-weight:800;font-size:1.05rem;
      color:var(--txt);margin-bottom:.35rem;
    }
    .rfc-sub { font-size:.82rem;color:var(--txt3);margin-bottom:1rem; }
    .star-picker { display:flex;gap:6px;margin:.5rem 0 1rem;flex-direction:row-reverse;justify-content:flex-end; }
    .star-picker input { display:none; }
    .star-picker label {
      font-size:1.8rem;cursor:pointer;color:var(--bdr2);
      transition:color .15s,transform .15s;
    }
    .star-picker label:hover,
    .star-picker label:hover ~ label,
    .star-picker input:checked ~ label { color:#fbbf24; }
    .star-picker label:hover { transform:scale(1.2); }
    .rev-textarea {
      width:100%;background:var(--bg2);border:1.5px solid var(--bdr);
      border-radius:12px;padding:.8rem 1rem;font-size:.88rem;color:var(--txt);
      resize:vertical;min-height:100px;font-family:var(--fb);
      transition:border-color var(--ease),box-shadow var(--ease);outline:none;
    }
    .rev-textarea:focus { border-color:var(--accent);box-shadow:0 0 0 3px var(--sh); }
    .rev-textarea::placeholder { color:var(--txt4); }
    .btn-submit-rev {
      display:inline-flex;align-items:center;gap:7px;
      padding:10px 22px;border-radius:50px;
      background:linear-gradient(135deg,var(--accent),var(--accent-d));
      color:#fff;font-weight:700;font-size:.88rem;
      border:none;cursor:pointer;transition:all var(--ease);
      box-shadow:0 4px 14px var(--sh);
    }
    .btn-submit-rev:hover { transform:translateY(-2px);box-shadow:0 8px 24px var(--sh2); }
    .char-count { font-size:.72rem;color:var(--txt4);text-align:right;margin-top:3px; }
    .existing-badge {
      background:var(--bg2);border-radius:10px;padding:.6rem .9rem;
      font-size:.82rem;color:var(--txt3);margin-bottom:.75rem;
    }
    .login-prompt {
      background:var(--bg2);border:1.5px dashed var(--bdr);
      border-radius:16px;padding:1.5rem;text-align:center;
    }
    .btn-lp-login {
      display:inline-flex;align-items:center;gap:6px;
      padding:9px 22px;border-radius:50px;
      background:linear-gradient(135deg,var(--accent),var(--accent-d));
      color:#fff;font-weight:700;font-size:.88rem;border:none;
      transition:all var(--ease);box-shadow:0 4px 12px var(--sh);
    }
    .btn-lp-login:hover { transform:translateY(-2px); }
    .btn-lp-reg {
      display:inline-flex;align-items:center;gap:6px;
      padding:9px 22px;border-radius:50px;
      background:transparent;border:1.5px solid var(--bdr2);
      color:var(--txt2);font-weight:700;font-size:.88rem;
      transition:all var(--ease);
    }
    .btn-lp-reg:hover { border-color:var(--accent);color:var(--accent); }

    /* ---- Review List ---- */
    .rev-item {
      background:var(--card);border:1px solid var(--bdr);border-radius:16px;
      padding:1.25rem 1.5rem;margin-bottom:1rem;
      transition:transform var(--ease),box-shadow var(--ease);
      position:relative;overflow:hidden;
    }
    .rev-item:hover { transform:translateY(-2px);box-shadow:0 10px 30px var(--sh); }
    .rev-item-stars { font-size:12px;color:#fbbf24;letter-spacing:1px; }
    .rev-item-msg {
      font-size:.9rem;line-height:1.65;color:var(--txt2);
      margin:.6rem 0 1rem;font-style:italic;
    }
    .rev-item-avatar {
      width:36px;height:36px;border-radius:50%;
      background:linear-gradient(135deg,var(--accent),var(--g700));
      display:flex;align-items:center;justify-content:center;
      font-weight:800;font-size:.85rem;color:#fff;flex-shrink:0;
    }
    .rev-item-name { font-weight:700;font-size:.88rem;color:var(--txt); }
    .rev-item-date { font-size:.72rem;color:var(--txt4); }
    .rev-item-updated {
      position:absolute;top:12px;right:14px;
      font-size:.65rem;color:var(--txt4);font-style:italic;
    }

    /* ---- Pagination ---- */
    .pag-btn {
      display:inline-flex;align-items:center;justify-content:center;
      width:38px;height:38px;border-radius:10px;border:1.5px solid var(--bdr2);
      font-size:.85rem;font-weight:600;color:var(--txt3);
      transition:all var(--ease);background:var(--card);
    }
    .pag-btn:hover { border-color:var(--accent);color:var(--accent); }
    .pag-btn.active { background:var(--accent);border-color:var(--accent);color:#fff; }
    .pag-btn.disabled { opacity:.4;pointer-events:none; }

    /* ---- Flash ---- */
    .flash-alert { padding:.75rem 1rem;border-radius:12px;margin-bottom:1.25rem;font-size:.9rem;font-weight:600; }
    .flash-success { background:var(--g100);color:var(--g700);border:1px solid var(--g300); }
    .flash-error   { background:#fee2e2;color:#991b1b;border:1px solid #fca5a5; }
    [data-bs-theme="dark"] .flash-success { background:rgba(34,197,94,.15);color:var(--g300);border-color:rgba(34,197,94,.3); }
    [data-bs-theme="dark"] .flash-error   { background:rgba(239,68,68,.15);color:#fca5a5;border-color:rgba(239,68,68,.3); }

    /* ---- Empty State ---- */
    .empty-state {
      background:var(--bg2);border:1.5px dashed var(--bdr);
      border-radius:20px;padding:3rem 2rem;text-align:center;color:var(--txt3);
    }

    /* ---- Reveal ---- */
    .reveal { opacity:0;transform:translateY(20px);transition:opacity .5s ease,transform .5s ease; }
    .reveal.visible { opacity:1;transform:none; }

    /* ---- Sticky sidebar ---- */
    @media(min-width:992px) {
      .sticky-sidebar { position:sticky;top:calc(var(--nav-h) + 1.5rem); }
    }

    /* ---- Tag badge ---- */
    .tag-badge {
      display:inline-flex;align-items:center;gap:6px;
      border:1px solid var(--bdr);border-radius:100px;
      padding:4px 14px;font-size:.72rem;font-weight:700;
      color:var(--g700);background:var(--bg3);text-transform:uppercase;letter-spacing:.07em;
    }
    [data-bs-theme="dark"] .tag-badge { color:var(--g300); }
  </style>
</head>
<body>

<!-- ================================================================ NAVBAR -->
<nav class="quest-navbar" id="nav">
  <div class="container-xl h-100 d-flex align-items-center justify-content-between gap-3">
    <a href="/" class="nav-logo">
      <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img">
      <span>Quest<sup style="font-size:.4em;vertical-align:super;color:var(--accent)">+</sup></span>
    </a>
    <div class="d-flex align-items-center gap-2">
      <a href="/" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Back to Home</a>
      <button class="theme-btn" id="themeBtn" onclick="toggleTheme()" aria-label="Toggle theme">
        <i class="fa-solid fa-moon"></i>
      </button>
    </div>
  </div>
</nav>

<!-- ================================================================ MAIN CONTENT -->
<main class="page-wrap">
  <div class="container-xl">

    <!-- Flash -->
    <?php if (!empty($flash)): ?>
      <div class="flash-alert flash-<?= htmlspecialchars($flash['type']) ?>">
        <i class="fa-solid fa-<?= $flash['type'] === 'success' ? 'circle-check' : 'circle-exclamation' ?>"></i>
        <?= htmlspecialchars($flash['message']) ?>
      </div>
    <?php endif; ?>

    <!-- Page Header -->
    <div class="page-header reveal">
      <div class="ph-badge"><i class="fa-solid fa-star"></i> Community Reviews</div>
      <h1 class="ph-title">What people say about Quest</h1>
      <p class="ph-sub">
        <?php if ($stats['total'] > 0): ?>
          <strong><?= number_format($stats['total']) ?></strong>
          <?= $stats['total'] === 1 ? 'review' : 'reviews' ?> ·
          Average rating:
          <strong><?= number_format((float)$stats['avg'], 1) ?> / 5 ★</strong>
        <?php else: ?>
          Be the first to leave a review and help others discover Quest!
        <?php endif; ?>
      </p>
    </div>

    <div class="row g-4 align-items-start">

      <!-- ======== LEFT COLUMN: list ======== -->
      <div class="col-12 col-lg-7 col-xl-8">

        <?php if (!empty($reviews)): ?>
          <?php foreach ($reviews as $rev):
            $name    = htmlspecialchars($rev['user_name'] ?? 'User');
            $initial = strtoupper(substr($name, 0, 1));
            $msg     = htmlspecialchars($rev['message']);
            $rating  = (int)($rev['rating'] ?? 5);
            $date    = isset($rev['created_at'])   ? date('M j, Y', strtotime($rev['created_at']))   : '';
            $updated = isset($rev['updated_at'])   ? date('M j, Y', strtotime($rev['updated_at']))   : '';
            $wasEdited = ($updated && $updated !== $date);
          ?>
          <div class="rev-item reveal">
            <?php if ($wasEdited): ?>
              <span class="rev-item-updated">Edited <?= $updated ?></span>
            <?php endif; ?>
            <div class="rev-item-stars">
              <?php for($s=1;$s<=5;$s++) echo $s<=$rating?'★':'☆'; ?>
              <span style="font-size:.75rem;color:var(--txt4);margin-left:4px;font-style:normal">(<?= $rating ?>/5)</span>
            </div>
            <p class="rev-item-msg">"<?= $msg ?>"</p>
            <div class="d-flex align-items-center gap-2">
              <div class="rev-item-avatar"><?= $initial ?></div>
              <div>
                <div class="rev-item-name"><?= $name ?></div>
                <div class="rev-item-date"><?= $date ?></div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>

          <!-- Pagination -->
          <?php if ($pages > 1): ?>
          <div class="d-flex gap-2 justify-content-center mt-4 reveal flex-wrap">
            <a href="/reviews?page=<?= max(1,$page-1) ?>"
               class="pag-btn <?= $page <= 1 ? 'disabled' : '' ?>">
              <i class="fa-solid fa-chevron-left"></i>
            </a>
            <?php for($p=1;$p<=$pages;$p++): ?>
              <a href="/reviews?page=<?= $p ?>"
                 class="pag-btn <?= $p===$page?'active':'' ?>"><?= $p ?></a>
            <?php endfor; ?>
            <a href="/reviews?page=<?= min($pages,$page+1) ?>"
               class="pag-btn <?= $page >= $pages ? 'disabled' : '' ?>">
              <i class="fa-solid fa-chevron-right"></i>
            </a>
          </div>
          <?php endif; ?>

        <?php else: ?>
          <div class="empty-state reveal">
            <i class="fa-regular fa-star fa-2x mb-3" style="color:var(--accent)"></i>
            <p class="mb-0 fw-bold">No reviews yet — be the first!</p>
            <p class="mt-1" style="font-size:.85rem">Share your experience and help others discover Quest.</p>
          </div>
        <?php endif; ?>

      </div><!-- /left col -->

      <!-- ======== RIGHT COLUMN: sidebar ======== -->
      <div class="col-12 col-lg-5 col-xl-4">
        <div class="sticky-sidebar">

          <!-- Rating Summary Card -->
          <div class="rating-summary reveal">
            <h2 class="rfc-title mb-3">Overall Rating</h2>
            <?php
              $avg = (float)($stats['avg'] ?? 0);
              $tot = (int)($stats['total'] ?? 0);
              $fullStars  = (int)floor($avg);
              $halfStar   = ($avg - $fullStars) >= 0.5 ? 1 : 0;
              $emptyStars = 5 - $fullStars - $halfStar;
            ?>
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="rs-score"><?= $avg > 0 ? number_format($avg,1) : '—' ?></div>
              <div>
                <div class="rs-stars">
                  <?php for($i=0;$i<$fullStars;$i++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
                  <?php if($halfStar): ?><i class="fa-solid fa-star-half-stroke"></i><?php endif; ?>
                  <?php for($i=0;$i<$emptyStars;$i++): ?><i class="fa-regular fa-star" style="color:var(--bdr2)"></i><?php endfor; ?>
                </div>
                <div class="rs-count"><?= $tot > 0 ? number_format($tot).' '.($tot===1?'review':'reviews') : 'No reviews yet' ?></div>
              </div>
            </div>
            <!-- Breakdown bars -->
            <?php foreach([5,4,3,2,1] as $star):
              $cnt  = $breakdown[$star] ?? 0;
              $pct  = $tot > 0 ? round(($cnt/$tot)*100) : 0;
            ?>
            <div class="bar-row">
              <span class="bar-lbl"><i class="fa-solid fa-star" style="font-size:9px;color:#fbbf24"></i> <?= $star ?></span>
              <div class="bar-track"><div class="bar-fill" style="width:<?= $pct ?>%"></div></div>
              <span class="bar-cnt"><?= $cnt ?></span>
            </div>
            <?php endforeach; ?>
          </div><!-- /rating summary -->

          <!-- Write a Review -->
          <?php if (isset($_SESSION['user_id'])): ?>
            <div class="review-form-card reveal">
              <div class="rfc-title"><?= !empty($userReview) ? '✏️ Update Your Review' : '⭐ Write a Review' ?></div>
              <div class="rfc-sub">
                <?= !empty($userReview)
                  ? 'You have already reviewed Quest. You can update your rating anytime.'
                  : 'Share your honest experience — it helps the community.' ?>
              </div>

              <?php if (!empty($userReview)): ?>
                <div class="existing-badge">
                  <i class="fa-solid fa-circle-check" style="color:var(--accent)"></i>
                  Current rating: <strong><?= (int)$userReview['rating'] ?>/5 stars</strong>
                </div>
              <?php endif; ?>

              <form action="/reviews/store" method="POST" id="reviewForm">

                <!-- Star picker -->
                <div class="star-picker">
                  <?php
                    $cur = isset($userReview['rating']) ? (int)$userReview['rating'] : 0;
                    for ($s = 5; $s >= 1; $s--): ?>
                    <input type="radio" name="rating" id="sr<?= $s ?>" value="<?= $s ?>"
                           <?= $cur===$s?'checked':'' ?> required>
                    <label for="sr<?= $s ?>" title="<?= $s ?> star<?= $s>1?'s':'' ?>">★</label>
                  <?php endfor; ?>
                </div>

                <textarea
                  name="message"
                  id="reviewMsg"
                  class="rev-textarea"
                  placeholder="Tell us about your experience with Quest…"
                  maxlength="1000"
                  required
                ><?= !empty($userReview) ? htmlspecialchars($userReview['message']) : '' ?></textarea>
                <div class="char-count"><span id="charCount"><?= !empty($userReview)?strlen($userReview['message']):0 ?></span> / 1000</div>

                <div class="d-flex gap-2 align-items-center flex-wrap mt-3">
                  <button type="submit" class="btn-submit-rev">
                    <i class="fa-solid fa-paper-plane"></i>
                    <?= !empty($userReview) ? 'Update Review' : 'Submit Review' ?>
                  </button>
                </div>
              </form>
            </div>

          <?php else: ?>
            <div class="login-prompt reveal">
              <i class="fa-solid fa-star fa-lg mb-2" style="color:var(--accent)"></i>
              <p class="mb-3" style="font-weight:600;color:var(--txt2)">Want to review Quest?</p>
              <div class="d-flex flex-column gap-2">
                <a href="/login" class="btn-lp-login">
                  <i class="fa-solid fa-right-to-bracket"></i> Login to Review
                </a>
                <a href="/register" class="btn-lp-reg">
                  <i class="fa-solid fa-user-plus"></i> Create an Account
                </a>
              </div>
            </div>
          <?php endif; ?>

        </div><!-- /sticky-sidebar -->
      </div><!-- /right col -->

    </div><!-- /row -->
  </div><!-- /container -->
</main>

<!-- ================================================================ FOOTER (minimal) -->
<footer style="background:var(--bg2);border-top:1px solid var(--bdr);padding:1.5rem 0;margin-top:2rem">
  <div class="container-xl d-flex align-items-center justify-content-between flex-wrap gap-2">
    <a href="/" class="nav-logo" style="font-size:1rem">
      <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest" class="logo-img" style="width:30px;height:30px">
      <span>Quest<sup style="font-size:.4em;vertical-align:super;color:var(--accent)">+</sup></span>
    </a>
    <p style="font-size:.8rem;color:var(--txt4);margin:0">© 2025 Quest — All rights reserved.</p>
    <a href="/" style="font-size:.82rem;color:var(--txt3)">← Back to Home</a>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Theme toggle
  let dark = false;
  function toggleTheme() {
    dark = !dark;
    document.documentElement.setAttribute('data-bs-theme', dark ? 'dark' : 'light');
    document.getElementById('themeBtn').innerHTML = dark
      ? '<i class="fa-solid fa-sun"></i>'
      : '<i class="fa-solid fa-moon"></i>';
  }

  // Navbar scroll shadow
  window.addEventListener('scroll', () => {
    document.getElementById('nav').classList.toggle('scrolled', window.scrollY > 10);
  }, { passive: true });

  // Char counter
  const ta  = document.getElementById('reviewMsg');
  const cnt = document.getElementById('charCount');
  if (ta && cnt) ta.addEventListener('input', () => { cnt.textContent = ta.value.length; });

  // Scroll reveal
  const ro = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); ro.unobserve(e.target); } });
  }, { threshold: .1, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.reveal').forEach(el => ro.observe(el));

  // Animate bars on load
  window.addEventListener('load', () => {
    document.querySelectorAll('.bar-fill').forEach(b => {
      const w = b.style.width;
      b.style.width = '0';
      setTimeout(() => { b.style.width = w; }, 200);
    });
  });
</script>
</body>
</html>
