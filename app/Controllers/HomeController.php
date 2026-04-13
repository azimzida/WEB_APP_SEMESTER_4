<?php

class HomeController extends Controller
{
    public function index()
    {
        $session = new SessionManager();
        $homeModel = $this->model('HomeModel');

        $data = [
            'title' => APP_NAME,
            'name' => APP_NAME,
            'page' => 'beranda',
            'message' => $homeModel->getWelcomeMessage(),
        ];

        if (!$session->isLoggedIn()) {
            $data['message'] = 'You are not logged in yet. Please login or register to access the dashboard.';
            $this->view('dashboard/guest', $data);
            return;
        }

        $data['user'] = $session->getUser();
        $this->view('dashboard/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'tentang',
            'message' => 'Ini adalah halaman Tentang Kami untuk aplikasi Edu Share.',
        ];

        $this->view('dashboard/about', $data);
    }

    public function catalog()
    {
        $data = [
            'title' => 'Katalog - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'katalog',
            'message' => 'Lihat koleksi materi dan katalog layanan Edu Share di sini.',
        ];

        $this->view('dashboard/index', $data);
    }
}
