<?php
$securityMode = $mode ?? 'overview';
// Modernized Security Index with Quest Style
?>

<div class="row g-4 reveal">
    <div class="col-12">
        <div class="d-flex gap-2 mb-3">
            <?php
            $tabs = [
                'overview' => 'Overview',
                'password' => 'Change Password',
                '2fa' => 'Two-Factor Auth',
                'history' => 'Login History',
                'sessions' => 'Sessions'
            ];
            foreach ($tabs as $key => $label):
                $active = $securityMode === $key ? 'btn-primary' : 'btn-outline-secondary';
                $url = '/dashboard/security' . ($key === 'overview' ? '' : '/' . $key);
            ?>
                <a href="<?= $url ?>" class="btn <?= $active ?> btn-sm"><?= $label ?></a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-12 col-lg-8">
        <div class="card-base p-4 p-md-5">
            <?php if ($securityMode === 'password'): ?>
                <h5 class="fw-bold mb-2 d-flex align-items-center gap-2">
                    <i class="fas fa-lock text-primary"></i> Change Password
                </h5>
                <p class="text-secondary small mb-4">Mettre à jour votre mot de passe pour renforcer la sécurité du compte.</p>
                <form action="/dashboard/security/password" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save New Password</button>
                </form>
            <?php elseif ($securityMode === '2fa'): ?>
                <h5 class="fw-bold mb-2 d-flex align-items-center gap-2">
                    <i class="fas fa-shield-alt text-primary"></i> Two-Factor Authentication
                </h5>
                <p class="text-secondary small mb-4">Enable or disable two-factor authentication for your account.</p>
                <div class="alert alert-info">
                    2FA is currently <strong><?= $is2FAEnabled ? 'enabled' : 'disabled' ?></strong>.
                </div>
                <form action="/dashboard/security/2fa" method="POST">
                    <?php if ($is2FAEnabled): ?>
                        <input type="hidden" name="action" value="disable">
                        <button type="submit" class="btn btn-outline-warning">Disable 2FA</button>
                    <?php else: ?>
                        <input type="hidden" name="action" value="enable">
                        <button type="submit" class="btn btn-primary">Enable 2FA</button>
                    <?php endif; ?>
                </form>

            <?php elseif ($securityMode === 'history'): ?>
                <h5 class="fw-bold mb-2 d-flex align-items-center gap-2">
                    <i class="fas fa-history text-primary"></i> Login History
                </h5>
                <p class="text-secondary small mb-4">View the latest logins to your account.</p>
                <div class="list-group-modern mb-4">
                    <?php if (!empty($loginHistory)): ?>
                        <?php foreach ($loginHistory as $entry): ?>
                            <div class="list-item">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light p-2 rounded-3 border">
                                        <i class="fas fa-globe text-muted"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($entry['browser_name'] ?? 'Unknown Browser') ?> - <?= htmlspecialchars($entry['device_type'] ?? 'Device') ?></div>
                                        <div class="text-secondary small"><?= htmlspecialchars($entry['location'] ?? 'Unknown Location') ?> — <?= date('Y-m-d H:i', strtotime($entry['login_time'])) ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-muted">No login history available.</div>
                    <?php endif; ?>
                </div>
            <?php elseif ($securityMode === 'sessions'): ?>
                <h5 class="fw-bold mb-2 d-flex align-items-center gap-2">
                    <i class="fas fa-laptop text-primary"></i> Active Sessions
                </h5>
                <p class="text-secondary small mb-4">Gérez vos sessions actives sur tous les appareils.</p>
                <div class="list-group-modern mb-4">
                    <?php if(!empty($items)): foreach($items as $item): ?>
                        <div class="list-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold"><?= htmlspecialchars($item['name']) ?></div>
                                <small class="text-secondary"><?= htmlspecialchars($item['title']) ?></small>
                            </div>
                            <button class="btn btn-sm btn-outline-danger">End Session</button>
                        </div>
                    <?php endforeach; else: ?>
                        <div class="text-muted">Aucune session active.</div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                    <i class="fas fa-key text-primary"></i> Login Credentials
                </h5>

                <div class="list-group-modern mb-5">
                    <div class="list-item">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light p-2 rounded-3 border">
                               <i class="fas fa-lock text-muted"></i>
                            </div>
                            <div>
                               <div class="fw-bold text-dark">Password</div>
                               <div class="text-secondary small">Last changed about 3 months ago</div>
                            </div>
                        </div>
                        <a href="/dashboard/security/password" class="btn btn-outline-primary btn-sm rounded-pill px-4">Update</a>
                    </div>
                    <div class="list-item">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light p-2 rounded-3 border">
                               <i class="fas fa-envelope text-muted"></i>
                            </div>
                            <div>
                               <div class="fw-bold text-dark">Primary Email</div>
                               <div class="text-secondary small">Your verified email for notifications</div>
                            </div>
                        </div>
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill border">VERIFIED</span>
                    </div>
                </div>
            <?php endif; ?>

            <h5 class="fw-bold mb-4 d-flex align-items-center gap-2 mt-2">
                <i class="fas fa-laptop text-primary"></i> Active Sessions
            </h5>
            
            <?php if(!empty($items)): ?>
                <div class="list-group-modern">
                    <?php foreach($items as $item): ?>
                        <div class="list-item">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-light p-2 rounded-3 border">
                                   <i class="fas fa-mobile-screen-button text-muted"></i>
                                </div>
                                <div>
                                   <div class="fw-bold text-dark"><?= htmlspecialchars($item['browser_name'] ?? 'Device Session') ?></div>
                                   <div class="text-muted smaller"><?= htmlspecialchars($item['device_type'] ?? 'Device') ?> · <?= htmlspecialchars($item['location'] ?? 'Unknown Location') ?></div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light text-secondary rounded-pill px-3 py-2 border" style="font-size:0.65rem">ACTIVE</span>
                                <button class="btn btn-icon text-danger hover-bg-danger-subtle rounded-circle"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state py-5">
                    <div class="empty-state-icon">🛡️</div>
                    <h5 class="empty-state-title">No session data</h5>
                    <p class="empty-state-text">Your security access logs will be populated here.</p>
                </div>
            <?php endif; ?>

            <div class="mt-5 pt-4 border-top">
               <a href="/dashboard" class="btn btn-light rounded-pill px-4 fw-bold">
                  <i class="fas fa-arrow-left me-2"></i> Dashboard
               </a>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="card-base p-4">
            <h6 class="fw-bold text-dark mb-4 small text-uppercase" style="letter-spacing: 0.1em;">Recommended Actions</h6>
            <div class="d-grid gap-3">
                <div class="p-3 rounded-4 bg-light border transition-all hover-elevate">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width:40px;height:40px;color:var(--accent)">
                            <i class="fas fa-shield-check"></i>
                        </div>
                        <div>
                            <div class="fw-bold small">Enable 2FA</div>
                            <div class="text-muted smaller">Add an extra layer of safety</div>
                        </div>
                    </div>
                </div>
                <div class="p-3 rounded-4 bg-light border transition-all hover-elevate">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center" style="width:40px;height:40px;color:#3b82f6">
                            <i class="fas fa-download"></i>
                        </div>
                        <div>
                            <div class="fw-bold small">Download Data</div>
                            <div class="text-muted smaller">Get your activity history</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-5 p-4 rounded-4 bg-light border border-dashed text-center">
                <h6 class="fw-bold small mb-2">Security Concern?</h6>
                <p class="text-secondary smaller mb-3">If you notice suspicious activity, report it immediately.</p>
                <button class="btn btn-outline-danger w-100 rounded-pill py-2 fw-bold small">Contact Safety Team</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal sequence
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach((el, i) => {
            setTimeout(() => el.classList.add('visible'), i * 80);
        });
    }, 50);
});
</script>
