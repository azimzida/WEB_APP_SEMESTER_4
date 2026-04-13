<?php

class AuthController extends Controller
{
    public function login()
    {
        $session = new SessionManager();

        if ($session->isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($email !== '' && $password !== '') {
                $session->login($email);
                header('Location: /dashboard');
                exit;
            }

            $data = [
                'title' => 'Login - ' . APP_NAME,
                'name' => APP_NAME,
                'page' => 'login',
                'message' => 'Please enter a valid email and password to access Edu Share.',
            ];

            $this->view('auth/login', $data);
            return;
        }

        $data = [
            'title' => 'Login - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'login',
            'message' => 'Enter your credentials to continue to Edu Share and access learning materials.',
        ];

        $this->view('auth/login', $data);
    }

    public function register()
    {
        $session = new SessionManager();

        if ($session->isLoggedIn()) {
            header('Location: /dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($email !== '' && $password !== '') {
                $session->login($email);
                header('Location: /dashboard');
                exit;
            }
        }

        $data = [
            'title' => 'Register - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'register',
            'message' => 'Daftar sekarang untuk memulai perjalanan belajarmu bersama Edu Share.',
        ];

        $this->view('auth/register', $data);
    }

    public function logout()
    {
        $session = new SessionManager();
        $session->logout();
        header('Location: /');
        exit;
    }
}
