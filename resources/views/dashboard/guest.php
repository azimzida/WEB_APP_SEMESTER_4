<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
?>

<div class="min-h-screen bg-slate-100 px-4 py-8 sm:px-6 lg:px-8">
    <div class="mx-auto grid max-w-[1400px] gap-8 xl:grid-cols-[280px_1fr]">
        <aside class="rounded-[32px] bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-violet-600 text-xl font-bold text-white">E</div>
                <div>
                    <p class="text-lg font-semibold text-slate-900">Edu Share</p>
                        <p class="text-sm text-slate-500">Belum login</p>
                    </div>
                </div>

            <nav class="mt-10 space-y-3 text-sm font-medium text-slate-700">
                <a href="/" class="flex items-center gap-3 rounded-[20px] bg-violet-100 px-4 py-3 text-slate-900 shadow-sm shadow-violet-100">Home</a>
                <a href="/login" class="flex items-center gap-3 rounded-[20px] bg-white px-4 py-3 text-violet-700 shadow-sm shadow-violet-100 hover:bg-violet-50 transition">Login</a>
                <a href="/register" class="flex items-center gap-3 rounded-[20px] bg-violet-700 px-4 py-3 text-white shadow-sm shadow-violet-500/20 hover:bg-violet-800 transition">Register</a>
                <h2 class="mt-2 text-lg font-semibold text-slate-900">Akses setelah login</h2>
                <p class="mt-3 text-sm leading-6">Masuk atau daftar untuk membuka dashboard lengkap, materi belajar, dan laporan progress.</p>
            </div>
        </aside>

        <main class="space-y-6">
            <div class="rounded-[32px] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Welcome to Edu Share</p>
                        <h1 class="mt-4 text-4xl font-bold text-slate-900">Belum login? Masuk atau daftar untuk melanjutkan</h1>
                        <p class="mt-4 max-w-2xl text-lg leading-8 text-slate-600">Saat ini Anda berada di halaman landing untuk pengguna yang belum masuk. Setelah login, Anda akan melihat dashboard lengkap dengan fitur materi, kursus, dan unduhan.</p>
                        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                            <a href="/login" class="inline-flex items-center justify-center rounded-full bg-violet-700 px-6 py-4 text-sm font-semibold text-white transition hover:bg-violet-800">Login</a>
                            <a href="/register" class="inline-flex items-center justify-center rounded-full border border-violet-700 bg-white px-6 py-4 text-sm font-semibold text-violet-700 transition hover:bg-violet-50">Register</a>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-violet-500 via-fuchsia-500 to-slate-900 p-6 text-white">
                        <div class="absolute -right-10 top-8 h-24 w-24 rounded-full bg-white/20 blur-3xl"></div>
                        <div class="absolute -left-10 bottom-8 h-24 w-24 rounded-full bg-fuchsia-300/20 blur-3xl"></div>
                        <div class="relative z-10 flex h-52 items-center justify-center rounded-[2rem] bg-white/10 p-6">
                            <div class="space-y-4 text-center">
                                <div class="mx-auto h-20 w-20 rounded-full bg-white/20"></div>
                                <p class="text-lg font-semibold">Landing Page</p>
                                <p class="text-sm text-slate-100/80">Masuk untuk membuka akses dashboard dan fitur pembelajaran.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-[2rem] bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                    <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Landing</p>
                    <h2 class="mt-4 text-3xl font-semibold text-slate-900">Before login</h2>
                    <p class="mt-2 text-sm text-slate-500">Halaman ini adalah preview Edu Share untuk pengguna yang belum login.</p>
                </div>
                <div class="rounded-[2rem] bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                    <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Segera aktif</p>
                    <h2 class="mt-4 text-3xl font-semibold text-slate-900">Dashboard pengguna</h2>
                    <p class="mt-2 text-sm text-slate-500">Dashboard lengkap akan ditampilkan setelah Anda login.</p>
                </div>
            </div>

            <div class="rounded-[32px] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Fitur utama</p>
                        <h2 class="mt-3 text-2xl font-semibold text-slate-900">Masuk atau daftar untuk mengakses</h2>
                    </div>
                    <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-600">Harus login untuk melanjutkan</span>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-[2rem] bg-violet-50 p-5">
                        <p class="text-sm font-semibold text-violet-700">Homepage</p>
                        <p class="mt-3 text-sm text-slate-500">Simple landing experience before login.</p>
                    </div>
                    <div class="rounded-[2rem] bg-slate-50 p-5">
                        <p class="text-sm font-semibold text-slate-700">Register</p>
                        <p class="mt-3 text-sm text-slate-500">Create an account when ready.</p>
                    </div>
                    <div class="rounded-[2rem] bg-fuchsia-50 p-5">
                        <p class="text-sm font-semibold text-fuchsia-700">Login</p>
                        <p class="mt-3 text-sm text-slate-500">Access the saved dashboard layout after login.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
