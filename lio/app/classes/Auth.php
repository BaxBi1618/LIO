<?php
namespace App;

class Auth
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isLogged(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function redirectIfNotLogged(string $redirectTo = '/dashboard'): void
    {
        if (!$this->isLogged()) {
            header("Location: $redirectTo");
            exit;
        }
    }

    public function redirectIfLogged(string $redirectTo = '/dashboard'): void
    {
        if ($this->isLogged()) {
            header("Location: $redirectTo");
            exit;
        }
    }
}
