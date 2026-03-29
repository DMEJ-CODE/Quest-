<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\User;
use App\Models\Question;

class ProfileController extends BaseController
{
    /**
     * View own profile or another user's profile
     */
    public function show($id = null)
    {
        $this->verifyAuth();

        $userId = $id ?: $_SESSION['user_id'];
        $user   = User::find($userId);

        if (!$user) {
            die("User not found.");
        }

        // Retrieve user's questions
        $questions  = User::getQuestions($userId);

        // Retrieve reputation
        $reputation = User::getReputation($userId)['score'] ?? 0;

        $body = $this->view('profiles/index', [
            'user'       => $user,
            'questions'  => $questions,
            'reputation' => $reputation
        ]);

        $title = ($userId == $_SESSION['user_id'])
            ? "My Profile"
            : "Profile — " . $user['name'];

        return $this->renderPage($title, $body);
    }

    public function update()
    {
        $this->verifyAuth();
        $userId = $_SESSION['user_id'];
        $db     = \Database::connect();

        if (isset($_POST['update_password'])) {
            $new     = $_POST['new_password']     ?? '';
            $confirm = $_POST['confirm_password'] ?? '';

            if (empty($new) || $new !== $confirm) {
                $this->setFlash('error', 'Passwords do not match.');
                $this->redirect('/profile');
            }

            $hash = password_hash($new, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE users SET password = :pw WHERE id = :id");
            if ($stmt->execute(['pw' => $hash, 'id' => $userId])) {
                $this->setFlash('success', 'Password updated successfully.');
            } else {
                $this->setFlash('error', 'Error updating password.');
            }
            $this->redirect('/profile');
        }

        $data = [
            'name'  => $_POST['name']  ?? '',
            'email' => $_POST['email'] ?? '',
            'bio'   => $_POST['bio']   ?? '',
        ];

        if (empty($data['name']) || empty($data['email'])) {
            $this->setFlash('error', 'Name and email are required.');
            $this->redirect('/profile');
        }

        try {
            $stmt = $db->prepare("UPDATE users SET name = :n, email = :e, bio = :b WHERE id = :id");
            if ($stmt->execute([
                'n'  => $data['name'],
                'e'  => $data['email'],
                'b'  => $data['bio'],
                'id' => $userId,
            ])) {
                $_SESSION['user_name'] = $data['name'];
                $this->setFlash('success', 'Profile updated successfully.');
            } else {
                $this->setFlash('error', 'Error updating profile.');
            }
        } catch (\PDOException $e) {
            $this->setFlash('error', 'This email may already be in use.');
        }

        $this->redirect('/profile');
    }
}
