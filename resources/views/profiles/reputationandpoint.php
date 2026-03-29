<div class="gallery-grid-3 mb-5">
    <div class="card-base p-4 text-center hover-elevate shadow-sm transition-all border-0">
        <div class="text-secondary fw-bold small text-uppercase mb-2" style="letter-spacing: 0.05em;">Total Reputation</div>
        <div class="display-4 fw-bolder text-success mb-2" style="letter-spacing: -0.05em;"><?= number_format(intval($stats['reputation'] ?? 0)) ?></div>
        <p class="text-secondary small mb-0">Points from all interactions</p>
    </div>
    
    <div class="card-base p-4 text-center hover-elevate shadow-sm transition-all border-0">
        <div class="text-secondary fw-bold small text-uppercase mb-2" style="letter-spacing: 0.05em;">Monthly Activity</div>
        <div class="display-4 fw-bolder text-primary mb-2" style="letter-spacing: -0.05em;"><?= number_format(intval($stats['month_points'] ?? 0)) ?></div>
        <p class="text-secondary small mb-0">Reward points this month</p>
    </div>

    <div class="card-base p-4 text-center hover-elevate shadow-sm transition-all border-0" style="background: linear-gradient(135deg, #1e293b, #0f172a);">
        <div class="text-white opacity-75 fw-bold small text-uppercase mb-2" style="letter-spacing: 0.05em;">Community Rank</div>
        <div class="display-4 fw-bolder text-white mb-2" style="letter-spacing: -0.05em;">#<?= intval($stats['rank'] ?? 1) ?></div>
        <p class="text-white opacity-50 small mb-0">Top thinker status</p>
    </div>
</div>

<div class="card-base p-4 p-md-5 shadow-sm border-0">
    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
        <i class="fas fa-timeline text-primary"></i> Achievement Timeline
    </h5>
    
    <div class="list-group-modern">
        <?php if(empty($events)): ?>
            <div class="empty-state py-4">
                <p class="text-secondary">No recent reputation changes recorded.</p>
            </div>
        <?php else: foreach($events as $event): ?>
            <div class="list-item py-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                        <i class="fas <?= $event['delta'] >= 0 ? 'fa-plus text-success' : 'fa-minus text-danger' ?>" style="font-size: 0.7rem;"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark"><?= htmlspecialchars($event['description']) ?></div>
                        <div class="text-secondary smaller">Automatic reward calculation</div>
                    </div>
                </div>
                <span class="fw-bolder <?= $event['delta'] >= 0 ? 'text-success' : 'text-danger' ?>" style="font-size: 1.1rem;">
                    <?= $event['delta'] > 0 ? '+' : '' ?><?= intval($event['delta']) ?>
                </span>
            </div>
        <?php endforeach; endif; ?>
    </div>
</div>
