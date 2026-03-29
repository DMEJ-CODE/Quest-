<?php $settingsMode = $mode ?? 'general'; ?>

<!-- Clean interface: main titles and subtitles removed as requested -->
<div class="row g-4">
    <!-- Main Settings Form -->
    <div class="col-12 col-lg-8">
        <div class="form-wrapper">
            <?php if ($settingsMode === 'general'): ?>
                <form action="/dashboard/settings/general" method="POST">
                    <!-- Section 1: General Configuration -->
                    <div class="form-section mb-5">
                        <div class="form-section-title mb-4">
                            <div class="form-section-number">1</div>
                            <h3>General Configuration</h3>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">Platform Name</label>
                            <input type="text" name="platform_name" class="form-control" value="Quest Hub" placeholder="Enter the platform name...">
                            <small class="form-text text-secondary">This name will be displayed in the header and emails</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" value="support@quest.com" placeholder="support@example.com">
                            <small class="form-text text-secondary">Used for notifications and customer support</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label fw-bold">Default Language</label>
                            <select name="language" class="form-select">
                                <option value="en" selected>English (Global)</option>
                                <option value="fr">Français (Cameroun)</option>
                                <option value="es">Español</option>
                            </select>
                            <small class="form-text text-secondary">Interface language for new users</small>
                        </div>
                    </div>

                    <hr style="border: none; border-top: 1px solid var(--bdr); margin: 3rem 0;">

                    <!-- Section 2: Privacy & Access -->
                    <div class="form-section mb-5">
                        <div class="form-section-title mb-4">
                            <div class="form-section-number">2</div>
                            <h3>Privacy & Access</h3>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="allow_register" id="allowRegister" checked>
                                <label class="form-check-label fw-bold" for="allowRegister">Allow free registration</label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="moderate_questions" id="moderateQuestions" checked>
                                <label class="form-check-label fw-bold" for="moderateQuestions">Moderate all new questions</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="enable_notifications" id="enableNotifications">
                                <label class="form-check-label fw-bold" for="enableNotifications">Enable email notifications</label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions mt-5">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save me-2"></i>Save changes</button>
                        <button type="reset" class="btn btn-secondary btn-lg ms-2"><i class="fas fa-redo me-2"></i>Reset</button>
                    </div>
                </form>

            <?php elseif ($settingsMode === 'preferences'): ?>
                <form action="/dashboard/settings/preferences" method="POST">
                    <div class="form-section mb-5">
                        <h3>User Preferences</h3>
                        <p class="text-muted">Specific settings for your experience.</p>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="dark_mode" id="darkMode" checked>
                            <label class="form-check-label" for="darkMode">Dark mode</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="compact_view" id="compactView">
                            <label class="form-check-label" for="compactView">Compact view</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="email_digest" id="emailDigest" checked>
                            <label class="form-check-label" for="emailDigest">Receive activity summary by email</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Save preferences</button>
                    </div>
                </form>

            <?php elseif ($settingsMode === 'language'): ?>
                <form action="/dashboard/settings/language" method="POST">
                    <div class="form-section mb-5">
                        <h3>Language</h3>
                        <p class="text-muted">Change the interface language.</p>

                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">Active Language</label>
                            <select name="language" class="form-select">
                                <option value="en" selected>English (Global)</option>
                                <option value="fr">Français (Cameroun)</option>
                                <option value="es">Español</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save language</button>
                    </div>
                </form>

            <?php else: ?>
                <div class="form-section mb-5">
                    <h3>Help & Support</h3>
                    <p class="text-secondary">This section is empty as you no longer want embedded assistance content.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar: System Health -->
    <div class="col-12 col-lg-4">
        <div class="card-base p-4" style="border: 2px solid #8b5cf6; background: linear-gradient(135deg, rgba(139, 92, 246, 0.05), rgba(168, 85, 247, 0.05));">
            <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom" style="border-color: var(--bdr);">
                <i class="fas fa-heartbeat text-success" style="font-size: 1.5rem;"></i>
                <h6 class="mb-0 fw-bold">System Health</h6>
            </div>

            <!-- Server Load -->
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-secondary fw-bold small">Server Load</span>
                    <span class="badge bg-success text-white small">12%</span>
                </div>
                <div class="progress" style="height: 8px; background: var(--bdr);">
                    <div class="progress-bar bg-success" style="width: 12%;"></div>
                </div>
                <small class="text-secondary d-block mt-1">Very good</small>
            </div>

            <!-- Memory Usage -->
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-secondary fw-bold small">Memory Usage</span>
                    <span class="badge bg-warning text-dark small">35%</span>
                </div>
                <div class="progress" style="height: 8px; background: var(--bdr);">
                    <div class="progress-bar bg-warning" style="width: 35%;"></div>
                </div>
                <small class="text-secondary d-block mt-1">45MB / 128MB</small>
            </div>

            <!-- Database Size -->
            <div class="mb-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-secondary fw-bold small">Database</span>
                    <span class="badge bg-info text-white small">22%</span>
                </div>
                <div class="progress" style="height: 8px; background: var(--bdr);">
                    <div class="progress-bar bg-info" style="width: 22%;"></div>
                </div>
                <small class="text-secondary d-block mt-1">1.8GB / 8GB</small>
            </div>

            <!-- Uptime -->
            <div class="mb-0 p-3 rounded-3" style="background: var(--bg3, #f0fdf4);">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary fw-bold small">Uptime</span>
                    <span class="h6 mb-0 fw-bold text-success">99.9%</span>
                </div>
                <small class="text-secondary d-block mt-1">45 days without interruption</small>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="card-base p-4 mt-4">
            <h6 class="fw-bold mb-3 pb-3 border-bottom" style="border-color: var(--bdr);">Quick Actions</h6>
            <div class="d-flex flex-column gap-2">
                <a href="/dashboard/backup" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-download me-2"></i>Backup now
                </a>
                <a href="/dashboard/logs" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-file-alt me-2"></i>View logs
                </a>
                <a href="/dashboard/cache/clear" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-trash me-2"></i>Clear cache
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .form-text {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.875rem;
    }
</style>
