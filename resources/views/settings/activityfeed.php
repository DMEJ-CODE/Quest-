<?php
// Modernized Settings Activity Feed
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                    <i class="fas fa-history"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Settings Activity</h4>
                   <p class="text-secondary small mb-0">Track all configuration changes made to your account environment.</p>
                </div>
            </div>

            <div class="list-group-modern pt-3">
                <!-- Activity row -->
                <?php 
                $sActivities = [
                    ['title' => 'Dark mode enabled', 'meta' => '12:45 PM', 'icon' => 'fa-moon', 'color' => '#1e293b'],
                    ['title' => 'Notification threshold updated', 'meta' => 'Yesterday', 'icon' => 'fa-bell', 'color' => '#f59e0b'],
                    ['title' => 'Profile visibility set to public', 'meta' => 'Feb 26, 2026', 'icon' => 'fa-eye', 'color' => '#3b82f6']
                ];
                foreach ($sActivities as $act): 
                ?>
                    <div class="list-item d-flex align-items-center justify-content-between p-4 border rounded-4 mb-3 transition-hover shadow-sm bg-white">
                        <div class="d-flex align-items-center gap-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:40px; height:40px; background:<?= $act['color'] ?>; color:#fff">
                                <i class="fas <?= $act['icon'] ?> small mb-0"></i>
                            </div>
                            <div>
                                <h6 class="fw-800 text-dark mb-1 small"><?= htmlspecialchars($act['title']) ?></h6>
                                <span class="smaller text-muted fw-700"><?= $act['meta'] ?> • Device: MacBook Pro</span>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-muted smaller opacity-25"></i>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-5 p-5 text-center bg-light border-dashed rounded-4">
                <p class="text-muted smaller mb-4 fw-800 opacity-50">History is preserved for audit and recovery purposes.</p>
                <button class="btn btn-q-ol rounded-pill px-5 fw-800 py-3 smaller shadow-sm border-2">Rollback Last Change</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal magic
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach((el, i) => {
            setTimeout(() => el.classList.add('visible'), i * 80);
        });
    }, 50);
});
</script>
