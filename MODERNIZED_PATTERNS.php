<?php
/**
 * MODERNIZED PAGE PATTERNS REFERENCE
 * 
 * Copy these pattern templates when creating new modernized pages.
 * All files should be placed in /resources/views/
 * 
 * CSS Files Required in parent layout:
 * - /assets/quest/forms.css
 * - /assets/quest/components.css
 * - /assets/quest/utilities.css
 */

// ============================================
// PATTERN 1: LIST/INDEX PAGES (Cards Grid)
// ============================================
?>

<!-- PATTERN: LIST PAGE WITH CARDS -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" 
             style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent), var(--accent-d)); color: white; font-size: 1.5rem;">
            <i class="fas fa-[ICON]"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0"><?= htmlspecialchars($pageTitle) ?></h1>
            <p class="page-header-subtitle mb-0">Subtitle describing the page purpose</p>
        </div>
    </div>
</div>

<?php if(empty($items)): ?>
    <!-- EMPTY STATE -->
    <div class="empty-state">
        <div class="empty-state-icon">📭</div>
        <h5 class="empty-state-title">No Items Found</h5>
        <p class="empty-state-text">Description of empty state message</p>
        <div class="empty-state-action">
            <a href="#" class="btn btn-primary">Action Button</a>
        </div>
    </div>
<?php else: ?>
    <!-- ITEMS GRID (for cards) or LIST (for list items) -->
    <div class="gallery-grid">
        <?php foreach($items as $item): ?>
        <div class="card-base">
            <h5 class="fw-bold mb-3"><?= htmlspecialchars($item['title']) ?></h5>
            <p class="text-secondary mb-3"><?= htmlspecialchars(substr($item['description'], 0, 100)) ?>...</p>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-primary btn-sm flex-grow-1">View</a>
                <a href="#" class="btn btn-outline-secondary btn-sm flex-grow-1">Edit</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php 
// ============================================
// PATTERN 2: LIST PAGES (With List Items)
// ============================================
?>

<!-- PATTERN: LIST PAGE WITH LIST ITEMS -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" 
             style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent), var(--accent-d)); color: white; font-size: 1.5rem;">
            <i class="fas fa-[ICON]"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0"><?= htmlspecialchars($pageTitle) ?></h1>
            <p class="page-header-subtitle mb-0">Subtitle describing the page purpose</p>
        </div>
    </div>
</div>

<!-- Filter Buttons -->
<div class="d-flex gap-2 mb-5 flex-wrap">
    <button class="btn btn-primary btn-sm" onclick="filterItems('all')">All</button>
    <button class="btn btn-outline-primary btn-sm" onclick="filterItems('active')">Active</button>
    <button class="btn btn-outline-primary btn-sm" onclick="filterItems('archived')">Archived</button>
</div>

<div class="list-group-modern">
    <?php foreach($items as $item): ?>
    <div class="list-item p-4 mb-3">
        <div class="d-flex align-items-center gap-4 w-100">
            <!-- Icon/Avatar -->
            <div class="d-flex align-items-center justify-content-center rounded-circle" 
                 style="width: 50px; height: 50px; background: var(--bg3); flex-shrink: 0;">
                <i class="fas fa-[icon] text-primary"></i>
            </div>

            <!-- Content -->
            <div class="flex-grow-1">
                <h6 class="mb-0 fw-bold"><?= htmlspecialchars($item['title']) ?></h6>
                <p class="text-secondary mb-0" style="font-size: 0.9rem;">
                    <?= htmlspecialchars(substr($item['description'], 0, 100)) ?>...
                </p>
            </div>

            <!-- Actions -->
            <div>
                <a href="#" class="btn btn-outline-primary btn-sm">View</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php 
// ============================================
// PATTERN 3: FORM PAGES
// ============================================
?>

