<?php

namespace App\Controllers;

use Core\BaseController;
use Database;
use PDO;

class AuthController extends BaseController
{
    // -----------------------------------------------------------
    // 1. SHOW LOGIN FORM
    // -----------------------------------------------------------
    public function loginForm()
    {
        $content = $this->view('auth/components/login_form');
        return $this->renderPage('Quest - Login', $content, '', 'auth');
    }

    // -----------------------------------------------------------
    // 2. HANDLE LOGIN (WITH ROLE-BASED REDIRECT)
    // -----------------------------------------------------------
    public function login()
    {
        $pdo = Database::connect();

        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {

            // Store user data in session
            $_SESSION['user_id']    = $user['id'];
            $_SESSION['user_name']  = $user['name'];
            $_SESSION['user_role']  = $user['role'];
            $_SESSION['user_email'] = $user['email'];

            // Record login history
            $this->recordLogin($user['id'], $pdo);

            // Redirect to feed
            header("Location: /feed");
            exit;
        } else {
            echo "<div style='color:red; text-align:center; margin-top:20px;'>";
            echo "Incorrect email or password. <a href='/login'>Try again</a>";
            echo "</div>";
        }
    }

    // -----------------------------------------------------------
    // HELPER: Record login in login_history table
    // -----------------------------------------------------------
    private function recordLogin($userId, $pdo)
    {
        try {
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
            $ipAddress = $_SERVER['REMOTE_ADDR']     ?? '0.0.0.0';

            // Simple browser detection
            $browser = 'Unknown Browser';
            if (strpos($userAgent, 'Chrome')  !== false) $browser = 'Chrome';
            elseif (strpos($userAgent, 'Firefox') !== false) $browser = 'Firefox';
            elseif (strpos($userAgent, 'Safari')  !== false && strpos($userAgent, 'Chrome') === false) $browser = 'Safari';
            elseif (strpos($userAgent, 'Edge')    !== false) $browser = 'Edge';
            elseif (strpos($userAgent, 'Opera')   !== false) $browser = 'Opera';

            // Device type detection
            $deviceType = 'Desktop';
            if (preg_match('/(iPhone|iPad|Android|Mobile)/i', $userAgent)) {
                $deviceType = strpos($userAgent, 'iPhone') !== false ? 'iPhone'
                            : (strpos($userAgent, 'iPad') !== false ? 'iPad' : 'Android Phone');
            } elseif (preg_match('/(Tablet|iPad)/i', $userAgent)) {
                $deviceType = 'Tablet';
            }

            $location = 'Unknown Location';

            $stmt = $pdo->prepare("
                INSERT INTO login_history (user_id, ip_address, user_agent, browser_name, device_type, location, login_time, is_active)
                VALUES (?, ?, ?, ?, ?, ?, NOW(), TRUE)
            ");
            $stmt->execute([$userId, $ipAddress, $userAgent, $browser, $deviceType, $location]);

        } catch (\Exception $e) {
            error_log("Login history recording failed: " . $e->getMessage());
        }
    }

    // -----------------------------------------------------------
    // 3. SHOW REGISTER FORM
    // -----------------------------------------------------------
    public function registerForm()
    {
        $content = $this->view('auth/components/register_form');
        return $this->renderPage('Quest - Register', $content, '', 'auth');
    }

    // -----------------------------------------------------------
    // 4. HANDLE REGISTRATION
    // -----------------------------------------------------------
    public function register()
    {
        $pdo = Database::connect();

        $name            = $_POST['name']             ?? '';
        $email           = $_POST['email']            ?? '';
        $password        = $_POST['password']         ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            die("All fields are required. <a href='/register'>Go back</a>");
        }

        if ($password !== $confirmPassword) {
            die("Passwords do not match. <a href='/register'>Go back</a>");
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            die("This email is already registered. <a href='/register'>Go back</a>");
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $defaultRole    = 'user';

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");

        if ($stmt->execute([$name, $email, $hashedPassword, $defaultRole])) {
            $newUserId = $pdo->lastInsertId();

            $_SESSION['user_id']    = $newUserId;
            $_SESSION['user_name']  = $name;
            $_SESSION['user_role']  = $defaultRole;
            $_SESSION['user_email'] = $email;

            header("Location: /feed");
            exit;
        } else {
            die("An error occurred while creating your account. Please try again.");
        }
    }

    public function forgotForm()
    {
        $content = $this->view('auth/components/forgot_form');
        return $this->renderPage('Quest - Forgot Password', $content, '', 'auth');
    }

    // -----------------------------------------------------------
    // 5. HANDLE FORGOT PASSWORD
    // -----------------------------------------------------------
    public function forgot()
    {
        $email = $_POST['email'] ?? '';

        if (empty($email)) {
            die("Email is required. <a href='/forgot'>Go back</a>");
        }

        // TODO: implement actual email reset logic
        echo "<div style='text-align:center; margin-top:20px;'>";
        echo "A password reset email has been sent to " . htmlspecialchars($email) . ". <a href='/login'>Back to Login</a>";
        echo "</div>";
    }

    // -----------------------------------------------------------
    // 6. LOGOUT
    // -----------------------------------------------------------
    public function logout()
    {
        if (isset($_SESSION['user_id'])) {
            try {
                $pdo  = Database::connect();
                $stmt = $pdo->prepare("
                    UPDATE login_history
                    SET is_active = FALSE, logout_time = NOW()
                    WHERE user_id = ? AND is_active = TRUE
                    ORDER BY login_time DESC
                    LIMIT 1
                ");
                $stmt->execute([$_SESSION['user_id']]);
            } catch (\Exception $e) {
                error_log("Logout recording failed: " . $e->getMessage());
            }
        }

        session_destroy();
        header("Location: /login");
        exit;
    }
}