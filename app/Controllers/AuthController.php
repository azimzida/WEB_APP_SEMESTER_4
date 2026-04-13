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

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $userModel = $this->model('UserModel');

            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email tidak valid.';
            }

            if ($password === '') {
                $errors[] = 'Password harus diisi.';
            }

            if (empty($errors)) {
                $user = $userModel->getUserByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    $session->login($user['email']);
                    header('Location: /dashboard');
                    exit;
                }

                $errors[] = 'Email atau password salah.';
            }
        }

        $data = [
            'title' => 'Login - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'login',
            'message' => 'Enter your credentials to continue to Edu Share and access learning materials.',
            'errors' => $errors,
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

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $userModel = $this->model('UserModel');

            if ($name === '') {
                $errors[] = 'Nama lengkap harus diisi.';
            }

            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email harus dalam format yang benar.';
            }

            if (strlen($password) < 8) {
                $errors[] = 'Password minimal 8 karakter.';
            }

            if ($phone === '' || !ctype_digit($phone)) {
                $errors[] = 'Nomor telepon harus berupa angka.';
            }

            if ($userModel->getUserByEmail($email)) {
                $errors[] = 'Email sudah terdaftar.';
            }

            if (empty($errors)) {
                $id = $userModel->generateId();
                $hash = password_hash($password, PASSWORD_DEFAULT);

                if ($userModel->createUser($id, $name, $email, $phone, $hash)) {
                    $session->login($email);
                    header('Location: /dashboard');
                    exit;
                }

                $errors[] = 'Gagal membuat akun. Silakan coba lagi.';
            }
        }

        $data = [
            'title' => 'Register - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'register',
            'message' => 'Daftar sekarang untuk memulai perjalanan belajarmu bersama Edu Share.',
            'errors' => $errors,
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
