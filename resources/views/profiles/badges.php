<div class="row g-4 reveal">
    <?php if(empty($badges)): ?>
        <div class="col-12 py-5">
            <div class="empty-state">
                <div class="empty-state-icon text-muted" style="opacity: 0.3">🏅</div>
                <h5 class="empty-state-title">No Achievements Yet</h5>
                <p class="empty-state-text">Your earned badges will appear here once you start participating in the community.</p>
                <a href="/dashboard/questions" class="btn btn-primary rounded-pill px-4 mt-3">Browse Feed</a>
            </div>
        </div>
    <?php else: foreach($badges as $badge): ?>
        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
            <div class="card-base p-4 text-center hover-elevate transition-all h-100 border-0 shadow-sm" style="border-radius: 28px;">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle bg-light" style="width: 70px; height: 70px; font-size: 2.2rem; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                    <?= htmlspecialchars($badge['icon'] ?? '🏅') ?>
                </div>
                <h6 class="fw-bolder text-dark mb-2"><?= htmlspecialchars($badge['title']) ?></h6>
                <p class="text-secondary small mb-0 px-2"><?= htmlspecialchars($badge['description']) ?></p>
            </div>
        </div>
    <?php endforeach; endif; ?>
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
