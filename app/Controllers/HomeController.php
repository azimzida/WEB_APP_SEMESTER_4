<?php

class HomeController extends Controller
{
    public function index()
    {
        $homeModel = $this->model('HomeModel');

        $data = [
            'title' => APP_NAME,
            'name' => APP_NAME,
            'page' => 'beranda',
            'message' => $homeModel->getWelcomeMessage(),
        ];

        $this->view('home/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Kami - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'tentang',
            'message' => 'Ini adalah halaman Tentang Kami untuk aplikasi Edu Share.',
        ];

        $this->view('home/about', $data);
    }

    public function catalog()
    {
        $data = [
            'title' => 'Katalog - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'katalog',
            'message' => 'Lihat koleksi materi dan katalog layanan Edu Share di sini.',
        ];

        $this->view('home/index', $data);
    }
}
