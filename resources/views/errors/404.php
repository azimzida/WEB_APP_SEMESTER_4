<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
$dbStatus = $dbStatus ?? false;
$dbStatusMessage = $dbStatusMessage ?? 'Database status unavailable.';
$user = $user ?? null;
$userName = $user['nama'] ?? null;
$userPhoto = $user['foto_profil'] ?? null;
?>

<div class="min-h-screen bg-slate-100 flex items-center justify-center p-6">
    <div class="rounded-[2rem] bg-white p-12 shadow-2xl shadow-slate-200/20 max-w-md w-full text-center">
        <div class="text-9xl font-bold text-violet-500 mb-6">404</div>
        <h1 class="text-3xl font-bold text-slate-900 mb-4">Halaman Tidak Ditemukan</h1>
        <p class="text-slate-600 mb-8">Halaman yang Anda cari tidak ditemukan.</p>
        <a href="/dashboard" class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-500/20 transition hover:bg-violet-700">Kembali ke Dashboard</a>
    </div>
</div>
