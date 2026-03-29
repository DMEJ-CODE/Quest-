<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-primary text-white">
            <i class="fas fa-stream"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0">Activity Feed</h1>
            <p class="page-header-subtitle mb-0">Live activity stream for your community contributions.</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="card-base p-4">
            <h5 class="fw-bold mb-3">Latest Actions</h5>
            <?php if(empty($activities)): ?>
                <div class="empty-state">
                    <div class="empty-state-icon">🕒</div>
                    <h5 class="empty-state-title">No activities yet</h5>
                    <p class="empty-state-text">This feed will show actions as they happen.</p>
                </div>
            <?php else: ?>
                <div class="list-group-modern">
                    <?php foreach($activities as $activity): ?>
                    <div class="list-item align-items-start">
                        <div class="list-item-icon bg-secondary text-white rounded-circle">
                            <i class="fas <?= htmlspecialchars($activity['icon'] ?? 'fa-bell') ?>"></i>
                        </div>
                        <div class="list-item-content">
                            <div class="list-item-title"><?= htmlspecialchars($activity['title']) ?></div>
                            <div class="list-item-subtitle"><?= htmlspecialchars($activity['subtitle']) ?></div>
                        </div>
                        <div class="text-secondary" style="font-size: 0.8rem;"><?= htmlspecialchars($activity['time'] ?? '') ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card-base p-4 mb-3">
            <h5 class="fw-bold mb-3">Activity Widgets</h5>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>Total actions</span>
                <strong><?= intval($metrics['actions'] ?? 0) ?></strong>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>Questions posted</span>
                <strong><?= intval($metrics['questions'] ?? 0) ?></strong>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span>Answers written</span>
                <strong><?= intval($metrics['answers'] ?? 0) ?></strong>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span>Reputation gained</span>
                <strong><?= intval($metrics['reputation'] ?? 0) ?></strong>
            </div>
        </div>

        <div class="card-base p-4">
            <h5 class="fw-bold mb-3">Quick Filters</h5>
            <div class="d-flex flex-column gap-2">
                <a href="/dashboards/activityfeed?filter=today" class="btn btn-outline-primary btn-sm">Today</a>
                <a href="/dashboards/activityfeed?filter=week" class="btn btn-outline-primary btn-sm">This Week</a>
                <a href="/dashboards/activityfeed?filter=month" class="btn btn-outline-primary btn-sm">This Month</a>
                <a href="/dashboards/activityfeed?filter=all" class="btn btn-outline-secondary btn-sm">All Time</a>
            </div>
        </div>
    </div>
</div>

<style>
.icon-circle { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
</style>
