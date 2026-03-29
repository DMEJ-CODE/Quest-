<!-- Total Engagement & Activity Section -->
<div class="row g-4 mb-5">
  <!-- Total Engagement Card -->
  <div class="col-12 col-xl-7 reveal" style="animation-delay: 0.15s;">
    <div class="q-card hover-elevate-card bg-white p-4 p-sm-5" style="border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 10px 40px rgba(0,0,0,0.02); min-height: 420px;">
      
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
           <h4 class="fw-bolder text-dark mb-1" style="letter-spacing: -0.02em;">Total Engagement</h4>
           <p class="text-secondary mb-0" style="font-size: 0.85rem; font-weight: 500;">Monitor activity trends across the platform.</p>
        </div>
        <div class="dropdown">
           <button class="btn btn-light rounded-pill border-0 px-3 py-2 fw-bold text-secondary" style="font-size: 0.75rem;">
              Overall Stats <i class="fas fa-chart-line ms-2" style="font-size: 0.6rem;"></i>
           </button>
        </div>
      </div>

      <?php 
        $totalEng = 0;
        if (!empty($engagementData)) {
            foreach ($engagementData as $item) $totalEng += $item['value'];
        }
        $displayEng = $totalEng > 0 ? number_format($totalEng) : '2,840';
      ?>
      <div class="d-flex align-items-center gap-4 mb-4">
        <h2 class="fw-bolder text-dark mb-0" style="font-size: 3.5rem; letter-spacing: -0.05em;"><?= $displayEng ?></h2>
        <div class="badge rounded-pill bg-success-subtle text-success px-3 py-2 fw-bold" style="font-size: 0.9rem;">
           <i class="fas fa-arrow-up me-1"></i> 14.2%
        </div>
      </div>

      <!-- Segmented Activity Bar (Data-Driven) -->
      <div class="mb-5">
        <div class="d-flex justify-content-between mb-2">
           <span class="text-secondary fw-bold" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Engagement History</span>
           <span class="text-dark fw-bold" style="font-size: 0.8rem;">Last 12 active months</span>
        </div>
        <div class="progress shadow-sm" style="height: 12px; border-radius: 100px; background: #f1f5f9; overflow: hidden;">
            <?php if (!empty($engagementData)): 
                $maxVal = max(array_column($engagementData, 'value'));
                $colors = ['var(--accent)', '#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b'];
                foreach ($engagementData as $i => $item):
                    $width = ($item['value'] / $totalEng) * 100;
                    $color = $colors[$i % count($colors)];
            ?>
                <div class="progress-bar" role="progressbar" style="width: <?= $width ?>%; background: <?= $color ?>;" aria-valuenow="<?= $width ?>" aria-valuemin="0" aria-valuemax="100"></div>
            <?php endforeach; else: ?>
                <div class="progress-bar" role="progressbar" style="width: 100%; background: var(--accent);" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            <?php endif; ?>
        </div>
      </div>

      <!-- Metric Details Grid -->
      <div class="row g-4">
        <?php 
          $metrics = [
            ['label' => 'Questions', 'val' => $statsData[0]['value'], 'color' => 'var(--accent)'],
            ['label' => 'Answers', 'val' => $statsData[1]['value'], 'color' => '#3b82f6'],
            ['label' => 'Reputation', 'val' => $statsData[2]['value'], 'color' => '#8b5cf6'],
            ['label' => 'Members', 'val' => $statsData[3]['value'], 'color' => '#ec4899']
          ];
          foreach ($metrics as $m):
        ?>
        <div class="col-6 col-md-3">
           <div class="d-flex align-items-center gap-2 mb-2">
              <div class="rounded-circle" style="width: 8px; height: 8px; background: <?= $m['color'] ?>;"></div>
              <span class="text-secondary fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.05em;"><?= $m['label'] ?></span>
           </div>
           <div class="h5 fw-bolder text-dark mb-0"><?= $m['val'] ?></div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>

  <!-- Active Users / Demographics Card -->
  <div class="col-12 col-xl-5 reveal" style="animation-delay: 0.2s;">
    <div class="q-card hover-elevate-card bg-white p-4 p-sm-5" style="border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 10px 40px rgba(0,0,0,0.02); height: 100%;">
      
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bolder text-dark mb-0" style="letter-spacing: -0.02em;">Community Reach</h4>
        <a href="/dashboard/members" class="text-decoration-none fw-bold" style="color: var(--accent); font-size: 0.85rem;">Manage Members</a>
      </div>

      <div class="mb-5">
         <div class="h1 fw-bolder text-dark mb-1" style="font-size: 2.8rem; letter-spacing: -0.04em;"><?= $statsData[3]['value'] ?></div>
         <p class="text-secondary fw-bold" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em;">Active thinkers in our community</p>
      </div>

      <div class="d-flex flex-column gap-4">
        <!-- Growth Indicator -->
        <div class="p-4 rounded-4" style="background: rgba(var(--accent-rgb), 0.05); border: 1px dashed var(--accent);">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center bg-white shadow-sm" style="width: 48px; height: 48px; color: var(--accent);">
                    <i class="fas fa-rocket"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark">Platform Growth</div>
                    <div class="text-secondary small">Your community is growing steadily this month.</div>
                </div>
            </div>
        </div>
        
        <div class="mt-2">
            <h6 class="fw-bold text-dark mb-3 small text-uppercase" style="letter-spacing: 0.05em;">Resource Usage</h6>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary small fw-bold">Success Rate</span>
                    <span class="fw-bold text-dark small">92%</span>
                </div>
                <div class="progress" style="height: 6px; background: #f1f5f9;">
                    <div class="progress-bar bg-success" style="width: 92%;"></div>
                </div>
            </div>
        </div>
      </div>

    </div>
  </div>
</div>
