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

    public function material()
    {
        $dbStatus = Database::testConnection();
        $courses = [];
        $categories = [];
        $uploadMessage = null;
        $uploadSuccess = null;

        if ($dbStatus) {
            $courseModel = $this->model('CourseModel');
            $kategoriModel = $this->model('KategoriModel');
            $courses = $courseModel->getAllCourses();
            $categories = $kategoriModel->getAllCategories();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $materiModel = $this->model('MateriModel');
            $user = $this->getAuthenticatedUser();
            $courseId = trim($_POST['course_id'] ?? '');
            $kategoriId = trim($_POST['kategori_id'] ?? '');
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $file = $_FILES['material_file'] ?? null;

            if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
                $uploadMessage = 'Unggah file gagal. Pastikan file PDF sudah dipilih.';
                $uploadSuccess = false;
            } elseif (strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) !== 'pdf') {
                $uploadMessage = 'Hanya file PDF yang diperbolehkan.';
                $uploadSuccess = false;
            } elseif (empty($courseId)) {
                $uploadMessage = 'Pilih course terlebih dahulu.';
                $uploadSuccess = false;
            } elseif (empty($kategoriId)) {
                $uploadMessage = 'Pilih kategori materi terlebih dahulu.';
                $uploadSuccess = false;
            } else {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                if ($mimeType !== 'application/pdf') {
                    $uploadMessage = 'File yang diunggah bukan PDF.';
                    $uploadSuccess = false;
                } else {
                    $fileContents = file_get_contents($file['tmp_name']);
                    if ($fileContents === false) {
                        $uploadMessage = 'Gagal membaca file PDF.';
                        $uploadSuccess = false;
                    } else {
                        $insertData = [
                            'judul' => $title,
                            'deskripsi' => $description,
                            'file_materi' => $fileContents,
                            'user_id' => $user['id'] ?? null,
                            'course_id' => $courseId,
                            'kategori_id' => $kategoriId,
                        ];

                        if ($materiModel->createMaterial($insertData)) {
                            $uploadMessage = 'Upload materi berhasil disimpan.';
                            $uploadSuccess = true;
                            if ($dbStatus) {
                                $courses = $courseModel->getAllCourses();
                            }
                        } else {
                            $uploadMessage = 'Gagal menyimpan data materi ke database.';
                            $uploadSuccess = false;
                        }
                    }
                }
            }
        }

        $data = [
            'title' => 'Material - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'material',
            'message' => 'Ini adalah halaman Material untuk aplikasi Edu Share.',
            'dbStatus' => $dbStatus,
            'dbStatusMessage' => $dbStatus ? 'Database connected successfully.' : 'Database not connected.',
            'user' => $this->getAuthenticatedUser(),
            'courses' => $courses,
            'categories' => $categories,
            'uploadMessage' => $uploadMessage,
            'uploadSuccess' => $uploadSuccess,
        ];

        $this->view('dashboard/courses', $data);
    }

    private function getAuthenticatedUser(): ?array
    {
        $session = new SessionManager();

        if (!$session->isLoggedIn()) {
            return null;
        }

        $userModel = $this->model('UserModel');
        $user = $userModel->getUserByEmail($session->getUser());

        if ($user && !empty($user['foto_profil'])) {
            $mimeType = $this->detectImageMimeType($user['foto_profil']);
            if ($mimeType) {
                $user['foto_profil'] = 'data:' . $mimeType . ';base64,' . base64_encode($user['foto_profil']);
            } else {
                unset($user['foto_profil']);
            }
        }

        return $user;
    }

    private function detectImageMimeType(string $binary): ?string
    {
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_buffer($finfo, $binary);
            finfo_close($finfo);
            return $mime ?: null;
        }

        $info = @getimagesizefromstring($binary);
        return $info['mime'] ?? null;
    }

    public function notFound()
    {
        $dbStatus = Database::testConnection();

        $data = [
            'title' => '404 - Halaman Tidak Ditemukan',
            'name' => APP_NAME,
            'page' => '404',
            'message' => 'Halaman yang Anda cari tidak ditemukan.',
            'dbStatus' => $dbStatus,
            'dbStatusMessage' => $dbStatus ? 'Database connected successfully.' : 'Database not connected.',
            'user' => $this->getAuthenticatedUser(),
        ];

        $this->view('errors/404', $data);
    }

    public function profile()
    {
        $dbStatus = Database::testConnection();
        $user = $this->getAuthenticatedUser();

        $data = [
            'title' => 'Profil Saya - ' . APP_NAME,
            'name' => APP_NAME,
            'page' => 'profil',
            'message' => 'Halaman profil sementara untuk melihat data akun dan status profil.',
            'dbStatus' => $dbStatus,
            'dbStatusMessage' => $dbStatus ? 'Database connected successfully.' : 'Database not connected.',
            'user' => $user,
        ];

        $this->view('dashboard/profile', $data);
    }

    public function updatePhoto()
    {
        $session = new SessionManager();

        if (!$session->isLoggedIn() || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /profile');
            exit;
        }

        if (empty($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            header('Location: /profile');
            exit;
        }

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            header('Location: /login');
            exit;
        }

        $photo = $_FILES['photo'];
        $imageInfo = @getimagesize($photo['tmp_name']);
        $allowedTypes = [
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_GIF => 'gif',
            IMAGETYPE_WEBP => 'webp',
        ];

        if (!$imageInfo || !isset($allowedTypes[$imageInfo[2]])) {
            header('Location: /profile');
            exit;
        }

        if ($photo['size'] > 4 * 1024 * 1024) {
            header('Location: /profile');
            exit;
        }

        $binaryData = file_get_contents($photo['tmp_name']);
        if ($binaryData === false) {
            header('Location: /profile');
            exit;
        }

        $userModel = $this->model('UserModel');
        $userModel->updateUser($user['id'], ['foto_profil' => $binaryData]);

        header('Location: /profile');
        exit;
    }

    public function deletePhoto()
    {
        $session = new SessionManager();

        if (!$session->isLoggedIn() || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /profile');
            exit;
        }

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            header('Location: /login');
            exit;
        }

        $userModel = $this->model('UserModel');
        $userModel->updateUser($user['id'], ['foto_profil' => null]);

        header('Location: /profile');
        exit;
    }
}
