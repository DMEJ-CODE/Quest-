<?php
$userName = $user['name'] ?? 'User';
$userEmail = $user['email'] ?? '';
$initials = strtoupper(substr($userName, 0, 2));
if (strpos($userName, ' ') !== false) {
    $parts = explode(' ', $userName);
    $initials = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
}
?>

<div class="row g-4 reveal">
    <!-- Profile Card Sidebar -->
    <div class="col-12 col-lg-3">
        <div class="card-base text-center">
            <div class="avatar-lg mx-auto mb-3" style="background: linear-gradient(135deg, var(--accent), var(--accent-d));">
                <?= htmlspecialchars($initials) ?>
            </div>
            <h5 class="fw-800 mb-1" style="color: var(--txt);"><?= htmlspecialchars($userName) ?></h5>
            <p class="text-secondary small mb-3">@<?= htmlspecialchars($user['username'] ?? 'username') ?></p>
            
            <div class="d-flex justify-content-center gap-2 mb-3">
                <span class="badge rounded-pill fw-700 px-3 py-2 <?= ($user['role'] ?? 'user') === 'admin' ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' ?>" style="font-size: 0.65rem;">
                    <i class="fas fa-shield-alt me-1"></i>
                    <?= ($user['role'] ?? 'user') === 'admin' ? 'ADMINISTRATOR' : 'MEMBER' ?>
                </span>
            </div>
            
            <div class="divider"></div>
            
            <div class="text-start">
                <div class="mb-3">
                    <span class="text-xs text-muted text-uppercase fw-800 opacity-75" style="font-size: 0.62rem; letter-spacing: 0.05em;">Community Reputation</span>
                    <div class="fw-800" style="font-size: 1.5rem; color: var(--accent); letter-spacing: -0.02em;">
                        <?= number_format($reputation ?? 0) ?>
                    </div>
                </div>
                <div>
                    <span class="text-xs text-muted text-uppercase fw-800 opacity-75" style="font-size: 0.62rem; letter-spacing: 0.05em;">Total Contributions</span>
                    <div class="fw-800" style="font-size: 1.5rem; color: var(--txt); letter-spacing: -0.02em;">
                        <?= count($questions ?? []) ?>
                    </div>
                </div>
            </div>

            <div class="divider"></div>
            <button class="btn btn-outline-secondary w-100 rounded-pill btn-sm fw-700 py-2 border-2">
                <i class="fas fa-cloud-upload-alt me-2"></i> Update Avatar
            </button>

            <div class="mt-3 d-grid gap-2">
                <a href="/dashboard/profile" class="btn btn-sm btn-outline-primary">Vue Profil</a>
                <a href="/dashboard/profile/badges" class="btn btn-sm btn-outline-success">Badges</a>
                <a href="/dashboard/profile/myactivity" class="btn btn-sm btn-outline-warning">Mon activité</a>
                <a href="/dashboard/profile/reputation" class="btn btn-sm btn-outline-danger">Réputation</a>
            </div>
        </div>
        
        <div class="mt-4 p-4 rounded-4 bg-light shadow-sm border" style="border-style: dashed !important;"
            <h6 class="fw-800 small text-uppercase mb-3 opacity-75">Account Verification</h6>
            <div class="d-flex align-items-center gap-3">
                <div class="badge rounded-circle bg-success d-flex align-items-center justify-content-center" style="width:32px;height:32px;font-size:0.8rem">
                    <i class="fas fa-check"></i>
                </div>
                <div>
                    <div class="small fw-800 text-dark">Email Verified</div>
                    <div class="text-muted" style="font-size:0.65rem">Verified on Jan 2026</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Forms -->
    <div class="col-12 col-lg-9">
        <!-- Personal Info Section -->
        <div class="form-wrapper mb-4 reveal shadow-sm" style="transition-delay: 0.1s;">
            <div class="form-section-title mb-4">
                <div class="form-section-number">1</div>
                <div>
                    <h3 class="fw-800">Personal Information</h3>
                    <p class="text-muted small mb-0">Update your account details and public bio.</p>
                </div>
            </div>
            
            <form action="/profile/update" method="POST">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="fullname">Full Name</label>
                            <input type="text" name="name" id="fullname" class="form-control" value="<?= htmlspecialchars($userName) ?>" placeholder="Enter your full name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="username">Username</label>
                            <div class="input-group rounded-4 overflow-hidden">
                                <span class="input-group-text border-0 bg-light pe-2 ps-3 text-muted">@</span>
                                <input type="text" name="username" id="username" class="form-control border-0" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control bg-light opacity-75" value="<?= htmlspecialchars($userEmail) ?>" readonly>
                            <span class="form-text mt-2"><i class="fas fa-info-circle me-1 opacity-75"></i> Email can only be changed via security settings.</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="bio">Short Bio</label>
                            <textarea name="bio" id="bio" class="form-control" placeholder="Tell us about yourself..." rows="4"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                            <div class="d-flex justify-content-between mt-2">
                                <span class="form-text">Briefly describe yourself for your public profile.</span>
                                <span class="form-text fw-bold">0 / 500</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions border-0 pt-0 mt-2">
                    <button type="reset" class="btn btn-q-ol rounded-pill px-4">Discard Changes</button>
                    <button type="submit" class="btn btn-q rounded-pill px-5 ms-auto shadow-lg">
                        <i class="fas fa-save me-2"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Security Section -->
        <div class="form-wrapper reveal shadow-sm" style="transition-delay: 0.2s;">
            <div class="form-section-title mb-4">
                <div class="form-section-number bg-danger-subtle text-danger border-danger">2</div>
                <div>
                    <h3 class="fw-800 text-dark">Security & Password</h3>
                    <p class="text-muted small mb-0">Protect your account with a strong password.</p>
                </div>
                <div class="ms-auto">
                    <span class="badge rounded-pill bg-light border text-muted px-3 py-2 fw-700" style="font-size:0.6rem">Last changed: 3 months ago</span>
                </div>
            </div>
            
            <form action="/profile/update" method="POST">
                <input type="hidden" name="update_password" value="1">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="form-group mb-4">
                            <label class="form-label" for="current_pass">Current Password</label>
                            <div class="position-relative">
                                <input type="password" name="current_password" id="current_pass" class="form-control pe-5" placeholder="••••••••" required>
                                <i class="fas fa-eye text-muted position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="new_pass">New Password</label>
                            <input type="password" name="new_password" id="new_pass" class="form-control" placeholder="Create a strong password" required>
                            <div class="pw-strength-meter mt-2 d-flex gap-1">
                                <div class="flex-grow-1 rounded-pill bg-light border" style="height:4px"></div>
                                <div class="flex-grow-1 rounded-pill bg-light border" style="height:4px"></div>
                                <div class="flex-grow-1 rounded-pill bg-light border" style="height:4px"></div>
                                <div class="flex-grow-1 rounded-pill bg-light border" style="height:4px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="confirm_pass">Confirm New Password</label>
                            <input type="password" name="confirm_password" id="confirm_pass" class="form-control" placeholder="Repeat password" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions border-0 pt-0 mt-3">
                    <div class="form-check form-switch col-auto align-self-center">
                        <input class="form-check-input" type="checkbox" id="twoFactor">
                        <label class="form-check-label small fw-700 ms-2" for="twoFactor">Enable 2FA</label>
                    </div>
                    <button type="submit" class="btn btn-q rounded-pill px-5 ms-auto" style="background: linear-gradient(135deg, #ef4444, #b91c1c);">
                        <i class="fas fa-key me-2"></i> Update Security
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.bg-danger-subtle { background: rgba(239,68,68,0.08); }
.bg-success-subtle { background: rgba(34,197,94,0.08); }
.fw-800 { font-weight: 800; }
.fw-700 { font-weight: 700; }
.text-xs { font-size: 0.75rem; }
.cursor-pointer { cursor: pointer; }
.bg-light-accent { background: rgba(var(--accent-rgb), 0.05); }

/* Input groups for "Quest" style */
.input-group-text {
    border-radius: 12px 0 0 12px !important;
}
.input-group .form-control {
    border-radius: 0 12px 12px 0 !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal magic
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach((el, i) => {
            setTimeout(() => el.classList.add('visible'), i * 80);
        });
    }, 100);
});
</script>
