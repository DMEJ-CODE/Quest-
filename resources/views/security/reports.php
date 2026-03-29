<?php
// Modernized Security Reports
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                    <i class="fas fa-file-contract"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Security Reports</h4>
                   <p class="text-secondary small mb-0">Download and review detailed access and audit trails.</p>
                </div>
            </div>

            <div class="list-group-modern">
                <?php 
                $reports = [
                    ['title' => 'Monthly Audit Trail - February 2026', 'size' => '1.2 MB', 'date' => 'Mar 01, 2026'],
                    ['title' => 'Device Access History - Q1', 'size' => '840 KB', 'date' => 'Feb 15, 2026'],
                    ['title' => 'Failed Login Attempts Analysis', 'size' => '240 KB', 'date' => 'Jan 28, 2026']
                ];
                foreach ($reports as $r): 
                ?>
                    <div class="list-item d-flex align-items-center justify-content-between p-4 border rounded-4 mb-3 transition-hover shadow-sm bg-white">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-muted border shadow-sm" style="width:40px; height:40px">
                                <i class="far fa-file-pdf"></i>
                            </div>
                            <div>
                                <h6 class="fw-800 text-dark mb-0 small"><?= htmlspecialchars($r['title']) ?></h6>
                                <span class="smaller text-muted fw-700"><?= $r['date'] ?> • <?= $r['size'] ?></span>
                            </div>
                        </div>
                        <button class="btn btn-q-ol rounded-pill px-3 py-2 smaller fw-800 border-2">
                            <i class="fas fa-download me-1"></i> Export
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-5 p-4 rounded-4 bg-light border border-dashed text-center">
                <p class="text-muted smaller mb-3 fw-700">Need specific data range? Generate a custom report.</p>
                <button class="btn btn-q rounded-pill px-5 fw-800 py-3 shadow-sm">Generate Custom Audit</button>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">Compliance Status</h6>
            <div class="p-4 rounded-4 shadow-sm border mb-4 text-center bg-success-subtle border-success-subtle">
                <i class="fas fa-check-shield text-success mb-2" style="font-size:2rem"></i>
                <h6 class="fw-800 text-success mb-1">Standard Compliant</h6>
                <p class="text-success smaller mb-0 opacity-75">Your security meets the global platform standards.</p>
            </div>
            
            <div class="mt-2">
                <h6 class="fw-800 small text-uppercase mb-3 opacity-75">Scheduled Reports</h6>
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border mb-2">
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input" type="checkbox" checked>
                    </div>
                    <span class="fw-800 small text-dark">Weekly Digest</span>
                </div>
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border">
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input" type="checkbox" checked>
                    </div>
                    <span class="fw-800 small text-dark">Breach Alerts</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal sequences
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach((el, i) => {
            setTimeout(() => el.classList.add('visible'), i * 80);
        });
    }, 50);
});
</script>
