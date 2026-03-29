<!-- Page Header -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="/dashboard/leaderboard" class="btn btn-icon btn-light rounded-circle border shadow-sm" style="width:42px; height:42px;"><i class="fas fa-arrow-left small"></i></a>
        <div>
            <h1 class="page-header-title mb-0">Community Activity Feed</h1>
            <p class="page-header-subtitle mb-0">Découvrez les dernières interactions et accomplissements de la communauté</p>
        </div>
    </div>
</div>

<!-- Navigation Tabs -->
<div class="d-flex gap-2 mb-4 flex-wrap">
    <a href="/dashboard/leaderboard/top" class="btn btn-outline-primary btn-sm px-4 rounded-pill">All Time</a>
    <a href="/dashboard/leaderboard/weekly" class="btn btn-outline-primary btn-sm px-4 rounded-pill">Weekly</a>
    <a href="/dashboard/leaderboard/monthly" class="btn btn-outline-primary btn-sm px-4 rounded-pill">Monthly</a>
    <div class="ms-md-auto d-flex gap-2 mt-2 mt-md-0">
        <a href="/dashboard/leaderboard/activity" class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm"><i class="fas fa-stream me-1"></i> Activity Active</a>
        <a href="/dashboard/leaderboard/analytics" class="btn btn-light btn-sm text-secondary fw-bold px-3 border"><i class="fas fa-chart-line me-1"></i> Analytics</a>
    </div>
</div>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="timeline-container ps-4 border-start border-light position-relative">
            <?php 
            $lbActivities = [
                ['user' => 'JD', 'name' => 'John Doe', 'action' => 'earned common badge', 'badge' => 'Fast Learner', 'time' => '10 min ago'],
                ['user' => 'AM', 'name' => 'Alice Mayer', 'action' => 'reached level 20', 'badge' => 'Expert', 'time' => '1 hr ago'],
                ['user' => 'RK', 'name' => 'Rick King', 'action' => 'won weekly challenge', 'badge' => 'Champion', 'time' => '3 hrs ago']
            ];
            foreach ($lbActivities as $act): 
            ?>
            <div class="timeline-item mb-5 position-relative">
                <div class="timeline-dot position-absolute d-flex align-items-center justify-content-center" 
                     style="left: -38px; top: 0; width: 32px; height: 32px; z-index: 10;">
                    <div class="bg-white border rounded-circle shadow-sm p-1 d-flex align-items-center justify-content-center" style="width:100%; height:100%;">
                        <div class="rounded-circle bg-accent" style="width: 8px; height: 8px; box-shadow: 0 0 8px var(--accent)"></div>
                    </div>
                </div>
                
                <div class="q-card p-4 border-0 shadow-sm rounded-4 bg-white reveal transition-hover">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-av sm bg-primary shadow-sm text-white fw-800" style="width:36px; height:36px; font-size:0.7rem;">
                                <?= $act['user'] ?>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-800 text-dark small"><?= htmlspecialchars($act['name']) ?></span>
                                    <i class="fas fa-check-circle text-primary smaller"></i>
                                </div>
                                <span class="text-muted smaller fw-700 opacity-75">
                                    <i class="far fa-clock me-1"></i> <?= $act['time'] ?>
                                </span>
                            </div>
                        </div>
                        <span class="badge bg-soft-accent text-accent fw-800 rounded-pill px-3 py-1" style="font-size:0.6rem">
                           LEVEL UP
                        </span>
                    </div>
                    
                    <h6 class="fw-800 text-dark mb-3 px-1" style="line-height: 1.5; font-size: 0.95rem;">
                        Successfully <?= htmlspecialchars($act['action']) ?>: <span class="text-accent"><?= htmlspecialchars($act['badge']) ?></span>
                    </h6>
                    
                    <div class="mt-3 pt-3 border-top border-light d-flex justify-content-between align-items-center">
                        <div class="progress rounded-pill bg-light" style="height:6px; width:120px">
                            <div class="progress-bar rounded-pill bg-accent" style="width:<?= rand(30, 95) ?>%"></div>
                        </div>
                        <a href="/profile/<?= strtolower($act['user']) ?>" class="btn-xs rounded-pill px-3 py-2 fw-800 text-decoration-none bg-light border">
                            Profile <i class="fas fa-external-link-alt ms-1 text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
