<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="form-wrapper p-4">
            <form action="/profile/update" method="POST">
                <div class="form-section mb-4">
                    <div class="form-section-title mb-3">
                        <div class="form-section-number">1</div>
                        <h3>Personal details</h3>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="bio">Bio</label>
                        <textarea id="bio" name="bio" class="form-control" rows="4"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                    </div>
                </div>

                <div class="form-section mb-4">
                    <div class="form-section-title mb-3">
                        <div class="form-section-number">2</div>
                        <h3>Account preferences</h3>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" name="notifications" type="checkbox" id="notify" <?= isset($user['notifications']) && $user['notifications'] ? 'checked' : '' ?> >
                        <label class="form-check-label" for="notify">Email notifications</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" name="public_profile" type="checkbox" id="publicProfile" <?= isset($user['public_profile']) && $user['public_profile'] ? 'checked' : '' ?> >
                        <label class="form-check-label" for="publicProfile">Public profile</label>
                    </div>
                </div>

                <div class="form-actions d-flex gap-2">
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary ms-auto">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card-base p-4">
            <h5 class="fw-bold mb-3">Account Info</h5>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email'] ?? 'user@example.com') ?></p>
            <p><strong>Joined:</strong> <?= htmlspecialchars($user['created_at'] ?? 'N/A') ?></p>
            <a href="/profiles/security" class="btn btn-outline-primary btn-sm mt-2">Security settings</a>
        </div>
    </div>
</div>
