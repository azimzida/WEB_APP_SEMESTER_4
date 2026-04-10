<?php

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Login - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'login',
            'message' => 'Masuk untuk melanjutkan ke platform Edu Share dan akses semua materi pembelajaran.',
        ];

        $this->view('auth/login', $data);
    }

    public function register()
    {
        $data = [
            'title' => 'Register - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'register',
            'message' => 'Daftar sekarang untuk memulai perjalanan belajarmu bersama Edu Share.',
        ];

        $this->view('auth/register', $data);
    }
}
