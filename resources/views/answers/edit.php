<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="q-card p-4 border rounded-4 bg-white shadow-sm mt-4 reveal">
            <h4 class="fw-bold mb-4">Edit Answer</h4>
            
            <form action="/answers/<?= $answer['id'] ?>/update" method="POST">
                <div class="mb-3">
                    <label class="form-label text-muted fw-bold small text-uppercase">Your Explanation</label>
                    <textarea name="explanation" class="form-control bg-light border-0 p-3" rows="6" required><?= htmlspecialchars($answer['explanation']) ?></textarea>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="/questions/<?= $answer['question_id'] ?>" class="btn btn-light rounded-pill px-4 text-secondary fw-bold shadow-sm">Cancel</a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        document.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
    }, 50);
});
</script>
