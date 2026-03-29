<!-- Tags, Contributors & Reputation Section -->
<div class="row g-4 mb-5">
  <!-- Popular Topics Card -->
  <div class="col-12 col-md-5 col-xl-4 reveal" style="animation-delay: 0.35s;">
    <div class="q-card hover-elevate-card bg-white p-4 p-sm-5" style="border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 10px 40px rgba(0,0,0,0.02); height: 100%;">
      
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="fw-bolder text-dark mb-0" style="letter-spacing: -0.02em;">Trending Topics</h5>
        <a href="/dashboard/tags" class="text-decoration-none fw-bold" style="color: var(--g800); font-size: 0.8rem;">Explore All</a>
      </div>

      <div class="d-flex flex-wrap gap-2">
        <?php 
        $popularTags = ['Laravel', 'JavaScript', 'PHP', 'Vue.js', 'Python', 'MySQL', 'React', 'AI / ML', 'API', 'Docker'];
        foreach($popularTags as $tag): 
        ?>
        <span class="badge rounded-pill bg-light text-dark px-3 py-2 fw-bold border hover-elevate transition-all" style="font-size: 0.75rem; cursor: pointer;">
           <i class="fas fa-hashtag text-secondary me-1" style="font-size: 0.65rem;"></i> <?= $tag ?>
        </span>
        <?php endforeach; ?>
        <span class="badge rounded-pill bg-light text-secondary px-3 py-2 fw-bold border" style="font-size: 0.75rem;">+200 more</span>
      </div>

    </div>
  </div>

  <!-- Top Contributors Card -->
  <div class="col-12 col-md-7 col-xl-4 reveal" style="animation-delay: 0.4s;">
    <div class="q-card hover-elevate-card bg-white p-4 p-sm-5" style="border-radius: 32px; border: 1px solid rgba(0,0,0,0.03); box-shadow: 0 10px 40px rgba(0,0,0,0.02); height: 100%;">
      
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="fw-bolder text-dark mb-0" style="letter-spacing: -0.02em;">Top Contributors</h5>
        <button class="btn btn-sm btn-light rounded-pill px-3 py-1 fw-bold text-dark border-0" style="font-size: 0.75rem;">Invite</button>
      </div>

      <div class="d-flex flex-column gap-3">
        <?php 
        $contributors = [
          ['name' => 'Karim Atoum', 'sub' => '248 answers · ML Engineer', 'initial' => 'K', 'color' => 'linear-gradient(135deg, #6366f1, #a855f7)'],
          ['name' => 'Maya Sow', 'sub' => '193 answers · PhD Researcher', 'initial' => 'M', 'color' => 'linear-gradient(135deg, #10b981, #059669)'],
          ['name' => 'Raj Patel', 'sub' => '141 answers · Software Dev', 'initial' => 'R', 'color' => 'linear-gradient(135deg, #f59e0b, #d97706)'],
          ['name' => 'Alex Kouam', 'sub' => '98 answers · Backend Dev', 'initial' => 'A', 'color' => 'linear-gradient(135deg, #ef4444, #dc2626)']
        ];
        foreach($contributors as $c): 
        ?>
        <div class="d-flex align-items-center gap-3 p-2 hover-bg-light transition-all rounded-4" style="cursor: pointer;">
           <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 42px; height: 42px; background: <?= $c['color'] ?>; font-size: 0.9rem;">
              <?= $c['initial'] ?>
           </div>
           <div class="flex-grow-1 overflow-hidden">
              <h6 class="fw-bolder text-dark mb-0 text-truncate" style="font-size: 0.9rem;"><?= $c['name'] ?></h6>
              <span class="text-secondary" style="font-size: 0.75rem;"><?= $c['sub'] ?></span>
           </div>
        </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>

  <!-- Your Reputation Card -->
  <div class="col-12 col-xl-4 reveal" style="animation-delay: 0.45s;">
    <div class="q-card hover-elevate-card bg-dark p-4 p-sm-5 d-flex flex-column" style="border-radius: 32px; box-shadow: 0 15px 40px rgba(15, 23, 42, 0.2); height: 100%; background: linear-gradient(135deg, #0f172a, #1e293b) !important;">
      
      <?php 
        $uName = $_SESSION['user_name'] ?? 'Guest';
        $uEmail = $_SESSION['user_email'] ?? 'No email set';
        $uInitials = strtoupper(substr($uName, 0, 1) . (strpos($uName, ' ') !== false ? substr($uName, strpos($uName, ' ') + 1, 1) : ''));
        $qCount = $statsData[0]['value'] ?? 0;
        $aCount = $statsData[1]['value'] ?? 0;
        $vCount = $statsData[2]['value'] ?? 0;
      ?>
      <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="fw-bold text-white mb-0" style="letter-spacing: -0.01em; opacity: 0.9;">Your Impact</h5>
        <div class="badge rounded-pill bg-primary border-0 px-2 py-1" style="font-size: 0.65rem; background: rgba(255,255,255,0.1) !important;">ACTIVE LEVEL</div>
      </div>

      <div class="d-flex align-items-center gap-3 mb-4">
        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 52px; height: 52px; background: var(--accent); border: 2px solid rgba(255,255,255,0.1);"><?= $uInitials ?></div>
        <div>
          <h6 class="fw-bolder text-white mb-0" style="font-size: 1.05rem;"><?= htmlspecialchars($uName) ?></h6>
          <span class="text-secondary" style="font-size: 0.8rem; opacity: 0.6;"><?= htmlspecialchars($uEmail) ?></span>
        </div>
      </div>

      <div class="row g-2 mb-4">
        <div class="col-6">
           <div class="p-3 text-center rounded-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
              <div class="h4 fw-bolder text-white mb-0"><?= $qCount ?></div>
              <span class="text-secondary text-uppercase" style="font-size: 0.6rem; letter-spacing: 0.05em;">Questions</span>
           </div>
        </div>
        <div class="col-6">
           <div class="p-3 text-center rounded-4" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);">
              <div class="h4 fw-bolder text-white mb-0"><?= $aCount ?></div>
              <span class="text-secondary text-uppercase" style="font-size: 0.6rem; letter-spacing: 0.05em;">Answers</span>
           </div>
        </div>
      </div>

      <div class="mt-auto">
         <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="text-secondary fw-bold" style="font-size: 0.75rem; opacity: 0.7;">Achievement Points</span>
            <span class="text-white fw-bold" style="font-size: 0.75rem;"><?= $vCount ?> pts</span>
         </div>
         <div class="progress" style="height: 6px; background: rgba(255,255,255,0.08); border-radius: 100px;">
            <div class="progress-bar" style="width: 100%; background: var(--accent); border-radius: 100px;"></div>
         </div>
      </div>

    </div>
  </div>
</div>
