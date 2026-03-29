    <div class="row justify-content-center">
        <div class="col-12 col-lg-9">
            <div class="mb-5 text-center">
                <h1 class="page-title mb-2 text-gradient fw-bold">Update Your Topic</h1>
                <p class="page-sub text-secondary mx-auto" style="max-width: 500px;">
                    Tweak your question to get better results.
                </p>
            </div>

            <div class="q-card p-5 border shadow-sm rounded-4 bg-white transition-all">
                <form action="/questions/<?= $question['id'] ?>/update" method="POST">
                    <!-- Title Row -->
                    <div class="mb-5">
                        <label for="title" class="form-label fw-bold h5 mb-3">Topic Title</label>
                        <p class="text-muted smaller mb-3">Keep it simple and relevant.</p>
                        <input type="text" name="title" id="title" class="form-control border-0 bg-light p-3 rounded-3" 
                            value="<?= htmlspecialchars($question['title']) ?>" placeholder="e.g. Is there an R function for finding the index of an element in a vector?" required autofocus>
                    </div>

                    <!-- Description Row -->
                    <div class="mb-5">
                        <label for="description" class="form-label fw-bold h5 mb-3">What are the details of your problem?</label>
                        <p class="text-muted smaller mb-3">Give context and elaborate on the issues you're facing. Minimum 20 characters.</p>
                        <textarea name="description" id="description" class="form-control border-0 bg-light p-3 rounded-3" 
                                rows="10" placeholder="Describe what you've tried and what went wrong..." required><?= htmlspecialchars($question['description']) ?></textarea>
                    </div>

                    <!-- Status Row -->
                    <div class="mb-5">
                        <label for="status" class="form-label fw-bold h5 mb-3">Discussion Status</label>
                        <select name="status" id="status" class="form-select border-0 bg-light p-3 rounded-3">
                            <option value="open" <?= $question['status'] == 'open' ? 'selected' : '' ?>>Open - Still accepting answers</option>
                            <option value="closed" <?= $question['status'] == 'closed' ? 'selected' : '' ?>>Closed - Discussion resolved</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 mt-4 border-top">
                        <a href="/questions/<?= $question['id'] ?>" class="btn btn-link text-decoration-none text-secondary smaller px-0 border-0 bg-transparent hover-primary">
                            <i class="fas fa-times me-1"></i> Cancel editing
                        </a>
                        <button type="submit" class="btn-q px-5 py-3 border-0 transition-all shadow-lg hover-up">
                            <i class="fas fa-save me-2"></i> Save your changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .smaller { font-size: 0.8rem; }
        .text-gradient {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-d) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hover-up:hover { transform: translateY(-3px); }
        .form-control:focus, .form-select:focus {
            background: #fff !important;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1) !important;
            border: 1px solid var(--accent) !important;
        }
        .btn-q {
            background: linear-gradient(135deg, var(--accent), var(--accent-d));
            color: #fff;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        .hover-primary:hover { color: var(--accent) !important; }
    </style>
