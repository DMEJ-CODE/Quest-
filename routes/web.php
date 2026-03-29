<?php

/**
 * --------------------------------------------------------------------------
 * Web Routes
 * --------------------------------------------------------------------------
 * Ici, on définit les routes de l'application.
 * Le format est : $router->METHOD(URI, 'Controller@method')
 */

// --- Frontend Routes ---
$router->get('/', 'HomeController@index');
$router->get('/feed', 'QuestionController@index');
$router->get('/questions', 'QuestionController@index');

// Auth
$router->get('/login', 'AuthController@loginForm');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@registerForm');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');
$router->get('/forgot', 'AuthController@forgotForm');
$router->post('/forgot', 'AuthController@forgot');

// Questions (CRUD Public)
$router->get('/questions', 'QuestionController@index');
$router->get('/search', 'QuestionController@search');
$router->post('/questions/load-more', 'QuestionController@loadMore');
$router->get('/questions/create', 'QuestionController@create');
$router->post('/questions', 'QuestionController@store');
$router->get('/questions/{id}', 'QuestionController@show');
$router->get('/questions/{id}/edit', 'QuestionController@edit');
$router->post('/questions/{id}/update', 'QuestionController@update');
$router->post('/questions/{id}/delete', 'QuestionController@destroy');
$router->get('/questions/trending', 'QuestionController@trending');
$router->get('/questions/recent', 'QuestionController@recent');
$router->get('/questions/my-questions', 'QuestionController@myQuestions');
$router->get('/tags/{name}', 'QuestionController@byTag');
$router->get('/questions/tagged/{tag}', 'QuestionController@byTag');

// Answers
$router->post('/answers/store', 'AnswerController@store');
$router->get('/answers/{id}/edit', 'AnswerController@edit');
$router->post('/answers/{id}/update', 'AnswerController@update');
$router->post('/answers/{id}/delete', 'AnswerController@destroy');
$router->post('/answers/{id}/accept', 'AnswerController@accept');

// Comments
$router->post('/comments/store', 'CommentController@store');
$router->post('/comments/{id}/delete', 'CommentController@destroy');

// Voting & Profile
$router->post('/vote', 'VoteController@cast');
$router->get('/profile', 'ProfileController@show');
$router->get('/profile/{id}', 'ProfileController@show');
$router->post('/profile/update', 'ProfileController@update');

// --- Dashboard Routes --- (Unified Role-Based)
$router->get('/dashboard', 'DashboardController@index');

// Resource: Questions Admin
$router->get('/dashboard/questions', 'QuestionController@index');
$router->get('/dashboard/questions/create', 'QuestionController@create');

// Generic Dashboard Routes
$router->get('/dashboard/answers', 'DashboardController@answers');
$router->get('/dashboard/members', 'DashboardController@members');
$router->get('/dashboard/voting', 'DashboardController@voting');
$router->get('/dashboard/tags', 'DashboardController@tags');
$router->get('/dashboard/profile', 'DashboardController@profile');
$router->get('/dashboard/notifications', 'DashboardController@notifications');
$router->get('/dashboard/settings', 'DashboardController@settings');
$router->post('/dashboard/settings/general', 'DashboardController@saveSettingsGeneral');
$router->post('/dashboard/settings/preferences', 'DashboardController@saveSettingsPreferences');
$router->post('/dashboard/settings/language', 'DashboardController@saveSettingsLanguage');
$router->post('/dashboard/security/password', 'DashboardController@saveSecurityPassword');
$router->post('/dashboard/security/2fa', 'DashboardController@saveSecurity2FA');
$router->get('/dashboard/analytics', 'DashboardController@analytics');
$router->get('/dashboard/help', 'DashboardController@help');
$router->get('/dashboard/activity-log', 'DashboardController@activityLog');
$router->get('/dashboard/leaderboard', 'DashboardController@leaderboard');

// Admin CRUD Endpoints
$router->post('/admin/users/{id}/delete', 'UserController@destroy');
$router->post('/admin/tags/{id}/delete', 'TagsController@destroy');

// Tag Follow System
$router->post('/tags/{id}/follow', 'TagsController@follow');
$router->post('/tags/{id}/unfollow', 'TagsController@unfollow');

// App Reviews & Ratings
$router->get('/reviews', 'ReviewController@index');
$router->post('/reviews/store', 'ReviewController@store');

// Fallback for sub-routes if needed (can be handled by more specific routes)
$router->get('/dashboard/{module}', 'DashboardController@generic');
$router->get('/dashboard/{module}/{sub}', 'DashboardController@generic');