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

<style>
    .fade-up {
        opacity: 0;
        animation: fadeUp 0.85s ease-out forwards;
    }
    .fade-up.delay-1 { animation-delay: 0.1s; }
    .fade-up.delay-2 { animation-delay: 0.2s; }
    .fade-up.delay-3 { animation-delay: 0.3s; }
    .fade-up.delay-4 { animation-delay: 0.4s; }
    .fade-up.delay-5 { animation-delay: 0.5s; }
    .fade-up.delay-6 { animation-delay: 0.65s; }
    .pop-in {
        opacity: 0;
        transform: scale(0.98);
        animation: popIn 0.7s ease-out forwards;
    }
    .pop-in.delay-1 { animation-delay: 0.15s; }
    .pop-in.delay-2 { animation-delay: 0.25s; }
    .pop-in.delay-3 { animation-delay: 0.35s; }
    .pop-in.delay-4 { animation-delay: 0.45s; }
    .pop-in.delay-5 { animation-delay: 0.55s; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes popIn {
        from { opacity: 0; transform: scale(0.96); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<div class="min-h-screen bg-slate-100">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="fade-up delay-1 flex flex-col gap-6 rounded-[2rem] bg-white px-6 py-6 shadow-2xl shadow-slate-200/20 lg:flex-row lg:items-center lg:justify-between lg:px-10 lg:py-8">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-violet-500 text-xl font-bold text-white">E</div>
                <div>
                            <div class="mb-2 flex items-center">
                            <span class="h-3 w-3 rounded-full <?= $dbStatus ? 'bg-emerald-500' : 'bg-rose-500' ?>" title="<?= htmlspecialchars($dbStatus ? 'Database connected' : 'Database disconnected', ENT_QUOTES, 'UTF-8') ?>"></span>
                        </div>
                        <p class="fade-up delay-2 text-sm font-semibold uppercase tracking-[0.3em] text-violet-600">Edu Share</p>
                        <p class="fade-up delay-3 text-xs text-slate-500">Learn easier and more structured</p>
                </div>
            </div>

            <div class="md:hidden">
                <button id="hamburger" class="text-slate-600 text-2xl">☰</button>
            </div>

            <nav id="nav" class="hidden md:flex flex-wrap items-center gap-3 text-sm font-medium text-slate-600">
                <a href="/dashboard" class="fade-up delay-2 rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">Home</a>
                <a href="/home/courses" class="fade-up delay-3 rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">Courses</a>
                <a href="/about" class="fade-up delay-4 rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">About</a>
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

        <section class="mt-10 grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
            <div class="space-y-6">
                <span class="fade-up delay-3 inline-flex rounded-full bg-violet-100 px-4 py-2 text-sm font-semibold text-violet-700">Start learning with Edu Share</span>
                <h1 class="fade-up delay-4 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Online Learning Platform for Students & Educators</h1>
                <p class="fade-up delay-5 max-w-2xl text-lg leading-8 text-slate-600"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>

                <div class="fade-up delay-5 flex flex-col gap-4 sm:flex-row">
                    <a href="#courses" class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-violet-500/20 transition hover:bg-violet-700">View Courses</a>
                    <a href="/about" class="inline-flex items-center justify-center rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">About Us</a>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6">
                    <form class="flex flex-col gap-4 sm:flex-row">
                        <input type="text" placeholder="Search materials, topics" class="w-full rounded-full border border-slate-200 bg-white px-5 py-4 text-slate-900 outline-none focus:border-violet-500 focus:ring-2 focus:ring-violet-200" />
                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-violet-600 px-6 py-4 text-sm font-semibold text-white transition hover:bg-violet-700">Search</button>
                    </form>
                </div>
            </div>

            <div class="fade-up delay-4 relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-violet-500 via-fuchsia-500 to-purple-500 p-8 text-white shadow-2xl shadow-violet-500/20">
                <div class="absolute -right-16 top-8 h-48 w-48 rounded-full bg-white/10 blur-3xl"></div>
                <div class="absolute -left-16 bottom-8 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative z-10">
                    <p class="text-sm uppercase tracking-[0.3em] text-white/80">Featured</p>
                    <h2 class="mt-6 text-3xl font-semibold">Most Popular Courses This Month</h2>
                    <p class="mt-4 text-slate-100 leading-7">Add to your learning journey with courses tailored for students and teachers.</p>
                    <div class="mt-8 grid gap-4">
                        <div class="fade-up delay-5 rounded-[2rem] bg-white/10 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-violet-100">Linux</p>
                            <p class="mt-3 text-lg font-semibold">Linux Basics</p>
                        </div>
                        <div class="fade-up delay-5 rounded-[2rem] bg-white/10 p-5">
                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-violet-100">SQL</p>
                            <p class="mt-3 text-lg font-semibold">Database for Beginners</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-12 grid gap-6 md:grid-cols-3">
            <div class="fade-up delay-4 rounded-[2rem] bg-white p-6 shadow-2xl shadow-slate-200/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Marketplace</p>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Akses materi lengkap</h3>
                <p class="mt-3 text-slate-600">Get study materials, modules, and reference resources for every lesson.</p>
            </div>
            <div class="fade-up delay-5 rounded-[2rem] bg-white p-6 shadow-2xl shadow-slate-200/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Learning Path</p>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Clear learning path</h3>
                <p class="mt-3 text-slate-600">Plan your learning from beginner to expert easily.</p>
            </div>
            <div class="fade-up delay-6 rounded-[2rem] bg-white p-6 shadow-2xl shadow-slate-200/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Support</p>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Full support</h3>
                <p class="mt-3 text-slate-600">Instructors and mentors are ready to support every step of your learning.</p>
            </div>
        </section>



        <section class="mt-12 grid gap-6 lg:grid-cols-3">
            <div class="rounded-[2rem] bg-violet-500 p-6 text-white shadow-2xl shadow-violet-500/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-100">Trusted</p>
                <h3 class="mt-4 text-xl font-semibold">120+ Materials</h3>
                <p class="mt-3 text-slate-100">Quality materials for various learning levels.</p>
            </div>
            <div class="rounded-[2rem] bg-violet-500 p-6 text-white shadow-2xl shadow-violet-500/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-100">Satisfaction</p>
                <h3 class="mt-4 text-xl font-semibold">95% Satisfaction</h3>
                <p class="mt-3 text-slate-100">Responsive learning support that is easy to follow.</p>
            </div>
            <div class="rounded-[2rem] bg-violet-500 p-6 text-white shadow-2xl shadow-violet-500/20">
                <p class="text-sm uppercase tracking-[0.3em] text-violet-100">Community</p>
                <h3 class="mt-4 text-xl font-semibold">Active Community</h3>
                <p class="mt-3 text-slate-100">Learn together with peers and mentors on one platform.</p>
            </div>
        </section>
    </div>

    <div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white p-6 w-80 rounded-lg shadow-lg">
            <button id="close-menu" class="mb-4 text-2xl text-slate-600 float-right">×</button>
            <nav class="flex flex-col gap-4 text-sm font-medium text-slate-600">
                <a href="/dashboard" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200 text-center">Home</a>
                <a href="/about" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200 text-center">About</a>
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
