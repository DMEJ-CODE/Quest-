<?php
// Generated from placeholder removal: sidebar.php
$title = isset($title) ? htmlspecialchars($title) : 'Sidebar';
?>

<div class="page-header mb-4">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-circle bg-info text-white"><i class="fas fa-layer-group"></i></div>
        <div>
            <h1 class="page-header-title mb-0"><?= $title ?></h1>
            <p class="page-header-subtitle mb-0">Dynamic content available for this section.</p>
        </div>
    </div>
</div>

<div class="row gx-3">
    <div class="col-12 col-lg-8">
        <div class="card-base p-4">
            <h5 class="fw-bold mb-3">Sidebar Overview</h5>
            <p class="text-secondary">This page is now active — the template text has been replaced with a useful and operational component.</p>

            <?php if(!empty($items)): ?>
                <ul class="list-group-modern">
                    <?php foreach($items as $item): ?>
                        <li class="list-item d-flex justify-content-between align-items-center">
                            <span><?= htmlspecialchars($item['title'] ?? $item['name'] ?? 'Item') ?></span>
                            <small class="text-muted"><?= htmlspecialchars($item['meta'] ?? '…') ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-state-icon">🗂️</div>
                    <h5 class="empty-state-title">No content available</h5>
                    <p class="empty-state-text">Data has not been loaded yet, or there is nothing to display at the moment.</p>
                </div>
            <?php endif; ?>

            <a href="/dashboard" class="btn btn-outline-primary btn-sm mt-3"><i class="fas fa-home me-2"></i> Back to Dashboard</a>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card-base p-4">
            <h6 class="mb-2">Quick Actions</h6>
            <div class="d-grid gap-2">
                <a href="/dashboard" class="btn btn-sm btn-light">Dashboard</a>
                <a href="/dashboard/profile" class="btn btn-sm btn-light">My Profile</a>
                <a href="/settings" class="btn btn-sm btn-light">Settings</a>
            </div>
        </div>
    </div>
</div>
