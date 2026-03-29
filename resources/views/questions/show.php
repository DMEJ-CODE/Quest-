<div class="mb-5">
    <a href="/questions" class="text-secondary text-decoration-none smaller d-inline-flex align-items-center mb-3 transition-all hover-primary">
        <i class="fas fa-arrow-left me-1"></i> Back to all questions
    </a>
    
    <div class="row g-5">
        <!-- Main Content -->
        <div class="col-12 col-lg-8">
            <h1 class="page-title mb-3 fw-bold"><?= htmlspecialchars($question['title']) ?></h1>
            
            <div class="d-flex align-items-center mb-4 pb-4 border-bottom">
                <div class="d-flex align-items-center me-4">
                    <span class="text-muted smaller me-1">Asked</span>
                    <span class="text-dark fw-medium smaller"><?= date('M d, Y', strtotime($question['created_at'])) ?></span>
                </div>
                <div class="d-flex align-items-center me-4">
                    <span class="text-muted smaller me-1">Modified</span>
                    <span class="text-dark fw-medium smaller"><?= date('M d, Y', strtotime($question['updated_at'] ?? $question['created_at'])) ?></span>                    
                </div>
                <div class="d-flex align-items-center me-4">
                    <span class="text-muted smaller me-1">Viewed</span>
                    <span class="text-dark fw-medium smaller"><?= $question['views'] ?> times</span>
                </div>
                <div class="ms-auto">
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $question['user_id']): ?>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-light text-dark rounded-pill shadow-sm px-3 dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                                <li><a class="dropdown-item py-2" href="/questions/<?= $question['id'] ?>/edit"><i class="fas fa-edit me-2 text-primary"></i> Edit</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="/questions/<?= $question['id'] ?>/delete" method="POST" onsubmit="return confirm('Sil vous plaît confirmez la suppression de cette question ?');">
                                        <button type="submit" class="dropdown-item text-danger py-2"><i class="fas fa-trash-alt me-2"></i> Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="q-content mb-5">
                <div class="d-flex">
                    <div class="text-center me-4" style="min-width: 45px;">
                        <form action="/vote" method="POST" class="mb-2 vote-form">
                            <input type="hidden" name="target_id" value="<?= $question['id'] ?>">
                            <input type="hidden" name="target_type" value="question">
                            <input type="hidden" name="vote_type" value="1">
                            <button type="submit" class="btn btn-light rounded-circle shadow-sm border p-2 w-100 hover-up">
                                <i class="fas fa-caret-up fa-2x"></i>
                            </button>
                        </form>
                        <span id="score-question-<?= $question['id'] ?>" class="fw-bold fs-4 d-block"><?= $question['votes'] ?? 0 ?></span>
                        <form action="/vote" method="POST" class="mt-2 vote-form">
                            <input type="hidden" name="target_id" value="<?= $question['id'] ?>">
                            <input type="hidden" name="target_type" value="question">
                            <input type="hidden" name="vote_type" value="-1">
                            <button type="submit" class="btn btn-light rounded-circle shadow-sm border p-2 w-100 hover-up">
                                <i class="fas fa-caret-down fa-2x"></i>
                            </button>
                        </form>
                    </div>
                    
                    <div class="flex-grow-1">
                        <div class="description-body mb-4 fs-6 leading-relaxed">
                            <?= nl2br(htmlspecialchars($question['description'])) ?>
                        </div>
                        
                        <?php if (!empty($tags)): ?>
                            <div class="tags-row mb-4">
                                <?php foreach ($tags as $tag): ?>
                                    <span class="tag-pill me-2 mb-2 transition-all hover-up-sm">
                                        <?= htmlspecialchars($tag['name']) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="author-card p-3 bg-light rounded-4 ms-auto" style="max-width: 280px;">
                            <span class="text-muted smaller d-block mb-2">Asked by</span>
                            <div class="d-flex align-items-center">
                                <div class="avatar-md bg-white border border-primary-subtle rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 42px; height: 42px;">
                                    <i class="fas fa-user-circle text-primary fa-lg"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-dark d-block lh-1 text-primary"><?= htmlspecialchars($question['author_name'] ?? 'Uknown') ?></span>
                                    <span class="text-muted smaller">@<?= htmlspecialchars($question['username'] ?? 'user') ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Question Comments (Premium nested UI) -->
                        <div class="comments-section mt-4 pt-4 border-top">
                            <h6 class="fw-bold fs-6 mb-3 text-muted"><i class="fas fa-comments me-2"></i> Discussions</h6>
                            <?php if (!empty($questionComments)): ?>
                                <div class="d-flex flex-column gap-3 mb-4">
                                <?php foreach ($questionComments as $c): ?>
                                    <div class="comment-item bg-light p-3 rounded-3 position-relative">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <span class="fw-bold text-dark text-sm"><?= htmlspecialchars($c['user_name']) ?></span>
                                            <span class="text-muted" style="font-size: 0.65rem;"><?= date('M d, H:i', strtotime($c['created_at'])) ?></span>
                                        </div>
                                        <p class="mb-0 text-secondary" style="font-size: 0.85rem;"><?= nl2br(htmlspecialchars($c['content'])) ?></p>
                                        <?php if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $c['user_id'] || $_SESSION['user_role'] === 'admin')): ?>
                                            <form action="/comments/<?= $c['id'] ?>/delete" method="POST" class="position-absolute" style="top: 8px; right: 8px;">
                                                <button type="submit" class="btn btn-sm text-danger p-0 border-0 bg-transparent hover-up-sm" title="Delete comment"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <form action="/comments/store" method="POST" class="d-flex gap-2">
                                    <input type="hidden" name="target_id" value="<?= $question['id'] ?>">
                                    <input type="hidden" name="target_type" value="question">
                                    <input type="text" name="content" class="form-control rounded-pill bg-light border-0 px-3" placeholder="Add a comment..." required>
                                    <button type="submit" class="btn btn-primary rounded-pill px-3 shadow-sm"><i class="fas fa-paper-plane"></i></button>
                                </form>
                            <?php else: ?>
                                <p class="text-muted smaller mt-2"><a href="/login" class="text-primary fw-bold text-decoration-none">Log in</a> to join the discussion.</p>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Answers Section -->
            <div class="answers-header d-flex justify-content-between align-items-end mb-4 border-bottom pb-2">
                <h4 class="fw-bold mb-0"><?= count($answers) ?> Answers</h4>
                <div class="sort-options smaller">
                    <span class="text-muted me-2">Sorted by</span>
                    <a href="#" class="text-dark fw-bold text-decoration-none">Latest answers</a>
                </div>
            </div>

            <div class="answers-list mb-5">
                <?php if (empty($answers)): ?>
                    <div class="text-center py-5 border rounded-4 bg-light border-dashed">
                        <p class="text-muted">No answers yet. Be the first to help!</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($answers as $a): ?>
                        <div class="answer-item py-4 border-bottom">
                            <div class="d-flex">
                                <div class="text-center me-4" style="min-width: 45px;">
                                    <form action="/vote" method="POST" class="mb-1 vote-form">
                                        <input type="hidden" name="target_id" value="<?= $a['id'] ?>">
                                        <input type="hidden" name="target_type" value="answer">
                                        <input type="hidden" name="vote_type" value="1">
                                        <button type="submit" class="btn btn-sm btn-light rounded-circle border p-2 w-100">
                                            <i class="fas fa-caret-up fs-5"></i>
                                        </button>
                                    </form>
                                    <span id="score-answer-<?= $a['id'] ?>" class="fw-bold d-block"><?= $a['votes'] ?? 0 ?></span>
                                    <form action="/vote" method="POST" class="mt-1 vote-form">
                                        <input type="hidden" name="target_id" value="<?= $a['id'] ?>">
                                        <input type="hidden" name="target_type" value="answer">
                                        <input type="hidden" name="vote_type" value="-1">
                                        <button type="submit" class="btn btn-sm btn-light rounded-circle border p-2 w-100">
                                            <i class="fas fa-caret-down fs-5"></i>
                                        </button>
                                    </form>
                                    <?php if ($a['is_accepted']): ?>
                                        <div class="text-success mt-2" title="Accepted Answer">
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        </div>
                                    <?php elseif (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $question['user_id']): ?>
                                        <form action="/answers/<?= $a['id'] ?>/accept" method="POST" class="mt-2">
                                            <button type="submit" class="btn btn-sm btn-outline-success rounded-pill px-2 py-0" title="Accept this answer">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="answer-body mb-4">
                                        <?= nl2br(htmlspecialchars($a['explanation'])) ?>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="d-flex gap-2 align-items-center">
                                            <button class="text-muted text-decoration-none border-0 bg-transparent smaller p-0 hover-primary fw-bold" onclick="document.getElementById('comment-box-<?= $a['id'] ?>').classList.toggle('d-none')">
                                                <i class="fas fa-reply me-1"></i> Reply
                                            </button>
                                            
                                            <?php if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $a['user_id'] || $_SESSION['user_role'] === 'admin')): ?>
                                                <span class="text-muted mx-1">|</span>
                                                <div class="dropdown">
                                                    <button class="text-muted text-decoration-none border-0 bg-transparent smaller p-0 hover-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownAnswer<?= $a['id'] ?>">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-start shadow border-0 rounded-3" aria-labelledby="dropdownAnswer<?= $a['id'] ?>">
                                                        <li><a class="dropdown-item text-secondary smaller" href="/answers/<?= $a['id'] ?>/edit"><i class="fas fa-edit me-2"></i> Edit Answer</a></li>
                                                        <li>
                                                            <form action="/answers/<?= $a['id'] ?>/delete" method="POST" class="d-inline">
                                                                <button type="submit" class="dropdown-item text-danger smaller border-0 bg-transparent" onclick="return confirm('Delete this answer?');"><i class="fas fa-trash-alt me-2"></i> Delete Answer</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="author-card p-2 bg-light rounded-3 d-inline-flex align-items-center ms-auto">
                                            <div class="smaller me-3 text-end">
                                                <span class="text-muted d-block opacity-75">answered <?= date('M d, Y', strtotime($a['created_at'])) ?></span>
                                                <span class="fw-bold text-dark"><?= htmlspecialchars($a['user_name'] ?? $a['username']) ?></span>
                                            </div>
                                            <div class="avatar-sm bg-white border rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user-circle text-primary"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Answer Comments -->
                                    <div class="answer-comments mt-3 ps-3 border-start border-2 border-primary-subtle">
                                        <?php if (!empty($answerComments[$a['id']])): ?>
                                            <div class="d-flex flex-column gap-2 mb-3">
                                            <?php foreach ($answerComments[$a['id']] as $ac): ?>
                                                <div class="ac-item bg-light p-2 rounded-2 position-relative">
                                                    <span class="text-dark fw-bold" style="font-size: 0.75rem;"><?= htmlspecialchars($ac['user_name']) ?>:</span> 
                                                    <span class="text-secondary" style="font-size: 0.8rem;"><?= htmlspecialchars($ac['content']) ?></span>
                                                    <span class="text-muted ms-2" style="font-size: 0.6rem;"><?= date('M d, H:i', strtotime($ac['created_at'])) ?></span>
                                                    
                                                    <?php if(isset($_SESSION['user_id']) && ($_SESSION['user_id'] == $ac['user_id'] || $_SESSION['user_role'] === 'admin')): ?>
                                                        <form action="/comments/<?= $ac['id'] ?>/delete" method="POST" class="d-inline position-absolute" style="right: 5px; top: 5px;">
                                                            <button type="submit" class="btn btn-sm text-danger p-0 border-0 bg-transparent hover-up-sm" title="Delete"><i class="fas fa-times"></i></button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if(isset($_SESSION['user_id'])): ?>
                                            <div id="comment-box-<?= $a['id'] ?>" class="d-none mt-2">
                                                <form action="/comments/store" method="POST" class="d-flex gap-2">
                                                    <input type="hidden" name="target_id" value="<?= $a['id'] ?>">
                                                    <input type="hidden" name="target_type" value="answer">
                                                    <input type="text" name="content" class="form-control form-control-sm rounded-pill bg-light border-0 px-3" placeholder="Write a reply..." required>
                                                    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">Reply</button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- New Answer Form -->
            <div class="new-answer-form mt-5">
                <h4 class="fw-bold mb-4">Your Answer</h4>
                <div class="q-card border shadow-sm p-4 rounded-4 bg-white">
                    <form action="/answers/store" method="POST">
                        <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                        <div class="mb-4">
                            <textarea name="explanation" class="form-control border-0 bg-light p-3 rounded-4" rows="8" placeholder="Type your answer here..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="smaller text-muted mb-0"><i class="fas fa-info-circle me-1"></i> Make sure to provide a detailed explanation.</p>
                            <button type="submit" class="btn-q border-0">Post your answer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-4">
            <div class="sticky-top" style="top: 100px;">
                <div class="q-card p-4 border rounded-4 bg-white shadow-sm mb-4">
                    <h5 class="fw-bold mb-3">Community Insights</h5>
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted smaller">Active discussions</span>
                            <span class="badge rounded-pill bg-primary px-3">12</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted smaller">Average response time</span>
                            <span class="text-dark fw-bold smaller">24 mins</span>
                        </div>
                    </div>
                </div>
                
                <div class="q-card p-4 border rounded-4 bg-gradient-light shadow-sm mb-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-lightbulb text-warning me-2"></i> How to Answer?</h5>
                    <ul class="text-secondary smaller ps-3 mb-0">
                        <li class="mb-2">Ensure your answer is direct and relevant.</li>
                        <li class="mb-2">Include code snippets if applicable.</li>
                        <li class="mb-2">Cite your sources or share your personal experiences.</li>
                        <li>Avoid jargon or overly complex language.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-light {
        background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
    }
    .smaller { font-size: 0.8rem; }
    .leading-relaxed { line-height: 1.7; }
    .leading-normal { line-height: 1.5; }
    .hover-up:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important; }
    .hover-up-sm:hover { transform: translateY(-1px); }
    .hover-primary:hover { color: var(--accent) !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // AJAX Voting Logic
    document.querySelectorAll('.vote-form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const btn = form.querySelector('button');
            const originalHtml = btn.innerHTML;
            
            // Add loading state
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            btn.disabled = true;
            
            const formData = new FormData(form);
            formData.append('ajax', '1');
            
            const targetId = formData.get('target_id');
            const targetType = formData.get('target_type');
            
            try {
                const res = await fetch('/vote', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                
                if (data.success) {
                    // Update score in UI with animation
                    const scoreSpan = document.getElementById(`score-${targetType}-${targetId}`);
                    if (scoreSpan) {
                        scoreSpan.style.transition = 'all 0.3s ease';
                        scoreSpan.style.transform = 'scale(1.4)';
                        scoreSpan.style.color = 'var(--accent-d)';
                        scoreSpan.innerText = data.new_score;
                        setTimeout(() => {
                            scoreSpan.style.transform = 'scale(1)';
                            scoreSpan.style.color = '';
                        }, 300);
                    }
                } else {
                    if (data.message === 'Unauthorized') {
                        // Redirect to login or show toast
                        window.location.href = '/login';
                    } else {
                        // Flash message simulator for errors
                        alert(data.message || 'Action failed.');
                    }
                }
            } catch (err) {
                console.error('Vote err:', err);
            } finally {
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            }
        });
    });
});
</script>
