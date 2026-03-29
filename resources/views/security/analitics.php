<?php
// Modernized Security Analytics
?>

<div class="row g-4 reveal">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:rgba(var(--accent-rgb), 0.05);color:var(--accent)">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="trend t-up"><i class="fas fa-caret-up me-1"></i> 5%</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">1.2k</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Total Logins</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#fef2f2;color:#ef4444">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="trend t-down text-danger"><i class="fas fa-caret-down me-1"></i> 2.1%</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">23</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Blocked Attempts</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#fffcf0;color:#ca8a04">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="badge bg-soft-accent text-accent px-3 py-1 fw-800 rounded-pill" style="font-size:0.6rem">OPTIMIZED</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">98%</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Security Score</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover" style="background: linear-gradient(135deg, var(--g800), var(--g900));">
            <div class="d-flex justify-content-between align-items-center mb-3 text-white">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:42px;height:42px;background:rgba(255,255,255,0.15);color:#fff">
                    <i class="fas fa-shield-virus"></i>
                </div>
                <div class="badge bg-white shadow-sm text-dark px-3 py-1 fw-800 rounded-pill" style="font-size:0.6rem">SECURE</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1 text-white" style="letter-spacing:-0.03em;">Healthy</h3>
                <span class="text-white small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">System Integrity</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <h5 class="fw-800 text-dark mb-5">Login Activity Analysis</h5>
            <div class="chart-container d-flex align-items-end gap-3" style="height: 250px;">
                <?php 
                $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                foreach ($days as $d): 
                    $h = rand(40, 200); 
                ?>
                <div class="flex-grow-1 d-flex flex-column align-items-center gap-2">
                    <div class="bar-s bl w-100 rounded-top" style="height: <?= $h ?>px; transition: height 0.8s ease;" title="<?= $h ?> logins"></div>
                    <span class="text-muted fw-800 text-uppercase" style="font-size:0.6rem"><?= $d ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">Verification Breakdown</h6>
            <div class="d-flex flex-column gap-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="text-dark fw-800 small">Two-Factor Auth</span>
                    <span class="fw-800 text-accent">85%</span>
                </div>
                <div class="progress rounded-pill bg-light" style="height:8px">
                    <div class="progress-bar rounded-pill bg-accent" style="width:85%"></div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-1 mt-2">
                    <span class="text-dark fw-800 small">Email Verification</span>
                    <span class="fw-800 text-primary">95%</span>
                </div>
                <div class="progress rounded-pill bg-light" style="height:8px">
                    <div class="progress-bar rounded-pill bg-primary" style="width:95%"></div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-1 mt-2">
                    <span class="text-dark fw-800 small">Phone Linked</span>
                    <span class="fw-800 text-warning">45%</span>
                </div>
                <div class="progress rounded-pill bg-light" style="height:8px">
                    <div class="progress-bar rounded-pill bg-warning" style="width:45%"></div>
                </div>
            </div>
            
            <button class="btn btn-q w-100 mt-5 rounded-pill py-3 fw-800 shadow-sm">Improve Security Score</button>
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
