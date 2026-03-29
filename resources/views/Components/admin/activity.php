<!-- Activity Statistics & Recent Questions Section -->
<div class="row g-4 mb-5">
  <!-- Activity Statistics Card -->
  <div class="col-12 col-xl-7 reveal" style="animation-delay: 0.25s;">
    <div class="q-card hover-elevate-card bg-white p-4 p-sm-5" style="border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 10px 40px rgba(0,0,0,0.02); min-height: 450px;">
      
      <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between mb-5 gap-3">
        <div>
           <h4 class="fw-bolder text-dark mb-1" style="letter-spacing: -0.02em;">Activity Statistics</h4>
           <div class="d-flex align-items-center gap-3 mt-2">
              <div class="d-flex align-items-center gap-2">
                 <div class="rounded-circle" style="width: 10px; height: 10px; background: #e2e8f0;"></div>
                 <span class="text-secondary fw-bold" style="font-size: 0.7rem; text-transform: uppercase;">Engagement Intensity</span>
              </div>
           </div>
        </div>
        <div>
           <select class="form-select form-select-sm border-0 bg-light rounded-pill px-3 py-2 fw-bold text-secondary shadow-none" style="font-size: 0.75rem; cursor: pointer;">
              <option>Full History</option>
           </select>
        </div>
      </div>

      <!-- Dribbble Style Bar Chart (Data-Driven) -->
      <div class="chart-wrapper position-relative" style="height: 220px;">
        <div class="d-flex justify-content-between align-items-end h-100 gap-2 px-2">
           <?php 
           if (!empty($engagementData)):
             $maxVal = max(array_column($engagementData, 'value'));
             foreach($engagementData as $item): 
               $h = ($item['value'] / $maxVal) * 100;
           ?>
           <div class="flex-grow-1 d-flex flex-column align-items-center gap-2 group">
              <div class="position-relative d-flex align-items-end gap-1 w-100 h-100" style="max-width: 30px;">
                 <div class="bar-part transition-all shadow-sm w-100" style="height: <?= $h ?>%; background: var(--accent); border-radius: 6px 6px 0 0; opacity: 0.8;">
                    <div class="position-absolute translate-middle-x start-50 bg-dark text-white rounded px-2 py-1 transition-all opacity-0 group-hover-opacity-100" style="bottom: 110%; font-size: 0.65rem; white-space: nowrap; z-index: 10;">
                       <?= $item['value'] ?> actions
                    </div>
                 </div>
              </div>
              <span class="text-secondary fw-bold" style="font-size: 0.65rem;"><?= $item['label'] ?></span>
           </div>
           <?php endforeach; else: ?>
             <div class="text-center w-100 py-5 text-secondary">No activity data available yet.</div>
           <?php endif; ?>
        </div>
      </div>

    </div>
  </div>

  <!-- Recent Questions Card -->
  <div class="col-12 col-xl-5 reveal" style="animation-delay: 0.3s;">
    <div class="q-card hover-elevate-card bg-white p-4 p-sm-5" style="border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 10px 40px rgba(0,0,0,0.02); height: 100%;">
      
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bolder text-dark mb-0" style="letter-spacing: -0.02em;">Recent Feed</h4>
        <a href="/dashboard/questions" class="btn btn-sm btn-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="View All">
           <i class="fas fa-arrow-right" style="font-size: 0.75rem;"></i>
        </a>
      </div>

      <div class="d-flex flex-column gap-4 activity-feed">
        <?php 
        $questions = $recentQuestions ?? [];
        if (empty($questions)):
        ?>
          <div class="text-center py-5">
            <i class="fas fa-inbox text-muted mb-3" style="font-size: 2rem; opacity: 0.2;"></i>
            <p class="text-secondary small">No recent questions found.</p>
          </div>
        <?php else:
          foreach ($questions as $i => $q): 
            $colors = ['var(--accent)', '#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b'];
            $color = $colors[$i % count($colors)];
        ?>
        <div class="d-flex align-items-start gap-3 p-2 hover-bg-light transition-all rounded-4" style="cursor: pointer;" onclick="window.location.href='/questions/<?= $q['id'] ?>'">
           <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm flex-shrink-0" 
                style="width: 44px; height: 44px; background: <?= $color ?>; font-size: 0.95rem;">
              <?= strtoupper(substr($q['author_name'] ?? 'U', 0, 1)) ?>
           </div>
           <div class="flex-grow-1 overflow-hidden">
              <h6 class="fw-bolder text-dark mb-1 text-truncate" style="font-size: 0.95rem;">
                <a href="/questions/<?= $q['id'] ?>" class="text-decoration-none text-dark hover-text-primary"><?= htmlspecialchars($q['title']) ?></a>
              </h6>
              <div class="d-flex align-items-center gap-2">
                 <span class="text-secondary fw-bold" style="font-size: 0.75rem;"><?= htmlspecialchars($q['author_name'] ?? 'Anonymous') ?></span>
                 <span class="rounded-circle" style="width: 3px; height: 3px; background: #cbd5e1;"></span>
                 <span class="text-muted" style="font-size: 0.75rem;"><?= date('M d', strtotime($q['created_at'])) ?></span>
              </div>
           </div>
           <div class="badge rounded-pill bg-light text-dark px-2 py-1 fw-bold border" style="font-size: 0.7rem;">
              <?= $q['votes'] ?? 0 ?>
           </div>
        </div>
        <?php endforeach; endif; ?>
      </div>
      
      <div class="mt-4 pt-4 border-top">
         <a href="/dashboard/questions" class="btn btn-light w-100 rounded-pill fw-bold text-dark py-2" style="font-size: 0.85rem;">Explore Full Feed</a>
      </div>

    </div>
  </div>
</div>

<style>
  .group:hover .group-hover-opacity-100 { opacity: 1 !important; }
  .bar-part:hover { transform: scaleX(1.1); filter: brightness(0.9); }
  .hover-bg-light:hover { background: #f8fafc; }
  .activity-feed .d-flex:last-child { margin-bottom: 0; }
  .activity-feed .d-flex:hover { transform: translateX(4px); }
</style>
