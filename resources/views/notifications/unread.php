<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-warning text-white"><i class="fas fa-envelope"></i></div>
        <div>
            <h1 class="page-header-title mb-0">Unread Notifications</h1>
            <p class="page-header-subtitle mb-0">Unseen updates needing your attention.</p>
        </div>
    </div>
</div>

<div class="card-base p-4">
    <?php if(empty($unread)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">✉️</div>
            <h5 class="empty-state-title">No unread items</h5>
            <p class="empty-state-text">You've read everything.</p>
        </div>
    <?php else: ?>
        <div class="list-group-modern">
            <?php foreach($unread as $note): ?>
            <div class="list-item align-items-start">
                <div class="list-item-icon bg-warning text-white rounded-circle"><i class="fas fa-bell"></i></div>
                <div class="list-item-content">
                    <div class="list-item-title"><?= htmlspecialchars($note['message']) ?></div>
                    <div class="list-item-subtitle"><?= htmlspecialchars($note['time']) ?></div>
                </div>
                <form action="/notifications/mark-read" method="POST">
                    <input type="hidden" name="id" value="<?= intval($note['id']) ?>">
                    <button type="submit" class="btn btn-sm btn-outline-dark">Mark read</button>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
