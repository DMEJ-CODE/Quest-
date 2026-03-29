<div class="row g-4">
    <div class="col-12 mb-3">
        <div class="alert alert-light">Classement de la communauté (sans en-tête fixe).</div>
    </div>
    <div class="col-12">
        <div class="q-card p-0 border shadow-sm rounded-4 bg-white overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted smaller fw-bold" style="width: 80px;">RANK</th>
                            <th class="py-3 text-muted smaller fw-bold">CONTRIBUTOR</th>
                            <th class="py-3 text-muted smaller fw-bold text-center">QUESTIONS</th>
                            <th class="py-3 text-muted smaller fw-bold text-center">ANSWERS</th>
                            <th class="py-3 text-muted smaller fw-bold text-center">REPUTATION</th>
                            <th class="pe-4 py-3 text-muted smaller fw-bold text-end">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($topUsers)): ?>
                            <tr><td colspan="6" class="text-center py-5 text-muted">No contributors yet.</td></tr>
                        <?php else: $rank = 1; foreach ($topUsers as $user): ?>
                        <tr>
                            <td class="ps-4">
                                <?php if($rank <= 3): ?>
                                    <div class="rank-badge rank-<?= $rank ?>"><?= $rank ?></div>
                                <?php else: ?>
                                    <span class="ms-2 fw-medium text-muted"><?= $rank ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-md bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border: 2px solid #fff; box-shadow: 0 0 0 1px #eee;">
                                        <i class="fas fa-user-circle text-secondary"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold"><?= htmlspecialchars($user['name']) ?></h6>
                                        <span class="smaller text-muted">@<?= htmlspecialchars($user['username']) ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center fw-medium"><?= $user['q_count'] ?></td>
                            <td class="text-center fw-medium"><?= $user['a_count'] ?></td>
                            <td class="text-center">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                   <i class="fas fa-bolt me-1"></i> <?= number_format($user['reputation']) ?>
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <span class="badge bg-success-subtle text-success rounded-pill px-2 smaller">Active</span>
                            </td>
                        </tr>
                        <?php $rank++; endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .rank-badge {
        width: 32px; height: 32px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 0.9rem; color: #fff;
    }
    .rank-1 { background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3); }
    .rank-2 { background: linear-gradient(135deg, #94a3b8, #64748b); box-shadow: 0 4px 10px rgba(148, 163, 184, 0.3); }
    .rank-3 { background: linear-gradient(135deg, #b45309, #78350f); box-shadow: 0 4px 10px rgba(180, 83, 9, 0.3); }
    .bg-primary-subtle { background-color: rgba(37, 99, 235, 0.1) !important; color: var(--accent) !important; }
    .bg-success-subtle { background-color: rgba(34, 197, 94, 0.1) !important; color: #16a34a !important; }
</style>
