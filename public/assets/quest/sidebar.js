/**
 * Sidebar and Submenu Logic
 * Handles the interaction between the primary icon strip and secondary dynamic sidebar
 */

/* ── Context data structure ── */
const sidebarContexts = {
    'dashboard': [{
        section: 'DASHBOARD',
        links: [
            { icon: 'fas fa-eye', label: 'Overview', url: '/dashboard' },
            { icon: 'fas fa-users-cog', label: 'Members', url: '/dashboard/members' },
            { icon: 'fas fa-chart-line', label: 'Analytics', url: '/dashboard/analytics' },
            { icon: 'fas fa-stream', label: 'Activity Feed', url: '/dashboard/activity-log' },
            { icon: 'fas fa-file-alt', label: 'Reports', url: '/dashboard/reports' }
        ]
    }],
    'questions': [{
        section: 'QUESTIONS',
        links: [
            { icon: 'fas fa-list', label: 'All Questions', url: '/dashboard/questions' },
            { icon: 'fas fa-plus-circle', label: 'Ask Question', url: '/dashboard/questions/create' },
            { icon: 'fas fa-fire', label: 'Trending', url: '/dashboard/questions/trending' },
            { icon: 'fas fa-clock', label: 'Recent', url: '/dashboard/questions/recent' },
            { icon: 'fas fa-bookmark', label: 'Saved Questions', url: '/dashboard/questions/saved' },
            { icon: 'fas fa-user-edit', label: 'My Questions', url: '/dashboard/questions/my-questions' }
        ]
    }],
    'answers': [{
        section: 'ANSWERS',
        links: [
            { icon: 'fas fa-comments', label: 'All Answers', url: '/dashboard/answers' },
            { icon: 'fas fa-user-check', label: 'My Answers', url: '/dashboard/answers/my-answers' },
            { icon: 'fas fa-check-circle', label: 'Accepted Answers', url: '/dashboard/answers/accepted' },
            { icon: 'fas fa-star', label: 'Most Voted', url: '/dashboard/answers/voted' },
            { icon: 'fas fa-hourglass-half', label: 'Pending Answers', url: '/dashboard/answers/pending' }
        ]
    }],
    'voting': [{
        section: 'VOTING',
        links: [
            { icon: 'fas fa-arrow-up', label: 'Upvotes Given', url: '/dashboard/voting/upvotes' },
            { icon: 'fas fa-arrow-down', label: 'Downvotes Given', url: '/dashboard/voting/downvotes' },
            { icon: 'fas fa-hand-paper', label: 'My Votes', url: '/dashboard/voting/my-votes' },
            { icon: 'fas fa-history', label: 'Vote History', url: '/dashboard/voting/history' },
            { icon: 'fas fa-trophy', label: 'Top Voted Content', url: '/dashboard/voting/top' }
        ]
    }],
    'tags': [{
        section: 'TAGS',
        links: [
            { icon: 'fas fa-tags', label: 'All Tags', url: '/dashboard/tags' },
            { icon: 'fas fa-fire-alt', label: 'Popular Tags', url: '/dashboard/tags/popular' },
            { icon: 'fas fa-search', label: 'Search Tags', url: '/dashboard/tags/search' },
            { icon: 'fas fa-heart', label: 'Followed Tags', url: '/dashboard/tags/followed' },
            { icon: 'fas fa-cogs', label: 'Tag Management', url: '/dashboard/tags/management' }
        ]
    }],
    'profile': [{
        section: 'PROFILE',
        links: [
            { icon: 'fas fa-id-card', label: 'Profile Overview', url: '/dashboard/profile' },
            { icon: 'fas fa-user-edit', label: 'Edit Profile', url: '/dashboard/profile/edit' },
            { icon: 'fas fa-tasks', label: 'My Activity', url: '/dashboard/profile/myactivity' },
            { icon: 'fas fa-star', label: 'Reputation & Points', url: '/dashboard/profile/reputation' },
            { icon: 'fas fa-medal', label: 'Badges', url: '/dashboard/profile/badges' }
        ]
    }],
    'security': [{
        section: 'SECURITY',
        links: [
            { icon: 'fas fa-key', label: 'Change Password', url: '/dashboard/security/password' },
            { icon: 'fas fa-shield-alt', label: 'Two-Factor Auth', url: '/dashboard/security/2fa' },
            { icon: 'fas fa-history', label: 'Login History', url: '/dashboard/security/history' },
            { icon: 'fas fa-laptop', label: 'Sessions', url: '/dashboard/security/sessions' }
        ]
    }],
    'notifications': [{
        section: 'NOTIFICATIONS',
        links: [
            { icon: 'fas fa-bell', label: 'All Notifications', url: '/dashboard/notifications' },
            { icon: 'fas fa-envelope-open-text', label: 'Unread', url: '/dashboard/notifications/unread' },
            { icon: 'fas fa-at', label: 'Mentions', url: '/dashboard/notifications/mentions' },
            { icon: 'fas fa-exclamation-triangle', label: 'System Alerts', url: '/dashboard/notifications/alerts' }
        ]
    }],
    'settings': [{
        section: 'SETTINGS',
        links: [
            { icon: 'fas fa-sliders-h', label: 'General Settings', url: '/dashboard/settings/general' },
            { icon: 'fas fa-heart', label: 'Preferences', url: '/dashboard/settings/preferences' },
            { icon: 'fas fa-language', label: 'Language', url: '/dashboard/settings/language' },
            { icon: 'fas fa-question-circle', label: 'Help / Support', url: '/dashboard/settings/help' }
        ]
    }],
    'leaderboard': [{
        section: 'LEADERBOARD',
        links: [
            { icon: 'fas fa-users', label: 'Top Users', url: '/dashboard/leaderboard/top' },
            { icon: 'fas fa-calendar-week', label: 'Weekly Ranking', url: '/dashboard/leaderboard/weekly' },
            { icon: 'fas fa-calendar-alt', label: 'Monthly Ranking', url: '/dashboard/leaderboard/monthly' }
        ]
    }]
};

