

<div class="card-base p-4">
    <?php if(empty($activity)): ?>
        <div class="empty-state">
            <div class="empty-state-icon">📭</div>
            <h5 class="empty-state-title">No activity yet</h5>
            <p class="empty-state-text">Start by asking a question or answering another user.</p>
        </div>
    <?php else: ?>
        <div class="list-group-modern">
            <?php foreach($activity as $item): ?>
            <div class="list-item align-items-start">
                <div class="list-item-icon bg-primary text-white rounded-circle"><i class="fas <?= htmlspecialchars($item['icon'] ?? 'fa-check') ?>"></i></div>
                <div class="list-item-content">
                    <div class="list-item-title"><?= htmlspecialchars($item['title']) ?></div>
                    <div class="list-item-subtitle"><?= htmlspecialchars($item['detail']) ?></div>
                </div>
                <div class="text-secondary" style="font-size: 0.8rem;"><?= htmlspecialchars($item['when']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
