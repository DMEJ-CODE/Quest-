<?php

namespace Core;

class BaseController
{
    /**
     * Vérifie si l'utilisateur est connecté
     */
    protected function verifyAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
    }

    /**
     * Vérifie si l'utilisateur est Admin
     */
    protected function verifyAdmin()
    {
        $this->verifyAuth();
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            die("Accès refusé. Vous n'êtes pas administrateur.");
        }
    }

    /**
     * Charge une vue et retourne son contenu.
     */
    protected function view($viewPath, $data = [])
    {
        extract($data);
        $fullPath = __DIR__ . '/../resources/views/' . str_replace('.', '/', $viewPath) . '.php';

        if (!file_exists($fullPath)) {
            return "View not found: " . $viewPath;
        }

        ob_start();
        include $fullPath;
        return ob_get_clean();
    }

    /**
     * Rendu d'une page avec Layout.
     */
    protected function renderPage($title, $bodyHtml, $subtitle = '', $layout = 'app')
    {
        $pageTitle = $title;
        $pageSubtitle = $subtitle;
        $pageBody = $bodyHtml;
        $flash = $this->getFlash();
        $layoutPath = __DIR__ . '/../resources/views/layouts/' . $layout . '.php';

        if (!file_exists($layoutPath)) {
            return $bodyHtml;
        }

        ob_start();
        require $layoutPath;
        return ob_get_clean();
    }

    /**
     * Définir un message flash en session
     * @param string $type success, error, warning, info
     * @param string $message 
     */
    protected function setFlash($type, $message)
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    /**
     * Retrieve and delete the flash message
     */
    protected function getFlash()
    {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    /**
     * Helper pour rediriger (Laravel style)
     */
    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}