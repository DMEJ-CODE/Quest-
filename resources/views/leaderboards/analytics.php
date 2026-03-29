<!-- Page Header -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="/dashboard/leaderboard" class="btn btn-icon btn-light rounded-circle border shadow-sm" style="width:42px; height:42px;"><i class="fas fa-arrow-left small"></i></a>
        <div>
            <h1 class="page-header-title mb-0">Leaderboard Analytics</h1>
            <p class="page-header-subtitle mb-0">Visualisez les tendances et performances de la communauté</p>
        </div>
    </div>
</div>

<!-- Navigation Tabs -->
<div class="d-flex gap-2 mb-4 flex-wrap">
    <a href="/dashboard/leaderboard/top" class="btn btn-outline-primary btn-sm px-4 rounded-pill">All Time</a>
    <a href="/dashboard/leaderboard/weekly" class="btn btn-outline-primary btn-sm px-4 rounded-pill">Weekly</a>
    <a href="/dashboard/leaderboard/monthly" class="btn btn-outline-primary btn-sm px-4 rounded-pill">Monthly</a>
    <div class="ms-md-auto d-flex gap-2 mt-2 mt-md-0">
        <a href="/dashboard/leaderboard/activity" class="btn btn-light btn-sm text-secondary fw-bold px-3 border"><i class="fas fa-stream me-1"></i> Activity</a>
        <a href="/dashboard/leaderboard/analytics" class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm"><i class="fas fa-chart-line me-1"></i> Analytics Active</a>
    </div>
</div>

<div class="row g-4 reveal">
    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:rgba(var(--accent-rgb), 0.05);color:var(--accent)">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="trend t-up"><i class="fas fa-caret-up me-1"></i> TOP 1%</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">#12</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Global Rank</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#f0629215;color:#f06292">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="trend t-up text-pink"><i class="fas fa-star me-1 small"></i> MVP</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">8,420</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Total Reputation</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#fffcf0;color:#ca8a04">
                    <i class="fas fa-medal"></i>
                </div>
                <div class="badge bg-soft-accent text-accent px-3 py-1 fw-800 rounded-pill" style="font-size:0.6rem">ELITE</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;">Expert</h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Contribution Tier</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover" style="background: linear-gradient(135deg, var(--g800), var(--g900));">
            <div class="d-flex justify-content-between align-items-center mb-3 text-white">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:42px;height:42px;background:rgba(255,255,255,0.15);color:#fff">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="badge bg-white shadow-sm text-dark px-3 py-1 fw-800 rounded-pill" style="font-size:0.6rem">LEGENDARY</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1 text-white" style="letter-spacing:-0.03em;">Gold</h3>
                <span class="text-white small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Highest Badge Earned</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <h5 class="fw-800 text-dark mb-5">Reputation History</h5>
            <div class="chart-container d-flex align-items-end gap-3" style="height: 250px;">
                <?php 
                $weeks = ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8'];
                foreach ($weeks as $w): 
                    $h = rand(30, 180); 
                ?>
                <div class="flex-grow-1 d-flex flex-column align-items-center gap-2">
                    <div class="bar-s bl w-100 rounded-top" style="height: <?= $h ?>px; transition: height 0.8s ease;" title="<?= $h ?> points earned"></div>
                    <span class="text-muted fw-800 text-uppercase" style="font-size:0.6rem"><?= $w ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">TOP TIER BADGES</h6>
            <div class="d-flex flex-column gap-3">
                <div class="badge-item d-flex align-items-center gap-3 p-3 bg-light rounded-4 border">
                    <div class="badge-icon rounded-circle bg-warning text-white d-flex align-items-center justify-content-center" style="width:32px; height:32px">
                       <i class="fas fa-bolt small"></i>
                    </div>
                    <div>
                       <span class="fw-800 text-dark small d-block">Quick Thinker</span>
                       <span class="text-muted smaller">Answered in 10min</span>
                    </div>
                </div>
                <div class="badge-item d-flex align-items-center gap-3 p-3 bg-light rounded-4 border">
                    <div class="badge-icon rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:32px; height:32px">
                       <i class="fas fa-star small"></i>
                    </div>
                    <div>
                       <span class="fw-800 text-dark small d-block">Community Hero</span>
                       <span class="text-muted smaller">50+ accepted answers</span>
                    </div>
                </div>
                <div class="badge-item d-flex align-items-center gap-3 p-3 bg-light rounded-4 border">
                    <div class="badge-icon rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width:32px; height:32px">
                       <i class="fas fa-heart small"></i>
                    </div>
                    <div>
                       <span class="fw-800 text-dark small d-block">Voter Champ</span>
                       <span class="text-muted smaller">Voted on 1k+ posts</span>
                    </div>
                </div>
            </div>
            
            <button class="btn btn-q w-100 mt-5 rounded-pill py-3 fw-800 shadow-sm">View All Medals</button>
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
