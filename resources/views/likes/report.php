<?php
// Modernized Likes Report
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(236, 72, 153, 0.05); color:#ec4899">
                    <i class="fas fa-heart"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Engagement Audit</h4>
                   <p class="text-secondary small mb-0">Detailed breakdown of all likes, shares, and stars received on your posts.</p>
                </div>
            </div>

            <div class="list-group-modern">
                <?php 
                $auditItems = [
                    ['title' => 'New like received on "PHP Closures"', 'desc' => 'Verified user John Doe upvoted your content', 'time' => '2 min ago'],
                    ['title' => 'Engagement Bonus: +10 Reputation', 'desc' => 'Content quality reward for reaching 50+ likes', 'time' => '1 hr ago'],
                    ['title' => 'Global Share reached 100 mark', 'desc' => 'Your discussion is being shared across community groups', 'time' => '3 hrs ago']
                ];
                foreach ($auditItems as $item): 
                ?>
                    <div class="list-item d-flex align-items-center justify-content-between p-4 border rounded-4 mb-3 transition-hover shadow-sm bg-white">
                        <div class="d-flex align-items-start gap-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-pink border shadow-sm" style="width:36px; height:36px; flex-shrink:0">
                                <i class="fas fa-heart small"></i>
                            </div>
                            <div>
                                <h6 class="fw-800 text-dark mb-1 small"><?= htmlspecialchars($item['title']) ?></h6>
                                <p class="smaller text-muted mb-0"><?= htmlspecialchars($item['desc']) ?></p>
                            </div>
                        </div>
                        <span class="smaller text-muted fw-700"><?= $item['time'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="mt-5 p-5 text-center bg-light border-dashed rounded-4">
                <p class="text-muted smaller mb-4 fw-800 opacity-50">Audit logs provide transparency on your community reputation.</p>
                <button class="btn btn-q-ol rounded-pill px-5 fw-800 py-3 smaller shadow-sm mb-2">Export Audit Trail</button>
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
