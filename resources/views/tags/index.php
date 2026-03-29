<div class="page-nav d-flex gap-2 flex-wrap mb-5">
    <a href="/dashboard/tags" class="btn btn-primary btn-sm px-4 rounded-pill">All Topics</a>
    <a href="/dashboard/tags/popular" class="btn btn-outline-primary btn-sm px-4 rounded-pill">Popular</a>
    <a href="/dashboard/tags/followed" class="btn btn-outline-primary btn-sm px-4 rounded-pill">Followed</a>
    <?php if($isAdmin): ?>
        <a href="/dashboard/tags/manage" class="btn btn-light btn-sm px-4 rounded-pill border ms-md-auto fw-800 text-secondary">
            <i class="fas fa-cog me-1"></i> Tag Management
        </a>
    <?php endif; ?>
</div>

<div class="row g-4 reveal" style="animation-delay: 0.1s;">
    <?php if(empty($tags)): ?>
        <div class="col-12 py-5 my-5 text-center">
            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-4" style="width: 120px; height: 120px;">
                <i class="fas fa-tags text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
            </div>
            <h3 class="fw-bolder text-dark mb-2" style="letter-spacing: -0.02em;">No Tags Built</h3>
            <p class="text-secondary mx-auto" style="max-width: 400px; font-size: 0.95rem;">
                Be the first to create tags when you ask a question. Tags help organize and connect members around specific topics.
            </p>
        </div>
    <?php else: ?>
        <?php foreach($tags as $tag): ?>
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="q-card hover-elevate-card bg-white position-relative overflow-hidden h-100 p-4" style="border-radius: 24px; border: 1px solid rgba(0,0,0,0.04); box-shadow: 0 4px 20px rgba(0,0,0,0.03); transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);">
                
                <!-- Background Decoration -->
                <div class="position-absolute" style="top: -20px; right: -20px; font-size: 6rem; opacity: 0.02; transform: rotate(15deg); pointer-events: none;">
                    <i class="fas fa-hashtag"></i>
                </div>

                <div class="d-flex flex-column h-100 position-relative z-1">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; background: linear-gradient(135deg, var(--g100), var(--g300)); color: var(--g800); font-size: 1.25rem;">
                            <i class="fas fa-hashtag"></i>
                        </div>
                        <button class="btn btn-sm btn-light rounded-pill border-0 text-secondary hover-text-primary px-3 follow-btn" 
                                style="font-weight: 700; font-size: 0.75rem;" 
                                data-tag-id="<?= $tag['id'] ?>" 
                                data-following="false">
                            Follow
                        </button>
                    </div>

                    <h4 class="fw-bolder text-dark mb-2" style="letter-spacing: -0.02em;">
                        <?= htmlspecialchars($tag['name']) ?>
                    </h4>
                    
                    <p class="text-secondary mb-4 line-clamp-3" style="font-size: 0.85rem; line-height: 1.5; opacity: 0.8;">
                        <?= htmlspecialchars($tag['description'] ?? 'This topic currently has no description. Join the discussion to shape it.') ?>
                    </p>

                    <div class="mt-auto d-flex justify-content-between align-items-center pt-3 border-top" style="border-color: rgba(0,0,0,0.04) !important;">
                        <span class="text-dark fw-bold" style="font-size: 0.85rem;">
                            <i class="fas fa-cubes text-muted me-1"></i> <?= (int)($tag['count'] ?? 0) ?> <span class="text-secondary fw-normal">Items</span>
                        </span>
                        <?php if($isAdmin): ?>
                            <form action="/dashboard/tags/delete" method="POST" class="m-0" onsubmit="return confirm('Delete this tag permanently?');">
                                <input type="hidden" name="tag_id" value="<?= $tag['id'] ?>">
                                <button type="submit" class="btn btn-light rounded-circle text-danger hover-btn-danger d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; border: none;" title="Delete Tag">
                                    <i class="fas fa-trash-alt p-0 m-0" style="font-size: 0.8rem;"></i>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>
    .hover-elevate-card:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 15px 35px rgba(34, 197, 94, 0.08) !important; 
        border-color: rgba(34, 197, 94, 0.2) !important;
    }
    
    .hover-text-primary:hover { color: var(--g700) !important; background: var(--g100) !important; }
    .hover-btn-danger:hover { background: #fee2e2 !important; color: #dc2626 !important; transform: scale(1.1); transition: all 0.2s; }
    
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-clamp: 3; }
    
    .reveal { opacity: 0; transform: translateY(20px); animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle follow/unfollow button clicks
    document.querySelectorAll('.follow-btn').forEach(button => {
        button.addEventListener('click', async function() {
            const tagId = this.getAttribute('data-tag-id');
            const isFollowing = this.getAttribute('data-following') === 'true';
            const action = isFollowing ? 'unfollow' : 'follow';
            
            try {
                const response = await fetch(`/tags/${tagId}/${action}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Toggle button state
                    this.setAttribute('data-following', !isFollowing);
                    this.textContent = isFollowing ? 'Follow' : 'Following';
                    this.classList.toggle('btn-primary', !isFollowing);
                    this.classList.toggle('btn-light', isFollowing);
                    this.classList.toggle('text-white', !isFollowing);
                    this.classList.toggle('text-secondary', isFollowing);
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
