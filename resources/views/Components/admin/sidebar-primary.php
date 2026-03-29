<!-- Sidebar 1 - Icon Strip Component -->
<aside class="sbi " id="sbi">
  <!-- Logo -->
  <div class="sbi-logo mb-4">
    <img src="/assets/quest/web-app-manifest-512x512.png" alt="Quest">
  </div>

  <!-- Modules -->
  <a href="/dashboard" class="sbi-btn" title="Dashboard" data-menu="dashboard" onclick="sbiClick(this,event)">
    <i class="fas fa-th-large"></i>
  </a>
  <a href="/dashboard/questions" class="sbi-btn" title="Questions" data-menu="questions" onclick="sbiClick(this,event)">
    <i class="fas fa-question-circle"></i>
  </a>
  <a href="/dashboard/answers" class="sbi-btn" title="Answers" data-menu="answers" onclick="sbiClick(this,event)">
    <i class="fas fa-comments"></i>
  </a>
  <a href="/dashboard/voting" class="sbi-btn" title="Voting" data-menu="voting" onclick="sbiClick(this,event)">
    <i class="fas fa-thumbs-up"></i>
  </a>
  <a href="/dashboard/tags" class="sbi-btn" title="Tags" data-menu="tags" onclick="sbiClick(this,event)">
    <i class="fas fa-tags"></i>
  </a>

  <div class="sbi-sep"></div>

  <a href="/dashboard/profile" class="sbi-btn" title="Profile" data-menu="profile" onclick="sbiClick(this,event)">
    <i class="fas fa-user"></i>
  </a>
  <a href="/dashboard/security" class="sbi-btn" title="Security" data-menu="security" onclick="sbiClick(this,event)">
    <i class="fas fa-shield-alt"></i>
  </a>
  <a href="/dashboard/notifications" class="sbi-btn" title="Notifications" data-menu="notifications" onclick="sbiClick(this,event)">
    <i class="fas fa-bell"></i>
  </a>
  <a href="/dashboard/leaderboard" class="sbi-btn" title="Leaderboard" data-menu="leaderboard" onclick="sbiClick(this,event)">
    <i class="fas fa-chart-bar"></i>
  </a>

  <div class="sbi-spacer"></div>

  <!-- Bottom Section -->
  <a href="/dashboard/settings" class="sbi-btn" title="Settings" data-menu="settings" onclick="sbiClick(this,event)">
    <i class="fas fa-cog"></i>
  </a>

  <!-- Logout -->
  <button class="sbi-btn" title="Logout" onclick="logout()">
    <i class="fas fa-sign-out-alt"></i>
  </button>
</aside>