/* ── Build Secondary Sidebar dynamically ── */
function renderSecondarySidebar(contextKey) {
    const sbnContent = document.getElementById('sbn-content');
    if (!sbnContent) return;

    // Fall back to dashboard if context is not found
    const sections = sidebarContexts[contextKey] || sidebarContexts['dashboard'];
    const currentPath = window.location.pathname;

    let html = '';
    let hasActive = false;

    sections.forEach(sec => {
        if (sec.section) {
            html += `<div class="sbn-lbl">${sec.section}</div>`;
        }

        sec.links.forEach(link => {
            // Hide admin-only links for regular users
            if (window.QUEST_USER_ROLE !== 'admin') {
                const adminLabels = ['Tag Management', 'Reports', 'Members', 'Platform Settings', 'General Settings'];
                if (adminLabels.includes(link.label)) return;
            }

            const isActive = link.url === currentPath;
            if (isActive) hasActive = true;

            const activeClass = isActive ? 'active' : '';
            const badgeHtml = link.badge ? `<span class="sbn-badge">${link.badge}</span>` : '';

            html += `
                <a href="${link.url}" class="sbn-link ${activeClass}" onclick="sbnClick(this,event)">
                    <span class="sbn-icon"><i class="${link.icon}"></i></span>${link.label}
                    ${badgeHtml}
                </a>
            `;
        });
    });

    sbnContent.innerHTML = html;

    // Automatically set the first link active if none matched the URL exactly
    if (!hasActive) {
        const firstLink = sbnContent.querySelector('.sbn-link');
        if (firstLink) firstLink.classList.add('active');
    }
}

function sbiClick(el, e) {
    e.preventDefault();
    const context = el.getAttribute('data-menu');
    let target = el.getAttribute('href');

    if (context && sidebarContexts[context]) {
        // ALWAYS fetch the first URL of the context unconditionally to prevent any loop logic fails
        target = sidebarContexts[context][0].links[0].url;

        // Quick verify if admin
        if (window.QUEST_USER_ROLE !== 'admin') {
            const adminLabels = ['Tag Management', 'Reports', 'Members', 'Platform Settings', 'General Settings'];
            if (adminLabels.includes(sidebarContexts[context][0].links[0].label)) {
                // If it's an admin link and they are not admin, fallback to the second link or original href
                target = sidebarContexts[context][0].links[1] ? sidebarContexts[context][0].links[1].url : el.getAttribute('href');
            }
        }
    }

    // Force immediate navigation, no hashtag magic that can crash routing on old browsers
    window.location.href = target;
}

/* ── Logout ── */
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        window.location.href = '/logout';
    }
}

/* ── Theme functions ── */
function setThemeButton(isDark) {
    const themeBtn = document.getElementById('themeBtn');
    if (!themeBtn) return;
    themeBtn.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
}

function applyTheme(theme) {
    const ts = (theme === 'dark') ? 'dark' : 'light';
    localStorage.setItem('questTheme', ts);
    document.documentElement.setAttribute('data-bs-theme', ts);
    setThemeButton(ts === 'dark');
}

function toggleTheme() {
    const current = document.documentElement.getAttribute('data-bs-theme') || 'light';
    const nextTheme = current === 'dark' ? 'light' : 'dark';
    applyTheme(nextTheme);
}

function initTheme() {
    const savedTheme = localStorage.getItem('questTheme') || 'light';
    applyTheme(savedTheme);
}