<!-- PATTERN: FORM PAGE WITH NUMBERED SECTIONS -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" 
             style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent), var(--accent-d)); color: white; font-size: 1.5rem;">
            <i class="fas fa-[ICON]"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0"><?= htmlspecialchars($pageTitle) ?></h1>
            <p class="page-header-subtitle mb-0">Subtitle describing the form</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="form-wrapper">
            <form action="/save" method="POST">
                <!-- SECTION 1 -->
                <div class="form-section mb-5">
                    <div class="form-section-title mb-4">
                        <div class="form-section-number">1</div>
                        <h3>Section Title</h3>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label fw-bold">Field Label</label>
                        <input type="text" class="form-control" placeholder="Enter text...">
                        <small class="form-text text-secondary">Helper text explaining the field</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label fw-bold">Another Field</label>
                        <textarea class="form-control" rows="4" placeholder="Enter content..."></textarea>
                    </div>
                </div>

                <hr style="border: none; border-top: 1px solid var(--bdr); margin: 3rem 0;">

                <!-- SECTION 2 -->
                <div class="form-section mb-5">
                    <div class="form-section-title mb-4">
                        <div class="form-section-number">2</div>
                        <h3>Another Section</h3>
                    </div>

                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="option1">
                            <label class="form-check-label fw-bold" for="option1">
                                Enable this option
                            </label>
                        </div>
                    </div>
                </div>

                <!-- FORM ACTIONS -->
                <div class="form-actions mt-5">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                    <button type="reset" class="btn btn-secondary btn-lg ms-2">
                        <i class="fas fa-redo me-2"></i>Reset
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SIDEBAR (Optional) -->
    <div class="col-12 col-lg-4">
        <div class="card-base p-4">
            <h6 class="fw-bold mb-3 pb-3 border-bottom" style="border-color: var(--bdr);">
                <i class="fas fa-info-circle me-2 text-primary"></i>Sidebar Title
            </h6>
            <p class="text-secondary mb-3">Sidebar content here</p>
            <div class="d-flex flex-column gap-2">
                <a href="#" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-icon me-2"></i>Action
                </a>
            </div>
        </div>
    </div>
</div>

<?php 
// ============================================
// PATTERN 4: DASHBOARD/STATS PAGES
// ============================================
?>

<!-- PATTERN: DASHBOARD WITH STAT CARDS -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" 
             style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent), var(--accent-d)); color: white; font-size: 1.5rem;">
            <i class="fas fa-[ICON]"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0">Dashboard</h1>
            <p class="page-header-subtitle mb-0">Overview of key metrics</p>
        </div>
    </div>
</div>

<!-- STAT CARDS GRID -->
<div class="gallery-grid mb-5">
    <div class="card-base stat-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="text-secondary mb-1">Total Users</h6>
                <h3 class="fw-bold mb-0" style="color: var(--txt);">1,234</h3>
            </div>
            <i class="fas fa-users text-primary" style="font-size: 2rem; opacity: 0.3;"></i>
        </div>
        <small class="badge bg-success bg-opacity-10 text-success">
            <i class="fas fa-arrow-up me-1"></i>+12% this month
        </small>
    </div>

    <div class="card-base stat-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="text-secondary mb-1">Active Sessions</h6>
                <h3 class="fw-bold mb-0" style="color: var(--txt);">456</h3>
            </div>
            <i class="fas fa-chart-line text-primary" style="font-size: 2rem; opacity: 0.3;"></i>
        </div>
        <small class="badge bg-success bg-opacity-10 text-success">
            <i class="fas fa-arrow-up me-1"></i>+8% this week
        </small>
    </div>

    <div class="card-base stat-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="text-secondary mb-1">Questions Posted</h6>
                <h3 class="fw-bold mb-0" style="color: var(--txt);">789</h3>
            </div>
            <i class="fas fa-question-circle text-primary" style="font-size: 2rem; opacity: 0.3;"></i>
        </div>
        <small class="badge bg-warning bg-opacity-10 text-warning">
            <i class="fas fa-minus me-1"></i>Stable
        </small>
    </div>

    <div class="card-base stat-card">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <h6 class="text-secondary mb-1">System Uptime</h6>
                <h3 class="fw-bold mb-0" style="color: var(--txt);">99.9%</h3>
            </div>
            <i class="fas fa-server text-primary" style="font-size: 2rem; opacity: 0.3;"></i>
        </div>
        <small class="badge bg-success bg-opacity-10 text-success">
            <i class="fas fa-check me-1"></i>Excellent
        </small>
    </div>
