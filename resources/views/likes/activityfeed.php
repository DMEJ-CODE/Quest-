<?php
// Modernized Likes Activity Feed
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="timeline-container ps-4 border-start border-light position-relative">
            <?php 
            $likeActivities = [
                ['user' => 'JD', 'name' => 'John Doe', 'action' => 'liked your answer on', 'topic' => 'CSS Flexbox Guide', 'time' => '10 min ago'],
                ['user' => 'AM', 'name' => 'Alice Mayer', 'action' => 'starred your question on', 'topic' => 'Laravel APIs', 'time' => '1 hr ago'],
                ['user' => 'RK', 'name' => 'Rick King', 'action' => 'upvoted your repo on', 'topic' => 'Python Analytics', 'time' => '3 hrs ago']
            ];
            foreach ($likeActivities as $act): 
            ?>
            <div class="timeline-item mb-5 position-relative">
                <div class="timeline-dot position-absolute d-flex align-items-center justify-content-center" 
                     style="left: -38px; top: 0; width: 32px; height: 32px; z-index: 10;">
                    <div class="bg-white border rounded-circle shadow-sm p-1 d-flex align-items-center justify-content-center" style="width:100%; height:100%;">
                        <div class="rounded-circle bg-pink" style="width: 8px; height: 8px; box-shadow: 0 0 8px #ec4899; background:#ec4899"></div>
                    </div>
                </div>
                
                <div class="q-card p-4 border-0 shadow-sm rounded-4 bg-white reveal transition-hover">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-av sm bg-info shadow-sm text-white fw-800" style="width:36px; height:36px; font-size:0.7rem;">
                                <?= $act['user'] ?>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-800 text-dark small"><?= htmlspecialchars($act['name']) ?></span>
                                    <span class="badge bg-soft-accent text-accent fw-800 rounded-pill px-2 py-1 smaller" style="font-size:0.5rem">NEW ENGAGEMENT</span>
                                </div>
                                <span class="text-muted smaller fw-700 opacity-75">
                                    <i class="far fa-clock me-1"></i> <?= $act['time'] ?>
                                </span>
                            </div>
                        </div>
                        <i class="fas fa-heart text-pink h5 mb-0 opacity-50"></i>
                    </div>
                    
                    <h6 class="fw-800 text-dark mb-3 px-1" style="line-height: 1.5; font-size: 0.95rem;">
                        <?= htmlspecialchars($act['name']) ?> <?= htmlspecialchars($act['action']) ?> <span class="text-accent">"<?= htmlspecialchars($act['topic']) ?>"</span>
                    </h6>
                    
                    <div class="mt-3 pt-3 border-top border-light d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <span class="text-xs text-muted fw-700 bg-light rounded-pill px-2 py-1 border shadow-xs"><i class="fas fa-eye me-1"></i> 152 Views</span>
                        </div>
                        <a href="/profile/<?= strtolower($act['user']) ?>" class="btn-xs rounded-pill px-3 py-2 fw-800 text-decoration-none bg-light border">
                            View Profile <i class="fas fa-arrow-right ms-1 text-muted smaller"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
.text-pink { color: #ec4899; }
.bg-pink { background: #ec4899; }
.bg-info-subtle { background: #e0f2fe; }
.text-info { color: #0ea5e9; }
</style>

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
