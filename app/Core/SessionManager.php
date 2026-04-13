<?php

class SessionManager
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login(string $user): void
    {
        $_SESSION['user'] = $user;
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
    }

    public function isLoggedIn(): bool
    {
        return !empty($_SESSION['user']);
    }

    public function getUser(): ?string
    {
        return $_SESSION['user'] ?? null;
    }
}
