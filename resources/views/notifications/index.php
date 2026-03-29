<?php
// Modernized Notifications View
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center justify-content-between mb-5">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div>
                       <h4 class="fw-800 text-dark mb-0">Notifications</h4>
                       <p class="text-secondary small mb-0">Manage and track all account activity and mentions.</p>
                    </div>
                </div>
                <?php if(!empty($notifications)): ?>
                    <button class="btn btn-q-ol rounded-pill px-4 btn-sm fw-800 border-2">Mark all as read</button>
                <?php endif; ?>
            </div>

            <?php if(empty($notifications)): ?>
                <div class="empty-state py-5">
                    <div class="empty-state-icon">🔔</div>
                    <h5 class="empty-state-title">You're all caught up!</h5>
                    <p class="empty-state-text">No new notifications at the moment. We'll let you know when something important happens.</p>
                    <button class="btn btn-q rounded-pill px-5 fw-800 py-3 shadow-lg border-0 mt-2">Notification Settings</button>
                </div>
            <?php else: ?>
                <div class="list-group-modern pt-2">
                    <?php foreach($notifications as $note): 
                        $isRead = $note['read'] ?? false;
                    ?>
                    <div class="list-item d-flex align-items-start gap-4 p-4 border rounded-4 mb-3 transition-hover shadow-sm <?= $isRead ? 'bg-light opacity-75' : 'bg-white' ?>">
                        <div class="rounded-circle d-flex align-items-center justify-content-center <?= $isRead ? 'bg-secondary text-white' : 'bg-primary text-white shadow-sm' ?>" style="width:40px; height:40px; flex-shrink:0">
                            <i class="fas <?= $isRead ? 'fa-check' : 'fa-bell' ?> small"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-800 text-dark mb-0 small text-wrap"><?= htmlspecialchars($note['message']) ?></h6>
                                <span class="smaller text-muted fw-700"><?= htmlspecialchars($note['time']) ?></span>
                            </div>
                            <div class="d-flex align-items-center gap-3 mt-3 pt-3 border-top border-light">
                                <?php if(!$isRead): ?>
                                    <form action="/notifications/mark-read" method="POST" class="m-0">
                                        <input type="hidden" name="id" value="<?= intval($note['id']) ?>">
                                        <button type="submit" class="btn btn-accent rounded-pill px-4 btn-xs fw-800 smaller border-0">Mark as read</button>
                                    </form>
                                <?php endif; ?>
                                <button class="btn btn-link text-decoration-none smaller fw-800 text-muted px-0">View Details</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal sequence
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach((el, i) => {
            setTimeout(() => el.classList.add('visible'), i * 80);
        });
    }, 50);
});
</script>
