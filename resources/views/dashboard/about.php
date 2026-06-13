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

<div class="min-h-screen bg-slate-100">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="flex flex-col gap-6 rounded-[2rem] bg-white px-6 py-6 shadow-2xl shadow-slate-200/20 lg:flex-row lg:items-center lg:justify-between lg:px-10 lg:py-8">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-violet-500 text-xl font-bold text-white">E</div>
                <div>
                    <div class="mb-2 flex items-center">
                        <span class="h-3 w-3 rounded-full <?= $dbStatus ? 'bg-emerald-500' : 'bg-rose-500' ?>" title="<?= htmlspecialchars($dbStatusMessage, ENT_QUOTES, 'UTF-8') ?>"></span>
                    </div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-violet-600">Edu Share</p>
                    <p class="text-xs text-slate-500">Learn easier and more structured</p>
                </div>
            </div>

            <div class="md:hidden">
                <button id="hamburger" class="text-slate-600 text-2xl">☰</button>
            </div>

            <nav id="nav" class="hidden md:flex flex-wrap items-center gap-3 text-sm font-medium text-slate-600">
                <a href="/dashboard" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">Home</a>
                <a href="/about" class="rounded-full px-4 py-2 bg-violet-600 text-white transition hover:bg-violet-700">About</a>
                <?php if ($user): ?>
                    <div class="ml-4 flex items-center gap-3">
                        <a href="/profile" class="flex items-center gap-3 rounded-full bg-slate-100 text-slate-900 transition hover:bg-slate-200 px-3 py-2">
                            <?php if (!empty($userPhoto)): ?>
                                <img src="<?= htmlspecialchars($userPhoto, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($userName ?: 'Profile', ENT_QUOTES, 'UTF-8') ?>" class="h-10 w-10 rounded-full object-cover" />
                            <?php else: ?>
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-600 text-sm font-semibold text-white"><?= strtoupper(substr($userName ?? ($user['email'] ?? 'U'), 0, 1)) ?></span>
                            <?php endif; ?>
                            <span class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($userName ?? ($user['email'] ?? 'User'), ENT_QUOTES, 'UTF-8') ?></span>
                        </a>
                        <a href="/logout" class="rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">Logout</a>
                    </div>
                <?php else: ?>
                    <div class="ml-4 flex flex-wrap items-center gap-2">
                        <a href="/login" class="rounded-full bg-violet-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-700">Login</a>
                        <a href="/register" class="rounded-full bg-violet-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-700">Register</a>
                    </div>
                <?php endif; ?>
            </nav>
        </header>

        <section class="mt-10 grid gap-8 lg:grid-cols-2">
            <article class="rounded-2xl bg-slate-50 p-6 shadow-sm">
                <h2 class="text-2xl font-semibold text-slate-900">Tentang Edu Share</h2>
                <p class="mt-4 text-slate-700 leading-7">Edu Share adalah platform belajar online yang dikembangkan sebagai proyek kelompok untuk mata kuliah Pemrograman Web. Platform ini dirancang untuk memudahkan siswa dan pengajar dalam berbagi materi pembelajaran, mengakses kursus, dan berkolaborasi dalam proses belajar mengajar.</p>
                <div class="mt-6 space-y-4 text-slate-700">
                    <div>
                        <h3 class="font-semibold text-slate-900">Visi</h3>
                        <p class="mt-2">Menjadi platform terdepan dalam pendidikan online yang memfasilitasi pembelajaran yang mudah, terstruktur, dan interaktif untuk semua kalangan.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900">Misi</h3>
                        <p class="mt-2">Menyediakan akses materi pembelajaran berkualitas, memfasilitasi kolaborasi antara siswa dan pengajar, serta mengembangkan fitur-fitur inovatif untuk meningkatkan pengalaman belajar.</p>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl bg-slate-50 p-6 shadow-sm">
                <h2 class="text-2xl font-semibold text-slate-900">Anggota Kelompok</h2>
                <div class="mt-4 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-violet-500 flex items-center justify-center text-white font-bold">A</div>
                        <div>
                            <h3 class="font-semibold text-slate-900">Anggota 1</h3>
                            <p class="text-slate-600">NIM: 12345678 - Backend Developer</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-violet-500 flex items-center justify-center text-white font-bold">B</div>
                        <div>
                            <h3 class="font-semibold text-slate-900">Anggota 2</h3>
                            <p class="text-slate-600">NIM: 12345679 - Frontend Developer</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-violet-500 flex items-center justify-center text-white font-bold">C</div>
                        <div>
                            <h3 class="font-semibold text-slate-900">Anggota 3</h3>
                            <p class="text-slate-600">NIM: 12345680 - UI/UX Designer</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-full bg-violet-500 flex items-center justify-center text-white font-bold">D</div>
                        <div>
                            <h3 class="font-semibold text-slate-900">Anggota 4</h3>
                            <p class="text-slate-600">NIM: 12345681 - Database Administrator</p>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <section class="mt-8 rounded-2xl bg-slate-900 p-6 text-white">
            <h2 class="text-2xl font-semibold">Teknologi yang Digunakan</h2>
            <p class="mt-4 leading-7 text-slate-200">Proyek ini dikembangkan menggunakan teknologi modern untuk memastikan performa dan keamanan yang optimal.</p>
            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                <div class="rounded-2xl bg-slate-800 p-4">
                    <h3 class="font-semibold">Backend</h3>
                    <p class="mt-2 text-slate-300">PHP dengan PDO untuk koneksi database MySQL</p>
                </div>
                <div class="rounded-2xl bg-slate-800 p-4">
                    <h3 class="font-semibold">Frontend</h3>
                    <p class="mt-2 text-slate-300">HTML, CSS dengan Tailwind CSS, dan JavaScript</p>
                </div>
                <div class="rounded-2xl bg-slate-800 p-4">
                    <h3 class="font-semibold">Database</h3>
                    <p class="mt-2 text-slate-300">MySQL untuk penyimpanan data</p>
                </div>
            </div>
        </section>
    </div>

    <div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white p-6 w-80 rounded-lg shadow-lg">
            <button id="close-menu" class="mb-4 text-2xl text-slate-600 float-right">×</button>
            <nav class="flex flex-col gap-4 text-sm font-medium text-slate-600">
                <a href="/dashboard" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200 text-center">Home</a>
                <a href="/about" class="rounded-full px-4 py-2 bg-violet-600 text-white transition hover:bg-violet-700 text-center">About</a>
                <a href="/login" class="rounded-full bg-violet-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-700 text-center">Login</a>
                <a href="/register" class="rounded-full bg-violet-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-700 text-center">Register</a>
            </nav>
        </div>
    </div>
</div>

<script>
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobile-menu');
const closeMenu = document.getElementById('close-menu');

hamburger.addEventListener('click', () => {
    mobileMenu.classList.remove('hidden');
});

closeMenu.addEventListener('click', () => {
    mobileMenu.classList.add('hidden');
});

mobileMenu.addEventListener('click', (e) => {
    if (e.target === mobileMenu) {
        mobileMenu.classList.add('hidden');
    }
});
</script>
