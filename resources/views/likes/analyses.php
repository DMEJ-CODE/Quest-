<?php
// Modernized Likes Analyses View
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(236, 72, 153, 0.05); color:#ec4899">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Engagement Analysis</h4>
                   <p class="text-secondary small mb-0">Deep dive into your content's popularity and user sentiment.</p>
                </div>
            </div>

            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                   <div class="p-3 text-center border rounded-4 bg-light shadow-sm">
                      <div class="h4 fw-800 mb-0">92%</div>
                      <span class="text-muted smaller fw-700 text-uppercase">Positivity</span>
                   </div>
                </div>
                <div class="col-6 col-md-3">
                   <div class="p-3 text-center border rounded-4 bg-light shadow-sm">
                      <div class="h4 fw-800 mb-0">1.2k</div>
                      <span class="text-muted smaller fw-700 text-uppercase">Shares</span>
                   </div>
                </div>
                <div class="col-6 col-md-3">
                   <div class="p-3 text-center border rounded-4 bg-light shadow-sm">
                      <div class="h4 fw-800 mb-0">342</div>
                      <span class="text-muted smaller fw-700 text-uppercase">Saves</span>
                   </div>
                </div>
                <div class="col-6 col-md-3">
                   <div class="p-3 text-center border rounded-4 bg-light shadow-sm">
                      <div class="h4 fw-800 mb-0">15m</div>
                      <span class="text-muted smaller fw-700 text-uppercase">Avg. View</span>
                   </div>
                </div>
            </div>

            <div class="chart-container d-flex align-items-end gap-3" style="height: 250px;">
                <?php 
                for ($i=1; $i<=7; $i++): 
                    $h = rand(40, 200); 
                ?>
                <div class="flex-grow-1 d-flex flex-column align-items-center gap-2">
                    <div class="bar-s bl w-100 rounded-top" style="height: <?= $h ?>px; transition: height 0.8s ease; opacity:0.8" title="<?= $h ?> points"></div>
                    <span class="text-muted fw-800 text-uppercase" style="font-size:0.6rem">Day <?= $i ?></span>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">TOP PERFORMING CONTENT</h6>
            <div class="d-flex flex-column gap-3">
                <div class="p-3 bg-light rounded-4 border mb-2 transition-hover">
                   <h6 class="fw-800 text-dark mb-1 small text-truncate">How to use CSS Grid effectively?</h6>
                   <div class="d-flex justify-content-between align-items-center mt-2">
                      <span class="badge bg-soft-accent text-accent fw-800 rounded-pill" style="font-size:0.6rem">842 LIKES</span>
                      <span class="text-muted smaller fw-700">12 Comments</span>
                   </div>
                </div>
                <div class="p-3 bg-light rounded-4 border mb-2 transition-hover">
                   <h6 class="fw-800 text-dark mb-1 small text-truncate">Laravel 11: What's new in routing?</h6>
                   <div class="d-flex justify-content-between align-items-center mt-2">
                      <span class="badge bg-soft-accent text-accent fw-800 rounded-pill" style="font-size:0.6rem">652 LIKES</span>
                      <span class="text-muted smaller fw-700">8 Comments</span>
                   </div>
                </div>
                <div class="p-3 bg-light rounded-4 border transition-hover">
                   <h6 class="fw-800 text-dark mb-1 small text-truncate">Optimizing Python queries for SQL</h6>
                   <div class="d-flex justify-content-between align-items-center mt-2">
                      <span class="badge bg-soft-accent text-accent fw-800 rounded-pill" style="font-size:0.6rem">125 LIKES</span>
                      <span class="text-muted smaller fw-700">4 Comments</span>
                   </div>
                </div>
            </div>
            
            <button class="btn btn-q w-100 mt-5 rounded-pill py-3 fw-800 shadow-sm">Content Strategy Guide</button>
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
