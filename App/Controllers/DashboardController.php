<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use App\Models\Vote;
use App\Models\Tag;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->verifyAuth();

        $isAdmin = $_SESSION['user_role'] === 'admin';
        $userId = $_SESSION['user_id'];
        $db = \Database::connect();

        // ── FETCH REAL STATS FROM DB ──
        if ($isAdmin) {
            $questionsCount = Question::count();
            $answersCount = Answer::count();
            $usersCount = User::count();
            // count all votes in the platform
            $votesCount = $db->query("SELECT (SELECT IFNULL(SUM(votes), 0) FROM questions) + (SELECT IFNULL(SUM(votes), 0) FROM answers)")->fetchColumn();
            
            // Engagement data for chart (using questions and answers as activity source)
            $sql = "SELECT DATE_FORMAT(created_at, '%b') as label, COUNT(*) as value 
                    FROM (
                        SELECT created_at FROM questions
                        UNION ALL
                        SELECT created_at FROM answers
                    ) as combined_activity
                    GROUP BY label 
                    ORDER BY MIN(created_at) ASC LIMIT 12";
            $engagementData = $db->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $qStmt = $db->prepare("SELECT COUNT(*) FROM questions WHERE user_id = :uid");
            $qStmt->execute(['uid' => $userId]);
            $questionsCount = $qStmt->fetchColumn();

            $aStmt = $db->prepare("SELECT COUNT(*) FROM answers WHERE user_id = :uid");
            $aStmt->execute(['uid' => $userId]);
            $answersCount = $aStmt->fetchColumn();

            $usersCount = 1; // self

            // votes received on questions and answers
            $vStmt = $db->prepare("
                SELECT IFNULL(SUM(votes), 0) FROM questions WHERE user_id = :uid
            ");
            $vStmt->execute(['uid' => $userId]);
            $qVotes = $vStmt->fetchColumn();

            $v2Stmt = $db->prepare("
                SELECT IFNULL(SUM(votes), 0) FROM answers WHERE user_id = :uid
            ");
            $v2Stmt->execute(['uid' => $userId]);
            $aVotes = $v2Stmt->fetchColumn();

            $votesCount = intval($qVotes) + intval($aVotes);
            
            // Personal engagement data (using personal questions and answers)
            $sql = "SELECT DATE_FORMAT(created_at, '%b') as label, COUNT(*) as value 
                    FROM (
                        SELECT created_at FROM questions WHERE user_id = :uid
                        UNION ALL
                        SELECT created_at FROM answers WHERE user_id = :uid
                    ) as personal_activity
                    GROUP BY label 
                    ORDER BY MIN(created_at) ASC LIMIT 12";
            $stmt = $db->prepare($sql);
            $stmt->execute(['uid' => $userId]);
            $engagementData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        $statsData = [
            [
                'label' => $isAdmin ? 'Total Questions' : 'My Questions',
                'value' => number_format($questionsCount),
                'trend' => '+12%',
                'trendType' => 'up',
                'icon' => 'fa-question-circle',
                'color' => 'var(--accent)'
            ],
            [
                'label' => $isAdmin ? 'Total Answers' : 'My Answers',
                'value' => number_format($answersCount),
                'trend' => '+8%',
                'trendType' => 'up',
                'icon' => 'fa-reply-all',
                'color' => '#3b82f6'
            ],
            [
                'label' => $isAdmin ? 'Total Votes' : 'My Reputation',
                'value' => number_format($votesCount),
                'trend' => '+24%',
                'trendType' => 'up',
                'icon' => 'fa-thumbs-up',
                'color' => '#8b5cf6'
            ],
            [
                'label' => $isAdmin ? 'Active Users' : 'Active Status',
                'value' => $isAdmin ? number_format($usersCount) : 'Online',
                'trend' => 'Stable',
                'trendType' => 'flat',
                'icon' => 'fa-users',
                'color' => '#ec4899'
            ]
        ];

        // Fetch recent activity
        if ($isAdmin) {
            $recentQuestions = $db->query("SELECT q.*, u.name as author_name FROM questions q JOIN users u ON q.user_id = u.id ORDER BY q.created_at DESC LIMIT 5")->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $rqStmt = $db->prepare("SELECT * FROM questions WHERE user_id = :uid ORDER BY created_at DESC LIMIT 5");
            $rqStmt->execute(['uid' => $userId]);
            $recentQuestions = $rqStmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        $body = $this->view('admin/dashboard', [
            'statsData' => $statsData,
            'recentQuestions' => $recentQuestions,
            'engagementData' => $engagementData,
            'isAdmin' => $isAdmin
        ]);
        
        $title = $isAdmin ? 'Admin Dashboard' : 'My Dashboard';
        $subtitle = $isAdmin ? 'Global overview of your Q&A community' : 'Overview of your community activity';
        return $this->renderPage($title, $body, $subtitle);
    }

    public function questions()
    {
        $this->verifyAuth();
        $isAdmin = $_SESSION['user_role'] === 'admin';
        $db = \Database::connect();
        
        $questions = Question::all();
        $qCount = Question::count();
        $uCount = User::count();
        $trending = $db->query("SELECT t.name, COUNT(qt.question_id) as count FROM tags t 
                               LEFT JOIN question_tag qt ON t.id = qt.tag_id 
                               GROUP BY t.id ORDER BY count DESC LIMIT 6")->fetchAll(\PDO::FETCH_ASSOC);

        $body = $this->view('questions/index', compact('questions', 'qCount', 'uCount', 'trending', 'isAdmin'));
        return $this->renderPage('Manage Questions', $body, 'Browse and moderate community questions');
    }

    public function answers()
    {
        $this->verifyAuth();
        $isAdmin = $_SESSION['user_role'] === 'admin';
        $db = \Database::connect();
        
        if ($isAdmin) {
            $sql = "SELECT answers.*, users.name as author_name, questions.title as question_title 
                    FROM answers 
                    JOIN users ON answers.user_id = users.id 
                    JOIN questions ON answers.question_id = questions.id 
                    ORDER BY created_at DESC LIMIT 50";
            $answers = $db->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT answers.*, questions.title as question_title 
                    FROM answers 
                    JOIN questions ON answers.question_id = questions.id 
                    WHERE answers.user_id = :uid 
                    ORDER BY answers.created_at DESC LIMIT 50";
            $stmt = $db->prepare($sql);
            $stmt->execute(['uid' => $_SESSION['user_id']]);
            $answers = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        $body = $this->view('answers/index', compact('answers', 'isAdmin'));
        return $this->renderPage('Community Answers', $body, 'Review and manage all posted answers');
    }

    public function members()
    {
        $this->verifyAuth();
        if ($_SESSION['user_role'] !== 'admin') {
            $this->setFlash('error', 'Unauthorized access.');
            header("Location: /dashboard");
            exit;
        }
        
        $users = User::all();
        $body = $this->view('admin/members', compact('users'));
        return $this->renderPage('Member Management', $body, 'Manage users, roles and permissions');
    }

    public function voting()
    {
        $this->verifyAuth();
        return $this->generic('voting', '');
    }

    public function tags()
    {
        $this->verifyAuth();
        $isAdmin = $_SESSION['user_role'] === 'admin';
        
        $tags = Tag::allWithCount();
        
        $body = $this->view('tags/index', compact('tags', 'isAdmin'));
        return $this->renderPage('Admin - Tags', $body);
    }

    public function profile()
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        $user = User::find($userId);
        $reputation = User::getReputation($userId)['score'] ?? 0;
        $questions = User::getQuestions($userId);

        $body = $this->view('profiles/index', compact('user', 'reputation', 'questions'));
        return $this->renderPage('Admin - Profile', $body, 'Votre tableau de bord de profil');
    }

    public function analytics()
    {
        $this->verifyAuth();
        $isAdmin = $_SESSION['user_role'] === 'admin';
        $userId = $_SESSION['user_id'];
        
        $popularTags = Tag::allWithCount();
        
        $db = \Database::connect();
        if ($isAdmin) {
            $sql = "SELECT DATE_FORMAT(created_at, '%b') as label, COUNT(*) as value 
                    FROM questions 
                    GROUP BY label 
                    ORDER BY MIN(created_at) ASC";
            $monthlyStats = $db->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $sql = "SELECT DATE_FORMAT(created_at, '%b') as label, COUNT(*) as value 
                    FROM questions WHERE user_id = :uid
                    GROUP BY label 
                    ORDER BY MIN(created_at) ASC";
            $stmt = $db->prepare($sql);
            $stmt->execute(['uid' => $userId]);
            $monthlyStats = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        if (empty($monthlyStats)) {
            $monthlyStats = [['label' => 'Jan', 'value' => 5], ['label' => 'Feb', 'value' => 12]];
        }

        $body = $this->view('votings/analytics', [
            'popularTags' => $popularTags,
            'monthlyStats' => $monthlyStats,
            'totalUsers' => User::count(),
            'totalQuestions' => Question::count(),
            'totalAnswers' => Answer::count(),
            'growth' => 12.5 // Mock for now
        ]);
        
        return $this->renderPage('Admin - Analytics', $body);
    }

    public function notifications()
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        $db = \Database::connect();
        
        $sql = "SELECT * FROM activity_log WHERE user_id = :uid ORDER BY created_at DESC LIMIT 50";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute(['uid' => $userId]);
            $notifications = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $notifications = [];
        }

        $body = $this->view('notifications/index', compact('notifications'));
        return $this->renderPage('Admin - Notifications', $body);
    }


    public function settings()
    {
        $this->verifyAuth();
        return $this->generic('settings', 'general');
    }

    public function help()
    {
        $this->verifyAuth();
        $body = $this->view('admin/help');
        return $this->renderPage('Admin - Help', $body);
    }

    public function activityLog()
    {
        $this->verifyAuth();
        $isAdmin = $_SESSION['user_role'] === 'admin';
        $userId = $_SESSION['user_id'];
        
        $db = \Database::connect();
        
        if ($isAdmin) {
            $sqlQ = "SELECT 'question' as type, id, title as content, created_at, user_id FROM questions ORDER BY created_at DESC LIMIT 25";
            $sqlA = "SELECT 'answer' as type, id, explanation as content, created_at, user_id FROM answers ORDER BY created_at DESC LIMIT 25";
            
            $qs = $db->query($sqlQ)->fetchAll(\PDO::FETCH_ASSOC);
            $as = $db->query($sqlA)->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            $sqlQ = "SELECT 'question' as type, id, title as content, created_at, user_id FROM questions WHERE user_id = :uid ORDER BY created_at DESC LIMIT 25";
            $sqlA = "SELECT 'answer' as type, id, explanation as content, created_at, user_id FROM answers WHERE user_id = :uid ORDER BY created_at DESC LIMIT 25";
            
            $stmtQ = $db->prepare($sqlQ);
            $stmtQ->execute(['uid' => $userId]);
            $qs = $stmtQ->fetchAll(\PDO::FETCH_ASSOC);

            $stmtA = $db->prepare($sqlA);
            $stmtA->execute(['uid' => $userId]);
            $as = $stmtA->fetchAll(\PDO::FETCH_ASSOC);
        }
        
        $activities = array_merge($qs, $as);
        usort($activities, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        $body = $this->view('votings/activityfeed', compact('activities'));
        return $this->renderPage('Admin - Activity Log', $body);
    }

    public function leaderboard()
    {
        $this->verifyAuth();
        return $this->generic('leaderboard', 'top');
    }

    public function generic($module = null, $sub = null)
    {
        $this->verifyAuth();
        $isAdmin = $_SESSION['user_role'] === 'admin';
        $userId = $_SESSION['user_id'];
        $db = \Database::connect();
        
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $title = $module ? ucfirst(str_replace('-', ' ', $module)) : '';
        if ($sub) $title .= ' - ' . ucfirst(str_replace('-', ' ', $sub));
        $title = $title ?: 'Dashboard View';

        // Do some route aliasing to avoid serviced fallback to generic dashboard page
        $module = strtolower($module ?? '');
        $sub = strtolower($sub ?? '');
        if ($module === 'votings') $module = 'voting';
        if ($module === 'leaderboards') $module = 'leaderboard';

        // --- SMART ROUTING LOGIC ---
        // Depending on module and sub, we can auto-render the main views with filters!
        
        // 1. VOTING SUB-PAGES
        if ($module === 'voting') {
            $sql = "SELECT v.*, q.title as question_title, a.explanation as answer_text,
                    IF(v.question_id IS NOT NULL, 'question', 'answer') as votable_type, v.vote_type as value
                    FROM votes v 
                    LEFT JOIN questions q ON v.question_id = q.id 
                    LEFT JOIN answers a ON v.answer_id = a.id 
                    WHERE 1=1 ";
            $params = [];
            
            if (!$isAdmin || in_array($sub, ['my-votes', 'history', 'upvotes', 'downvotes'])) {
                $sql .= " AND v.user_id = :uid ";
                $params['uid'] = $userId;
            }
            if ($sub === 'upvotes') {
                $sql .= " AND v.vote_type = 1 ";
                $title = "Upvotes Given";
            } elseif ($sub === 'downvotes') {
                $sql .= " AND v.vote_type = -1 ";
                $title = "Downvotes Given";
            }

            $sql .= " ORDER BY v.created_at DESC LIMIT 50";
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            $recentVotes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $body = $this->view('votings/index', compact('recentVotes', 'isAdmin', 'title'));
            return $this->renderPage(trim($title), $body);
        }

        // 2. ANSWERS SUB-PAGES
        if ($module === 'answers') {
            $sql = "SELECT answers.*, questions.title as question_title, users.name as author_name
                    FROM answers 
                    JOIN questions ON answers.question_id = questions.id 
                    JOIN users ON answers.user_id = users.id
                    WHERE 1=1 ";
            $params = [];

            if ($sub === 'my-answers') {
                $sql .= " AND answers.user_id = :uid ";
                $params['uid'] = $userId;
                $title = "My Answers";
            } elseif ($sub === 'accepted') {
                $sql .= " AND answers.is_accepted = 1 ";
                $title = "Accepted Answers";
                if (!$isAdmin) { $sql .= " AND answers.user_id = :uid "; $params['uid'] = $userId; }
            } elseif ($sub === 'voted' || $sub === 'top') {
                if (!$isAdmin) { $sql .= " AND answers.user_id = :uid "; $params['uid'] = $userId; }
                $sql .= " ORDER BY answers.votes DESC ";
                $title = "Most Voted Answers";
            } elseif ($sub === 'pending') {
                $sql .= " AND answers.is_accepted = 0 ";
                $title = "Pending Answers";
                if (!$isAdmin) { $sql .= " AND answers.user_id = :uid "; $params['uid'] = $userId; }
            }

            if (strpos($sql, 'ORDER BY') === false) {
                $sql .= " ORDER BY answers.created_at DESC LIMIT 50";
            } else {
                $sql .= " LIMIT 50";
            }

            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            $answers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $body = $this->view('answers/index', compact('answers', 'isAdmin', 'title'));
            return $this->renderPage(trim($title), $body);
        }

        // 3. TAGS SUB-PAGES
        if ($module === 'tags') {
            $viewName = 'tags/index';
            $params = [];
            
            try {
                // Fetch tags summary
                $sql = "SELECT t.*, 
                        (SELECT COUNT(*) FROM question_tag qt WHERE qt.tag_id = t.id) as count 
                        FROM tags t ORDER BY count DESC LIMIT 50";
                $tags = $db->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\Exception $e) { $tags = []; }

            if ($sub === 'popular') {
                $viewName = 'tags/popular';
                $title = "Popular Topics";
            } elseif ($sub === 'followed') {
                $viewName = 'tags/followedtags';
                $title = "Tags You Follow";
                
                // Get followed tags for current user
                try {
                    $userId = $_SESSION['user_id'] ?? null;
                    if ($userId) {
                        $sql = "SELECT t.*, 
                                (SELECT COUNT(*) FROM question_tag qt WHERE qt.tag_id = t.id) as count,
                                DATE_FORMAT(utf.created_at, '%M %d, %Y') as followed_date
                                FROM tags t 
                                INNER JOIN user_tag_follows utf ON t.id = utf.tag_id 
                                WHERE utf.user_id = ? 
                                ORDER BY utf.created_at DESC";
                        $stmt = $db->prepare($sql);
                        $stmt->execute([$userId]);
                        $tags = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    } else {
                        $tags = [];
                    }
                } catch (\Exception $e) {
                    $tags = [];
                }
            } elseif ($sub === 'manage' || $sub === 'tagmanagement') {
                $viewName = 'tags/tagmanagement';
                $title = "Manage Categories";
            }

            $body = $this->view($viewName, compact('tags', 'isAdmin', 'title'));
            return $this->renderPage(trim($title) ?: 'Tags', $body, 'Explore by specific categories and tags');
        }
        
        // 4. QUESTIONS SUB-PAGES
        if ($module === 'questions') {
            if ($sub === 'create') {
                header("Location: /questions/create");
                exit;
            }
            
            // ── FETCH QUESTIONS WITH ENRICHED DATA (FEED STYLE) ──
            $itemsPerPage = 15;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $itemsPerPage;
            
            $sql = "SELECT 
                        q.id, q.title, q.description, q.user_id, q.created_at, q.votes,
                        u.name as author_name, u.email as author_email,
                        (SELECT COUNT(*) FROM answers WHERE question_id = q.id) as answers_count,
                        (SELECT IFNULL(SUM(vote_type), 0) FROM votes WHERE question_id = q.id AND question_id IS NOT NULL) as vote_count,
                        (SELECT vote_type FROM votes WHERE question_id = q.id AND user_id = :user_id LIMIT 1) as user_vote,
                        (SELECT COUNT(*) FROM comments WHERE question_id = q.id) as comments_count,
                        GROUP_CONCAT(DISTINCT t.name) as tags
                    FROM questions q
                    LEFT JOIN users u ON q.user_id = u.id
                    LEFT JOIN question_tag qt ON q.id = qt.question_id
                    LEFT JOIN tags t ON qt.tag_id = t.id
                    WHERE 1=1 ";
            
            $params = ['user_id' => $userId];

            if ($sub === 'my-questions') {
                $sql .= " AND q.user_id = :uid ";
                $params['uid'] = $userId;
                $title = "My Questions Feed";
            } else {
                $title = ($sub === 'trending') ? "Trending Discussions" : "Community Feed";
            }

            $sql .= " GROUP BY q.id ";
            
            if ($sub === 'trending') {
                $sql .= " ORDER BY q.votes DESC ";
            } else {
                $sql .= " ORDER BY q.created_at DESC ";
            }
            
            $sql .= " LIMIT :limit OFFSET :offset";
            
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':user_id', $userId, \PDO::PARAM_INT);
            if(isset($params['uid'])) $stmt->bindValue(':uid', $params['uid'], \PDO::PARAM_INT);
            $stmt->bindValue(':limit', $itemsPerPage, \PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
            $stmt->execute();
            $questions = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // ── FETCH STATISTICS AND TRENDS ──
            $statsStmt = $db->query("SELECT COUNT(*) as q_count FROM questions");
            $qCount = $statsStmt->fetchColumn();
            $uCountStmt = $db->query("SELECT COUNT(*) FROM users");
            $uCount = $uCountStmt->fetchColumn();
            
            $trending = $db->query("SELECT t.name, COUNT(qt.question_id) as count FROM tags t 
                                   LEFT JOIN question_tag qt ON t.id = qt.tag_id 
                                   GROUP BY t.id ORDER BY count DESC LIMIT 6")->fetchAll(\PDO::FETCH_ASSOC);

            $body = $this->view('questions/index', compact('questions', 'title', 'qCount', 'uCount', 'trending', 'isAdmin'));
            return $this->renderPage(trim($title), $body);
        }

        // Dedicated profile sub-routes (avoid generic placeholder for badges/activity/reputation)
        if ($module === 'profile') {
            $userId = $_SESSION['user_id'];
            $user = User::find($userId);

            if ($sub === 'activity' || $sub === 'myactivity') {
                // capture both action paths
                $activity = [];
                $q = $db->prepare("SELECT id, title as detail, created_at FROM questions WHERE user_id = :uid ORDER BY created_at DESC LIMIT 10");
                $q->execute(['uid' => $userId]);
                foreach ($q->fetchAll(\PDO::FETCH_ASSOC) as $item) {
                    $activity[] = ['icon' => 'fa-question', 'title' => 'Question publiée', 'detail' => $item['detail'], 'when' => date('d M Y', strtotime($item['created_at']))];
                }
                $a = $db->prepare("SELECT id, explanation as detail, created_at FROM answers WHERE user_id = :uid ORDER BY created_at DESC LIMIT 10");
                $a->execute(['uid' => $userId]);
                foreach ($a->fetchAll(\PDO::FETCH_ASSOC) as $item) {
                    $activity[] = ['icon' => 'fa-comments', 'title' => 'Réponse postée', 'detail' => substr(strip_tags($item['detail']), 0, 80) . '...', 'when' => date('d M Y', strtotime($item['created_at']))];
                }
                usort($activity, function($a, $b) { return strtotime($b['when']) - strtotime($a['when']); });

                $body = $this->view('profiles/myactivity', compact('activity'));
                return $this->renderPage('My Activity', $body, 'Timeline of your actions');
            }

            if ($sub === 'badges') {
                $badges = [];
                try {
                    $stmt = $db->prepare("SELECT * FROM badges WHERE user_id = :uid ORDER BY awarded_at DESC");
                    $stmt->execute(['uid' => $userId]);
                    $badges = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                } catch (\Exception $e) {
                    $badges = [
                        ['icon' => '🥉', 'title' => 'First Steps', 'description' => 'Post your first question'],
                        ['icon' => '🥈', 'title' => 'First Answers', 'description' => 'Provide your first answer']
                    ];
                }

                $body = $this->view('profiles/badges', compact('badges'));
                return $this->renderPage('Badges', $body, 'Vos badges et accomplissements');
            }

            if (in_array($sub, ['reputation', 'reputationandpoint', 'reputation-and-point'])) {
                $qCount = $db->prepare("SELECT COUNT(*) FROM questions WHERE user_id = :uid");
                $qCount->execute(['uid' => $userId]);
                $aCount = $db->prepare("SELECT COUNT(*) FROM answers WHERE user_id = :uid");
                $aCount->execute(['uid' => $userId]);

                $stats = [
                    'reputation' => intval(User::getReputation($userId)['score'] ?? 0),
                    'month_points' => intval(($qCount->fetchColumn() + $aCount->fetchColumn()) * 10),
                    'rank' => 1,
                ];

                $events = [
                    ['description' => 'Question upvotée', 'delta' => 10],
                    ['description' => 'Réponse acceptée', 'delta' => 15],
                ];

                $body = $this->view('profiles/reputationandpoint', compact('stats', 'events'));
                return $this->renderPage('Reputation & Points', $body, 'Suivi de votre progression');
            }

            if ($sub === 'edit') {
                $body = $this->view('profiles/edit', compact('user'));
                return $this->renderPage('Edit Profile', $body, 'Modifier vos informations de profil');
            }

            return $this->profile();
        }

        if ($module === 'security') {
            $mode = $sub ?: 'overview';
            $subtitleMap = [
                'overview' => 'Manage your password, sessions and account security',
                'password' => 'Change your password credentials',
                '2fa' => 'Two-factor authentication settings',
                'history' => 'Review login history and activities',
                'sessions' => 'Manage active devices and sessions'
            ];
            $pageSubtitle = $subtitleMap[$mode] ?? 'Security and access settings';

            // ── FETCH REAL DATA FROM DATABASE ──
            $db = \Database::connect();
            
            // Get active sessions (login history with is_active = true)
            $items = [];
            $loginHistory = [];
            $passwordInfo = null;
            $is2FAEnabled = false;
            
            try {
                // Get active sessions (login history with is_active = true)
                $stmt = $db->prepare("
                    SELECT id, browser_name, device_type, location, login_time, is_active 
                    FROM login_history 
                    WHERE user_id = :user_id AND is_active = TRUE
                    ORDER BY login_time DESC
                    LIMIT 10
                ");
                $stmt->execute(['user_id' => $userId]);
                $items = $stmt->fetchAll();
                
                // Get login history (all logins)
                $stmt = $db->prepare("
                    SELECT id, browser_name, device_type, location, login_time 
                    FROM login_history 
                    WHERE user_id = :user_id
                    ORDER BY login_time DESC
                    LIMIT 20
                ");
                $stmt->execute(['user_id' => $userId]);
                $loginHistory = $stmt->fetchAll();
                
                // Get user's password change info
                $stmt = $db->prepare("
                    SELECT password_changed_at FROM users WHERE id = :id
                ");
                $stmt->execute(['id' => $userId]);
                $passwordInfo = $stmt->fetch();
                
                // Get 2FA status
                $stmt = $db->prepare("
                    SELECT is_enabled FROM `2fa_devices` WHERE user_id = :user_id LIMIT 1
                ");
                $stmt->execute(['user_id' => $userId]);
                $twoFaInfo = $stmt->fetch();
                $is2FAEnabled = $twoFaInfo ? $twoFaInfo['is_enabled'] : false;
            } catch (\Exception $e) {
                // Tables don't exist yet - provide empty defaults
                error_log("Security data fetch error: " . $e->getMessage());
            }

            $body = $this->view('security/index', compact('items', 'loginHistory', 'mode', 'passwordInfo', 'is2FAEnabled'));
            return $this->renderPage('Identity & Safety', $body, $pageSubtitle);
        }

        if ($module === 'settings') {
            $mode = $sub ?: 'general';
            $settingsPages = ['general', 'preferences', 'language', 'help'];

            if ($mode === 'help') {
                $body = $this->view('admin/help');
            } else {
                $body = $this->view('settings/index', compact('mode'));
            }

            // Remove global title/subtitle for minimal interface requirement
            return $this->renderPage('', $body, '');
        }

        if ($module === 'leaderboard') {
            $mode = $sub ?: 'top';

            // Special case for analytics and activity sub-views
            if ($mode === 'analytics') {
                $body = $this->view('leaderboards/analytics');
                return $this->renderPage('Leaderboard Analytics', $body, 'Visualisez les tendances de la communauté');
            }

            if ($mode === 'activity' || $mode === 'activityfeed') {
                $body = $this->view('leaderboards/activityfeed');
                return $this->renderPage('Leaderboard Activity', $body, 'Flux d\'activité récent des contributeurs');
            }

            $dateCondition = '';
            if ($mode === 'weekly') {
                $dateCondition = " AND created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
            } elseif ($mode === 'monthly') {
                $dateCondition = " AND created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
            }

            $sql = "SELECT users.*, 
                    (SELECT COUNT(*) FROM questions WHERE questions.user_id = users.id{$dateCondition}) as q_count,
                    (SELECT COUNT(*) FROM answers WHERE answers.user_id = users.id{$dateCondition}) as a_count,
                    (SELECT IFNULL(SUM(votes), 0) FROM questions WHERE questions.user_id = users.id{$dateCondition}) + 
                    (SELECT IFNULL(SUM(votes), 0) FROM answers WHERE answers.user_id = users.id{$dateCondition}) as reputation
                    FROM users
                    ORDER BY reputation DESC LIMIT 20";

            $topUsers = $db->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
            $body = $this->view('leaderboards/index', compact('topUsers', 'mode'));

            // Finalized minimal header
            return $this->renderPage('', $body, '');
        }

        // 5. NOTIFICATIONS SUB-PAGES
        if ($module === 'notifications') {
            $sql = "SELECT *, action as message, created_at as time FROM activity_log WHERE user_id = :uid ";
            $params = ['uid' => $userId];
            if ($sub === 'unread') {
                $sql .= " AND is_read = 0 ";
                $title = "Unread Notifications";
            } elseif ($sub === 'mentions') {
                $sql .= " AND action LIKE '%mentioned%' ";
                $title = "Your Mentions";
            } elseif ($sub === 'alerts') {
                $sql .= " AND action LIKE '%system%' ";
                $title = "System Alerts";
            }
            $sql .= " ORDER BY created_at DESC LIMIT 50";
            $notifications = [];
            try {
                $stmt = $db->prepare($sql);
                $stmt->execute($params);
                $notifications = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\Exception $e) { }

            $body = $this->view('notifications/index', compact('notifications', 'title'));
            return $this->renderPage(trim($title), $body);
        }
    }

    // ────────────────────────────────────────────────────────────────
    // ─ SETTINGS FORM HANDLERS
    // ────────────────────────────────────────────────────────────────

    public function saveSettingsGeneral()
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        $db = \Database::connect();

        try {
            $platform_name = $_POST['platform_name'] ?? '';
            $contact_email = $_POST['contact_email'] ?? '';
            $privacy_default = isset($_POST['privacy_default']) ? 1 : 0;

            // Insert or update user_settings
            $stmt = $db->prepare("
                INSERT INTO user_settings (user_id, language) 
                VALUES (?, ?) 
                ON DUPLICATE KEY UPDATE language = VALUES(language)
            ");
            $stmt->execute([$userId, $_POST['language'] ?? 'en']);

            $this->setFlash('success', 'General settings saved successfully.');
        } catch (\Exception $e) {
            $this->setFlash('error', 'Error saving settings: ' . $e->getMessage());
        }

        $this->redirect('/dashboard/settings/general');
    }

    public function saveSettingsPreferences()
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        $db = \Database::connect();

        try {
            $dark_mode = isset($_POST['dark_mode']) ? 1 : 0;
            $compact_view = isset($_POST['compact_view']) ? 1 : 0;
            $email_digest = isset($_POST['email_digest']) ? 1 : 0;

            $stmt = $db->prepare("
                INSERT INTO user_settings (user_id, dark_mode, compact_view, email_digest) 
                VALUES (?, ?, ?, ?) 
                ON DUPLICATE KEY UPDATE 
                    dark_mode = VALUES(dark_mode),
                    compact_view = VALUES(compact_view),
                    email_digest = VALUES(email_digest)
            ");
            $stmt->execute([$userId, $dark_mode, $compact_view, $email_digest]);

            $this->setFlash('success', 'Preferences saved successfully.');
        } catch (\Exception $e) {
            $this->setFlash('error', 'Error saving preferences: ' . $e->getMessage());
        }

        $this->redirect('/dashboard/settings/preferences');
    }

    public function saveSettingsLanguage()
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        $db = \Database::connect();

        try {
            $language = $_POST['language'] ?? 'en';

            $stmt = $db->prepare("
                INSERT INTO user_settings (user_id, language) 
                VALUES (?, ?) 
                ON DUPLICATE KEY UPDATE language = VALUES(language)
            ");
            $stmt->execute([$userId, $language]);

            $_SESSION['language'] = $language;
            $this->setFlash('success', 'Language preference updated.');
        } catch (\Exception $e) {
            $this->setFlash('error', 'Error updating language: ' . $e->getMessage());
        }

        $this->redirect('/dashboard/settings/language');
    }

    public function saveSecurityPassword()
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        $db = \Database::connect();

        try {
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (empty($current_password) || empty($new_password)) {
                throw new \Exception('All password fields are required.');
            }

            if ($new_password !== $confirm_password) {
                throw new \Exception('New passwords do not match.');
            }

            // Verify current password
            $stmt = $db->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            $user = $stmt->fetch();

            if (!$user || !password_verify($current_password, $user['password'])) {
                throw new \Exception('Current password is incorrect.');
            }

            // Update password
            $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
            $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashedPassword, $userId]);

            // Record password change
            if ($db->getAttributeValue(\PDO::ATTR_DRIVER_NAME) !== 'sqlite') {
                $stmt = $db->prepare("ALTER TABLE users ADD COLUMN IF NOT EXISTS password_changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
                $stmt->execute();
                $stmt = $db->prepare("UPDATE users SET password_changed_at = NOW() WHERE id = ?");
                $stmt->execute([$userId]);
            }

            $this->setFlash('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            $this->setFlash('error', 'Error: ' . $e->getMessage());
        }

        $this->redirect('/dashboard/security/password');
    }

    public function saveSecurity2FA()
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        $db = \Database::connect();

        try {
            $action = $_POST['action'] ?? 'enable';

            if ($action === 'enable') {
                // Generate a secret for 2FA
                $secret = bin2hex(random_bytes(16));

                $stmt = $db->prepare("
                    INSERT INTO `2fa_devices` (user_id, device_name, secret_key, is_enabled) 
                    VALUES (?, ?, ?, ?) 
                    ON DUPLICATE KEY UPDATE 
                        secret_key = VALUES(secret_key),
                        is_enabled = VALUES(is_enabled)
                ");
                $stmt->execute([$userId, '2FA Device', $secret, 1]);

                $this->setFlash('success', 'Two-factor authentication enabled.');
            } else {
                // Disable 2FA
                $stmt = $db->prepare("UPDATE `2fa_devices` SET is_enabled = 0 WHERE user_id = ?");
                $stmt->execute([$userId]);

                $this->setFlash('success', 'Two-factor authentication disabled.');
            }
        } catch (\Exception $e) {
            $this->setFlash('error', 'Error: ' . $e->getMessage());
        }

        $this->redirect('/dashboard/security/2fa');
    }
}