/* ── Topbar scroll shadow ── */
function initScrollShadow() {
    const mainContent = document.getElementById('mainContent');
    const topbar = document.getElementById('topbar');

    if (mainContent && topbar) {
        mainContent.addEventListener('scroll', function() {
            topbar.classList.toggle('scrolled', this.scrollTop > 8);
        }, { passive: true });
    }
}

/* ── Sidebar toggle logic ── */
const sbiEl = document.getElementById('sbi');
const sbnEl = document.getElementById('sbn');
const mobOv = document.getElementById('mobOv');

function toggleNav() {
    if (sbnEl) {
        sbnEl.classList.contains('open') ? closeAll() : openNav();
    }
}

function openNav() {
    if (sbiEl) sbiEl.classList.add('open');
    if (sbnEl) sbnEl.classList.add('open');
    if (mobOv) mobOv.classList.add('show');
    if (window.innerWidth < 768) document.body.style.overflow = 'hidden';
}

function closeAll() {
    if (sbiEl) sbiEl.classList.remove('open');
    if (sbnEl) sbnEl.classList.remove('open');
    if (mobOv) mobOv.classList.remove('show');
    document.body.style.overflow = '';
}

window.addEventListener('resize', () => {
    if (window.innerWidth >= 1280) closeAll();
}, { passive: true });

/* ── Nav link active state ── */
function sbnClick(el, e) {
    // We let the browser handle the native navigation! No preventDefault needed!
    // Just visually update the active class instantly before page unloads for quick feedback.
    document.querySelectorAll('.sbn-link').forEach(l => l.classList.remove('active'));
    el.classList.add('active');

    // Close the mobile navigation wrapper when clicked so it feels responsive
    if (window.innerWidth < 1280 && typeof closeAll === 'function') {
        closeAll();
    }
}

/* ── Highlight active link based on URL ── */
function highlightActivePrimaryNav() {
    const currentPath = window.location.pathname;
    let foundContext = 'dashboard'; // default

    // Smart context detection based on path parts
    if (currentPath.startsWith('/dashboard/')) {
        const parts = currentPath.split('/');
        // parts: ["", "dashboard", "module", ...]
        if (parts.length >= 3 && parts[2]) {
            if (sidebarContexts[parts[2]]) {
                foundContext = parts[2];
            } else {
                // Try fallback check if module name doesn't match contextkey directly
                for (const [contextKey, sections] of Object.entries(sidebarContexts)) {
                    for (const sec of sections) {
                        for (const link of sec.links) {
                            if (currentPath.startsWith(link.url) && link.url.length > 10) {
                                // length check ensures we don't match short root paths incorrectly
                                foundContext = contextKey;
                                break;
                            }
                        }
                    }
                }
            }
        }
    } else if (currentPath === '/dashboard') {
        foundContext = 'dashboard';
    } else {
        // Find which context matches the current URL exact or startsWith
        for (const [contextKey, sections] of Object.entries(sidebarContexts)) {
            for (const sec of sections) {
                for (const link of sec.links) {
                    if (currentPath === link.url) {
                        foundContext = contextKey;
                        break;
                    }
                }
            }
        }
    }

    // Update primary sidebar active class
    document.querySelectorAll('.sbi-btn').forEach(btn => {
        const menu = btn.getAttribute('data-menu');
        if (menu === foundContext) {
            btn.classList.add('active');
        } else if (menu) { // Only remove if it's a menu btn
            btn.classList.remove('active');
        }
    });

    return foundContext;
}

/* ── Scroll reveal animation ── */
function initScrollReveal() {
    const mainContent = document.getElementById('mainContent');

    if (!mainContent) return;

    const ro = new IntersectionObserver(entries => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 55);
                ro.unobserve(e.target);
            }
        });
    }, { root: mainContent, threshold: .06 });

    document.querySelectorAll('.reveal').forEach(el => ro.observe(el));
}

/* ── Initialize on DOM ready ── */
document.addEventListener('DOMContentLoaded', function() {
    initTheme();
    initScrollShadow();
    initScrollReveal();

    // Set correct context on load and render
    const activeContext = highlightActivePrimaryNav();
    renderSecondarySidebar(activeContext);

    // Check if we need to open the nav dynamically (useful for mobile auto-redirect)
    if (window.location.hash.includes('open-nav')) {
        if (typeof openNav === 'function' && window.innerWidth < 1280) {
            openNav();
        }
    }
    initMobileScrollHint();
});
/* ── Mobile Scroll Hint Logic ── */
function initMobileScrollHint() {
    const container = document.getElementById('sbn-content');
    const hint = document.getElementById('sbnScrollHint');

    if (container && hint) {
        container.addEventListener('scroll', () => {
            if (container.scrollLeft > 20) {
                hint.classList.add('hidden');
            } else {
                hint.classList.remove('hidden');
            }
        }, { passive: true });
    }
}