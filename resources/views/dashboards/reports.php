<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-warning text-white">
            <i class="fas fa-flag"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0">Reports</h1>
            <p class="page-header-subtitle mb-0">Moderation tickets and issue tracking module.</p>
        </div>
    </div>
</div>

<div class="card-base p-4 mb-4">
    <h5 class="fw-bold mb-3">Recent Reports</h5>
    <?php if(empty($reports)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">✅</div>
            <h5 class="empty-state-title">No open reports</h5>
            <p class="empty-state-text">All reported issues are resolved.</p>
        </div>
    <?php else: ?>
        <div class="list-group-modern">
            <?php foreach($reports as $rep): ?>
            <div class="list-item align-items-start">
                <div class="list-item-icon bg-danger text-white rounded-circle"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="list-item-content">
                    <div class="list-item-title"><?= htmlspecialchars($rep['reason']) ?></div>
                    <div class="list-item-subtitle">Reported by <?= htmlspecialchars($rep['reporter']) ?> on <?= date('M d, Y', strtotime($rep['created_at'])) ?></div>
                </div>
                <div class="text-secondary" style="font-size: 0.8rem;"><?= htmlspecialchars($rep['status']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="row g-4">
    <div class="col-12 col-md-4"><a href="/reports/resolve-all" class="btn btn-primary w-100">Resolve All</a></div>
    <div class="col-12 col-md-4"><a href="/reports/new" class="btn btn-outline-primary w-100">Create Report</a></div>
    <div class="col-12 col-md-4"><a href="/reports/history" class="btn btn-outline-secondary w-100">View History</a></div>
</div>

<style>.icon-circle{width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.25rem;}</style>
