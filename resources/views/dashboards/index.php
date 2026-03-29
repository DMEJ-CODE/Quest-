<?php
/**
 * Dashboard Page
 * Modernized dashboard with responsive grid and card-based layout
 */
?>

<div class="page-header">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent), var(--accent-d)); color: white; font-size: 1.5rem;">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <h1 class="page-header-title mb-0"><?= (isset($isAdmin) && $isAdmin) ? 'Admin Dashboard' : 'My Dashboard' ?></h1>
                <p class="page-header-subtitle mb-0"><?= (isset($isAdmin) && $isAdmin) ? 'Community overview and analytics' : 'Your activity summary' ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="gallery-grid mb-5">
    <?php
    $stats = [
        [
            'label' => 'Total Questions',
            'value' => '2,420',
            'trend' => '+12%',
            'icon' => '❓',
            'type' => 'up'
        ],
        [
            'label' => 'New Answers',
            'value' => '450',
            'trend' => '+5%',
            'icon' => '💬',
            'type' => 'up'
        ],
        [
            'label' => 'Reports',
            'value' => '12',
            'trend' => '-2%',
            'icon' => '🚩',
            'type' => 'down'
        ],
        [
            'label' => 'Active Users',
            'value' => '1,892',
            'trend' => '+8%',
            'icon' => '👥',
            'type' => 'up'
        ]
    ];
    
    foreach ($stats as $stat): ?>
        <div class="card-base stat-card">
            <div class="stat-icon"><?= $stat['icon'] ?></div>
            <div class="stat-value"><?= $stat['value'] ?></div>
            <div class="stat-label"><?= $stat['label'] ?></div>
            <span class="stat-trend <?= $stat['type'] ?>">
                <i class="fas fa-arrow-<?= $stat['type'] === 'up' ? 'up' : 'down' ?>"></i>
                <?= $stat['trend'] ?>
            </span>
        </div>
    <?php endforeach; ?>
</div>

<!-- Content Row -->
<div class="row g-4">
    <!-- Activity Feed -->
    <div class="col-12 col-lg-8">
        <div class="card-base">
            <h3 class="font-bold mb-3" style="color: var(--txt); font-size: 1.15rem;">Recent Activity</h3>
            <div class="list-group-modern">
                <div class="list-item">
                    <div class="list-item-icon">📝</div>
                    <div class="list-item-content">
                        <div class="list-item-title">New question posted</div>
                        <div class="list-item-subtitle">"How to optimize Laravel queries?"</div>
                    </div>
                    <div class="list-item-action text-xs text-muted">2 hours ago</div>
                </div>
                <div class="list-item">
                    <div class="list-item-icon">💡</div>
                    <div class="list-item-content">
                        <div class="list-item-title">Answer accepted</div>
                        <div class="list-item-subtitle">Your answer received 5 upvotes</div>
                    </div>
                    <div class="list-item-action text-xs text-muted">4 hours ago</div>
                </div>
                <div class="list-item">
                    <div class="list-item-icon">⭐</div>
                    <div class="list-item-content">
                        <div class="list-item-title">Reputation gained</div>
                        <div class="list-item-subtitle">You earned 50 reputation points</div>
                    </div>
                    <div class="list-item-action text-xs text-muted">1 day ago</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Engagement Sidebar -->
    <div class="col-12 col-lg-4">
        <div class="card-base mb-4">
            <h5 class="font-bold mb-0" style="color: var(--txt); font-size: 1rem;">Engagement Metrics</h5>
            <div class="divider my-3"></div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-secondary text-sm">Total Views</span>
                <span class="font-bold" style="font-size: 1.35rem;">45.2k</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-secondary text-sm">Avg. Time on Page</span>
                <span class="font-bold" style="font-size: 1.15rem;">4m 30s</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-secondary text-sm">Bounce Rate</span>
                <span class="font-bold" style="font-size: 1.15rem;">32%</span>
            </div>
        </div>
        
        <div class="card-base">
            <h5 class="font-bold mb-3" style="color: var(--txt);">Quick Actions</h5>
            <div class="d-grid gap-2">
                <a href="/questions/create" class="btn btn-primary">
                    <i class="fas fa-pencil-alt me-1"></i> Ask Question
                </a>
                <a href="/profile" class="btn btn-secondary">
                    <i class="fas fa-user me-1"></i> View Profile
                </a>
            </div>
        </div>
    </div>
</div>