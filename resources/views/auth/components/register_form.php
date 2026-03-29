    <!-- FORM SIDE -->
    <div class="auth-form-side">
        <div class="auth-header">
            <div class="register-icon-wrap">
                <i class="fas fa-user-plus text-success"></i>
            </div>
            <h1 class="auth-title">Create Account</h1>
            <p class="auth-sub">Join the Quest community and start sharing your knowledge today.</p>
        </div>

        <form method="POST" action="/register" id="registerForm" onsubmit="return validateRegister()">
            <!-- Step 1: Basic Info -->
            <div id="step1" class="register-step animate-fade-in">
                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <div class="position-relative">
                        <i class="fas fa-user position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.9rem;"></i>
                        <input class="form-input ps-5" type="text" name="name" id="name" placeholder="John Doe" required autocomplete="name">
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="position-relative">
                        <i class="fas fa-envelope position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.9rem;"></i>
                        <input class="form-input ps-5" type="email" name="email" id="email" placeholder="john@example.com" required autocomplete="email">
                    </div>
                </div>

                <button type="button" class="btn-submit mt-4" onclick="nextStep()">
                    Continue <i class="fas fa-arrow-right ms-2" style="font-size: 0.8rem;"></i>
                </button>
            </div>

            <!-- Step 2: Password & Terms -->
            <div id="step2" class="register-step animate-fade-in" style="display:none;">
                <div class="form-group">
                    <label class="form-label" for="password">Create Password</label>
                    <div class="position-relative">
                        <i class="fas fa-lock position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.9rem;"></i>
                        <input class="form-input ps-5" type="password" name="password" id="password" placeholder="••••••••••••" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                    <div class="position-relative">
                        <i class="fas fa-shield-alt position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary" style="font-size: 0.9rem;"></i>
                        <input class="form-input ps-5" type="password" name="confirm_password" id="confirm_password" placeholder="••••••••••••" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label" for="terms">
                        I accept the <a href="#" class="q-link">Terms of Service</a> and <a href="#" class="q-link">Privacy Policy</a>.
                    </label>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="button" class="btn-submit bg-light border text-dark shadow-none" onclick="prevStep()" style="background: var(--bg3) !important;">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                    <button type="submit" class="btn-submit flex-grow-1">
                        Complete Registration <i class="fas fa-check-circle ms-2"></i>
                    </button>
                </div>
            </div>
            
            <p class="auth-switch">Already a member? <a href="/login">Sign In</a></p>
        </form>

        <div class="auth-footer">
            <span class="auth-footer-text">© 2025 Quest — High Speed Knowledge</span>
            <div class="d-flex gap-3">
                <a class="auth-footer-text" href="#"><i class="fas fa-globe"></i> EN</a>
                <a class="auth-footer-text" href="#"><i class="fas fa-question-circle"></i> Help</a>
            </div>
        </div>
    </div>

    <!-- VISUAL SIDE (Desktop) -->
    <div class="auth-visual-side">
        <div class="auth-visual-bg"></div>
        <div class="auth-visual-overlay"></div>
        <div class="visual-content">
            <div class="visual-big-icon">🚀</div>
            <h3 class="visual-title">Ignite Your Curiosity</h3>
            <p class="visual-sub">Join thousands of minds collaborating to solve complex problems every single day.</p>
            
            <div class="security-badges w-100">
                <div class="security-badge hover-elevate">
                    <div class="security-badge-icon bg-success-subtle text-success rounded-circle p-2">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">Lightning Fast</div>
                        <span class="security-badge-text">Get answers in minutes, not hours.</span>
                    </div>
                </div>
                <div class="security-badge hover-elevate mt-2">
                    <div class="security-badge-icon bg-primary-subtle text-primary rounded-circle p-2">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">Expert Network</div>
                        <span class="security-badge-text">Verified thinkers from around the world.</span>
                    </div>
                </div>
                <div class="security-badge hover-elevate mt-2">
                    <div class="security-badge-icon bg-warning-subtle text-warning rounded-circle p-2">
                        <i class="fas fa-shield-halved"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">Safety First</div>
                        <span class="security-badge-text">Privacy and security focused architecture.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .hover-elevate {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-elevate:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px var(--sh2) !important;
        }
    </style>