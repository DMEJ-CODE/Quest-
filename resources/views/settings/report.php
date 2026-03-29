<?php
// Modernized Settings Report
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-10 mx-auto">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                    <i class="fas fa-file-medical"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Configuration Summary</h4>
                   <p class="text-secondary small mb-0">Review your current application configuration and profile settings.</p>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-12 col-md-6">
                    <div class="p-4 border rounded-4 bg-white shadow-sm h-100">
                        <h6 class="fw-800 small text-uppercase mb-3 opacity-50">Account Details</h6>
                        <ul class="list-group-modern">
                            <li class="list-item"><span class="fw-bold smaller text-muted">Tier:</span> <span class="fw-800 text-accent small">PRO</span></li>
                            <li class="list-item"><span class="fw-bold smaller text-muted">Joined:</span> <span class="fw-800 text-dark small">Jan 2026</span></li>
                            <li class="list-item"><span class="fw-bold smaller text-muted">Region:</span> <span class="fw-800 text-dark small">Europe</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="p-4 border rounded-4 bg-white shadow-sm h-100">
                        <h6 class="fw-800 small text-uppercase mb-3 opacity-50">Security Summary</h6>
                        <ul class="list-group-modern">
                            <li class="list-item"><span class="fw-bold smaller text-muted">2FA:</span> <span class="fw-800 text-success small">ENABLED</span></li>
                            <li class="list-item"><span class="fw-bold smaller text-muted">Auth Meth:</span> <span class="fw-800 text-dark small">OAuth Google</span></li>
                            <li class="list-item"><span class="fw-bold smaller text-muted">Login Limit:</span> <span class="fw-800 text-dark small">3 Active sessions</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mt-5 text-center p-5 rounded-4 bg-light shadow-sm border border-dashed">
                <i class="fas fa-file-download h1 text-accent mb-4 opacity-50"></i>
                <h5 class="fw-800 text-dark mb-2">Export Full Account Profile</h5>
                <p class="text-secondary small mb-4 px-5">Download a detailed PDF or JSON report containing all your preferences, profile data, and security history for compliance purposes.</p>
                <div class="d-flex gap-3 justify-content-center">
                   <button class="btn btn-q-ol rounded-pill px-5 fw-800 py-3 shadow-sm border-2">Download PDF (Report)</button>
                   <button class="btn btn-accent rounded-pill px-5 fw-800 py-3 shadow-lg border-0">Data Portability (JSON)</button>
                </div>
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
