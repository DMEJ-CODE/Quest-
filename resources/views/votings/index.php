<div class="mt-4"></div>

<div class="mt-4"></div>

<div class="row g-4 reveal" style="animation-delay: 0.1s;">
    <?php if(empty($recentVotes)): ?>
        <div class="col-12 py-5 my-5 text-center">
            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-4" style="width: 120px; height: 120px;">
                <i class="fas fa-vote-yea text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
            </div>
            <h3 class="fw-bolder text-dark mb-2" style="letter-spacing: -0.02em;">No Activity Found</h3>
            <p class="text-secondary mx-auto mb-4" style="max-width: 400px; font-size: 0.95rem;">
                No votes match this category. Start engaging with the community by upvoting helpful content!
            </p>
        </div>
    <?php else: ?>
        <div class="col-12">
            <div class="d-flex flex-column gap-3">
                <?php foreach($recentVotes as $vote): ?>
                <div class="q-card hover-elevate-row bg-white p-3 p-sm-4 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3" style="border-radius: 20px; border: 1px solid rgba(0,0,0,0.03); transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);">
                    
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <!-- Vote Indicator Badge -->
                        <div class="d-flex align-items-center justify-content-center rounded-circle shrink-0 shadow-sm" style="width: 54px; height: 54px; background: <?= $vote['value'] > 0 ? 'linear-gradient(135deg, var(--g400), var(--g600))' : 'linear-gradient(135deg, #f87171, #ef4444)' ?>; color: white; font-size: 1.5rem;">
                            <i class="fas <?= $vote['value'] > 0 ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                        </div>

                        <!-- Content Details -->
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <?php if($vote['votable_type'] === 'question'): ?>
                                    <span class="badge rounded-pill px-2 py-1 bg-light text-secondary border" style="font-size: 0.65rem; font-weight: 700; letter-spacing: 0.05em;"><i class="fas fa-question-circle me-1"></i> QUESTION</span>
                                <?php else: ?>
                                    <span class="badge rounded-pill px-2 py-1 bg-light text-secondary border" style="font-size: 0.65rem; font-weight: 700; letter-spacing: 0.05em;"><i class="fas fa-comment-dots me-1"></i> ANSWER</span>
                                <?php endif; ?>
                                
                                <span class="text-muted" style="font-size: 0.75rem; font-weight: 500;">
                                    <i class="far fa-clock me-1"></i> <?= date('M d, g:i A', strtotime($vote['created_at'])) ?>
                                </span>
                            </div>
                            
                            <h5 class="fw-bolder text-dark mb-0 line-clamp-1" style="font-size: 1.05rem; letter-spacing: -0.01em; max-width: 500px;">
                                <?php if($vote['votable_type'] === 'question'): ?>
                                    <?= htmlspecialchars($vote['question_title'] ?? 'Unknown Question') ?>
                                <?php else: ?>
                                    <?= htmlspecialchars(strip_tags($vote['answer_text'] ?? 'Unknown Answer')) ?>
                                <?php endif; ?>
                            </h5>
                        </div>
                    </div>

                    <!-- Voter Info -->
                    <?php if($isAdmin): ?>
                    <div class="d-flex align-items-center gap-3 py-2 py-sm-0 px-sm-3 border-start-sm border-light">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-secondary fw-bold border" style="width: 38px; height: 38px; font-size: 0.9rem;">
                            <?= strtoupper(substr($vote['voter_name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div>
                            <span class="d-block text-secondary" style="font-size: 0.65rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;">Voted By</span>
                            <span class="fw-bold text-dark" style="font-size: 0.9rem;"><?= htmlspecialchars($vote['voter_name'] ?? 'Unknown Member') ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .shrink-0 { flex-shrink: 0; }
    
    .hover-elevate-row:hover { 
        transform: translateY(-4px); 
        box-shadow: 0 12px 24px rgba(0,0,0,0.06) !important; 
        border-color: rgba(0,0,0,0.08) !important; 
        z-index: 10;
        position: relative;
    }
    
    .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; line-clamp: 1; }
    
    @media (min-width: 576px) {
        .border-start-sm { border-left: 1px solid rgba(0,0,0,0.05); }
    }
    
    .reveal { opacity: 0; transform: translateY(20px); animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
</style>
