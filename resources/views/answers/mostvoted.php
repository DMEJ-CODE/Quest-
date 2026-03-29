<?php
// Modernized Most Voted Answers View
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-10 mx-auto">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5 pt-2">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:48px; height:48px; background:rgba(239, 158, 11, 0.05); color:#f59e0b">
                    <i class="fas fa-fire"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Trending Solutions</h4>
                   <p class="text-secondary small mb-0">Discover the most helpful answers across all categories this week.</p>
                </div>
            </div>

            <div class="list-group-modern pt-3">
                <!-- Answer row -->
                <?php 
                $vAns = [
                    ['title' => 'Why is 0.1 + 0.2 not 0.3 in JS?', 'snippet' => 'It boils down to how floating point numbers are handled by binary computers (IEEE 754)...', 'votes' => 1240, 'accepted' => true, 'time' => '10 min ago'],
                    ['title' => 'Docker vs Podman in 2026', 'snippet' => 'Podman is gaining massive traction due to rootless execution and daemon-less mode...', 'votes' => 980, 'accepted' => false, 'time' => '1 hr ago'],
                    ['title' => 'React 19 vs Next.js Server Actions', 'snippet' => 'The biggest shift is move toward server-only logic while keeping client state hydrated...', 'votes' => 842, 'accepted' => true, 'time' => '3 hrs ago']
                ];
                foreach ($vAns as $ans): 
                ?>
                    <div class="list-item d-flex align-items-start gap-4 p-4 border rounded-4 mb-4 transition-hover shadow-sm bg-white">
                        <div class="d-flex flex-column align-items-center gap-1" style="min-width:60px">
                           <div class="rounded-pill bg-warning text-white fw-800 px-3 py-1 smaller shadow-sm border-0"><?= $ans['votes'] ?></div>
                           <span class="text-muted smaller fw-bolder mt-1" style="font-size:0.6rem">SCORE</span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-800 text-dark mb-0 small text-truncate" style="max-width:320px"><?= htmlspecialchars($ans['title']) ?></h6>
                                <?php if($ans['accepted']): ?>
                                    <span class="badge bg-soft-accent text-accent fw-800 rounded-pill px-2 py-1 smaller" style="font-size:0.5rem"><i class="fas fa-award me-1"></i> TOP SOLUTION</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-secondary smaller mb-3 text-truncate"><?= htmlspecialchars($ans['snippet']) ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                               <div class="d-flex gap-3 align-items-center">
                                  <div class="user-av sm">AM</div>
                                  <span class="smaller text-muted fw-700">Alice Michael</span>
                               </div>
                               <button class="btn btn-q rounded-pill px-4 btn-xs fw-800 smaller">View Topic</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
