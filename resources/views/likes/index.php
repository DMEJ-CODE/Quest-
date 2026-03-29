<?php
// Modernized Likes Index (Recommendations)
?>

<div class="row g-4 reveal">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:rgba(var(--accent-rgb), 0.05);color:var(--accent)">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="trend t-up"><i class="fas fa-caret-up me-1"></i> 14%</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">5.2k</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Total Likes Received</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#fef2f2;color:#ef4444">
                    <i class="fas fa-thumbs-up"></i>
                </div>
                <div class="trend t-up text-danger"><i class="fas fa-caret-up me-1"></i> 8%</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">124</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Upvoted Questions</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#fffcf0;color:#ca8a04">
                    <i class="fas fa-star"></i>
                </div>
                <div class="badge bg-soft-accent text-accent px-3 py-1 fw-800 rounded-pill" style="font-size:0.6rem">FAVORITE</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">45</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Starred Discussions</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover" style="background: linear-gradient(135deg, var(--g800), var(--g900));">
            <div class="d-flex justify-content-between align-items-center mb-3 text-white">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:42px;height:42px;background:rgba(255,255,255,0.15);color:#fff">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="badge bg-white shadow-sm text-dark px-3 py-1 fw-800 rounded-pill" style="font-size:0.6rem">OPTIMIZED</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1 text-white" style="letter-spacing:-0.03em;">High</h3>
                <span class="text-white small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Interaction Level</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <h5 class="fw-800 text-dark mb-5">Engagement Distribution</h5>
            <div class="chart-container d-flex align-items-end gap-3" style="height: 250px;">
                <?php 
                if (!empty($engagementData)):
                    $maxVal = max(array_column($engagementData, 'value'));
                    foreach ($engagementData as $item): 
                        $h = ($item['value'] / $maxVal) * 180; 
                ?>
                <div class="flex-grow-1 d-flex flex-column align-items-center gap-2">
                    <div class="bar-s bl w-100 rounded-top" style="height: <?= $h ?>px; transition: height 0.8s ease; background: var(--accent)" title="<?= $item['value'] ?> interactions"></div>
                    <span class="text-muted fw-800 text-uppercase" style="font-size:0.6rem"><?= $item['label'] ?></span>
                </div>
                <?php endforeach; else: ?>
                    <p class="text-secondary w-100 text-center py-5">No engagement data recorded.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">Recent Feed</h6>
            <div class="list-group-modern">
                <?php 
                $recent = $recentQuestions ?? [];
                if (empty($recent)):
                ?>
                    <div class="text-center py-4">
                        <p class="text-muted small">No recent activity.</p>
                    </div>
                <?php else: 
                    foreach (array_slice($recent, 0, 3) as $r):
                ?>
                <div class="list-item d-flex align-items-center gap-3">
                    <div class="user-av sm bg-primary" style="background: var(--accent) !important"><?= strtoupper(substr($r['author_name'] ?? 'U', 0, 1)) ?></div>
                    <div>
                        <div class="fw-800 text-dark small text-truncate" style="max-width: 180px;"><?= htmlspecialchars($r['title']) ?></div>
                        <div class="text-muted smaller"><?= date('M d', strtotime($r['created_at'])) ?></div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
            
            <a href="/dashboard/questions" class="btn btn-q w-100 mt-5 rounded-pill py-3 fw-800 shadow-sm">Explore Community</a>
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
