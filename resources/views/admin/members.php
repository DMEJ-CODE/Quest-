<!-- Dribbble-Style Header - Actions only -->
<div class="d-flex flex-column flex-sm-row justify-content-end align-items-sm-center mb-4 reveal">
    <div class="mt-3 mt-sm-0">
        <div class="input-group dribbble-search-grp" style="max-width: 320px;">
            <span class="input-group-text border-0 ps-3 bg-light text-muted"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control border-0 bg-light py-2 ps-1 pe-3 q-search-input" placeholder="Search by name or email...">
        </div>
    </div>
</div>

<div class="reveal" style="animation-delay: 0.1s;">
    <?php if(empty($users)): ?>
        <div class="col-12 py-5 my-5 text-center">
            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-4" style="width: 120px; height: 120px;">
                <i class="fas fa-user-friends text-muted" style="font-size: 3rem; opacity: 0.5;"></i>
            </div>
            <h3 class="fw-bolder text-dark mb-2" style="letter-spacing: -0.02em;">No Members Found</h3>
            <p class="text-secondary mx-auto mb-4" style="max-width: 400px; font-size: 0.95rem;">
                Your community hasn't started yet. Once users register, they will appear here as a vibrant list.
            </p>
        </div>
    <?php else: ?>
        <div class="table-responsive px-1 pb-4" style="margin-left: -5px; margin-right: -5px;">
            <table class="table align-middle" style="border-collapse: separate; border-spacing: 0 12px;">
                <thead>
                    <tr class="d-none d-md-table-row">
                        <th class="text-secondary text-uppercase fw-bolder py-2 px-4 border-0" style="font-size: 0.75rem; letter-spacing: 0.05em;">Member Profile</th>
                        <th class="text-secondary text-uppercase fw-bolder py-2 px-4 border-0" style="font-size: 0.75rem; letter-spacing: 0.05em;">Access Role</th>
                        <th class="text-secondary text-uppercase fw-bolder py-2 px-4 border-0" style="font-size: 0.75rem; letter-spacing: 0.05em;">Joined Date</th>
                        <th class="text-secondary text-uppercase fw-bolder py-2 px-4 text-end border-0" style="font-size: 0.75rem; letter-spacing: 0.05em;">Organization</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <tr class="hover-row shadow-sm transition-all" style="background: var(--card);">
                        <td class="px-4 py-3" style="border-radius: 16px 0 0 16px; border: 1px solid var(--bdr); border-right: none;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-master rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--g400), var(--g700)); border: 2px solid #fff;">
                                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-bolder text-dark mb-0" style="font-size: 1rem;"><?= htmlspecialchars($user['name']) ?></span>
                                    <span class="text-secondary" style="font-size: 0.8rem;"><?= htmlspecialchars($user['email']) ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3" style="border-top: 1px solid var(--bdr); border-bottom: 1px solid var(--bdr);">
                            <?php if($user['role'] === 'admin'): ?>
                                <span class="badge rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2" style="background: #e0f2fe; color: #0369a1; font-weight: 700; font-size: 0.75rem;">
                                    <i class="fas fa-shield-alt" style="font-size: 0.7rem;"></i> Administrator
                                </span>
                            <?php else: ?>
                                <span class="badge rounded-pill px-3 py-2 d-inline-flex align-items-center gap-2" style="background: var(--bg2); color: var(--g700); font-weight: 700; font-size: 0.75rem;">
                                    <i class="fas fa-user-check" style="font-size: 0.7rem;"></i> Member
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3" style="border-top: 1px solid var(--bdr); border-bottom: 1px solid var(--bdr);">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark" style="font-size: 0.9rem;"><?= date('M d, Y', strtotime($user['created_at'])) ?></span>
                                <span class="text-muted" style="font-size: 0.75rem;">at <?= date('h:i A', strtotime($user['created_at'])) ?></span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-end" style="border-radius: 0 16px 16px 0; border: 1px solid var(--bdr); border-left: none;">
                            <div class="d-inline-flex gap-1 gap-md-2">
                                <button class="btn btn-icon-dribbble hover-bg-primary transition-all" title="Edit Member">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <form action="/dashboard/members/delete" method="POST" class="m-0" onsubmit="return confirm('Suspend this user activity permanently?');">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <button type="submit" class="btn btn-icon-dribbble hover-bg-danger transition-all" title="Ban Member">
                                        <i class="fas fa-user-slash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<style>
    .dribbble-search-grp {
        border-radius: 100px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        transition: all 0.3s;
    }
    .dribbble-search-grp:focus-within {
        box-shadow: 0 4px 15px rgba(22, 163, 74, 0.15);
        transform: translateY(-1px);
    }
    .q-search-input:focus {
        background: white !important;
        box-shadow: none !important;
    }

    .hover-row { transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); }
    .hover-row:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(0,0,0,0.05) !important; z-index: 2; position: relative; }

    .btn-icon-dribbble {
        width: 40px; height: 40px; border-radius: 50% !important;
        display: inline-flex; align-items: center; justify-content: center;
        background: #f8fafc; border: none; color: #64748b; font-size: 0.9rem;
    }
    .btn-icon-dribbble.hover-bg-primary:hover { background: #e0f2fe !important; color: #0369a1 !important; transform: scale(1.1); }
    .btn-icon-dribbble.hover-bg-danger:hover { background: #fee2e2 !important; color: #dc2626 !important; transform: scale(1.1); }
    
    .reveal { opacity: 0; transform: translateY(16px); animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
</style>
