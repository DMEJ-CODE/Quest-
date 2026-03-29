<?php
// Modernized My Answers View
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-9 mx-auto">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5 pt-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:48px; height:48px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                    <i class="fas fa-reply-all"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">My Answers</h4>
                   <p class="text-secondary small mb-0">Review and manage all your contributions to the community.</p>
                </div>
            </div>

            <div class="list-group-modern pt-3">
                <!-- Data-driven answers -->
                <?php 
                if (empty($answers)):
                ?>
                    <div class="empty-state py-5">
                        <div class="empty-state-icon">💬</div>
                        <h5 class="empty-state-title">No answers yet</h5>
                        <p class="empty-state-text">You haven't posted any answers yet. Share your knowledge with others!</p>
                        <a href="/dashboard/questions" class="btn btn-q rounded-pill px-4 mt-3">Browse Feed</a>
                    </div>
                <?php 
                else:
                    foreach ($answers as $ans): 
                ?>
                    <div class="list-item d-flex align-items-start gap-4 p-4 border rounded-4 mb-4 transition-hover shadow-sm bg-white">
                        <div class="d-flex flex-column align-items-center gap-2" style="min-width:50px">
                           <div class="rounded-pill bg-light text-dark fw-800 px-3 py-1 smaller shadow-sm border"><?= $ans['votes'] ?? 0 ?></div>
                           <span class="text-muted smaller fw-700">VOTES</span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-800 text-dark mb-0 small text-truncate" style="max-width:320px"><?= htmlspecialchars($ans['question_title'] ?? 'Full Discussion') ?></h6>
                                <?php if(isset($ans['is_accepted']) && $ans['is_accepted']): ?>
                                    <span class="badge bg-soft-accent text-accent fw-800 rounded-pill px-2 py-1 smaller" style="font-size:0.5rem"><i class="fas fa-check me-1"></i> ACCEPTED</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-secondary smaller mb-3 text-truncate"><?= htmlspecialchars(strip_tags($ans['explanation'] ?? '')) ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="smaller text-muted fw-700"><i class="far fa-clock me-1 text-muted opacity-50"></i> <?= date('M d, Y', strtotime($ans['created_at'])) ?></span>
                                <div class="d-flex gap-2">
                                   <a href="/answers/<?= $ans['id'] ?>/edit" class="btn btn-link text-decoration-none smaller fw-800 text-muted px-0 me-3">Edit</a>
                                   <a href="/questions/<?= $ans['question_id'] ?>" class="btn btn-q-ol rounded-pill px-3 py-2 btn-xs fw-800 smaller">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
            </div>

            <div class="mt-5 p-5 text-center bg-light border-dashed rounded-4">
                <i class="fas fa-medal h2 text-accent opacity-25 mb-4"></i>
                <h5 class="fw-800 text-dark mb-3">Keep contributing!</h5>
                <p class="text-secondary small mb-4 px-5">Your answers have helped 1,240 people this week. Keep sharing your knowledge!</p>
                <button class="btn btn-q rounded-pill px-5 fw-800 py-3 shadow-lg border-0">Find New Questions</button>
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
