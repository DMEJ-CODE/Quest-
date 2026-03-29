<?php
// Modernized Answers Index
?>

<div class="row g-4 reveal">
    <?php if(empty($answers)): ?>
        <div class="col-12 col-lg-8 mx-auto">
            <div class="form-wrapper shadow-sm border-0 h-100 p-5 text-center">
                <div class="empty-state py-5">
                    <div class="empty-state-icon">💭</div>
                    <h5 class="empty-state-title">No Answers Found</h5>
                    <p class="empty-state-text">It seems quiet here. Nobody has posted an answer that matches this criteria yet.</p>
                    <button class="btn btn-q rounded-pill px-5 fw-800 py-3 shadow-lg border-0 mt-2">Find Questions to Answer</button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="col-12">
            <div class="gallery-grid-2">
                <?php foreach($answers as $ans): ?>
                <div class="q-card hover-elevate-card bg-white p-4 p-sm-5 shadow-sm border-0 rounded-4">
                    <!-- Header with Status Badge -->
                    <div class="d-flex justify-content-between align-items-start gap-3 mb-4 pt-1">
                        <div class="flex-grow-1">
                            <h5 class="fw-800 text-dark mb-2" style="font-size: 1.1rem; line-height:1.4"><?= htmlspecialchars(substr(strip_tags($ans['explanation']), 0, 80)) ?>...</h5>
                            <div class="d-flex gap-3 align-items-center flex-wrap">
                                <span class="smaller text-muted fw-700">
                                    <i class="far fa-clock me-1 opacity-50"></i><?= date('M d, Y', strtotime($ans['created_at'])) ?>
                                </span>
                                <?php if($ans['is_accepted']): ?>
                                    <span class="badge bg-soft-accent text-accent fw-800 rounded-pill px-3 py-1 smaller" style="font-size:0.6rem">
                                        <i class="fas fa-check-circle me-1"></i> VALIDATED
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning fw-800 rounded-pill px-3 py-1 smaller" style="font-size:0.6rem; color:#ca8a04 !important; background:rgba(254, 252, 232, 1) !important; border:1px solid rgba(254, 240, 138, 1)">
                                        <i class="fas fa-hourglass-half me-1"></i> PENDING
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Question Link -->
                    <div class="mb-4">
                        <a href="/questions/<?= $ans['question_id'] ?>" class="text-decoration-none fw-800 text-primary small d-flex align-items-center gap-2 px-3 py-2 bg-light rounded-pill w-fit" style="width:fit-content">
                            <i class="fas fa-link smaller opacity-50"></i>
                            <span class="text-truncate" style="max-width:280px"><?= htmlspecialchars($ans['question_title']) ?></span>
                        </a>
                    </div>

                    <!-- Answer Preview -->
                    <div class="p-4 rounded-4 mb-4 bg-light border-0 shadow-inner position-relative overflow-hidden" style="background:#f8fafc !important">
                        <p class="mb-0 text-secondary fw-700 smaller" style="line-height: 1.6;">
                            <?= htmlspecialchars(substr(strip_tags($ans['explanation']), 0, 150)) ?>...
                        </p>
                    </div>

                    <!-- Footer Content -->
                    <div class="d-flex justify-content-between align-items-center mb-0 mt-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="badge bg-accent text-white px-3 py-2 fw-800 rounded-pill shadow-xs" style="font-size:0.75rem">
                                <strong><?= (int)$ans['votes'] ?></strong> votes
                            </div>
                            <?php if(isset($ans['author_name'])): ?>
                                <span class="smaller text-muted fw-800 opacity-50">by <?= htmlspecialchars($ans['author_name']) ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="/questions/<?= $ans['question_id'] ?>#answer-<?= $ans['id'] ?>" class="btn-xs rounded-pill px-3 py-2 fw-800 bg-white border shadow-sm text-decoration-none">
                               View Solution <i class="fas fa-arrow-right ms-1 text-muted smaller"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
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
