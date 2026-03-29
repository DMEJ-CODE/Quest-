<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-success text-white">
            <i class="fas fa-chart-pie"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0">Analytics</h1>
            <p class="page-header-subtitle mb-0">Actionable insights and trends from platform activity.</p>
        </div>
    </div>
</div>

<div class="gallery-grid mb-4">
    <div class="card-base p-4">
        <h6 class="mb-3">Question Trends</h6>
        <div style="min-height: 220px; display: flex; align-items: center; justify-content: center;">
            <small class="text-muted">Graph module (Chart.js placeholder)</small>
        </div>
    </div>
    <div class="card-base p-4">
        <h6 class="mb-3">Answer Engagement</h6>
        <div style="min-height: 220px; display: flex; align-items: center; justify-content: center;">
            <small class="text-muted">Graph module (Chart.js placeholder)</small>
        </div>
    </div>
    <div class="card-base p-4">
        <h6 class="mb-3">Active Users</h6>
        <div style="min-height: 220px; display: flex; align-items: center; justify-content: center;">
            <small class="text-muted">Graph module (Chart.js placeholder)</small>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-6">
        <div class="card-base p-4">
            <h6 class="mb-3">Top Tags by Activity</h6>
            <ul class="list-group-modern">
                <?php if(empty($topTags)): ?>
                    <li class="list-item">No tags found.</li>
                <?php else: foreach($topTags as $tag): ?>
                    <li class="list-item d-flex justify-content-between align-items-center">
                        <span>#<?= htmlspecialchars($tag['name']) ?></span>
                        <span class="badge bg-secondary text-white"><?= intval($tag['count']) ?></span>
                    </li>
                <?php endforeach; endif; ?>
            </ul>
        </div>
    </div>

    <div class="col-12 col-lg-6">
        <div class="card-base p-4">
            <h6 class="mb-3">System Metrics</h6>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span>CPU Load</span>
                <strong><?= htmlspecialchars($system['cpu'] ?? '23%') ?></strong>
            </div>
            <div class="progress mb-3" style="height: 8px;"><div class="progress-bar" style="width: <?= intval($system['cpu_percent'] ?? 23) ?>%;"></div></div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Memory Usage</span>
                <strong><?= htmlspecialchars($system['memory'] ?? '1.2GB/4GB') ?></strong>
            </div>
            <div class="progress mb-3" style="height: 8px;"><div class="progress-bar bg-info" style="width: <?= intval($system['memory_percent'] ?? 30) ?>%;"></div></div>
            <div class="d-flex justify-content-between align-items-center">
                <span>DB Queries / sec</span>
                <strong><?= htmlspecialchars($system['queries_per_sec'] ?? 48) ?></strong>
            </div>
        </div>
    </div>
</div>

<style>.icon-circle{width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.25rem;}</style>
