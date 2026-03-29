<?php
// Modernized Tag Management View
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                    <i class="fas fa-tag"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Tag Management</h4>
                   <p class="text-secondary small mb-0">Customize and manage your personal tag taxonomy.</p>
                </div>
            </div>

            <div class="list-group-modern">
                <!-- Tag row -->
                <?php 
                $mTags = [
                    ['name' => 'Web Dev', 'type' => 'Category', 'color' => '#3b82f6'],
                    ['name' => 'Backend', 'type' => 'Category', 'color' => '#ef4444'],
                    ['name' => 'API', 'type' => 'System', 'color' => '#8b5cf6']
                ];
                foreach ($mTags as $tag): 
                ?>
                    <div class="list-item d-flex align-items-center justify-content-between p-4 border rounded-4 mb-3 transition-hover shadow-sm bg-white">
                        <div class="d-flex align-items-center gap-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:40px; height:40px; background:<?= $tag['color'] ?>; color:#fff">
                                <i class="fas fa-layer-group small"></i>
                            </div>
                            <div>
                                <h6 class="fw-800 text-dark mb-1 small"><?= htmlspecialchars($tag['name']) ?></h6>
                                <span class="smaller text-muted fw-700"><?= $tag['type'] ?></span>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                           <button class="btn btn-q-ol rounded-pill px-3 py-2 btn-xs fw-800"><i class="fas fa-edit me-1"></i> Edit</button>
                           <button class="btn btn-outline-danger rounded-pill px-3 py-2 btn-xs fw-800">Remove</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-5 p-5 text-center bg-light border-dashed rounded-4">
                <i class="fas fa-plus h2 text-muted opacity-25 mb-4"></i>
                <h5 class="fw-800 text-dark mb-3">Create New System Tag</h5>
                <form class="d-flex gap-2 justify-content-center px-5">
                    <input type="text" class="form-control rounded-pill border-0 shadow-sm px-4 fw-800 small" placeholder="e.g. Frontend" style="max-width:320px; box-shadow:none; background:rgba(0,0,0,0.03) !important">
                    <button class="btn btn-accent rounded-pill px-4 fw-800 shadow-sm border-0">Add Tag</button>
                </form>
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
