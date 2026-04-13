<?php

class HomeController extends Controller
{
    public function index()
    {
        $homeModel = $this->model('HomeModel');

        $dbStatus = Database::testConnection();

        $data = [
            'title' => APP_NAME,
            'name' => APP_NAME,
            'page' => 'beranda',
            'message' => $homeModel->getWelcomeMessage(),
            'dbStatus' => $dbStatus,
            'dbStatusMessage' => $dbStatus ? 'Database connected successfully.' : 'Database not connected.',
            'user' => $this->getAuthenticatedUser(),
        ];

        $this->view('dashboard/index', $data);
    }

    public function about()
    {
        $homeModel = $this->model('HomeModel');

        $dbStatus = Database::testConnection();

        $data = [
            'title' => 'Tentang Kami - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'tentang',
            'message' => 'Ini adalah halaman Tentang Kami untuk aplikasi Edu Share.',
            'dbStatus' => $dbStatus,
            'dbStatusMessage' => $dbStatus ? 'Database connected successfully.' : 'Database not connected.',
            'user' => $this->getAuthenticatedUser(),
        ];

        $this->view('dashboard/about', $data);
    }

    private function getAuthenticatedUser(): ?array
    {
        $session = new SessionManager();

        if (!$session->isLoggedIn()) {
            return null;
        }

        $userModel = $this->model('UserModel');
        return $userModel->getUserByEmail($session->getUser());
    }

    public function catalog()
    {
        $data = [
            'title' => 'Katalog - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'katalog',
            'message' => 'Lihat koleksi materi dan katalog layanan Edu Share di sini.',
            'user' => $this->getAuthenticatedUser(),
        ];

        $this->view('dashboard/index', $data);
    }
}
