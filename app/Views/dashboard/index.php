<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
?>

<div class="min-h-screen bg-slate-100">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="flex flex-col gap-6 rounded-[2rem] bg-white px-6 py-6 shadow-2xl shadow-slate-200/20 lg:flex-row lg:items-center lg:justify-between lg:px-10 lg:py-8">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-violet-500 text-xl font-bold text-white">E</div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-violet-600">Edu Share</p>
                    <p class="text-xs text-slate-500">Belajar lebih mudah dan terstruktur</p>
                </div>
            </div>

            <nav class="flex flex-wrap items-center gap-3 text-sm font-medium text-slate-600">
                <a href="/index.php?url=home/index" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">Home</a>
                <a href="/index.php?url=home/about" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">About</a>
                <a href="/index.php?url=home/catalog" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">Catalog</a>
                <a href="#courses" class="rounded-full px-4 py-2 text-slate-700 transition hover:text-slate-900">Courses</a>
                <a href="/index.php?url=auth/login" class="ml-4 rounded-full bg-violet-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-700">Login</a>
            </nav>
        </header>

        <section class="mt-10 grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
            <div class="space-y-6">
                <span class="inline-flex rounded-full bg-violet-100 px-4 py-2 text-sm font-semibold text-violet-700">Mulai belajar dengan Edu Share</span>
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Platform Belajar Online untuk Siswa & Pengajar</h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-600"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>

                <div class="flex flex-col gap-4 sm:flex-row">
                    <a href="#courses" class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-500/20 transition hover:bg-violet-700">Lihat Kursus</a>
                    <a href="/index.php?url=home/about" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Tentang Kami</a>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6">
                    <form class="flex flex-col gap-4 sm:flex-row">
                        <input type="text" placeholder="Cari materi, topik atau guru" class="w-full rounded-full border border-slate-200 bg-white px-5 py-4 text-slate-900 outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-200" />
                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-4 text-sm font-semibold text-white transition hover:bg-violet-700">Search</button>
                    </form>
                </div>
            </div>

            <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-violet-500 via-fuchsia-500 to-purple-500 p-8 text-white shadow-2xl shadow-violet-500/20">
                <div class="absolute -right-16 top-8 h-48 w-48 rounded-full bg-white/10 blur-3xl"></div>
                <div class="absolute -left-16 bottom-8 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative z-10">
                    <p class="text-sm uppercase tracking-[0.3em] text-white/80">Featured</p>
                    <h2 class="mt-6 text-3xl font-semibold">Kursus Terpopuler Bulan Ini</h2>
                    <p class="mt-4 text-slate-100 leading-7">Tambahkan ke perjalanan belajarmu dengan kursus yang dibuat khusus untuk kebutuhan siswa dan guru.</p>
                    <div class="mt-8 grid gap-4">
                        <div class="rounded-[2rem] bg-white/10 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-violet-100">Linux</p>
                            <p class="mt-3 text-lg font-semibold">Dasar Linux</p>
                        </div>
                        <div class="rounded-[2rem] bg-white/10 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-violet-100">SQL</p>
                            <p class="mt-3 text-lg font-semibold">Database untuk Pemula</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-12 grid gap-6 md:grid-cols-3">
            <div class="rounded-[2rem] bg-white p-6 shadow-2xl shadow-slate-200/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Marketplace</p>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Akses materi lengkap</h3>
                <p class="mt-3 text-slate-600">Dapatkan materi belajar, modul, dan sumber referensi untuk setiap pelajaran.</p>
            </div>
            <div class="rounded-[2rem] bg-white p-6 shadow-2xl shadow-slate-200/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Learning Path</p>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Jalur pembelajaran jelas</h3>
                <p class="mt-3 text-slate-600">Susun rencana belajar dari dasar sampai mahir dengan mudah.</p>
            </div>
            <div class="rounded-[2rem] bg-white p-6 shadow-2xl shadow-slate-200/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Support</p>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Dukungan penuh</h3>
                <p class="mt-3 text-slate-600">Tim pengajar dan mentor siap membantu setiap langkah belajarmu.</p>
            </div>
        </section>

        <section id="courses" class="mt-12 rounded-[2rem] bg-white p-8 shadow-2xl shadow-slate-200/20">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-violet-600">My Courses</p>
                    <h2 class="mt-3 text-2xl font-semibold text-slate-900">Kursus Pilihan</h2>
                </div>
                <a href="#" class="rounded-full bg-violet-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-violet-700">Lihat Semua</a>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-3">
                <div class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-500">Linux</p>
                    <p class="mt-3 text-slate-700">Belajar command dasar hingga scripting.</p>
                </div>
                <div class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-500">SQL</p>
                    <p class="mt-3 text-slate-700">Bangun query dan kelola database secara efisien.</p>
                </div>
                <div class="rounded-[1.75rem] border border-slate-200 bg-slate-50 p-5">
                    <p class="text-sm font-semibold text-slate-500">Web Dev</p>
                    <p class="mt-3 text-slate-700">Membuat website interaktif menggunakan HTML, CSS, dan JS.</p>
                </div>
            </div>
        </section>

        <section class="mt-12 grid gap-6 lg:grid-cols-3">
            <div class="rounded-[2rem] bg-violet-500 p-6 text-white shadow-2xl shadow-violet-500/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-100">Trusted</p>
                <h3 class="mt-4 text-xl font-semibold">120+ Materi</h3>
                <p class="mt-3 text-slate-100">Materi berkualitas untuk berbagai jenjang belajar.</p>
            </div>
            <div class="rounded-[2rem] bg-violet-500 p-6 text-white shadow-2xl shadow-violet-500/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-100">Satisfaction</p>
                <h3 class="mt-4 text-xl font-semibold">95% Kepuasan</h3>
                <p class="mt-3 text-slate-100">Dukungan pembelajaran yang responsif dan mudah diikuti.</p>
            </div>
            <div class="rounded-[2rem] bg-violet-500 p-6 text-white shadow-2xl shadow-violet-500/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-100">Community</p>
                <h3 class="mt-4 text-xl font-semibold">Komunitas Aktif</h3>
                <p class="mt-3 text-slate-100">Belajar bersama teman dan mentor dalam satu platform.</p>
            </div>
        </section>
    </div>
</div>
