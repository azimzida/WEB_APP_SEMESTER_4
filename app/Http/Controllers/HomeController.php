<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends BaseController
{
    public function guest(Request $request)
    {
        if ($request->session()->has('user_email')) {
            return redirect('/dashboard');
        }

        return $this->renderLegacyView('dashboard/guest', [
            'title' => config('app.name'),
            'page' => 'guest',
            'message' => 'Welcome to Edu Share. Please login or register to continue.',
        ]);
    }

    public function index()
    {
        return $this->renderLegacyView('dashboard/index', [
            'title' => config('app.name'),
            'page' => 'beranda',
            'message' => 'Ini adalah halaman beranda Edu Share.',
        ]);
    }

    public function about()
    {
        return $this->renderLegacyView('dashboard/about', [
            'title' => 'Tentang Kami - ' . config('app.name'),
            'page' => 'tentang',
            'message' => 'Ini adalah halaman Tentang Kami untuk aplikasi Edu Share.',
        ]);
    }

    public function courses()
    {
        $categories = DB::table('kategori')->get();
        $courses = DB::table('course')->get();
        $materials = DB::table('materi')->get();

        return $this->renderLegacyView('dashboard/courses', [
            'title' => 'Courses - ' . config('app.name'),
            'page' => 'courses',
            'message' => 'Ini adalah halaman Courses untuk aplikasi Edu Share.',
            'categories' => $categories,
            'courses' => $courses,
            'materials' => $materials,
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
            DB::table('kategori')->insert([
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

            DB::table('course')->insert($insert);

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

        try {
            DB::table('materi')->insert([
                'id' => Str::random(20),
                'user_id' => $this->getAuthenticatedUser()['id'] ?? null,
                'course_id' => $data['course'] ?? null,
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
        return $this->renderLegacyView('dashboard/profile', [
            'title' => 'Profil Saya - ' . config('app.name'),
            'page' => 'profil',
            'message' => 'Halaman profil sementara untuk melihat data akun dan status profil.',
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

        DB::table('users')->where('id', $user['id'])->update(['foto_profil' => $binaryData]);

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

        DB::table('users')->where('id', $user['id'])->update(['foto_profil' => null]);

        return redirect('/profile');
    }
}