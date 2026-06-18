<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Kategori;
use App\Models\Materi;
use App\Models\ProfileVisit;
use App\Models\User;

class HomeController extends BaseController
{
    public function guest(Request $request)
    {
        if ($request->session()->has('user_email')) {
            return redirect('/dashboard');
        }

        return $this->renderBladeView('dashboard.guest', [
            'title' => config('app.name'),
            'page' => 'guest',
            'message' => 'Welcome to Edu Share. Please login or register to continue.',
        ]);
    }

    public function index()
    {
        return $this->renderBladeView('dashboard.index', [
            'title' => config('app.name'),
            'page' => 'beranda',
            'message' => 'Ini adalah halaman beranda Edu Share.',
        ]);
    }

    public function about()
    {
        return $this->renderBladeView('dashboard.about', [
            'title' => 'Tentang Kami - ' . config('app.name'),
            'page' => 'tentang',
            'message' => 'Ini adalah halaman Tentang Kami untuk aplikasi Edu Share.',
        ]);
    }

    public function courses()
    {
        $categories = Kategori::query()->get();
        $courses = Course::query()->get();
        $materials = Materi::query()->get();
        $users = User::query()->get();

        return $this->renderBladeView('dashboard.courses', [
            'title' => 'Courses - ' . config('app.name'),
            'page' => 'courses',
            'message' => 'Ini adalah halaman Courses untuk aplikasi Edu Share.',
            'categories' => $categories,
            'courses' => $courses,
            'materials' => $materials,
            'users' => $users,
        ]);
    }

public function courseDetail($id)
{
    $categories = Kategori::query()->get();
    $course = Course::query()->where('id', $id)->first();
    $users = User::query()->get();

    if (!$course) {
        return $this->renderBladeView('dashboard.course-detail', [
            'title' => 'Detail Material - ' . config('app.name'),
            'page' => 'course-detail',
            'notFound' => true,
            'categories' => $categories,
            'users' => $users,
        ]);
    }

    $materials = Materi::query()->where('course_id', $id)->get();

    return $this->renderBladeView('dashboard.course-detail', [
        'title' => 'Detail Material - ' . config('app.name'),
        'page' => 'course-detail',
        'course' => $course,
        'categories' => $categories,
        'materials' => $materials,
        'users' => $users,
    ]);
}

    public function createCategory(Request $request)
    {
        if (!$request->session()->has('user_email')) {
            return redirect('/login');
        }

        $data = $request->validate([
            'name' => 'required|string|max:150',
        ]);

        try {
            Kategori::query()->insert([
                'kategori_id' => Str::random(20),
                'nama_kategori' => $data['name'],
                'slug' => Str::slug($data['name']),
            ]);

            return redirect('/home/courses')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect('/home/courses')->with('error', 'Gagal menambahkan kategori: ' . $e->getMessage());
        }
    }

    public function createCourse(Request $request)
    {
        if (!$request->session()->has('user_email')) {
            return redirect('/login');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable',
        ]);

        $user = $this->getAuthenticatedUser();

        try {
            $insert = [
                'id' => Str::random(20),
                'nama_course' => $data['title'],
                'deskripsi' => $data['description'] ?? null,
                'created_by' => $user['id'] ?? null,
            ];

            if (!empty($data['category']) && Schema::hasColumn('course', 'kategori_id')) {
                $insert['kategori_id'] = $data['category'];
            }

            Course::query()->insert($insert);

            return redirect('/home/courses')->with('success', 'Course berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect('/home/courses')->with('error', 'Gagal menambahkan course: ' . $e->getMessage());
        }
    }

