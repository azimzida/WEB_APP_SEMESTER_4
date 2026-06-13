<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/home/courses', [HomeController::class, 'courses']);
Route::get('/profile', [HomeController::class, 'profile']);
Route::post('/profile/upload', [HomeController::class, 'uploadPhoto']);
Route::post('/profile/delete', [HomeController::class, 'deletePhoto']);
Route::match(['get', 'post'], '/login', [AuthController::class, 'login']);
Route::match(['get', 'post'], '/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);
// routes/web.php (tambahkan)
Route::post('/kategori/create', [App\Http\Controllers\HomeController::class, 'createCategory']);
Route::post('/course/create', [App\Http\Controllers\HomeController::class, 'createCourse']);
Route::post('/materials/upload', [App\Http\Controllers\HomeController::class, 'uploadMaterial']);
Route::get('/home/previewMaterial/{id}', [App\Http\Controllers\HomeController::class, 'previewMaterial']);
Route::get('/home/view_pdf/{id}', [App\Http\Controllers\HomeController::class, 'previewMaterial']);

Route::fallback(function () {
    $dbStatus = true;

    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        $dbStatus = false;
    }

    return response()->view('errors.404', [
        'title' => '404 - Halaman Tidak Ditemukan',
        'page' => '404',
        'message' => 'Halaman yang Anda cari tidak ditemukan.',
        'name' => config('app.name'),
        'dbStatus' => $dbStatus,
        'dbStatusMessage' => $dbStatus ? 'Database connected successfully.' : 'Database not connected.',
        'user' => null,
    ], 404);
});