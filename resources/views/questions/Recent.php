<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-info text-white"><i class="fas fa-clock"></i></div>
        <div>
            <h1 class="page-header-title mb-0">Recent Questions</h1>
            <p class="page-header-subtitle mb-0">Latest questions from the community.</p>
        </div>
    </div>
</div>

<div class="row g-3">
    <?php if(empty($questions)): ?>
        <div class="col-12">
            <div class="empty-state"><div class="empty-state-icon">📭</div><h5 class="empty-state-title">No questions yet</h5><p class="empty-state-text">Ask first or check back later.</p></div>
        </div>
    <?php else: foreach($questions as $q): ?>
        <div class="col-12">
            <div class="card-base p-3">
                <div class="d-flex justify-content-between align-items-start gap-3">
                    <a href="/questions/<?= $q['id'] ?>" class="h6 fw-bold text-dark text-decoration-none"><?= htmlspecialchars($q['title']) ?></a>
                    <span class="badge bg-light text-secondary"><?= intval($q['answers']) ?> answers</span>
                </div>
                <p class="text-secondary mb-2"><?= htmlspecialchars(substr(strip_tags($q['description'] ?? ''),0,120)) ?>...</p>
                <div class="text-secondary smaller">Asked by <?= htmlspecialchars($q['author_name']) ?> · <?= date('M d, Y', strtotime($q['created_at'])) ?></div>
            </div>
        </div>
    <?php endforeach; endif; ?>
</div>