</div>

<!-- ACTIVITY/ADDITIONAL CONTENT -->
<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="card-base p-4">
            <h6 class="fw-bold mb-4"><i class="fas fa-clock me-2 text-primary"></i>Recent Activity</h6>
            <div class="list-group-modern">
                <!-- Activity items -->
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card-base p-4">
            <h6 class="fw-bold mb-4"><i class="fas fa-fire me-2 text-primary"></i>Quick Stats</h6>
            <!-- Quick stats -->
        </div>
    </div>
</div>

<?php 
// ============================================
// PATTERN 5: DETAILED VIEW PAGES
// ============================================
?>

<!-- PATTERN: DETAILED ITEM VIEW -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <a href="/back" class="btn btn-light rounded-circle" style="width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="page-header-title mb-0"><?= htmlspecialchars($item['title']) ?></h1>
            <p class="page-header-subtitle mb-0">By <?= htmlspecialchars($item['author']) ?> on <?= date('M d, Y', strtotime($item['created_at'])) ?></p>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 col-lg-8">
        <div class="card-base p-4">
            <!-- Item details -->
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card-base p-4">
            <h6 class="fw-bold mb-3">Metadata</h6>
            <!-- Sidebar metadata -->
        </div>
    </div>
</div>

<?php
// ============================================
// CSS VARIABLES AVAILABLE
// ============================================

/*
COLORS:
--accent: #22c55e (Primary green)
--accent-d: #16a34a (Darker green)
--accent-l: #4ade80 (Lighter green)
--bg: #f6fefa (Page background)
--bg2: #e5f3ec (Secondary background)
--bg3: #f0fdf4 (Tertiary background)
--card: #ffffff (Card background)
--txt: #071a0e (Main text)
--txt2: #4b5563 (Secondary text)
--txt3: #6b7280 (Tertiary text)
--txt4: #9ca3af (Quaternary text)
--bdr: #c6f6d5 (Border color)

SPACING:
--form-spacing: 1.5rem
--radius-md: 12px
--radius-lg: 16px

SHADOWS:
--shadow-sm: 0 2px 8px rgba(0,0,0,0.05)
--shadow: 0 4px 20px rgba(0,0,0,0.08)
--shadow-lg: 0 10px 30px rgba(0,0,0,0.12)
*/

?>

<!-- ==========================================
     CSS CLASSES QUICK REFERENCE
     ========================================== -->

<?php
/*

LAYOUT CLASSES:
- .page-header: Main page header section
- .page-header-title: Page title
- .page-header-subtitle: Page subtitle
- .form-wrapper: Form container
- .form-section: Grouped form section
- .form-section-number: Numbered form step
- .form-section-title: Section heading

GRID CLASSES:
- .gallery-grid: 3-column responsive grid
- .gallery-grid-2: 2-column responsive grid
- .gallery-grid-3: 3-column responsive grid

CARD CLASSES:
- .card-base: Basic card container
- .stat-card: Statistic card with icon
- .q-card: Question/answer card variant

LIST CLASSES:
- .list-group-modern: Modern list container
- .list-item: Individual list item
- .list-item-icon: List item icon
- .list-item-content: List item content
- .list-item-title: List item title
- .list-item-subtitle: List item subtitle

FORM CLASSES:
- .form-group: Input grouping
- .form-label: Input label
- .form-control: Text input
- .form-select: Select input
- .form-check: Checkbox/radio
- .form-switch: Toggle switch

BUTTON CLASSES:
- .btn.btn-primary: Primary button
- .btn.btn-secondary: Secondary button
- .btn.btn-outline-primary: Outline primary
- .btn.btn-outline-secondary: Outline secondary
- .btn.btn-outline-danger: Outline danger
- .btn.btn-sm: Small button
- .btn.btn-lg: Large button

BADGE CLASSES:
- .badge: Basic badge
- .badge.bg-success: Success badge
- .badge.bg-warning: Warning badge
- .badge.bg-danger: Danger badge

UTILITY CLASSES:
- .empty-state: Empty state container
- .empty-state-icon: Icon in empty state
- .empty-state-title: Title in empty state
- .empty-state-text: Text in empty state
- .text-secondary: Secondary text color
- .text-primary: Primary text color
- .fw-bold: Bold font weight
- .d-flex: Flexbox display
- .gap-3: Gap between flex items
- .rounded-circle: Circular shape

RESPONSIVE CLASSES:
- .d-none: Hide element
- .d-lg-none: Hide on large screens
- .d-flex: Flex display
- .w-100: Full width
- .flex-grow-1: Grow to fill space

HOVER CLASSES:
- .hover-elevate: Elevate on hover
- .hover-text-primary: Primary color on hover
- .transition-all: Smooth transition
*/
?>

