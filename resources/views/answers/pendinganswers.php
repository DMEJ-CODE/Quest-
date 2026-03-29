<?php
// Modernized Pending Answers View
?>

<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" 
             style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; font-size: 1.5rem;">
            <i class="fas fa-clock-rotate-left"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0">Pending Validation</h1>
            <p class="page-header-subtitle mb-0">Review contributions waiting for community consensus.</p>
        </div>
    </div>
</div>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8">
        <div class="card-base p-4 p-md-5 border-0 shadow-sm">
            <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="fas fa-list-check text-warning"></i> Validation Queue
            </h5>

            <?php if(!empty($pendingAnswers)): ?>
                <div class="list-group-modern">
                    <?php foreach($pendingAnswers as $ans): ?>
                        <div class="list-item p-4 border rounded-4 mb-4 transition-hover bg-white shadow-sm">
                            <div class="d-flex align-items-center gap-4 mb-3">
                                <div class="user-av sm bg-warning"><?= strtoupper(substr($ans['author_name'] ?? 'U', 0, 1)) ?></div>
                                <div class="flex-grow-1 overflow-hidden">
                                   <h6 class="fw-800 text-dark mb-1 small text-truncate">
                                       <a href="/questions/<?= $ans['question_id'] ?>" class="text-decoration-none text-dark hover-text-primary">
                                            <?= htmlspecialchars($ans['question_title'] ?? 'Review Post') ?>
                                       </a>
                                   </h6>
                                   <div class="text-muted smaller">Submitted <?= date('M d, g:i A', strtotime($ans['created_at'])) ?></div>
                                </div>
                                <div class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill border">PENDING</div>
                            </div>
                            
                            <p class="text-secondary small mb-3 line-clamp-2"><?= htmlspecialchars(strip_tags($ans['explanation'] ?? '')) ?></p>
                            
                            <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                                <a href="/questions/<?= $ans['question_id'] ?>" class="btn btn-light rounded-pill px-4 fw-bold small">Review</a>
                                <?php if($_SESSION['user_role'] === 'admin'): ?>
                                    <button class="btn btn-success rounded-pill px-4 fw-bold small">Approve</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state py-5">
                    <div class="empty-state-icon text-muted" style="opacity:0.2">📭</div>
                    <h5 class="empty-state-title">All caught up!</h5>
                    <p class="empty-state-text">There are no answers waiting for validation at the moment.</p>
                </div>
            <?php endif; ?>

            <div class="mt-4 pt-4 border-top">
                <a href="/dashboard" class="btn btn-light rounded-pill px-4 fw-bold small"><i class="fas fa-home me-2"></i> Dashboard</a>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="card-base p-4">
            <h6 class="fw-bold text-dark mb-4 small text-uppercase" style="letter-spacing: 0.1em;">Review Guidelines</h6>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex gap-3">
                    <i class="fas fa-circle-check text-success mt-1"></i>
                    <p class="smaller text-secondary mb-0">Check for technical accuracy and relevance.</p>
                </div>
                <div class="d-flex gap-3">
                    <i class="fas fa-circle-check text-success mt-1"></i>
                    <p class="smaller text-secondary mb-0">Ensure clear explanations and code snippets.</p>
                </div>
                <div class="d-flex gap-3">
                    <i class="fas fa-circle-check text-success mt-1"></i>
                    <p class="smaller text-secondary mb-0">Verify compliance with community standards.</p>
                </div>
            </div>
            
            <div class="mt-5 p-4 rounded-4 bg-light border border-dashed text-center">
                <h6 class="fw-bold small mb-2">Reputation Gained</h6>
                <p class="text-secondary smaller mb-0">Accepting high-quality answers helps you earn <span class="text-primary fw-bold">+10 points</span>.</p>
            </div>
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
