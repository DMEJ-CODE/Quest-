<?php
// Modernized Voting Reports
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                    <i class="fas fa-poll-h"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Voting Insights</h4>
                   <p class="text-secondary small mb-0">Discover community trends and detailed voting analysis.</p>
                </div>
            </div>

            <div class="list-group-modern">
                <?php 
                $reports = [
                    ['title' => 'Community Sentiment - Feb 2026', 'size' => '2.4 MB', 'date' => 'Mar 01, 2026'],
                    ['title' => 'Top Question Engagement Report', 'size' => '1.5 MB', 'date' => 'Feb 15, 2026'],
                    ['title' => 'Voter Demographics (Detailed)', 'size' => '3.1 MB', 'date' => 'Jan 28, 2026']
                ];
                foreach ($reports as $r): 
                ?>
                    <div class="list-item d-flex align-items-center justify-content-between p-4 border rounded-4 mb-3 transition-hover shadow-sm bg-white">
                        <div class="d-flex align-items-center gap-3">
                            <i class="far fa-file-excel text-success h4 mb-0"></i>
                            <div>
                                <h6 class="fw-800 text-dark mb-0 small"><?= htmlspecialchars($r['title']) ?></h6>
                                <span class="smaller text-muted fw-700"><?= $r['date'] ?> • <?= $r['size'] ?></span>
                            </div>
                        </div>
                        <button class="btn btn-q-ol rounded-pill px-3 py-2 smaller fw-800 border-2">
                            <i class="fas fa-file-download me-1"></i> CSV
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-5 text-center p-5 rounded-4 bg-light border-dashed">
                <i class="fas fa-rocket text-accent h1 mb-3 opacity-25"></i>
                <h5 class="fw-800 text-dark mb-2">Automated Reports</h5>
                <p class="text-secondary small mb-4">You can schedule these reports to be sent via email every Monday.</p>
                <button class="btn btn-accent rounded-pill px-5 fw-800 py-3 shadow-lg">Activate Automation</button>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">Platform Sentiment</h6>
            <div class="p-4 rounded-4 shadow-sm border mb-4 text-center bg-primary-subtle border-primary-subtle position-relative overflow-hidden">
                <i class="fas fa-smile text-primary mb-2 opacity-50" style="font-size:3.5rem; position:absolute; bottom:-10px; right:-10px"></i>
                <h6 class="fw-800 text-primary mb-1">Very Positive</h6>
                <p class="text-primary smaller mb-0 fw-bold">88% Engagement Rate</p>
            </div>
            
            <div class="mt-4">
                <h6 class="fw-800 small text-uppercase mb-3 opacity-75">Top Contributor Voted</h6>
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border mb-2">
                    <div class="user-av sm">AM</div>
                    <div>
                       <span class="fw-800 small text-dark d-block">Alex Michael</span>
                       <span class="text-muted smaller">12.4k upvotes</span>
                    </div>
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
