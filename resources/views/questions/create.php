<div class="row justify-content-center reveal">
    <div class="col-12 col-lg-10">
        
        <!-- Page Introduction -->
        <div class="mb-5 text-center">
            <h1 class="page-title mb-2">Ask a Question</h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">
                Share your problem with the community. Be specific and descriptive to get the best help.
            </p>
        </div>

        <!-- Main Form Card -->
        <div class="form-wrapper shadow-lg border-0 mb-5">
            
            <form action="/questions" method="POST">
                
                <!-- Step 1: Title -->
                <div class="form-section mb-5">
                    <div class="form-section-title">
                        <div class="form-section-number">1</div>
                        <h3>Topic Title</h3>
                    </div>
                    <p class="text-muted small mb-3">
                        <i class="fas fa-lightbulb me-1 text-accent"></i> 
                        Imagine you're asking a question to another person. Keep it clear and concise.
                    </p>
                    <div class="form-group">
                        <input type="text" name="title" id="title" class="form-control form-control-lg py-3 fw-bold" 
                               placeholder="e.g. How do I center a div using CSS Flexbox?" required autofocus>
                    </div>
                </div>

                <!-- Step 2: Detailed Explanation -->
                <div class="form-section mb-5">
                    <div class="form-section-title">
                        <div class="form-section-number">2</div>
                        <h3>Detailed Explanation</h3>
                    </div>
                    <p class="text-muted small mb-3">
                        Introduce the problem and expand on what you put in the title. Minimum 20 characters.
                    </p>
                    <div class="form-group position-relative rounded-4 overflow-hidden border">
                        <textarea name="description" id="description" class="form-control border-0 p-4" 
                                  placeholder="Describe what you've tried, expected outcomes, and actual results..." 
                                  style="min-height: 250px; border-radius: 0 !important; font-family: var(--ff); line-height: 1.6;" required></textarea>
                        
                        <!-- Premium Markdown Toolbar -->
                        <div class="d-flex align-items-center gap-1 p-2 bg-light border-top" style="border-color: var(--bdr) !important;">
                            <button type="button" class="btn btn-sm btn-icon-q" title="Bold"><i class="fas fa-bold"></i></button>
                            <button type="button" class="btn btn-sm btn-icon-q" title="Italic"><i class="fas fa-italic"></i></button>
                            <div class="mx-1 border-start h-50" style="width:1px; height:20px; border-color:var(--bdr2) !important"></div>
                            <button type="button" class="btn btn-sm btn-icon-q" title="Code Block"><i class="fas fa-code"></i></button>
                            <button type="button" class="btn btn-sm btn-icon-q" title="Link"><i class="fas fa-link"></i></button>
                            <button type="button" class="btn btn-sm btn-icon-q" title="Image"><i class="fas fa-image"></i></button>
                            <div class="ms-auto d-flex align-items-center me-2">
                                <span class="text-xs text-muted fw-bold">Markdown Supported</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Tags -->
                <div class="form-section mb-4">
                    <div class="form-section-title">
                        <div class="form-section-number">3</div>
                        <h3>Add Tags</h3>
                    </div>
                    <p class="text-muted small mb-3">
                        Add up to 5 tags to describe what your question is about (comma separated).
                    </p>
                    <div class="form-group">
                        <div class="input-group shadow-sm rounded-4 overflow-hidden border">
                            <span class="input-group-text border-0 ps-3 bg-white text-muted">
                                <i class="fas fa-hashtag"></i>
                            </span>
                            <input type="text" name="tags_input" id="tags_input" class="form-control border-0 py-3 ps-2" 
                                   placeholder="e.g. javascript, react, frontend">
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions border-0 pt-2 p-0">
                    <a href="/dashboard/questions" class="btn btn-link text-decoration-none text-muted fw-800 small p-0 align-self-center">
                        <i class="fas fa-times me-1"></i> Discard Draft
                    </a>
                    <button type="submit" class="btn btn-q rounded-pill px-5 ms-auto shadow-lg">
                        <i class="fas fa-paper-plane me-2"></i> Publish Question
                    </button>
                </div>

            </form>
        </div>

        <!-- Tips Header -->
        <h5 class="fw-800 text-dark mb-4 px-1" style="font-size: 1.1rem;">
            <i class="fas fa-magic me-2 text-accent"></i> Tips for a Great Question
        </h5>

        <!-- Tips Row -->
        <div class="row g-4 mb-5">
            <div class="col-12 col-md-4">
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm transition-hover">
                    <div class="d-flex align-items-center justify-content-center rounded-3 mb-3 border shadow-sm" style="width: 48px; height: 48px; background: rgba(var(--accent-rgb), 0.05); color: var(--accent); font-size: 1.2rem;">
                        <i class="fas fa-search"></i>
                    </div>
                    <h6 class="fw-800 mb-2">Search First</h6>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Check if someone has already asked the same question. It might save your time and help you find an answer faster.
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm transition-hover">
                    <div class="d-flex align-items-center justify-content-center rounded-3 mb-3 border shadow-sm" style="width: 48px; height: 48px; background: #f0fdf4; color: #16a34a; font-size: 1.2rem;">
                        <i class="fas fa-terminal"></i>
                    </div>
                    <h6 class="fw-800 mb-2">Be Specific</h6>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Include all relevant details, like code samples, error messages, or context about your environment.
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="p-4 rounded-4 bg-white border h-100 shadow-sm transition-hover">
                    <div class="d-flex align-items-center justify-content-center rounded-3 mb-3 border shadow-sm" style="width: 48px; height: 48px; background: #fffcf0; color: #ca8a04; font-size: 1.2rem;">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h6 class="fw-800 mb-2">Be Respectful</h6>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        The community is built on mutual respect. Be kind and polite when describing your issue to others.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .btn-icon-q {
        width: 32px; height: 32px; padding: 0;
        display: flex; align-items: center; justify-content: center;
        color: var(--txt4); border-radius: 6px; transition: all 0.2s;
    }
    .btn-icon-q:hover { background: var(--bdr2); color: var(--txt2); }
    .transition-hover { transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .transition-hover:hover { transform: translateY(-5px); box-shadow: 0 12px 30px rgba(0,0,0,0.08) !important; border-color: var(--accent) !important; }
    .fw-800 { font-weight: 800; }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Reveal animation sequence
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach((el, i) => {
            setTimeout(() => el.classList.add('visible'), i * 100);
        });
    }, 50);
});
</script>
