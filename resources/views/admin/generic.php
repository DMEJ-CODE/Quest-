
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card-base p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="badge bg-primary">Utilisateurs</span>
                <i class="fas fa-users text-primary"></i>
            </div>
            <h3><?= intval($stats['users'] ?? 0) ?></h3>
            <p class="mb-0 text-muted">Actifs</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card-base p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="badge bg-success">Questions</span>
                <i class="fas fa-question text-success"></i>
            </div>
            <h3><?= intval($stats['questions'] ?? 0) ?></h3>
            <p class="mb-0 text-muted">Totales</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card-base p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="badge bg-warning">Réponses</span>
                <i class="fas fa-comments text-warning"></i>
            </div>
            <h3><?= intval($stats['answers'] ?? 0) ?></h3>
            <p class="mb-0 text-muted">Soumises</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card-base p-3">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="badge bg-danger">Signalements</span>
                <i class="fas fa-flag text-danger"></i>
            </div>
            <h3><?= intval($stats['reports'] ?? 0) ?></h3>
            <p class="mb-0 text-muted">En cours</p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-base p-4">
            <h5 class="fw-bold mb-3">Tâches rapides</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="/admin/users" class="btn btn-outline-primary">Gérer les utilisateurs</a>
                <a href="/admin/questions" class="btn btn-outline-success">Gérer les questions</a>
                <a href="/admin/reports" class="btn btn-outline-danger">View reports</a>
                <a href="/admin/settings" class="btn btn-outline-secondary">Paramètres</a>
            </div>

            <div class="mt-4">
                <h6 class="mb-2">Dernières activités administratives</h6>
                <?php if(empty($adminLogs)): ?>
                    <div class="empty-state">
                        <div class="empty-state-icon">🧾</div>
                        <h5 class="empty-state-title">Aucune activité récente</h5>
                        <p class="empty-state-text">Les actions récentes apparaîtront ici.</p>
                    </div>
                <?php else: ?>
                    <ul class="list-group-modern">
                        <?php foreach($adminLogs as $log): ?>
                            <li class="list-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= htmlspecialchars($log['action']) ?></strong><br>
                                    <small class="text-secondary"><?= htmlspecialchars($log['info']) ?></small>
                                </div>
                                <small class="text-muted"><?= htmlspecialchars($log['when']) ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-base p-4">
            <h5 class="fw-bold mb-3">Aide</h5>
            <p class="small text-secondary">Utilisez ces éléments pour accéder facilement aux sections critiques de gestion. Toutes les données affichées sont récupérées dynamiquement.</p>
            <a href="/dashboard" class="btn btn-primary w-100 mb-2"><i class="fas fa-home"></i> Aller au Dashboard</a>
            <button class="btn btn-outline-secondary w-100" onclick="history.back()"><i class="fas fa-arrow-left"></i> Retour à la page précédente</button>
        </div>
    </div>
</div>

<style>
.icon-circle { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
</style>
