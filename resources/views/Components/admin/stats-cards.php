<!-- Statistics Cards Component -->
<div class="row g-4 mb-5">
  <?php 
  // Default data fallback
  $cards = $statsData ?? [
    ['label' => 'Total Questions', 'value' => '2,420', 'trend' => '+12%', 'trendType' => 'up', 'icon' => 'fa-question-circle', 'color' => 'var(--g500)'],
    ['label' => 'Total Answers', 'value' => '4,100', 'trend' => '+10%', 'trendType' => 'up', 'icon' => 'fa-reply-all', 'color' => '#3b82f6'],
    ['label' => 'Total Votes', 'value' => '65,791', 'trend' => '+25%', 'trendType' => 'up', 'icon' => 'fa-thumbs-up', 'color' => '#8b5cf6'],
    ['label' => 'Active Users', 'value' => '10,782', 'trend' => '-5%', 'trendType' => 'down', 'icon' => 'fa-users', 'color' => '#ec4899']
  ];

  foreach ($cards as $i => $card): 
    $tClass = ($card['trendType'] === 'up') ? 'text-success bg-success-subtle' : (($card['trendType'] === 'down') ? 'text-danger bg-danger-subtle' : 'text-secondary bg-secondary-subtle');
    $tIcon = ($card['trendType'] === 'up') ? 'fa-arrow-up' : (($card['trendType'] === 'down') ? 'fa-arrow-down' : 'fa-minus');
    $iconColor = $card['color'] ?? 'var(--g600)';
    $delay = 0.1 + ($i * 0.05);
  ?>
  <div class="col-12 col-md-6 col-xl-3 reveal" style="animation-delay: <?= $delay ?>s;">
    <div class="q-card hover-elevate-card bg-white position-relative overflow-hidden h-100 p-4" style="border-radius: 24px; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 4px 20px rgba(0,0,0,0.02); transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);">
      
      <!-- Decorative Glow -->
      <div class="position-absolute" style="top: -20px; right: -20px; width: 100px; height: 100px; background: <?= $iconColor ?>; filter: blur(40px); opacity: 0.15; border-radius: 50%; pointer-events: none;"></div>

      <div class="d-flex justify-content-between align-items-start mb-4 position-relative z-1">
        <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px; background: <?= $iconColor ?>; color: white; font-size: 1.25rem;">
          <i class="fas <?php echo $card['icon']; ?>"></i>
        </div>
        <button class="btn btn-sm text-muted hover-bg-light rounded-circle" style="width: 32px; height: 32px;" title="Options">
          <i class="fas fa-ellipsis-v"></i>
        </button>
      </div>

      <div class="position-relative z-1 d-flex flex-column gap-1">
        <div class="text-secondary fw-bold text-uppercase" style="font-size: 0.70rem; letter-spacing: 0.05em;"><?php echo $card['label']; ?></div>
        <div class="stat-num text-dark fw-bolder mb-2" style="font-size: 2.2rem; letter-spacing: -0.03em;"><?php echo $card['value']; ?></div>
        
        <div class="d-flex align-items-center gap-2 mt-auto">
          <span class="badge rounded-pill <?php echo $tClass; ?> px-2 py-1" style="font-size: 0.75rem; font-weight: 700;">
            <i class="fas <?php echo $tIcon; ?> me-1"></i> <?php echo $card['trend']; ?>
          </span>
          <span class="text-muted" style="font-size:0.75rem; font-weight: 500;">vs last month</span>
        </div>
      </div>
      
    </div>
  </div>
  <?php endforeach; ?>
</div>

<style>
   .bg-success-subtle { background-color: #dcfce7 !important; }
   .bg-danger-subtle { background-color: #fee2e2 !important; }
   .bg-secondary-subtle { background-color: #f1f5f9 !important; }
</style>
