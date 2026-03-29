<?php

namespace App\Controllers;

use Core\BaseController;
use App\Models\User;

class UserController extends BaseController
{
    /**
     * Supprime ou banni un utilisateur
     */
    public function destroy($id)
    {
        $this->verifyAuth();
        
        if ($_SESSION['user_role'] !== 'admin') {
            die("Action non autorisée. Seul un administrateur peut supprimer des membres.");
        }

        if ($id == $_SESSION['user_id']) {
            $this->setFlash('error', "Vous ne pouvez pas supprimer votre propre compte admin.");
            header('Location: /dashboard/members');
            exit;
        }

        $user = User::find($id);
        if (!$user) {
            $this->setFlash('error', "Utilisateur introuvable.");
        } else {
            $db = \Database::connect();
            $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
            if ($stmt->execute(['id' => $id])) {
                $this->setFlash('success', "Le membre a été supprimé du système.");
            } else {
                $this->setFlash('error', "Impossible de supprimer ce membre, des données y sont liées.");
            }
        }
        
        header('Location: /dashboard/members');
        exit;
    }
}