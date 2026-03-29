<?php
// Modernized Settings Analytics
?>

<div class="row g-4 reveal">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:rgba(var(--accent-rgb), 0.05);color:var(--accent)">
                   <i class="fas fa-chart-line"></i>
                </div>
                <div class="trend t-up text-accent fw-800 smaller">HEALTHY</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">Active</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Account Performance</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#f0fdf4;color:#16a34a">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="badge bg-soft-accent text-accent px-3 py-1 fw-800 rounded-pill" style="font-size:0.6rem">FULL</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">Gold</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Verification Tier</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#fee2e2;color:#ef4444">
                    <i class="fas fa-user-clock"></i>
                </div>
                <div class="text-danger fw-800 smaller">12 LOGS</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">Feb 28</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Last Security Review</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover" style="background: linear-gradient(135deg, var(--g800), var(--g900)); color:#fff">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:rgba(255,255,255,0.15);color:#fff">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="badge bg-white shadow-sm text-dark px-3 py-1 fw-800 rounded-pill" style="font-size:0.6rem">PREMIUM</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">Pro</h3>
                <span class="text-white small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Subscription Level</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <h5 class="fw-800 text-dark mb-4">Preference Trends</h5>
            <div class="chart-container d-flex align-items-end gap-3" style="height: 250px;">
                <?php 
                for ($i=1; $i<=10; $i++): 
                    $h = rand(40, 200); 
                ?>
                <div class="flex-grow-1 d-flex flex-column align-items-center gap-2">
                    <div class="bar-s bl w-100 rounded-top" style="height: <?= $h ?>px; transition: height 0.8s ease;" title="<?= $h ?> changes"></div>
                </div>
                <?php endfor; ?>
            </div>
            <div class="divider mb-4 mt-5"></div>
            <p class="text-muted smaller fw-800 opacity-50 text-center">Your account preferences are optimized based on your activity patterns.</p>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">Settings Health</h6>
            <div class="d-flex flex-column gap-5">
                <div>
                   <div class="d-flex justify-content-between align-items-center mb-1">
                      <span class="text-dark fw-800 small">Data Privacy</span>
                      <span class="fw-800 text-accent">100%</span>
                   </div>
                   <div class="progress rounded-pill bg-light" style="height:8px">
                      <div class="progress-bar rounded-pill bg-accent" style="width:100%"></div>
                   </div>
                </div>
                <div>
                   <div class="d-flex justify-content-between align-items-center mb-1">
                      <span class="text-dark fw-800 small">Notification Config</span>
                      <span class="fw-800 text-primary">75%</span>
                   </div>
                   <div class="progress rounded-pill bg-light" style="height:8px">
                      <div class="progress-bar rounded-pill bg-primary" style="width:75%"></div>
                   </div>
                </div>
                <div>
                   <div class="d-flex justify-content-between align-items-center mb-1">
                      <span class="text-dark fw-800 small">Account Security</span>
                      <span class="fw-800 text-warning">90%</span>
                   </div>
                   <div class="progress rounded-pill bg-light" style="height:8px">
                      <div class="progress-bar rounded-pill bg-warning" style="width:90%"></div>
                   </div>
                </div>
            </div>
            
            <button class="btn btn-q w-100 mt-5 rounded-pill py-3 fw-800 shadow-sm">Recalibrate Settings</button>
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
