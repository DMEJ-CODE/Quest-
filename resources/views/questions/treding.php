<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-danger text-white"><i class="fas fa-fire"></i></div>
        <div>
            <h1 class="page-header-title mb-0">Trending Questions</h1>
            <p class="page-header-subtitle mb-0">Hot topics and community favorites right now.</p>
        </div>
    </div>
</div>

<div class="row g-3">
    <?php if(empty($questions)): ?>
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-state-icon">🔥</div>
                <h5 class="empty-state-title">No trending questions yet</h5>
                <p class="empty-state-text">Come back in a bit to catch rising discussions.</p>
            </div>
        </div>
    <?php else: foreach($questions as $q): ?>
        <div class="col-12 col-md-6">
            <div class="card-base p-3">
                <a href="/questions/<?= $q['id'] ?>" class="h6 fw-bold text-dark text-decoration-none"><?= htmlspecialchars($q['title']) ?></a>
                <p class="text-secondary small"><?= htmlspecialchars(substr(strip_tags($q['description'] ?? ''),0,100)) ?>...</p>
                <div class="d-flex justify-content-between align-items-center"> 
                    <span class="badge bg-warning text-dark">🔥 <?= intval($q['trend_score']) ?></span>
                    <span class="text-secondary small"><?= intval($q['answers']) ?> answers</span>
                </div>
            </div>
        </div>
    <?php endforeach; endif; ?>
</div>
