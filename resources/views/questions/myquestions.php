<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-secondary text-white"><i class="fas fa-user-circle"></i></div>
        <div>
            <h1 class="page-header-title mb-0">My Questions</h1>
            <p class="page-header-subtitle mb-0">Manage questions you have asked.</p>
        </div>
    </div>
</div>

<div class="card-base p-4">
    <?php if(empty($questions)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">📭</div>
            <h5 class="empty-state-title">No questions yet</h5>
            <p class="empty-state-text">Ask your first question to start earning reputation.</p>
            <a href="/questions/create" class="btn btn-primary">Ask Question</a>
        </div>
    <?php else: ?>
        <div class="list-group-modern">
            <?php foreach($questions as $q): ?>
            <div class="list-item align-items-start">
                <div class="list-item-content">
                    <a href="/questions/<?= $q['id'] ?>" class="list-item-title fw-bold"><?= htmlspecialchars($q['title']) ?></a>
                    <div class="list-item-subtitle"><?= intval($q['answers']) ?> answers · <?= intval($q['views']) ?> views</div>
                </div>
                <div class="d-flex gap-1">
                    <a href="/questions/<?= $q['id'] ?>/edit" class="btn btn-sm btn-outline-primary">Edit</a>
                    <form action="/questions/<?= $q['id'] ?>/delete" method="POST" onsubmit="return confirm('Delete this question?');">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
