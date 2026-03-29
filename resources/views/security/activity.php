<?php
// Modernized Security Activity Feed
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(239, 68, 68, 0.05); color:#ef4444">
                    <i class="fas fa-history"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Security Events</h4>
                   <p class="text-secondary small mb-0">Track all sensitive actions performed on your account.</p>
                </div>
            </div>

            <div class="list-group-modern">
                <!-- Simulation of activities -->
                <?php 
                $activities = $activities ?? [
                    ['title' => 'Password reset', 'meta' => '2 hrs ago', 'type' => 'critical'],
                    ['title' => 'Login from new device', 'meta' => 'Feb 12, 10:45 AM', 'type' => 'warning'],
                    ['title' => 'Account email updated', 'meta' => 'Jan 30, 09:15 AM', 'type' => 'info']
                ];
                foreach ($activities as $act): 
                    $color = ($act['type'] === 'critical') ? 'danger' : (($act['type'] === 'warning') ? 'warning' : 'primary');
                ?>
                    <div class="list-item d-flex align-items-start gap-4 p-4 border rounded-4 mb-3 transition-hover shadow-sm bg-white">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-<?= $color ?> text-white" style="width:36px; height:36px; flex-shrink:0">
                            <i class="fas <?= $act['type'] === 'critical' ? 'fa-exclamation' : 'fa-bell' ?> small"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-800 text-dark mb-0"><?= htmlspecialchars($act['title']) ?></h6>
                                <span class="smaller text-muted fw-700"><?= htmlspecialchars($act['meta']) ?></span>
                            </div>
                            <p class="text-secondary smaller mb-0">Successfully completed from Browser (Chrome/Mac) • 192.168.1.1</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-5 text-center">
                <button class="btn btn-q-ol rounded-pill px-5 fw-800">Clear Logs History</button>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">Access History</h6>
            <div class="d-flex flex-column gap-3 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="text-muted fw-800 smaller">This Month</span>
                    <span class="badge bg-soft-accent text-accent fw-800 rounded-pill">12 Successful Logs</span>
                </div>
                <div class="progress rounded-pill bg-light" style="height:6px">
                    <div class="progress-bar rounded-pill bg-accent" style="width:85%"></div>
                </div>
            </div>

            <h6 class="fw-800 small text-uppercase mb-3 opacity-75">Recent Devices</h6>
            <div class="list-group-modern">
                <div class="list-item d-flex align-items-center gap-3">
                    <div class="bg-light p-2 rounded-3 border">
                       <i class="fas fa-mobile-alt text-muted"></i>
                    </div>
                    <div>
                       <div class="fw-bold text-dark small">iPhone 13</div>
                       <div class="text-muted smaller">iOS 17.2 • Paris, FR</div>
                    </div>
                </div>
                <div class="list-item d-flex align-items-center gap-3">
                    <div class="bg-light p-2 rounded-3 border">
                       <i class="fas fa-desktop text-muted"></i>
                    </div>
                    <div>
                       <div class="fw-bold text-dark small">MacBook Pro M2</div>
                       <div class="text-muted smaller">macOS 14.3 • Lagos, NG</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal magic
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach((el, i) => {
            setTimeout(() => el.classList.add('visible'), i * 80);
        });
    }, 50);
});
</script>
