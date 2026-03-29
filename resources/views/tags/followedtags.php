<?php
// Modernized Followed Tags View
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center justify-content-between mb-5">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div>
                       <h4 class="fw-800 text-dark mb-0">Followed Topics</h4>
                       <p class="text-secondary small mb-0">Customizing your feed preferences based on these tags.</p>
                    </div>
                </div>
                <button class="btn btn-q rounded-pill px-4 btn-sm fw-800 shadow-sm py-2">Add New Tag</button>
            </div>

            <div class="list-group-modern">
                <?php if (empty($tags)): ?>
                    <div class="text-center py-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-4" style="width: 120px; height: 120px;">
                            <i class="fas fa-tags text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
                        </div>
                        <h5 class="fw-bolder text-dark mb-2">No Followed Tags Yet</h5>
                        <p class="text-secondary mb-4" style="max-width: 400px; margin: 0 auto;">
                            Start following tags to customize your feed and stay updated on topics that interest you.
                        </p>
                        <a href="/dashboard/tags" class="btn btn-primary rounded-pill px-4">Browse Tags</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($tags as $tag): ?>
                        <div class="list-item d-flex align-items-center justify-content-between p-4 border rounded-4 mb-3 transition-hover shadow-sm bg-white">
                            <div class="d-flex align-items-center gap-4">
                                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:40px; height:40px; background:rgba(255, 255, 255, 0.7); color:#22c55e">
                                    <i class="fas fa-hashtag small mb-0"></i>
                                </div>
                                <div>
                                    <h6 class="fw-800 text-dark mb-0 small">#<?= htmlspecialchars($tag['name']) ?></h6>
                                    <span class="smaller text-success fw-bolder"><?= (int)($tag['count'] ?? 0) ?> questions</span>
                                    <?php if (isset($tag['followed_date'])): ?>
                                        <span class="smaller text-muted ms-2">Followed <?= htmlspecialchars($tag['followed_date']) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                               <button class="btn btn-outline-danger btn-xs rounded-pill px-3 py-2 fw-800 unfollow-btn" 
                                       data-tag-id="<?= $tag['id'] ?>">
                                   Unfollow
                               </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <div class="mt-5 text-center p-4 border rounded-4 bg-light border-dashed">
                <p class="text-muted smaller mb-0 fw-700">More tags means a more personalized experience.</p>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">Feed Analysis</h6>
            <div class="p-4 rounded-4 shadow-sm border mb-4 text-center bg-info-subtle border-info-subtle position-relative overflow-hidden">
                <i class="fas fa-chart-pie text-info mb-2 opacity-50" style="font-size:3.5rem; position:absolute; bottom:-10px; right:-10px"></i>
                <h6 class="fw-800 text-info mb-1">Top Coverage</h6>
                <p class="text-info smaller mb-0 fw-bold">Laravel is your #1 topic</p>
            </div>
            
            <div class="mt-4">
                <h6 class="fw-800 small text-uppercase mb-3 opacity-75">Related Recommendations</h6>
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border mb-2">
                    <span class="rounded-circle bg-white border shadow-sm d-flex align-items-center justify-content-center" style="width:32px; height:32px">
                       <i class="fas fa-plus text-primary smaller"></i>
                    </span>
                    <div>
                       <span class="fw-800 small text-dark d-block">#PostgreSQL</span>
                       <span class="text-muted smaller">85% match with PHP</span>
                    </div>
                </div>
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

    // Handle unfollow button clicks
    document.querySelectorAll('.unfollow-btn').forEach(button => {
        button.addEventListener('click', async function() {
            const tagId = this.getAttribute('data-tag-id');
            const listItem = this.closest('.list-item');
            
            try {
                const response = await fetch(`/tags/${tagId}/unfollow`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Remove the tag from the list with animation
                    listItem.style.transition = 'all 0.3s ease';
                    listItem.style.opacity = '0';
                    listItem.style.transform = 'translateX(-20px)';
                    
                    setTimeout(() => {
                        listItem.remove();
                        
                        // Check if no tags left
                        const remainingItems = document.querySelectorAll('.list-item');
                        if (remainingItems.length === 0) {
                            location.reload(); // Reload to show empty state
                        }
                    }, 300);
                } else {
                    alert(result.message || 'An error occurred');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred while processing your request');
            }
        });
    });
});
</script>
