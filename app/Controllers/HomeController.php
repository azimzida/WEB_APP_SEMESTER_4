<?php

class HomeController extends Controller
{
    private $courseModel;

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
        $materials = [];
        $uploadMessage = null;
        $uploadSuccess = null;

        if ($dbStatus) {
            if (!isset($this->courseModel)) {
                $this->courseModel = $this->model('CourseModel');
            }
            $kategoriModel = $this->model('KategoriModel');
            $materiModel = $this->model('MateriModel');
            $courses = $this->courseModel->findAll();
            $categories = $kategoriModel->getAllCategories();
            $materials = $materiModel->getAllMaterials();
        }

        if (isset($_GET['uploadMessage'])) {
            $uploadMessage = trim($_GET['uploadMessage']);
            $uploadSuccess = isset($_GET['uploadSuccess']) && $_GET['uploadSuccess'] === '1';
        }

        if (isset($_GET['message'])) {
            $uploadMessage = trim($_GET['message']);
            $uploadSuccess = isset($_GET['success']) && $_GET['success'] === '1';
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
            'materials' => $materials,
            'uploadMessage' => $uploadMessage,
            'uploadSuccess' => $uploadSuccess,
        ];

        $this->view('dashboard/material', $data);
    }

    public function storeMaterial()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /home/material');
            exit;
        }

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            header('Location: /login');
            exit;
        }

        $materiModel = $this->model('MateriModel');
        $courseId = trim($_POST['course_id'] ?? '');
        $kategoriId = trim($_POST['kategori_id'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        $uploadSuccess = false;
        $uploadMessage = '';
        $fileContents = null;

        if (empty($title)) {
            $uploadMessage = 'Judul materi tidak boleh kosong.';
        } elseif (empty($courseId)) {
            $uploadMessage = 'Pilih course terlebih dahulu.';
        } elseif (empty($kategoriId)) {
            $uploadMessage = 'Pilih kategori materi terlebih dahulu.';
        } else {
            $file = $_FILES['file_materi'] ?? null;

            if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
                $uploadMessage = 'Unggah file gagal. Pastikan file PDF sudah dipilih.';
            } elseif (strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) !== 'pdf') {
                $uploadMessage = 'Hanya file PDF yang diperbolehkan.';
            } else {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimeType = finfo_file($finfo, $file['tmp_name']);
                finfo_close($finfo);

                if ($mimeType !== 'application/pdf') {
                    $uploadMessage = 'File yang diunggah bukan PDF.';
                } else {
                    $fileContents = file_get_contents($file['tmp_name']);
                    if ($fileContents === false) {
                        $uploadMessage = 'Gagal membaca file PDF.';
                    }
                }
            }

            if ($uploadMessage === '') {
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
                } else {
                    $uploadMessage = 'Gagal menyimpan data materi ke database.';
                }
            }
        }

        $redirectUrl = '/home/material?uploadMessage=' . rawurlencode($uploadMessage) . '&uploadSuccess=' . ($uploadSuccess ? '1' : '0');
        header('Location: ' . $redirectUrl);
        exit;
    }

    public function previewMaterial($id = null)
    {
        if (empty($id)) {
            header('Location: /home/material');
            exit;
        }

        $materiModel = $this->model('MateriModel');
        $material = $materiModel->getMaterialById($id);

        if (!$material || empty($material['file_materi'])) {
            header('Location: /home/material');
            exit;
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="material.pdf"');
        echo $material['file_materi'];
        exit;
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

    public function storeCourse()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /home/material');
            exit;
        }

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            header('Location: /login');
            exit;
        }

        $courseModel = $this->model('CourseModel');
        $courseName = trim($_POST['course_name'] ?? '');
        $courseDescription = trim($_POST['course_description'] ?? '');

        $message = '';
        $success = false;

        if (empty($courseName)) {
            $message = 'Nama course tidak boleh kosong.';
        } else {
            $courseId = $courseModel->generateId();
            if ($courseModel->createCourse($courseId, $courseName, $courseDescription, $user['id'])) {
                $message = 'Course berhasil ditambahkan.';
                $success = true;
            } else {
                $message = 'Gagal menambahkan course.';
            }
        }

        $redirectUrl = '/home/material?message=' . rawurlencode($message) . '&success=' . ($success ? '1' : '0');
        header('Location: ' . $redirectUrl);
        exit;
    }

    public function storeCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /home/material');
            exit;
        }

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            header('Location: /login');
            exit;
        }

        $kategoriModel = $this->model('KategoriModel');
        $categoryName = trim($_POST['category_name'] ?? '');

        $message = '';
        $success = false;

        if (empty($categoryName)) {
            $message = 'Nama kategori tidak boleh kosong.';
        } else {
            $categoryId = $kategoriModel->generateId();
            $categorySlug = $kategoriModel->generateSlug($categoryName);
            if ($kategoriModel->createCategory($categoryId, $categoryName, $categorySlug)) {
                $message = 'Kategori berhasil ditambahkan.';
                $success = true;
            } else {
                $message = 'Gagal menambahkan kategori.';
            }
        }

        $redirectUrl = '/home/material?message=' . rawurlencode($message) . '&success=' . ($success ? '1' : '0');
        header('Location: ' . $redirectUrl);
        exit;
    }

   
}
