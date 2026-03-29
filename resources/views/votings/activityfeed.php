<?php
// Mock data if none passed
$activities = $activities ?? [];
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8 mx-auto">
        <div class="timeline-container ps-4 border-start border-light position-relative">
            <?php if (empty($activities)): ?>
                <div class="text-center py-5">
                    <div class="p-4 rounded-circle bg-light d-inline-flex mb-3">
                        <i class="fas fa-stream text-muted" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                    <h5 class="fw-800 text-muted">No activity recorded</h5>
                    <p class="text-secondary small">Your community's latest actions will appear here shortly.</p>
                </div>
            <?php else: foreach ($activities as $act): 
                $isQ = ($act['type'] == 'question');
                $icon = $isQ ? 'fa-question-circle text-accent' : 'fa-reply text-success';
                $label = $isQ ? 'New Question' : 'New Answer';
                $initials = 'U'; // Default
            ?>
            <div class="timeline-item mb-5 position-relative">
                <!-- Premium Timeline Dot -->
                <div class="timeline-dot position-absolute d-flex align-items-center justify-content-center" 
                     style="left: -38px; top: 0; width: 32px; height: 32px; z-index: 10;">
                    <div class="bg-white border rounded-circle shadow-sm p-1 d-flex align-items-center justify-content-center" style="width:100%; height:100%;">
                        <div class="rounded-circle <?= $isQ ? 'bg-accent' : 'bg-success' ?>" style="width: 8px; height: 8px; box-shadow: 0 0 8px <?= $isQ ? 'var(--accent)' : '#16a34a' ?>"></div>
                    </div>
                </div>
                
                <div class="q-card p-4 border-0 shadow-sm rounded-4 bg-white reveal transition-hover">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-av sm" style="width:36px; height:36px; font-size:0.7rem; background: linear-gradient(135deg, var(--g400), var(--g700)); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800;">
                                <?= $initials ?>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge <?= $isQ ? 'bg-soft-accent text-accent' : 'bg-success-subtle text-success' ?> rounded-pill px-3 py-1 fw-800" style="font-size: 0.65rem;">
                                       <i class="fas <?= $icon ?> me-1"></i> <?= $label ?>
                                    </span>
                                </div>
                                <span class="text-muted text-uppercase fw-800 opacity-75" style="font-size: 0.65rem; letter-spacing: 0.05em;">
                                    <i class="far fa-clock me-1"></i> <?= date('H:i', strtotime($act['created_at'])) ?> &bull; <?= date('d M Y', strtotime($act['created_at'])) ?>
                                </span>
                            </div>
                        </div>
                        <div class="smaller text-muted fw-700 opacity-50">#ACT-<?= $act['id'] ?></div>
                    </div>
                    
                    <h6 class="fw-800 text-dark mb-3 px-1" style="line-height: 1.5; font-size: 0.95rem;">
                        <?= htmlspecialchars(substr($act['content'], 0, 180)) . (strlen($act['content']) > 180 ? '...' : '') ?>
                    </h6>
                    
                    <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top border-light">
                        <div class="d-flex gap-2">
                           <?php if($isQ): ?>
                               <span class="text-xs text-muted fw-700 px-2 py-1 bg-light rounded-pill"><i class="fas fa-tag me-1"></i> Technology</span>
                           <?php else: ?>
                               <span class="text-xs text-muted fw-700 px-2 py-1 bg-light rounded-pill"><i class="fas fa-check-circle me-1"></i> Verified</span>
                           <?php endif; ?>
                        </div>
                        <a href="<?= $isQ ? '/questions/'.$act['id'] : '/questions' ?>" class="btn-xs rounded-pill px-3 py-2 fw-800 text-decoration-none">
                            View Thread <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>

<style>
    .bg-soft-accent { background: rgba(var(--accent-rgb, 34, 197, 94), 0.08); }
    .bg-success-subtle { background: rgba(34, 197, 94, 0.08); color: #16a34a !important; }
    .fw-800 { font-weight: 800; }
    .fw-700 { font-weight: 700; }
    .text-xs { font-size: 0.72rem; }
    .transition-hover { transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.08) !important; border-color: var(--accent) !important; }
    
    .timeline-container::before {
        content: '';
        position: absolute;
        left: 2px;
        top: 0;
        bottom: 0;
        width: 1px;
        background: linear-gradient(to bottom, transparent, var(--bdr) 10%, var(--bdr) 90%, transparent);
        z-index: 1;
    }
</style>

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
