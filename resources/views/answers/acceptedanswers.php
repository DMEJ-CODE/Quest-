<?php
// Modernized Accepted Answers View
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-9 mx-auto">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5 pt-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:48px; height:48px; background:rgba(34, 197, 94, 0.05); color:#22c55e">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Accepted Solutions</h4>
                   <p class="text-secondary small mb-0">Browse through community-validated technical answers.</p>
                </div>
            </div>

            <div class="list-group-modern pt-3">
                <!-- Data-driven accepted answers -->
                <?php 
                if (empty($acceptedAnswers)):
                ?>
                    <div class="empty-state py-5">
                        <div class="empty-state-icon text-success">🏆</div>
                        <h5 class="empty-state-title">No accepted solutions</h5>
                        <p class="empty-state-text">Browse the feed to find questions that need your expertise!</p>
                        <a href="/dashboard/questions" class="btn btn-q rounded-pill px-4 mt-3">Help the community</a>
                    </div>
                <?php 
                else:
                    foreach ($acceptedAnswers as $ans): 
                ?>
                    <div class="p-4 border rounded-4 mb-4 transition-hover shadow-sm bg-white d-flex align-items-center justify-content-between position-relative overflow-hidden">
                        <div class="d-flex align-items-center gap-4">
                            <div class="user-av sm bg-success"><?= strtoupper(substr($ans['author_name'] ?? 'U', 0, 1)) ?></div>
                            <div>
                               <h6 class="fw-800 text-dark mb-1 small text-truncate" style="max-width:320px">
                                   <a href="/questions/<?= $ans['question_id'] ?>" class="text-decoration-none text-dark hover-text-primary">
                                        <?= htmlspecialchars($ans['question_title'] ?? 'Full Discussion') ?>
                                   </a>
                               </h6>
                               <p class="text-muted smaller mb-0 text-truncate" style="max-width:280px"><?= htmlspecialchars(strip_tags($ans['explanation'] ?? '')) ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="smaller text-muted fw-700"><?= date('M d', strtotime($ans['created_at'])) ?></span>
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width:28px; height:28px; font-size:0.75rem">
                               <i class="fas fa-check"></i>
                            </div>
                        </div>
                        <div class="bg-success-subtle position-absolute end-0 h-100" style="width:4px; top:0"></div>
                    </div>
                <?php endforeach; endif; ?>
            </div>

            <div class="mt-5 p-5 text-center bg-light border border-dashed rounded-4">
                <i class="fas fa-lightbulb text-accent h2 mb-3 opacity-25"></i>
                <h5 class="fw-800 text-dark mb-3">Community Knowledge Base</h5>
                <p class="text-secondary small mb-4 px-5">All these solutions have been verified by the community to be accurate and efficient.</p>
                <div class="d-flex gap-2 justify-content-center">
                   <button class="btn btn-q rounded-pill px-5 fw-800 shadow-sm border-0 py-3">Browse Wiki</button>
                   <button class="btn btn-q-ol rounded-pill px-5 fw-800 shadow-sm border-2 py-3">Join Discussion</button>
                </div>
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
