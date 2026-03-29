?>
  <!-- Dashboard Stats row -->

  <!-- On inclut les stats. La variable $statsData est accessible. -->
  <?php include __DIR__ . '/../Components/admin/stats-cards.php'; ?>

  <!-- On inclut l'engagement. La variable $engagementData est accessible. -->
  <?php if (isset($isAdmin) && $isAdmin): ?>
    <?php include __DIR__ . '/../Components/admin/engagement.php'; ?>
  <?php endif; ?>

  <!-- Les autres composants... -->
  <?php include __DIR__ . '/../Components/admin/activity.php'; ?>
  <?php if (isset($isAdmin) && $isAdmin): ?>
    <?php include __DIR__ . '/../Components/admin/footer-cards.php'; ?>
  <?php endif; ?>