    public function uploadMaterial(Request $request)
    {
        if (!$request->session()->has('user_email')) {
            return redirect('/login');
        }
 
        $data = $request->validate([
            'category' => 'nullable',
            'course' => 'nullable',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material_file' => 'required|file|mimes:pdf|max:512000',
        ]);
 
        $file = $request->file('material_file');
        $path = $file->store('materials', 'public');
 
        $courseId = null;
        $courseName = trim($data['course'] ?? '');
        if ($courseName !== '') {
            $existingCourse = Course::query()->where('nama_course', $courseName)->first();
            if ($existingCourse) {
                $courseId = $existingCourse->id;
            } else {
                $courseId = Str::random(20);
                Course::query()->insert([
                    'id' => $courseId,
                    'nama_course' => $courseName,
                    'created_by' => $this->getAuthenticatedUser()['id'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
 
        try {
            Materi::query()->insert([
                'id' => Str::random(20),
                'user_id' => $this->getAuthenticatedUser()['id'] ?? null,
                'course_id' => $courseId,
                'kategori_id' => $data['category'] ?? null,
                'judul' => $data['title'],
                'deskripsi' => $data['description'] ?? null,
                'file_materi' => $path,
                'tanggal_upload' => now(),
                'updated_at' => now(),
            ]);
 
            return redirect('/home/courses')->with('success', 'Materi berhasil diupload.');
        } catch (\Exception $e) {
            return redirect('/home/courses')->with('error', 'Gagal upload materi: ' . $e->getMessage());
        }
    }

    public function profile()
    {
        $user = $this->getAuthenticatedUser();
        $userMaterials = [];
        $courses = [];
        $categories = [];
        
        if ($user) {
            $userMaterials = Materi::query()->where('user_id', $user['id'])->get();
            $courses = Course::query()->get();
            $categories = Kategori::query()->get();
        }

        return $this->renderBladeView('dashboard.profile', [
            'title' => 'Profil Saya - ' . config('app.name'),
            'page' => 'profil',
            'message' => 'Halaman profil sementara untuk melihat data akun dan status profil.',
            'userMaterials' => $userMaterials,
            'courses' => $courses,
            'categories' => $categories,
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        if (!$request->session()->has('user_email') || !$request->isMethod('post')) {
            return redirect('/profile');
        }

        $photo = $request->file('photo');
        if (!$photo || !$photo->isValid()) {
            return redirect('/profile');
        }

        $imageInfo = @getimagesize($photo->path());
        $allowedTypes = [
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_GIF => 'gif',
            IMAGETYPE_WEBP => 'webp',
        ];

        if (!$imageInfo || !isset($allowedTypes[$imageInfo[2]])) {
            return redirect('/profile');
        }

        if ($photo->getSize() > 4 * 1024 * 1024) {
            return redirect('/profile');
        }

        $binaryData = file_get_contents($photo->path());
        if ($binaryData === false) {
            return redirect('/profile');
        }

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login');
        }

        User::query()->where('id', $user['id'])->update(['foto_profil' => $binaryData]);

        return redirect('/profile');
    }

    public function deletePhoto(Request $request)
    {
        if (!$request->session()->has('user_email') || !$request->isMethod('post')) {
            return redirect('/profile');
        }

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login');
        }

        User::query()->where('id', $user['id'])->update(['foto_profil' => null]);

        return redirect('/profile');
    }

    public function updateProfile(Request $request)
    {
        if (!$request->session()->has('user_email') || !$request->isMethod('post')) {
            return redirect('/profile');
        }

        $user = $this->getAuthenticatedUser();
        if (!$user) {
            return redirect('/login');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        // Check if email already exists for another user
        $emailExists = User::query()
            ->where('email', $data['email'])
            ->where('id', '!=', $user['id'])
            ->exists();

        if ($emailExists) {
            return redirect('/profile')->with('error', 'Email sudah terdaftar oleh pengguna lain.');
        }

        try {
            User::query()
                ->where('id', $user['id'])
                ->update([
                    'nama' => $data['name'],
                    'email' => $data['email'],
                    'no_telp' => $data['telephone'],
                ]);

            session(['user_email' => $data['email']]);

            return redirect('/profile')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect('/profile')->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    public function showUploadForm()
    {
        if (!session()->has('user_email')) {
            return redirect('/login');
        }

        $categories = Kategori::query()->get();
        $courses = Course::query()->get();

        return $this->renderBladeView('dashboard.upload', [
            'title' => 'Upload Materi - ' . config('app.name'),
            'page' => 'upload-material',
            'message' => 'Upload materi pembelajaran baru.',
            'categories' => $categories,
            'courses' => $courses,
        ]);
    }

    public function editCourseForm($id)
    {
        if (!session()->has('user_email')) {
            return redirect('/login');
        }

        $course = Course::query()->where('id', $id)->first();
        if (!$course) {
            return redirect('/home/courses')->with('error', 'Course tidak ditemukan.');
        }

        $categories = Kategori::query()->get();

        return $this->renderBladeView('dashboard.course-edit', [
            'title' => 'Edit Course - ' . config('app.name'),
            'page' => 'edit-course',
            'course' => $course,
            'categories' => $categories,
        ]);
    }

    public function updateCourse(Request $request, $id)
    {
        if (!session()->has('user_email')) {
            return redirect('/login');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable',
        ]);

        try {
            $update = [
                'nama_course' => $data['title'],
                'deskripsi' => $data['description'] ?? null,
            ];

            if (!empty($data['category']) && Schema::hasColumn('course', 'kategori_id')) {
                $update['kategori_id'] = $data['category'];
            }

            Course::query()->where('id', $id)->update($update);

            return redirect('/home/courses')->with('success', 'Course berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect("/course/$id/edit")->with('error', 'Gagal memperbarui course: ' . $e->getMessage());
        }
    }

    public function deleteCourse(Request $request, $id)
    {
        if (!session()->has('user_email') || !$request->isMethod('post')) {
            return redirect('/home/courses');
        }

        try {
            Course::query()->where('id', $id)->delete();
            return redirect('/home/courses')->with('success', 'Course berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect('/home/courses')->with('error', 'Gagal menghapus course: ' . $e->getMessage());
        }
    }

    public function editMaterialForm($id)
    {
        if (!session()->has('user_email')) {
            return redirect('/login');
        }

        $material = Materi::query()->where('id', $id)->first();
        if (!$material) {
            return redirect('/home/courses')->with('error', 'Materi tidak ditemukan.');
        }

        $user = $this->getAuthenticatedUser();
        if ($material->user_id !== $user['id']) {
            return redirect('/home/courses')->with('error', 'Anda tidak berhak mengedit materi ini.');
        }

        $categories = Kategori::query()->get();
        $courses = Course::query()->get();
        $course = $material->course_id ? Course::query()->where('id', $material->course_id)->first() : null;

        return $this->renderBladeView('dashboard.material-edit', [
            'title' => 'Edit Materi - ' . config('app.name'),
            'page' => 'edit-material',
            'material' => $material,
            'categories' => $categories,
            'courses' => $courses,
            'course' => $course,
        ]);
    }

    public function updateMaterial(Request $request, $id)
    {
        if (!session()->has('user_email')) {
            return redirect('/login');
        }

        $material = Materi::query()->where('id', $id)->first();
        if (!$material) {
            return redirect('/home/courses')->with('error', 'Materi tidak ditemukan.');
        }

        $user = $this->getAuthenticatedUser();
        if ($material->user_id !== $user['id']) {
            return redirect('/home/courses')->with('error', 'Anda tidak berhak mengedit materi ini.');
        }

        $data = $request->validate([
            'category' => 'nullable',
            'title' => 'required|string|max:255',
            'course_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'material_file' => 'nullable|file|mimes:pdf|max:512000',
        ]);

        $update = [
            'kategori_id' => $data['category'] ?? null,
            'judul' => $data['title'],
            'deskripsi' => $data['description'] ?? null,
            'updated_at' => now(),
        ];

        if ($request->hasFile('material_file')) {
            $file = $request->file('material_file');
            $path = $file->store('materials', 'public');
            $update['file_materi'] = $path;
            
            if (Storage::disk('public')->exists($material->file_materi)) {
                Storage::disk('public')->delete($material->file_materi);
            }
        }

        try {
            Materi::query()->where('id', $id)->update($update);
            
            if ($material->course_id && !empty($data['course_name'])) {
                $courseUpdate = ['nama_course' => $data['course_name']];
                if (!empty($data['category']) && Schema::hasColumn('course', 'kategori_id')) {
                    $courseUpdate['kategori_id'] = $data['category'];
                }
                Course::query()->where('id', $material->course_id)->update($courseUpdate);
            }
            
            return redirect('/profile')->with('success', 'Materi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect("/materials/$id/edit")->with('error', 'Gagal memperbarui materi: ' . $e->getMessage());
        }
    }

    public function deleteMaterial(Request $request)
    {
        if (!session()->has('user_email') || !$request->isMethod('post')) {
            return redirect('/home/courses');
        }

        $materialId = $request->input('id');

        try {
            $material = Materi::query()->where('id', $materialId)->first();
            if ($material && Storage::disk('public')->exists($material->file_materi)) {
                Storage::disk('public')->delete($material->file_materi);
            }

            $courseId = $material ? $material->course_id : null;
            Materi::query()->where('id', $materialId)->delete();

            if ($courseId) {
                $count = Materi::query()->where('course_id', $courseId)->count();
                if ($count === 0) {
                    Course::query()->where('id', $courseId)->delete();
                }
            }

            return redirect()->back()->with('success', 'Materi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus materi: ' . $e->getMessage());
        }
    }

    public function previewMaterial($id)
    {
        $material = Materi::query()->where('id', $id)->first();

        if (!$material) {
            return redirect('/home/courses')->with('error', 'Materi tidak ditemukan.');
        }

        $filepath = storage_path('app/public/' . $material->file_materi);

        if (!file_exists($filepath)) {
            return redirect('/home/courses')->with('error', 'File tidak ditemukan.');
        }

        return response()->file($filepath);
    }

    public function download($id = null)
    {
        if ($id) {
            return $this->previewMaterial($id);
        }

        $categories = Kategori::query()->get();
        $courses = Course::query()->get();
        $materials = Materi::query()->get();
        $users = User::query()->get();

        return $this->renderBladeView('dashboard.download', [
            'title' => 'Download Materi - ' . config('app.name'),
            'page' => 'download',
            'categories' => $categories,
            'courses' => $courses,
            'materials' => $materials,
            'users' => $users,
        ]);
    }

    public function publicProfile(Request $request, $id)
    {
        $profileUser = User::query()->where('id', $id)->first();

        if (!$profileUser) {
            return redirect('/home/courses')->with('error', 'User tidak ditemukan.');
        }

        // Jangan catat kunjungan jika yang berkunjung adalah pemilik profil itu sendiri
        $loggedInUser = $this->getAuthenticatedUser();
        $isOwner = $loggedInUser && $loggedInUser['id'] === $profileUser->id;

        if (!$isOwner) {
            ProfileVisit::query()->insert([
                'user_id' => $profileUser->id,
                'visitor_ip' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $materials = Materi::query()->where('user_id', $profileUser->id)->get();
        $courses = Course::query()->get();

        return $this->renderBladeView('dashboard.public-profile', [
            'title' => 'Profil Publik - ' . config('app.name'),
            'page' => 'public-profile',
            'profileUser' => $profileUser,
            'materials' => $materials,
            'courses' => $courses,
            'isOwner' => $isOwner,
            'user' => $loggedInUser
        ]);
    }

    public function getProfileVisitsData(Request $request)
    {
        $user = $this->getAuthenticatedUser();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Ambil 7 hari terakhir
        $days = 7;
        $visits = ProfileVisit::query()
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('user_id', $user['id'])
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Siapkan format tanggal dan count default 0
        $labels = [];
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('d M');
            $data[$date] = 0;
        }

        // Isi dengan data asli
        foreach ($visits as $visit) {
            if (isset($data[$visit->date])) {
                $data[$visit->date] = $visit->count;
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => array_values($data),
        ]);
    }
}