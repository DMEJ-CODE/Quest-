<!-- Q&A COMMUNITY FEED LAYOUT -->
<div class="row g-4 reveal">
    <!-- LEFT: MAIN FEED COLUMN -->
    <div class="col-12 col-lg-8">
        
        <div class="mt-2"></div>

        <!-- Mobile-Only Expandable Search (Sticky at top of feed) -->
        <div class="d-lg-none position-sticky" style="top: 0; z-index: 1015; margin: -1rem -1.5rem 1.5rem;">
            <div class="d-flex justify-content-end p-3" id="mobileSearchContainer">
                <form action="/search" method="GET" class="search-expandable" id="searchForm">
                    <input type="text" name="q" id="searchInput" placeholder="Search in feed..." class="search-input" autocomplete="off">
                    <button type="button" class="search-btn" id="searchToggle">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <style>
            .search-expandable {
                position: relative;
                width: 45px;
                height: 45px;
                background: var(--card);
                border-radius: 50px;
                transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                display: flex;
                align-items: center;
                overflow: hidden;
                box-shadow: 0 8px 20px var(--sh);
                border: 1px solid var(--bdr);
            }
            .search-expandable.active {
                width: 100%;
                box-shadow: 0 10px 25px var(--sh2);
            }
            .search-input {
                width: 100%;
                height: 100%;
                border: none;
                background: transparent;
                padding: 0 15px 0 50px;
                outline: none;
                font-size: 0.9rem;
                font-weight: 600;
                color: var(--txt);
                opacity: 0;
                transition: opacity 0.3s;
            }
            .search-expandable.active .search-input {
                opacity: 1;
            }
            .search-btn {
                position: absolute;
                left: 0;
                width: 45px;
                height: 100%;
                background: transparent;
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--txt2);
                font-size: 1.1rem;
                cursor: pointer;
                transition: all 0.3s;
                z-index: 2;
            }
            .search-expandable.active .search-btn {
                color: var(--accent);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toggle = document.getElementById('searchToggle');
                const form = document.getElementById('searchForm');
                const input = document.getElementById('searchInput');

                toggle.addEventListener('click', (e) => {
                    if (!form.classList.contains('active')) {
                        form.classList.add('active');
                        input.focus();
                    } else {
                        if (input.value.trim() !== "") {
                            form.submit();
                        } else {
                            form.classList.remove('active');
                        }
                    }
                });

                // Close when clicking outside
                document.addEventListener('click', (e) => {
                    if (!form.contains(e.target) && form.classList.contains('active')) {
                        form.classList.remove('active');
                    }
                });

                // Submit on Enter
                input.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') {
                        form.submit();
                    }
                });
            });
        </script>

        <!-- Feed Items List -->
        <div class="d-flex flex-column gap-4" id="feed-items-container">
            <?php if (empty($questions)): ?>
                <div class="col-12 py-5 my-4 text-center bg-white shadow-sm border-0 rounded-4" style="border-radius: 32px !important;">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-search text-muted" style="font-size: 2rem; opacity: 0.3;"></i>
                    </div>
                    <h3 class="fw-bolder text-dark mb-2" style="letter-spacing: -0.02em;">Nothing found!</h3>
                    <p class="text-secondary mx-auto mb-4 px-3" style="max-width: 400px; font-size: 0.95rem;">
                        We couldn't find any questions matching your current filters. Try exploring other categories or clearing your search.
                    </p>
                    <a href="/dashboard/questions" class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm">
                        Back to All Feed
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($questions as $q): ?>
                    <!-- Full-Width Feed Card -->
                    <div class="q-card feed-item-master border-0 bg-white p-3 p-md-4 h-100 d-flex flex-column hover-elevate-card shadow-sm" data-id="<?= $q['id'] ?>" style="border-radius: 28px; transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1); border: 1px solid rgba(0,0,0,0.03);">
                        
                        <!-- Header: User & Time -->
                        <div class="d-flex justify-content-between align-items-center mb-3 mb-md-4">
                            <div class="d-flex align-items-center gap-2 gap-md-3">
                                <div class="avatar-master rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--g400), var(--g700)); border: 2px solid #fff;">
                                    <?= strtoupper(substr($q['author_name'] ?? 'U', 0, 1)) ?>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-bolder text-dark mb-0" style="font-size: 0.95rem;"><?= htmlspecialchars($q['author_name'] ?? 'Anonymous') ?></span>
                                    <span class="text-secondary" style="font-size: 0.75rem;">
                                        <?= date('M d, Y', strtotime($q['created_at'])) ?> · <i class="fas fa-clock fs-xs"></i> 
                                        <?php 
                                            $diff = time() - strtotime($q['created_at']);
                                            if($diff < 3600) echo max(1, floor($diff/60)) . 'm ago';
                                            elseif($diff < 86400) echo floor($diff/3600) . 'h ago';
                                            else echo floor($diff/86400) . 'd ago';
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <button class="btn btn-light rounded-circle border-0 shadow-sm-hover" style="width: 40px; height: 40px;">
                                <i class="fas fa-ellipsis-h text-muted"></i>
                            </button>
                        </div>

                        <!-- Content Body -->
                        <div class="flex-grow-1 px-1">
                            <h3 class="fw-bolder mb-2 mb-md-3" style="letter-spacing: -0.02em; line-height: 1.3; font-size: clamp(1.1rem, 2.5vw, 1.4rem);">
                                <a href="/questions/<?= $q['id'] ?>" class="text-dark text-decoration-none hover-text-primary">
                                    <?= htmlspecialchars($q['title']) ?>
                                </a>
                            </h3>
                            <p class="text-secondary mb-3 mb-md-4" style="font-size: 0.94rem; line-height: 1.6; opacity: 0.85;">
                                <?= htmlspecialchars(substr(strip_tags($q['description'] ?? ''), 0, 180)) ?>...
                            </p>
                            
                            <!-- Tags Bar -->
                            <?php if(!empty($q['tags'])): ?>
                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <?php foreach(explode(',', $q['tags']) as $tag): ?>
                                    <span class="badge rounded-pill bg-light text-dark px-3 py-2 fw-bold border-0 hover-bg-dark transition-all" style="font-size: 0.75rem;">
                                        #<?= htmlspecialchars(trim($tag)) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Interactions Bar -->
                        <div class="border-top pt-3 pt-md-4 mt-1 d-flex justify-content-between align-items-center" style="border-top: 1px solid rgba(0,0,0,0.05) !important;">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="/questions/<?= $q['id'] ?>#votes" class="btn btn-light rounded-pill px-2 px-md-3 py-2 border-0 d-inline-flex align-items-center gap-2 fw-bolder hover-elevate transition-all" style="font-size: 0.8rem; color: #4B5563;">
                                    <i class="fas fa-arrow-up text-success"></i> <?= $q['vote_count'] ?? 0 ?>
                                </a>
                                <a href="/questions/<?= $q['id'] ?>#answers" class="btn btn-light rounded-pill px-2 px-md-3 py-2 border-0 d-inline-flex align-items-center gap-2 fw-bolder hover-elevate transition-all" style="font-size: 0.8rem; color: #4B5563;">
                                    <i class="fas fa-reply text-primary"></i> <?= $q['answers_count'] ?? 0 ?>
                                </a>
                                <a href="/questions/<?= $q['id'] ?>#comments" class="btn btn-light rounded-pill px-2 px-md-3 py-2 border-0 d-inline-flex align-items-center gap-2 fw-bolder hover-elevate transition-all" style="font-size: 0.8rem; color: #4B5563;">
                                    <i class="fas fa-comment-dots text-secondary"></i> <?= $q['comments_count'] ?? 0 ?>
                                </a>
                                <div class="btn btn-light rounded-pill px-2 px-md-3 py-2 border-0 d-inline-flex align-items-center gap-2 fw-bolder d-none d-sm-flex" style="font-size: 0.8rem; color: #4B5563; cursor: default;">
                                    <i class="fas fa-eye text-info"></i> <?= $q['views'] ?? 0 ?>
                                </div>
                            </div>
                            <div class="text-muted" style="font-size: 0.8rem; font-weight: 600;">
                                <i class="fas fa-fire me-1 text-danger"></i> Trending now
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Feed Loader -->
        <div id="feed-loader" class="mt-4 text-center py-4" style="visibility: hidden;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- RIGHT: SIDEBAR (STICKY & INDEPENDENT SCROLL) -->
    <div class="col-12 col-lg-4 d-none d-lg-block">
        <div class="sticky-sidebar-wrapper">
            
            <!-- Sidebar Search & Categories -->
            <div class="q-card border-0 bg-white p-4 mb-4" style="border-radius: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.03);">
                <h5 class="fw-bolder text-dark mb-3 px-2">Discover Feed</h5>
                <form action="/search" method="GET" class="position-relative mb-4">
                    <input type="text" name="q" placeholder="Find in feed..." class="form-control rounded-pill border py-2 px-4 fw-bold" style="font-size: 0.85rem; background: #fbfbfc;">
                    <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-3 text-secondary"></i>
                </form>

                <div class="d-flex flex-column gap-2">
                    <div class="text-secondary fw-bold px-2 mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em; text-transform: uppercase;">Categories</div>
                    <a href="/dashboard/questions" class="side-cat-link active">
                        <i class="fas fa-stream"></i> All Discussions
                    </a>
                    <a href="/questions/trending" class="side-cat-link">
                        <i class="fas fa-fire"></i> Popular Weekly
                    </a>
                    <a href="/questions/my-questions" class="side-cat-link">
                        <i class="fas fa-user-circle"></i> My Submissions
                    </a>
                    <a href="/dashboard/tags" class="side-cat-link">
                        <i class="fas fa-tags"></i> Browse All Topics
                    </a>
                </div>
            </div>

            <!-- Quick Stats Card -->
            <div class="q-card border-0 bg-white p-4 mb-4" style="border-radius: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.03);">
                <h5 class="fw-bolder text-dark mb-4 px-2">Community Vitals</h5>
                <div class="row g-2">
                    <div class="col-6">
                        <div class="p-3 rounded-4 text-center" style="background: rgba(34, 197, 94, 0.05);">
                            <div class="h4 fw-bolder text-success mb-1"><?= $qCount ?? 0 ?></div>
                            <span class="text-secondary text-uppercase fw-bold" style="font-size: 0.6rem;">Questions</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-4 text-center" style="background: rgba(59, 130, 246, 0.05);">
                            <div class="h4 fw-bolder text-primary mb-1"><?= $uCount ?? 0 ?></div>
                            <span class="text-secondary text-uppercase fw-bold" style="font-size: 0.6rem;">Thinkers</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trending Tags Card (Multi-Select) -->
            <div class="q-card border-0 bg-white p-4 mb-4" style="border-radius: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.02); border: 1px solid rgba(0,0,0,0.03);">
                <div class="d-flex justify-content-between align-items-center mb-4 px-2">
                    <h5 class="fw-bolder text-dark mb-0">Trending Now</h5>
                    <i class="fas fa-bolt text-warning"></i>
                </div>
                <div class="d-flex flex-column gap-3" id="trending-tags-filter">
                    <?php if(!empty($trending)): foreach($trending as $trend): ?>
                        <div class="d-flex align-items-center justify-content-between p-2 rounded-3 hover-bg-light transition-all tag-checkbox-item" style="cursor: pointer;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="form-check m-0">
                                    <input class="form-check-input tag-filter-checkbox" type="checkbox" value="<?= htmlspecialchars($trend['name']) ?>" id="tag-<?= $trend['name'] ?>" 
                                        <?= (isset($_GET['tags']) && in_array($trend['name'], explode(',', $_GET['tags']))) ? 'checked' : '' ?>>
                                </div>
                                <label class="fw-bold text-dark m-0" for="tag-<?= $trend['name'] ?>" style="font-size: 0.95rem; cursor: pointer;"><?= htmlspecialchars($trend['name']) ?></label>
                            </div>
                            <span class="badge rounded-pill bg-light text-secondary fw-bold border-0 px-2 py-1" style="font-size: 0.75rem;">
                                <?= $trend['count'] ?>
                            </span>
                        </div>
                    <?php endforeach; else: ?>
                        <div class="text-center py-3 text-muted">No trending tags</div>
                    <?php endif; ?>
                </div>
                <button id="apply-tag-filters" class="btn btn-dark w-100 rounded-pill mt-4 fw-bold py-2 d-none" style="font-size: 0.85rem;">Apply Filters</button>
            </div>

            <!-- Promotion Card -->
            <div class="q-card border-0 p-4 mb-5" style="border-radius: 28px; background: linear-gradient(135deg, #1e293b, #0f172a); color: white;">
                <div class="mb-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 44px; height: 44px; background: rgba(255,255,255,0.1);">
                    <i class="fas fa-rocket text-warning"></i>
                </div>
                <h5 class="fw-bold mb-2">Be more visible!</h5>
                <p class="mb-3" style="font-size: 0.8rem; opacity: 0.7; line-height: 1.5;">Highlight your profile and questions to get expert help faster.</p>
                <button class="btn btn-light w-100 rounded-pill fw-bold py-2" style="font-size: 0.8rem;">Upgrade Now</button>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let currentPage = 1;
        let isLoading = false;
        let hasMore = <?= (!empty($questions) && count($questions) >= 10) ? 'true' : 'false' ?>;
        const container = document.getElementById('feed-items-container');
        const loader = document.getElementById('feed-loader');

        if(hasMore && loader) {
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && !isLoading && hasMore) {
                    loadMore();
                }
            }, { threshold: 0.1 });
            observer.observe(loader);
        }

        // --- TAG FILTER LOGIC ---
        const tagCheckboxes = document.querySelectorAll('.tag-filter-checkbox');
        const applyBtn = document.getElementById('apply-tag-filters');

        tagCheckboxes.forEach(cb => {
            cb.addEventListener('change', () => {
                applyBtn.classList.remove('d-none');
                // Auto-apply logic (optional, user can click apply or it triggers automatically)
                // Let's make it auto-apply after 500ms for smoothness
                clearTimeout(this.filterTimeout);
                this.filterTimeout = setTimeout(() => applyFilters(), 800);
            });
        });

        if(applyBtn) applyBtn.addEventListener('click', applyFilters);

        function applyFilters() {
            const selected = Array.from(tagCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            
            if (selected.length > 0) {
                window.location.href = `/questions/trending?tags=${selected.join(',')}`;
            } else {
                window.location.href = '/dashboard/questions';
            }
        }

        function loadMore() {
            isLoading = true;
            loader.style.visibility = 'visible';
            currentPage++;

            fetch('/questions/load-more', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `page=${currentPage}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.questions.length > 0) {
                    data.questions.forEach(q => {
                        container.insertAdjacentHTML('beforeend', createQuestionCard(q));
                    });
                    if (data.questions.length < 10) {
                        hasMore = false;
                        loader.remove();
                    }
                } else {
                    hasMore = false;
                    loader.remove();
                }
                isLoading = false;
                loader.style.visibility = 'hidden';
            })
            .catch(() => {
                isLoading = false;
                loader.style.visibility = 'hidden';
            });
        }

        function createQuestionCard(q) {
            const date = new Date(q.created_at).toLocaleDateString();
            const tags = q.tags ? q.tags.split(',').map(t => `<span class="badge rounded-pill bg-light text-dark px-3 py-2 fw-bold border-0 hover-bg-dark transition-all" style="font-size: 0.75rem;">#${t.trim()}</span>`).join('') : '';
            return `
                <div class="q-card feed-item-master border-0 bg-white p-4 h-100 d-flex flex-column hover-elevate-card" data-id="${q.id}" style="border-radius: 32px; box-shadow: 0 4px 30px rgba(0,0,0,0.02); transition: all 0.3s cubic-bezier(0.25, 1, 0.5, 1); border: 1px solid rgba(0,0,0,0.03);">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar-master rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--g400), var(--g700)); border: 2px solid #fff;">
                                ${(q.author_name || 'U').charAt(0).toUpperCase()}
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fw-bolder text-dark mb-0" style="font-size: 1rem;">${q.author_name || 'Anonymous'}</span>
                                <span class="text-secondary" style="font-size: 0.75rem;">${date}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-grow-1 px-1">
                        <h3 class="fw-bolder mb-3" style="letter-spacing: -0.03em; line-height: 1.3;">
                            <a href="/questions/${q.id}" class="text-dark text-decoration-none hover-text-primary">${q.title}</a>
                        </h3>
                        <p class="text-secondary mb-4" style="font-size: 1rem; line-height: 1.7; opacity: 0.85;">${(q.description || '').replace(/<[^>]*>/g, '').substring(0, 220)}...</p>
                        <div class="d-flex flex-wrap gap-2 mb-4">${tags}</div>
                    </div>
                    <div class="border-top pt-4 mt-2 d-flex justify-content-between align-items-center" style="border-top: 1px solid rgba(0,0,0,0.05) !important;">
                        <div class="d-flex gap-2">
                             <a href="/questions/${q.id}#votes" class="btn btn-light rounded-pill px-3 py-2 border-0 d-inline-flex align-items-center gap-2 fw-bolder hover-elevate" style="font-size: 0.85rem;"><i class="fas fa-arrow-up text-success"></i> ${q.vote_count || 0}</a>
                             <a href="/questions/${q.id}#answers" class="btn btn-light rounded-pill px-3 py-2 border-0 d-inline-flex align-items-center gap-2 fw-bolder hover-elevate" style="font-size: 0.85rem;"><i class="fas fa-reply text-primary"></i> ${q.answers_count || 0}</a>
                             <a href="/questions/${q.id}#comments" class="btn btn-light rounded-pill px-3 py-2 border-0 d-inline-flex align-items-center gap-2 fw-bolder hover-elevate" style="font-size: 0.85rem;"><i class="fas fa-comment-dots text-secondary"></i> ${q.comments_count || 0}</a>
                             <div class="btn btn-light rounded-pill px-3 py-2 border-0 d-inline-flex align-items-center gap-2 fw-bolder" style="font-size: 0.85rem; color: #4B5563; cursor: default;"><i class="fas fa-eye text-info"></i> ${q.views || 0}</div>
                        </div>
                    </div>
                </div>
            `;
        }
    });
</script>

<style>
    .sticky-sidebar-wrapper {
        position: sticky;
        top: 2rem;
        max-height: calc(100vh - 4rem);
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .sticky-sidebar-wrapper::-webkit-scrollbar { display: none; }
    
    .side-cat-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--txt3);
        transition: all 0.2s;
        text-decoration: none;
    }
    .side-cat-link i { width: 20px; font-size: 1rem; opacity: 0.7; }
    .side-cat-link:hover { background: #f8fafc; color: var(--accent); }
    .side-cat-link.active { background: var(--bg3); color: var(--accent); }

    .hover-elevate:hover { transform: translateY(-2px); filter: brightness(0.95); }
    .hover-elevate-card:hover { transform: translateY(-6px); box-shadow: 0 15px 45px rgba(0,0,0,0.06) !important; border-color: rgba(22, 163, 74, 0.15) !important; }
    .hover-text-primary:hover { color: var(--g700) !important; }
    .hover-bg-light:hover { background: #f8fafc; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    .fs-xs { font-size: 0.65rem; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .feed-item-master { animation: fadeIn 0.4s ease-out forwards; }
</style>
