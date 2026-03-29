<?php
// Modernized Leaderboard Reports
?>

<div class="row g-4 reveal">
    <div class="col-12 col-lg-8">
        <div class="form-wrapper shadow-sm border-0 h-100 p-5">
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="rounded-circle d-flex align-items-center justify-content-center border shadow-sm" style="width:52px; height:52px; background:rgba(var(--accent-rgb), 0.05); color:var(--accent)">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div>
                   <h4 class="fw-800 text-dark mb-0">Reputation Audit</h4>
                   <p class="text-secondary small mb-0">Detailed breakdown of how your points were calculated across the community.</p>
                </div>
            </div>

            <div class="list-group-modern">
                <?php 
                $auditItems = [
                    ['title' => 'Contribution reward: +150 reputation', 'desc' => 'Your answer was marked as accepted on "PHP Namespaces"', 'time' => '10 min ago'],
                    ['title' => 'Daily Login Bonus: +5 reputation', 'desc' => 'Platform activity reward for today', 'time' => '1 hr ago'],
                    ['title' => 'Vote quality bonus: +25 reputation', 'desc' => 'Your votes were corroborated by expert members', 'time' => '3 hrs ago']
                ];
                foreach ($auditItems as $item): 
                ?>
                    <div class="list-item d-flex align-items-center justify-content-between p-4 border rounded-4 mb-3 transition-hover shadow-sm bg-white">
                        <div class="d-flex align-items-start gap-4">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-muted border shadow-sm" style="width:36px; height:36px; flex-shrink:0">
                                <i class="fas fa-plus small text-success"></i>
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

            <div class="mt-5 p-4 rounded-4 bg-light border-dashed text-center">
                <p class="text-muted smaller mb-3 fw-700">Audit logs are kept for 12 months for compliance and fairness.</p>
                <button class="btn btn-q-ol rounded-pill px-5 fw-800 py-3 smaller">Export Detailed Log</button>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-4">
        <div class="q-card hover-elevate-card bg-white border-0 shadow-sm p-4 h-100">
            <h6 class="fw-800 small text-uppercase mb-4 opacity-75">Reputation Breakdown</h6>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px">
                       <i class="fas fa-check small"></i>
                    </div>
                    <div>
                       <span class="fw-800 text-dark small d-block">Answers (+5.2k)</span>
                       <span class="text-muted smaller">62% of total rep</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border">
                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px">
                       <i class="fas fa-question small"></i>
                    </div>
                    <div>
                       <span class="fw-800 text-dark small d-block">Questions (+2.1k)</span>
                       <span class="text-muted smaller">25% of total rep</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 border">
                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px">
                       <i class="fas fa-thumbs-up small"></i>
                    </div>
                    <div>
                       <span class="fw-800 text-dark small d-block">Votes (+1.1k)</span>
                       <span class="text-muted smaller">13% of total rep</span>
                    </div>
                </div>
            </div>
            
            <div class="mt-5 p-4 rounded-4 shadow-sm border text-center bg-dark text-white">
                <div class="badge bg-white shadow-sm text-dark px-3 py-1 fw-800 rounded-pill mb-2" style="font-size:0.6rem">PLATINUM</div>
                <h6 class="fw-800 mb-1">Elite Contributor</h6>
                <p class="smaller mb-0 opacity-75">You are in the top 5% of all users globally.</p>
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
