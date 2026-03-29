<?php
// Components/admin/header.php
if (isset($headerData)):
    $title = $headerData['title'] ?? 'Dashboard';
    $subtitle = $headerData['subtitle'] ?? '';
    $showActions = $headerData['showActions'] ?? true;
?>

<div class="d-flex flex-column flex-sm-row justify-content-end align-items-sm-center mb-4 reveal">
  <!-- Title removed as it is now in the topbar -->
  
  <?php if ($showActions): ?>
  <div class="mt-4 mt-sm-0 d-flex gap-2 flex-wrap">
    <a href="/dashboard/questions/create" class="btn btn-primary rounded-pill shadow-sm hover-elevate d-inline-flex align-items-center gap-2 fw-bold px-4 py-2" style="background: linear-gradient(135deg, var(--g600), var(--g800)); border: none; font-size: 0.95rem;">
      <i class="fas fa-plus"></i> Ask Question
    </a>
    <button class="btn btn-light rounded-pill border hover-bg-dark d-inline-flex align-items-center gap-2 fw-bold px-4 py-2" style="font-size: 0.95rem;">
      <i class="fas fa-cloud-download-alt text-secondary"></i> Export Data
    </button>
  </div>
  <?php endif; ?>
</div>

<style>
    .hover-elevate:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(22, 163, 74, 0.25) !important; }
    .hover-bg-dark:hover { background: var(--bg3) !important; color: var(--txt) !important; }
</style>
<?php endif; ?>