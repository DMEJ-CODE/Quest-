<!-- Topbar Component -->
<header class="topbar" id="topbar">
  <button class="ham" id="hamBtn" onclick="toggleNav()"><i class="fas fa-bars"></i></button>

  <div class="tb-meta">
    <span><i class="fas fa-calendar"></i></span>
    <span>Last Update, <strong><?php echo date('j M Y'); ?></strong></span>
    <span style="color:var(--accent);cursor:pointer;font-size:13px;display:flex;align-items:center"><i class="fas fa-sync"></i></span>
  </div>

  <div class="d-none d-lg-flex align-items-center flex-grow-1 mx-4">
    <form action="/search" method="GET" class="w-100 position-relative" style="max-width: 480px;">
      <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.9rem;"></i>
      <input type="text" name="q" class="form-control border-0 bg-light rounded-pill px-5 py-2 fw-bold" placeholder="Search questions, users, tags..." style="font-size: 0.88rem; box-shadow: none; transition: all 0.2s;">
    </form>
  </div>

  <div class="d-none d-lg-flex align-items-center gap-2 tb-pills ms-auto">

  <div class="tb-right">
    <button class="theme-btn" onclick="toggleTheme()" id="themeBtn" title="Toggle Theme">
      <i class="fas fa-moon"></i>
    </button>
    <div class="tb-icon" title="Notifications">
      <i class="fas fa-bell"></i>
    </div>
    <div class="tb-icon d-none d-sm-flex" title="Messages">
      <i class="fas fa-envelope"></i>
    </div>
    <button class="btn-share" title="Share">
      <i class="fas fa-share-alt"></i> Share
    </button>
    <div class="user-chip">
      <div class="user-av">TM</div>
      <div class="d-none d-md-block">
        <div class="user-name">Totok Michael</div>
        <div class="user-email">tmichael20@quest.com</div>
      </div>
    </div>
  </div>
</header>
