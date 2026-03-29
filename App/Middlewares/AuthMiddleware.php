<?php

namespace App\Middlewares;

class AuthMiddleware {
    public static function check() {
        // Démarrer la session si ce n'est pas fait
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si user_id n'existe pas en session -> Redirection
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
    }
}