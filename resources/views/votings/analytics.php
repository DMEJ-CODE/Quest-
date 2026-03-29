<?php
// Simulation of data if not provided
$totalUsers = $totalUsers ?? 12840;
$totalQuestions = $totalQuestions ?? 4529;
$totalAnswers = $totalAnswers ?? 12480;
$growth = $growth ?? 15.4;
?>

<div class="row g-4 reveal">
    <!-- Main Stats Row -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:rgba(var(--accent-rgb), 0.05);color:var(--accent)">
                    <i class="fas fa-users"></i>
                </div>
                <div class="trend t-up"><i class="fas fa-caret-up me-1"></i> 12%</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;"><?= number_format($totalUsers) ?></h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Total Community Members</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#f0fdf4;color:#16a34a">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="trend t-up"><i class="fas fa-caret-up me-1"></i> 8.2%</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;"><?= number_format($totalQuestions) ?></h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Total Questions Asked</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width:42px;height:42px;background:#fffcf0;color:#ca8a04">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="trend t-up"><i class="fas fa-caret-up me-1"></i> 14%</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1" style="letter-spacing:-0.03em;"><?= number_format($totalAnswers) ?></h3>
                <span class="text-muted small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Accepted Answers</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-3">
        <div class="q-card p-4 shadow-sm border-0 d-flex flex-column justify-content-between h-100 transition-hover" style="background: linear-gradient(135deg, var(--g800), var(--g900));">
            <div class="d-flex justify-content-between align-items-center mb-3 text-white">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width:42px;height:42px;background:rgba(255,255,255,0.15);color:#fff">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="badge rounded-pill bg-white text-dark small px-3 py-1 fw-800">PREMIUM</div>
            </div>
            <div>
                <h3 class="fw-800 mb-1 text-white" style="letter-spacing:-0.03em;"><?= $growth ?>%</h3>
                <span class="text-white small fw-700 text-uppercase opacity-75" style="font-size:0.65rem;letter-spacing:0.05em">Platform Growth Rate</span>
            </div>
        </div>
    </div>

    <!-- Growth Chart -->
    <div class="col-12 col-lg-8">
        <div class="q-card p-4 shadow-sm h-100 border-0">
            <div class="d-flex justify-content-between align-items-start mb-5">
                <div>
                    <h5 class="fw-800 text-dark mb-1">Growth Overview</h5>
                    <p class="text-muted small mb-0">Monthly analysis of community interactions.</p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-700 border-2" data-bs-toggle="dropdown">Last 12 Months <i class="fas fa-chevron-down ms-1"></i></button>
                </div>
            </div>
            
            <div class="chart-container d-flex align-items-end gap-3" style="height: 250px;">
                <?php 
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                foreach ($months as $m): 
                    $h = rand(40, 200); // Simulated heights
                ?>
                <div class="flex-grow-1 d-flex flex-column align-items-center gap-2">
                    <div class="bar-s bl w-100 rounded-top active-hover-grow" style="height: <?= $h ?>px; transition: height 0.8s ease;" title="<?= $h * 10 ?> interactions"></div>
                    <span class="text-muted fw-800 text-uppercase" style="font-size:0.6rem"><?= $m ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Top Categories / Topics -->
    <div class="col-12 col-lg-4">
        <div class="q-card p-4 shadow-sm h-100 border-0">
            <h5 class="fw-800 text-dark mb-4">Top Categories</h5>
            <div class="d-flex flex-column gap-3">
                <?php 
                $cats = [
                    ['name' => 'Technology', 'val' => 45, 'color' => 'var(--accent)', 'icon' => 'fa-laptop-code'],
                    ['name' => 'Science', 'val' => 28, 'color' => '#3b82f6', 'icon' => 'fa-flask'],
                    ['name' => 'Education', 'val' => 15, 'color' => '#10b981', 'icon' => 'fa-graduation-cap'],
                    ['name' => 'Business', 'val' => 12, 'color' => '#f59e0b', 'icon' => 'fa-briefcase']
                ];
                foreach ($cats as $c): ?>
                <div class="p-3 border rounded-4 shadow-sm bg-white transition-hover">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm border" style="width:36px;height:36px;background:rgba(255,255,255,0.7);color:<?= $c['color'] ?>">
                                <i class="fas <?= $c['icon'] ?> small"></i>
                            </div>
                            <span class="fw-800 text-dark small"><?= $c['name'] ?></span>
                        </div>
                        <span class="fw-800 text-muted" style="font-size:0.75rem"><?= $c['val'] ?>%</span>
                    </div>
                    <div class="progress rounded-pill bg-light" style="height:6px">
                        <div class="progress-bar rounded-pill" style="width:<?= $c['val'] ?>%; background:<?= $c['color'] ?>"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <button class="btn btn-link w-100 mt-4 text-decoration-none fw-800 small text-accent">View All Categories <i class="fas fa-arrow-right ms-1"></i></button>
        </div>
    </div>
</div>

<style>
.fw-800 { font-weight: 800; }
.fw-700 { font-weight: 700; }
.transition-hover { transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.transition-hover:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.08) !important; border-color: var(--accent) !important; }
.active-hover-grow:hover { opacity: 1 !important; filter: brightness(1.1); }
</style>

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
