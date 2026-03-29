<?php
// Modernized Popular Tags View
?>

<div class="row g-4 reveal">
    <?php 
    if (empty($tags)):
    ?>
        <div class="col-12 py-5 text-center">
            <h5 class="text-secondary">No popular tags found.</h5>
        </div>
    <?php 
    else:
        foreach ($tags as $pt): 
            $colors = ['#ff2d20', '#f7df1e', '#777bb4', '#61dafb', '#3776ab', '#4479a1', '#42b883', '#2496ed'];
            $color = $colors[array_rand($colors)];
    ?>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 text-center transition-hover h-100">
            <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm mx-auto mb-3" style="width:60px; height:60px; background:rgba(255, 255, 255, 0.7); color:<?= $color ?>">
                <i class="fas fa-hashtag h4 mb-0"></i>
            </div>
            <h6 class="fw-800 text-dark mb-1">#<?= htmlspecialchars($pt['name']) ?></h6>
            <p class="text-muted smaller fw-700 mb-3"><?= $pt['count'] ?? 0 ?> discussions</p>
            <a href="/questions/tagged/<?= urlencode($pt['name']) ?>" class="btn btn-q-ol rounded-pill px-4 btn-sm fw-800 border-2">Explore Feed</a>
        </div>
    </div>
    <?php endforeach; endif; ?>
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
