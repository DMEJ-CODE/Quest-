<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\AppReview;

class ReviewController extends BaseController
{
    /**
     * GET /reviews — Show all reviews + add-review form
     */
    public function index()
    {
        $page    = max(1, (int) ($_GET['page'] ?? 1));
        $perPage = 10;

        $reviews   = AppReview::getPaginated($page, $perPage);
        $total     = AppReview::totalCount();
        $stats     = AppReview::stats();
        $breakdown = AppReview::breakdown();
        $pages     = max(1, (int) ceil($total / $perPage));

        $userReview = null;
        if (isset($_SESSION['user_id'])) {
            $userReview = AppReview::getUserReview((int) $_SESSION['user_id']);
        }

        $flash = $this->getFlash();

        echo $this->view('reviews.index', compact(
            'reviews', 'total', 'stats', 'breakdown',
            'page', 'pages', 'userReview', 'flash'
        ));
    }

    /**
     * POST /reviews/store — Save a review
     */
    public function store()
    {
        $this->verifyAuth();

        $rating  = (int) ($_POST['rating']  ?? 0);
        $message = trim($_POST['message'] ?? '');

        // Validate
        if ($rating < 1 || $rating > 5) {
            $this->setFlash('error', 'Please select a rating between 1 and 5 stars.');
            $this->redirect('/reviews');
        }

        if (strlen($message) < 10) {
            $this->setFlash('error', 'Your review must be at least 10 characters long.');
            $this->redirect('/reviews');
        }

        if (strlen($message) > 1000) {
            $this->setFlash('error', 'Your review must be under 1000 characters.');
            $this->redirect('/reviews');
        }

        $userId  = (int) $_SESSION['user_id'];
        $success = AppReview::createOrUpdate($userId, $rating, $message);

        if ($success) {
            $this->setFlash('success', 'Thank you! Your review has been saved.');
        } else {
            $this->setFlash('error', 'Something went wrong. Please try again.');
        }

        $this->redirect('/reviews');
    }
}
