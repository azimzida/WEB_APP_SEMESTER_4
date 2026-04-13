<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
$displayName = $_SESSION['user'] ?? 'Kim Jennie';
?>

<div class="min-h-screen bg-slate-100">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="mb-8 rounded-[36px] bg-white p-6 shadow-[0_24px_80px_rgba(15,23,42,0.08)] sm:flex sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-gradient-to-br from-violet-600 to-fuchsia-500 text-2xl font-bold text-white shadow-lg">E</div>
                <div>
                    <p class="text-lg font-semibold text-slate-900">Edu Share</p>
                    <p class="text-sm text-slate-500">Learning made better</p>
                </div>
            </div>
            <div class="mt-4 flex flex-col gap-4 sm:mt-0 sm:flex-row sm:items-center">
                <div class="flex items-center gap-3 rounded-full bg-slate-100 px-4 py-2 shadow-sm">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-violet-600 text-base font-semibold text-white">
                        <?= htmlspecialchars(strtoupper(substr($displayName, 0, 1)), ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8') ?></p>
                        <p class="text-xs text-slate-500">Premium Member</p>
                    </div>
                </div>
                <a href="/logout" class="inline-flex items-center justify-center rounded-full bg-violet-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-violet-700">Log Out</a>
            </div>
        </header>

        <div class="grid gap-6 xl:grid-cols-[300px_1fr]">
            <aside class="space-y-6">
                <div class="rounded-[32px] bg-white p-6 shadow-[0_20px_50px_rgba(15,23,42,0.06)]">
                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-violet-600 text-2xl font-bold text-white shadow-lg">E</div>
                        <div>
                            <p class="text-lg font-semibold text-slate-900">Edu Share</p>
                            <p class="text-sm text-slate-500">Dashboard akses penuh</p>
                        </div>
                    </div>

                    <nav class="mt-8 space-y-3 text-sm font-semibold text-slate-600">
                        <a href="#" class="flex items-center gap-3 rounded-[20px] bg-violet-50 px-4 py-3 text-slate-900 transition hover:bg-violet-100">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white text-violet-600 shadow-sm">🏠</span>
                            Home
                        </a>
                        <a href="#" class="flex items-center gap-3 rounded-[20px] px-4 py-3 transition hover:bg-slate-100">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">📚</span>
                            Courses
                        </a>
                        <a href="#" class="flex items-center gap-3 rounded-[20px] px-4 py-3 transition hover:bg-slate-100">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">⬆️</span>
                            Upload
                        </a>
                        <a href="#" class="flex items-center gap-3 rounded-[20px] px-4 py-3 transition hover:bg-slate-100">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">⬇️</span>
                            Download
                        </a>
                        <a href="#" class="flex items-center gap-3 rounded-[20px] px-4 py-3 transition hover:bg-slate-100">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-500">👤</span>
                            Profile
                        </a>
                    </nav>
                </div>

                <div class="rounded-[32px] bg-gradient-to-br from-[#eef2ff] via-[#f8f0ff] to-[#ffffff] p-6 shadow-[0_20px_50px_rgba(99,102,241,0.08)]">
                    <div class="text-center">
                        <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-white text-3xl">📘</div>
                        <p class="text-sm uppercase tracking-[0.35em] text-violet-600">Learning Boost</p>
                        <p class="mt-3 text-sm leading-6 text-slate-500">Edu Share menyatukan catatan, kursus, dan progress dalam satu tempat.</p>
                        <a href="#" class="mt-5 inline-flex w-full items-center justify-center rounded-full bg-violet-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-violet-700">Explore Now</a>
                    </div>
                </div>
            </aside>

            <main class="space-y-6">
                <section class="grid gap-6 xl:grid-cols-[1.4fr_0.95fr]">
                    <div class="rounded-[32px] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                        <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Welcome back</p>
                        <h1 class="mt-4 text-4xl font-semibold text-slate-900">Semua pelajaran, progress, dan fitur di satu dashboard.</h1>
                        <p class="mt-4 max-w-2xl text-lg leading-8 text-slate-600">Akses materi, lihat status kursus, dan unduh file penting tanpa pindah halaman.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <span class="rounded-full bg-violet-50 px-4 py-2 text-sm font-semibold text-violet-700">Premium</span>
                            <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">24/7 Access</span>
                            <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">Fast Downloads</span>
                        </div>
                    </div>

                    <div class="rounded-[32px] bg-gradient-to-br from-violet-600 via-fuchsia-500 to-slate-900 p-8 text-white shadow-[0_20px_60px_rgba(15,23,42,0.18)]">
                        <div class="relative overflow-hidden rounded-[2rem] bg-white/10 p-6">
                            <div class="absolute -right-10 top-8 h-24 w-24 rounded-full bg-white/20 blur-3xl"></div>
                            <div class="absolute -left-8 bottom-8 h-24 w-24 rounded-full bg-white/15 blur-3xl"></div>
                            <div class="relative z-10 flex h-52 flex-col items-center justify-center gap-4 rounded-[2rem] bg-white/10 p-6 text-center">
                                <div class="grid h-20 w-20 place-items-center rounded-full bg-white/20 text-3xl">📘</div>
                                <p class="text-xl font-semibold">Your learning hub</p>
                                <p class="text-sm text-white/80">Nikmati akses cepat ke konten dan laporan progress setiap saat.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="grid gap-4 lg:grid-cols-2">
                    <article class="rounded-[32px] bg-purple-50 p-6 shadow-[0_20px_50px_rgba(168,85,247,0.12)]">
                        <p class="text-sm uppercase tracking-[0.3em] text-[#9333ea]">Materials</p>
                        <p class="mt-4 text-4xl font-semibold text-[#6d28d9]">20+</p>
                        <p class="mt-2 text-sm text-slate-600">Materi siap dipelajari kapan saja.</p>
                    </article>
                    <article class="rounded-[32px] bg-blue-50 p-6 shadow-[0_20px_50px_rgba(59,130,246,0.12)]">
                        <p class="text-sm uppercase tracking-[0.3em] text-[#2563eb]">Downloads</p>
                        <p class="mt-4 text-4xl font-semibold text-[#1d4ed8]">1.5k</p>
                        <p class="mt-2 text-sm text-slate-600">File unduhan terbanyak oleh komunitas.</p>
                    </article>
                </section>

                <section class="rounded-[32px] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.3em] text-violet-600">My Courses</p>
                            <h2 class="mt-3 text-3xl font-semibold text-slate-900">Featured Courses</h2>
                        </div>
                        <a href="#" class="inline-flex items-center rounded-full bg-violet-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-violet-700">View All</a>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div class="rounded-[2rem] bg-[#fdf2f8] p-5 shadow-[0_20px_40px_rgba(168,85,247,0.08)]">
                            <p class="text-sm font-semibold uppercase text-[#881337]">Programming</p>
                            <p class="mt-4 text-sm text-slate-600">2 Materials</p>
                        </div>
                        <div class="rounded-[2rem] bg-[#eff6ff] p-5 shadow-[0_20px_40px_rgba(59,130,246,0.08)]">
                            <p class="text-sm font-semibold uppercase text-[#1d4ed8]">UI/UX Design</p>
                            <p class="mt-4 text-sm text-slate-600">4 Materials</p>
                        </div>
                        <div class="rounded-[2rem] bg-[#f5d0fe] p-5 shadow-[0_20px_40px_rgba(168,85,247,0.08)]">
                            <p class="text-sm font-semibold uppercase text-[#7c3aed]">Database</p>
                            <p class="mt-4 text-sm text-slate-600">3 Materials</p>
                        </div>
                    </div>
                </section>

                <section class="rounded-[32px] bg-white p-8 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-slate-900">Recent Materials</h2>
                            <p class="text-sm text-slate-500">Latest files shared by the community</p>
                        </div>
                        <button class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Browse</button>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="flex flex-col gap-4 rounded-[24px] border border-slate-200 bg-slate-50 p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-4">
                                <div class="h-16 w-16 rounded-[20px] bg-gradient-to-br from-[#4338ca] to-[#818cf8]"></div>
                                <div>
                                    <p class="font-semibold text-slate-900">SQL Basics</p>
                                    <p class="text-sm text-slate-500">by <?= htmlspecialchars($displayName, ENT_QUOTES, 'UTF-8') ?> • 2 hours ago</p>
                                </div>
                            </div>
                            <button class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-slate-600 shadow-sm hover:bg-slate-100 transition">⇩</button>
                        </div>
                        <div class="flex flex-col gap-4 rounded-[24px] border border-slate-200 bg-slate-50 p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-4">
                                <div class="h-16 w-16 rounded-[20px] bg-gradient-to-br from-[#a855f7] to-[#f0abfc]"></div>
                                <div>
                                    <p class="font-semibold text-slate-900">Basic HTML & CSS</p>
                                    <p class="text-sm text-slate-500">by Park Chaeyoung • 3 hours ago</p>
                                </div>
                            </div>
                            <button class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-slate-600 shadow-sm hover:bg-slate-100 transition">⇩</button>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</div>
