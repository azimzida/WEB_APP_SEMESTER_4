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
                <a href="/home/courses" class="fade-up delay-3 rounded-full px-4 py-2 bg-violet-600 text-white transition hover:bg-violet-700">Courses</a>
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

        <section class="mt-10">
            <div class="fade-up delay-1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-violet-600">All Courses</p>
                    <h1 class="mt-3 text-3xl font-extrabold text-slate-900">Share Learning Materials More Easily</h1>
                    <p class="mt-2 text-slate-600">The best place to share and find college study materials.</p>
                </div>
            </div>

            <!-- Category Filter + Search + Upload -->
            <div class="fade-up delay-2 flex flex-col gap-4 mb-8 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap gap-3">
                    <button class="px-4 py-2 rounded-full bg-orange-400 text-white font-semibold text-sm transition hover:bg-orange-500">All</button>
                    <button class="px-4 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold text-sm transition hover:bg-slate-300">Data Base</button>
                    <button class="px-4 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold text-sm transition hover:bg-slate-300">Programming</button>
                    <button class="px-4 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold text-sm transition hover:bg-slate-300">UI/UX Design</button>
                </div>
                <div class="flex w-full max-w-2xl items-center gap-3 sm:w-auto">
                    <button id="uploadMaterialButton" type="button" class="inline-flex items-center gap-2 rounded-full bg-yellow-400 px-4 py-2 text-sm font-semibold text-white transition hover:bg-yellow-500">
                        Upload Material
                    </button>
                    <div class="flex w-full max-w-md items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-2 shadow-sm sm:w-auto">
                        <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 104 4 4 4 0 00-4-4zm-6 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.817-4.817A6 6 0 012 12z" clip-rule="evenodd" />
                        </svg>
                        <label for="courseSearch" class="sr-only">Search courses</label>
                        <input id="courseSearch" type="search" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400" placeholder="Search materi..." />
                    </div>
                </div>
            </div>

            <!-- Course Cards Grid -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <!-- SQL Basics Card -->
                <div class="pop-in delay-1 rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                    <div class="h-32 bg-gradient-to-br from-cyan-400 to-cyan-600 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-pattern"></div>
                        <span class="text-5xl text-cyan-900 relative z-10">💾</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-block px-3 py-1 bg-cyan-100 text-cyan-700 text-xs font-semibold rounded-full">Data Base</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">SQL Basics</h3>
                        <p class="mt-2 text-sm text-slate-600">Learn SQL fundamentals and database management</p>
                        <div class="mt-4 flex items-center gap-2">
                            <a href="#" class="flex-1 py-2 rounded-lg bg-orange-400 text-white font-semibold text-center text-sm transition hover:bg-orange-500">Detail</a>
                            <button class="px-3 py-2 rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200">⬇</button>
                        </div>
                    </div>
                </div>

                <!-- UI Design Card -->
                <div class="pop-in delay-2 rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                    <div class="h-32 bg-gradient-to-br from-purple-400 to-purple-600 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-pattern"></div>
                        <span class="text-5xl text-purple-900 relative z-10">🎨</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">UI/UX Design</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Basic UI Design</h3>
                        <p class="mt-2 text-sm text-slate-600">Master the principles of user interface design</p>
                        <div class="mt-4 flex items-center gap-2">
                            <a href="#" class="flex-1 py-2 rounded-lg bg-orange-400 text-white font-semibold text-center text-sm transition hover:bg-orange-500">Detail</a>
                            <button class="px-3 py-2 rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200">⬇</button>
                        </div>
                    </div>
                </div>

                <!-- HTML & CSS Card -->
                <div class="pop-in delay-3 rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                    <div class="h-32 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-pattern"></div>
                        <span class="text-5xl text-blue-900 relative z-10">💻</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Programming</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Basic HTML & CSS</h3>
                        <p class="mt-2 text-sm text-slate-600">Build responsive web pages from scratch</p>
                        <div class="mt-4 flex items-center gap-2">
                            <a href="#" class="flex-1 py-2 rounded-lg bg-orange-400 text-white font-semibold text-center text-sm transition hover:bg-orange-500">Detail</a>
                            <button class="px-3 py-2 rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200">⬇</button>
                        </div>
                    </div>
                </div>

                <!-- CRUD Guide Card -->
                <div class="pop-in delay-4 rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                    <div class="h-32 bg-gradient-to-br from-rose-400 to-rose-600 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-pattern"></div>
                        <span class="text-5xl text-rose-900 relative z-10">📝</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-block px-3 py-1 bg-rose-100 text-rose-700 text-xs font-semibold rounded-full">Programming</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">CRUD Guide</h3>
                        <p class="mt-2 text-sm text-slate-600">Complete guide to Create, Read, Update, Delete operations</p>
                        <div class="mt-4 flex items-center gap-2">
                            <a href="#" class="flex-1 py-2 rounded-lg bg-orange-400 text-white font-semibold text-center text-sm transition hover:bg-orange-500">Detail</a>
                            <button class="px-3 py-2 rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200">⬇</button>
                        </div>
                    </div>
                </div>

                <!-- Relational Database Card -->
                <div class="pop-in delay-5 rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                    <div class="h-32 bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-pattern"></div>
                        <span class="text-5xl text-amber-900 relative z-10">🗄️</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-block px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">Data Base</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Relational Database</h3>
                        <p class="mt-2 text-sm text-slate-600">Understanding relationships and constraints in databases</p>
                        <div class="mt-4 flex items-center gap-2">
                            <a href="#" class="flex-1 py-2 rounded-lg bg-orange-400 text-white font-semibold text-center text-sm transition hover:bg-orange-500">Detail</a>
                            <button class="px-3 py-2 rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200">⬇</button>
                        </div>
                    </div>
                </div>

                <!-- JavaScript Basics Card -->
                <div class="pop-in delay-6 rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                    <div class="h-32 bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10 bg-pattern"></div>
                        <span class="text-5xl text-teal-900 relative z-10">⚡</span>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-teal-100 text-teal-700 text-xs font-semibold rounded-full">Programming <span class="text-xs bg-orange-400 text-white px-2 py-0.5 rounded-full">NEW</span></span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">JavaScript Basics</h3>
                        <p class="mt-2 text-sm text-slate-600">Learn JavaScript fundamentals and DOM manipulation</p>
                        <div class="mt-4 flex items-center gap-2">
                            <a href="#" class="flex-1 py-2 rounded-lg bg-orange-400 text-white font-semibold text-center text-sm transition hover:bg-orange-500">Detail</a>
                            <button class="px-3 py-2 rounded-lg bg-slate-100 text-slate-600 transition hover:bg-slate-200">⬇</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Modal -->
            <div id="uploadModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4">
                <div class="w-full max-w-2xl overflow-hidden rounded-[2rem] bg-white shadow-2xl">
                    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Upload Material</h2>
                            <p class="mt-1 text-sm text-slate-500">Masukkan informasi dan upload file materi.</p>
                        </div>
                        <button id="closeUploadModal" type="button" class="rounded-full bg-slate-100 px-3 py-2 text-slate-600 transition hover:bg-slate-200">✕</button>
                    </div>
                    <form class="space-y-5 px-6 py-6" method="post" enctype="multipart/form-data">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Category</span>
                                <select name="category" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none">
                                    <option value="">Select category...</option>
                                    <option>Data Base</option>
                                    <option>Programming</option>
                                    <option>UI/UX Design</option>
                                </select>
                            </label>
                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Title</span>
                                <input name="title" type="text" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" placeholder="Enter the title of the material..." />
                            </label>
                        </div>
                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Description</span>
                            <textarea name="description" rows="4" class="w-full resize-none rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" placeholder="A short description or explanation of the material to be uploaded..."></textarea>
                        </label>
                        <div class="rounded-[1.5rem] border border-dashed border-slate-300 bg-slate-50 p-6 text-center">
                            <div class="mx-auto mb-4 inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-white text-3xl text-slate-400">📄</div>
                            <p class="text-sm font-semibold text-slate-900">Upload PDF</p>
                            <p class="mt-1 text-sm text-slate-500">Drag & drop pdf files here or click to upload</p>
                            <input name="material_file" type="file" accept=".pdf" class="mx-auto mt-4 block w-full max-w-xs cursor-pointer text-sm text-slate-700" />
                            <p class="mt-2 text-xs text-slate-400">File max. 500 MB</p>
                        </div>
                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                            <button id="cancelUpload" type="button" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Cancel</button>
                            <button type="submit" class="rounded-full bg-yellow-400 px-5 py-3 text-sm font-semibold text-white transition hover:bg-yellow-500">Upload Material</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    (function () {
        var searchInput = document.getElementById('courseSearch');
        var courseCards = document.querySelectorAll('.grid > .pop-in');
        var uploadButton = document.getElementById('uploadMaterialButton');
        var uploadModal = document.getElementById('uploadModal');
        var closeUploadModal = document.getElementById('closeUploadModal');
        var cancelUpload = document.getElementById('cancelUpload');

        function filterCourses() {
            var query = searchInput.value.trim().toLowerCase();
            courseCards.forEach(function (card) {
                var text = card.textContent.toLowerCase();
                card.style.display = text.includes(query) ? '' : 'none';
            });
        }

        function openModal() {
            if (!uploadModal) return;
            uploadModal.classList.remove('hidden');
            uploadModal.classList.add('flex');
        }

        function closeModal() {
            if (!uploadModal) return;
            uploadModal.classList.add('hidden');
            uploadModal.classList.remove('flex');
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterCourses);
        }

        if (uploadButton) {
            uploadButton.addEventListener('click', openModal);
        }

        if (closeUploadModal) {
            closeUploadModal.addEventListener('click', closeModal);
        }

        if (cancelUpload) {
            cancelUpload.addEventListener('click', closeModal);
        }

        if (uploadModal) {
            uploadModal.addEventListener('click', function (event) {
                if (event.target === uploadModal) {
                    closeModal();
                }
            });
        }
    })();
</script>