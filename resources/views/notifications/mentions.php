<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-primary text-white"><i class="fas fa-at"></i></div>
        <div>
            <h1 class="page-header-title mb-0">Mentions</h1>
            <p class="page-header-subtitle mb-0">Where others have mentioned your username.</p>
        </div>
    </div>
</div>

<div class="card-base p-4">
    <?php if(empty($mentions)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">💬</div>
            <h5 class="empty-state-title">No mentions yet</h5>
            <p class="empty-state-text">Be active to get more visibility.</p>
        </div>
    <?php else: ?>
        <div class="list-group-modern">
            <?php foreach($mentions as $mention): ?>
            <div class="list-item align-items-start">
                <div class="list-item-icon bg-secondary text-white rounded-circle"><i class="fas fa-user"></i></div>
                <div class="list-item-content">
                    <div class="list-item-title"><?= htmlspecialchars($mention['actor']) ?> mentioned you in <?= htmlspecialchars($mention['context']) ?></div>
                    <div class="list-item-subtitle"><?= htmlspecialchars($mention['time']) ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
