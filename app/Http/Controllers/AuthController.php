<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        if ($request->session()->has('user_email')) {
            return redirect('/dashboard');
        }

        $errors = [];

        if ($request->isMethod('post')) {
            $email = trim($request->input('email', ''));
            $password = trim($request->input('password', ''));

            if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email tidak valid.';
            }

            if ($password === '') {
                $errors[] = 'Password harus diisi.';
            }

            if (empty($errors)) {
                $user = DB::table('users')->where('email', $email)->first();

                if ($user && Hash::check($password, $user->password)) {
                    session(['user_email' => $email]);
                    return redirect('/dashboard');
                }

                $errors[] = 'Email atau password salah.';
            }
        }

        return $this->renderLegacyView('auth/login', [
            'title' => 'Login - ' . config('app.name'),
            'page' => 'login',
            'message' => 'Enter your credentials to continue to Edu Share and access learning materials.',
            'errors' => $errors,
        ]);
    }

    public function register(Request $request)
    {
        if ($request->session()->has('user_email')) {
            return redirect('/dashboard');
        }

        $errors = [];

        if ($request->isMethod('post')) {
            $name = trim($request->input('fullname', ''));
            $email = trim($request->input('email', ''));
            $password = trim($request->input('password', ''));
            $phone = trim($request->input('phone', ''));

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

            if (DB::table('users')->where('email', $email)->exists()) {
                $errors[] = 'Email sudah terdaftar.';
            }

            if (empty($errors)) {
                $id = Str::random(20);
                $hash = Hash::make($password);

                $saved = DB::table('users')->insert([
                    'id' => $id,
                    'nama' => $name,
                    'email' => $email,
                    'no_telp' => $phone,
                    'password' => $hash,
                    'role' => 'user',
                ]);

                if ($saved) {
                    session(['user_email' => $email]);
                    return redirect('/dashboard');
                }

                $errors[] = 'Gagal membuat akun. Silakan coba lagi.';
            }
        }

        return $this->renderLegacyView('auth/register', [
            'title' => 'Register - ' . config('app.name'),
            'page' => 'register',
            'message' => 'Daftar sekarang untuk memulai perjalanan belajarmu bersama Edu Share.',
            'errors' => $errors,
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_email');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
