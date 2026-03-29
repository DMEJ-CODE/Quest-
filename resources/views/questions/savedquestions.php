<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-info text-white"><i class="fas fa-bookmark"></i></div>
        <div>
            <h1 class="page-header-title mb-0">Saved Questions</h1>
            <p class="page-header-subtitle mb-0">List of questions you saved for later.</p>
        </div>
    </div>
</div>

<div class="card-base p-4">
    <?php if(empty($saved)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">🕰️</div>
            <h5 class="empty-state-title">Not saved yet</h5>
            <p class="empty-state-text">Star questions to save them for later review.</p>
        </div>
    <?php else: ?>
        <div class="list-group-modern">
            <?php foreach($saved as $q): ?>
            <div class="list-item align-items-start">
                <div class="list-item-content">
                    <a href="/questions/<?= $q['id'] ?>" class="list-item-title fw-bold"><?= htmlspecialchars($q['title']) ?></a>
                    <div class="list-item-subtitle">Saved <?= date('M d, Y', strtotime($q['saved_at'])) ?></div>
                </div>
                <form action="/questions/<?= $q['id'] ?>/unsave" method="POST">
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Unsave</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
