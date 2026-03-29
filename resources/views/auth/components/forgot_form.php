    <!-- FORM SIDE -->
    <div class="auth-form-side">
      
      <!-- Default (Input) State -->
      <div id="formState">
        <div class="auth-header">
          <div class="d-flex align-items-center gap-3">
           <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest Logo" class="logo-img" width="80">
  <div>
              <h1 class="auth-title mb-1">Forgot password?</h1>
              <p class="auth-sub mb-0">No worries — enter your email and we'll send you reset instructions right away.</p>
            </div>
          </div>
        </div>
        
        <form method="POST" action="/forgot" class="d-flex flex-column gap-2 mt-4">
          <div class="form-group">
            <label class="form-label" for="emailInput">Email address</label>
            <input class="form-input" type="email" id="emailInput" name="email" placeholder="you@example.com" required autocomplete="email">
          </div>
          <button class="btn-submit rounded-pill mt-4" type="submit">Send Reset Link</button>
        </form>

        <p class="auth-switch mt-3">
          <a href="/login">← Back to login</a>
        </p>

        <div class="auth-footer mt-5">
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