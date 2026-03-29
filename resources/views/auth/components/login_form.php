    <!-- FORM SIDE -->
    <div class="auth-form-side">
      <div class="auth-header">
        <div class="d-flex align-items-center gap-3">
              <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img" width="80">

          <div>
            <h1 class="auth-title mb-1">Welcome back</h1>
            <p class="auth-sub mb-0">Log in and continue your quest for knowledge</p>
          </div>
        </div>
      </div>

      <form method="POST" action="/login" class="d-flex flex-column gap-3 mt-4">
        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <input class="form-input" type="email" name="email" id="email" placeholder="you@example.com" required autocomplete="email">
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input class="form-input" type="password" name="password" id="password" placeholder="••••••••••••••••" required autocomplete="current-password">
        </div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <div class="form-check mb-0">
            <input class="form-check-input" type="checkbox" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Remember me</label>
          </div>
          <a href="/forgot" class="q-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn-submit rounded-pill">Log In →</button>

        <p class="auth-switch">Don't have an account? <a href="/register">Sign up</a></p>
      </form>

      <div class="auth-footer">
        <span class="auth-footer-text">© 2025 Quest</span>
        <a class="auth-footer-text" href="#">Terms & Conditions</a>
      </div>
    </div>

    <!-- VISUAL SIDE (Desktop) -->
    <div class="auth-visual-side">
      <div class="auth-visual-bg"></div>
      <div class="auth-visual-overlay"></div>
      <div class="visual-content">
        <div class="visual-big-icon">📚</div>
        <h3 class="visual-title">Join the knowledge quest</h3>
        <p class="visual-sub">Connect with experts, get answers, and expand your understanding.</p>
        <div class="security-badges">
          <div class="security-badge">
            <span class="security-badge-icon">👥</span>
            <span class="security-badge-text">Community driven</span>
          </div>
          <div class="security-badge">
            <span class="security-badge-icon">⭐</span>
            <span class="security-badge-text">Expert answers</span>
          </div>
          <div class="security-badge">
            <span class="security-badge-icon">🔒</span>
            <span class="security-badge-text">Secure & private</span>
          </div>
        </div>
      </div>
    </div>