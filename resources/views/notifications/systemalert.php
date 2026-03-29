<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-danger text-white"><i class="fas fa-exclamation-circle"></i></div>
        <div>
            <h1 class="page-header-title mb-0">System Alerts</h1>
            <p class="page-header-subtitle mb-0">Important messages from the platform.</p>
        </div>
    </div>
</div>

<div class="card-base p-4">
    <?php if(empty($alerts)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">🚨</div>
            <h5 class="empty-state-title">No alerts</h5>
            <p class="empty-state-text">No critical messages at this moment.</p>
        </div>
    <?php else: ?>
        <div class="list-group-modern">
            <?php foreach($alerts as $alert): ?>
            <div class="list-item align-items-start">
                <div class="list-item-icon bg-danger text-white rounded-circle"><i class="fas fa-bell"></i></div>
                <div class="list-item-content">
                    <div class="list-item-title"><?= htmlspecialchars($alert['subject']) ?></div>
                    <div class="list-item-subtitle"><?= htmlspecialchars($alert['description']) ?></div>
                </div>
                <div class="text-secondary" style="font-size:0.8rem;"><?= htmlspecialchars($alert['time']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