<!-- ==========================================
     INTEGRATION CHECKLIST
     ========================================== -->

<?php 
/*
When creating a new modernized page:

☑ 1. Include page header with icon
☑ 2. Use appropriate grid (gallery-grid, gallery-grid-2, list-group-modern)
☑ 3. Add empty state for no results
☑ 4. Use card-base for content containers
☑ 5. Apply proper text classes (font-bold, text-secondary)
☑ 6. Add action buttons with correct styling
☑ 7. Ensure mobile responsiveness (test at 375px, 768px, 1920px)
☑ 8. Add hover effects to interactive elements
☑ 9. Verify color contrast (WCAG AA - 4.5:1)
☑ 10. Test on multiple browsers (Chrome, Firefox, Safari, Edge)
☑ 11. Verify form inputs have proper labels
☑ 12. Check icon rendering (fa-*)
☑ 13. Verify touch targets are ≥44px
☑ 14. Test form submission
☑ 15. Add page documentation comment

*/
?>

<!-- ==========================================
     EXAMPLE PAGE: COMPLETE IMPLEMENTATION
     ========================================== -->

<!-- FULL EXAMPLE: My Questions Page -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center gap-3 mb-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" 
             style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent), var(--accent-d)); color: white; font-size: 1.5rem;">
            <i class="fas fa-question-circle"></i>
        </div>
        <div>
            <h1 class="page-header-title mb-0">My Questions</h1>
            <p class="page-header-subtitle mb-0">Manage your published questions and track responses</p>
        </div>
    </div>
</div>

<!-- Filter Controls -->
<div class="d-flex gap-2 mb-5 flex-wrap">
    <button class="btn btn-primary btn-sm">Recent</button>
    <button class="btn btn-outline-primary btn-sm">Popular</button>
    <button class="btn btn-outline-primary btn-sm">Unanswered</button>
</div>

<?php if(empty($questions)): ?>
    <div class="empty-state">
        <div class="empty-state-icon">🤔</div>
        <h5 class="empty-state-title">No Questions Yet</h5>
        <p class="empty-state-text">You haven't asked any questions yet. Start by asking your first question!</p>
        <div class="empty-state-action">
            <a href="/questions/create" class="btn btn-primary">Ask Your First Question</a>
        </div>
    </div>
<?php else: ?>
    <div class="gallery-grid">
        <?php foreach($questions as $q): ?>
        <div class="card-base q-card">
            <h5 class="fw-bold mb-3 line-clamp-2"><?= htmlspecialchars($q['title']) ?></h5>
            
            <p class="text-secondary mb-3" style="font-size: 0.9rem;">
                <?= htmlspecialchars(substr(strip_tags($q['description']), 0, 100)) ?>...
            </p>
            
            <div class="d-flex gap-2 mb-3 flex-wrap">
                <span class="badge" style="background: var(--bg3); color: var(--txt2);">
                    <i class="fas fa-comments me-1"></i><?= $q['answer_count'] ?> answers
                </span>
                <span class="badge" style="background: var(--bg3); color: var(--txt2);">
                    <i class="fas fa-eye me-1"></i><?= $q['view_count'] ?> views
                </span>
            </div>
            
            <div class="d-flex gap-2 pt-3 border-top" style="border-color: var(--bdr);">
                <a href="/questions/<?= $q['id'] ?>" class="btn btn-outline-primary btn-sm flex-grow-1">View</a>
                <a href="/questions/<?= $q['id'] ?>/edit" class="btn btn-outline-secondary btn-sm flex-grow-1">Edit</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

