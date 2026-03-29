<!-- Filter Buttons -->
<div class="d-flex gap-2 mb-4 flex-wrap">
    <a href="/dashboard/leaderboard/top" class="btn <?= ($mode === 'top' || empty($mode)) ? 'btn-primary' : 'btn-outline-primary' ?> btn-sm px-4 rounded-pill">All Time</a>
    <a href="/dashboard/leaderboard/weekly" class="btn <?= ($mode === 'weekly') ? 'btn-primary' : 'btn-outline-primary' ?> btn-sm px-4 rounded-pill">Weekly</a>
    <a href="/dashboard/leaderboard/monthly" class="btn <?= ($mode === 'monthly') ? 'btn-primary' : 'btn-outline-primary' ?> btn-sm px-4 rounded-pill">Monthly</a>
    <div class="ms-md-auto d-flex gap-2 mt-2 mt-md-0">
        <a href="/dashboard/leaderboard/activity" class="btn btn-light btn-sm text-secondary fw-bold px-3 border"><i class="fas fa-stream me-1"></i> Activity</a>
        <a href="/dashboard/leaderboard/analytics" class="btn btn-light btn-sm text-secondary fw-bold px-3 border"><i class="fas fa-chart-line me-1"></i> Analytics</a>
    </div>
</div>

<!-- Leaderboard List -->
<div class="list-group-modern">
    <?php 
    if (empty($topUsers)):
    ?>
        <div class="empty-state py-5">
            <div class="empty-state-icon">🏆</div>
            <h5 class="empty-state-title">No rankings yet</h5>
            <p class="empty-state-text">Start contributing to the community to see your name here!</p>
        </div>
    <?php 
    else:
        $rank = 1;
        foreach($topUsers as $user): 
            $initials = strtoupper(substr($user['name'] ?? 'U', 0, 1));
    ?>
    <div class="list-item p-4 mb-3 reveal shadow-sm transition-hover">
        <div class="d-flex align-items-center gap-4 w-100">
            <!-- Rank Badge -->
            <div class="d-flex align-items-center justify-content-center" style="min-width: 50px;">
                <div class="badge rounded-circle d-flex align-items-center justify-content-center fw-bolder shadow-sm" 
                     style="width: 50px; height: 50px; font-size: 1.25rem;
                             background: <?= $rank == 1 ? '#fbbf24' : ($rank == 2 ? '#94a3b8' : ($rank == 3 ? '#b45309' : '#f8fafc')) ?>;
                             color: <?= $rank <= 3 ? '#fff' : 'var(--g700)' ?>;
                             border: <?= $rank > 3 ? '1px solid var(--bdr)' : 'none' ?>;">
                    <?= $rank++ ?>
                </div>
            </div>

            <!-- User Info -->
            <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="user-av sm bg-light text-dark fw-bold border me-2" style="width:36px; height:36px; font-size: 0.8rem;"><?= $initials ?></div>
                    <h6 class="mb-0 fw-800 text-dark" style="font-size: 1.05rem;"><?= htmlspecialchars($user['name'] ?? 'Unknown User') ?></h6>
                    <?php if($rank <= 4): ?>
                        <span class="badge bg-soft-accent text-accent fw-800 rounded-pill px-2 py-1" style="font-size:0.55rem; letter-spacing:0.05em">MASTER CONTRIBUTOR</span>
                    <?php endif; ?>
                </div>
                <div class="d-flex gap-4 flex-wrap" style="font-size: 0.85rem;">
                    <span class="text-secondary fw-700">
                        <i class="fas fa-medal me-1 text-warning opacity-75"></i>
                        <strong><?= number_format($user['reputation'] ?? 0) ?></strong> <span class="opacity-50 text-uppercase small" style="font-size:0.65rem">reputation</span>
                    </span>
                    <span class="text-secondary fw-700">
                        <i class="fas fa-comment-dots me-1 text-primary opacity-75"></i>
                        <strong><?= $user['a_count'] ?? 0 ?></strong> <span class="opacity-50 text-uppercase small" style="font-size:0.65rem">answers</span>
                    </span>
                    <span class="text-secondary fw-700">
                        <i class="fas fa-question-circle me-1 text-secondary opacity-75"></i>
                        <strong><?= $user['q_count'] ?? 0 ?></strong> <span class="opacity-50 text-uppercase small" style="font-size:0.65rem">questions</span>
                    </span>
                </div>
            </div>

            <!-- Action Button -->
            <div class="d-none d-md-block">
                <a href="/profiles/<?= intval($user['id'] ?? 0) ?>" class="btn btn-q-ol rounded-pill px-4 btn-sm fw-800">
                    <i class="fas fa-user-circle me-1 opacity-50"></i> Profile
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; endif; ?>
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