<!-- Modern Questions Index Layout -->
<div class="page-header mb-5">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--accent), var(--accent-d)); color: white; font-size: 1.5rem;">
                <i class="fas fa-questions"></i>
            </div>
            <div>
                <h1 class="page-header-title mb-0">Questions</h1>
                <p class="page-header-subtitle mb-0">Explore, ask, and answer community questions</p>
            </div>
        </div>
        <a href="/questions/create" class="btn btn-primary btn-lg">
            <i class="fas fa-pencil-alt me-1"></i> Ask Question
        </a>
    </div>
</div>

<!-- Search & Filters -->
<div class="card-base mb-4">
    <div class="d-flex flex-column flex-md-row gap-3 align-items-md-center">
        <div class="flex-grow-1">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search questions...">
            </div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <button class="btn btn-secondary active">All</button>
            <button class="btn btn-secondary">Unanswered</button>
            <button class="btn btn-secondary">Trending</button>
        </div>
    </div>
</div>

<!-- Questions List -->
<div class="gallery-grid-2">
    <!-- Sample Question Card -->
    <div class="card-base q-card hover-lift">
        <div class="d-flex justify-content-between mb-2">
            <span class="badge variant-info"><i class="fas fa-arrow-up me-1"></i> +15 votes</span>
            <span class="badge variant-success">3 answers</span>
        </div>
        <h5 class="q-card-title mb-2">
            <a href="#" class="text-decoration-none">How to optimize database queries in Laravel?</a>
        </h5>
        <p class="q-card-body mb-3">
            I'm working on a Laravel application that fetches data from multiple tables. The queries are slow and I need optimization tips for better performance...
        </p>
        <div class="d-flex gap-2 mb-3 flex-wrap">
            <span class="tag">laravel</span>
            <span class="tag">database</span>
            <span class="tag">performance</span>
        </div>
        <div class="q-card-footer">
            <div class="user-info">
                <div class="avatar-sm" style="background: linear-gradient(135deg, var(--accent), var(--accent-d));">JD</div>
                <div class="user-info-text">
                    <div class="user-name">John Doe</div>
                    <div class="user-meta">2 hours ago</div>
                </div>
            </div>
        </div>
    </div>
</div>
