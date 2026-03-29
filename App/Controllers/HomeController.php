<?php
// App/Controllers/HomeController.php

namespace App\Controllers;

use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use App\Models\AppReview;
use Core\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        // Recent questions for the landing page
        $questions = Question::all();
        $questions = array_slice($questions, 0, 6);

        // Global platform stats
        $stats = [
            'users'     => User::count(),
            'questions' => Question::count(),
            'answers'   => Answer::count(),
        ];

        // App reviews for the testimonials section
        $latestReviews = AppReview::getLatest(3);
        $reviewStats   = AppReview::stats();

        // Current user's existing review (if logged in)
        $userReview = null;
        if (isset($_SESSION['user_id'])) {
            $userReview = AppReview::getUserReview((int) $_SESSION['user_id']);
        }

        $flash = $this->getFlash();

        echo $this->view('welcome', compact(
            'questions', 'stats',
            'latestReviews', 'reviewStats', 'userReview', 'flash'
        ));
    }
}
