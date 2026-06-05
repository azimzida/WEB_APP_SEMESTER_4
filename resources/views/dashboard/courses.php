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

$categoryMap = [];
if (isset($categories) && $categories) {
    foreach ($categories as $cat) {
        $categoryMap[$cat->kategori_id ?? ''] = $cat->nama_kategori ?? $cat->name ?? $cat->nama ?? 'Category';
    }
}

$courseMap = [];
if (isset($courses) && $courses) {
    foreach ($courses as $course) {
        $courseMap[$course->id ?? ''] = $course->nama_course ?? $course->title ?? 'Course';
    }
}
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

            <div class="fade-up delay-2 flex flex-col gap-4 mb-8 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap gap-3">
                    <button class="px-4 py-2 rounded-full bg-orange-400 text-white font-semibold text-sm transition hover:bg-orange-500">All</button>
                    <?php if (isset($categories) && $categories): ?>
                        <?php foreach ($categories as $cat): ?>
                            <button class="px-4 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold text-sm transition hover:bg-slate-300">
                                <?= htmlspecialchars($cat->nama_kategori ?? $cat->name ?? $cat->nama ?? 'Category', ENT_QUOTES, 'UTF-8') ?>
                            </button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2">
                        <button id="openAddCategory" type="button" class="rounded-full bg-indigo-600 px-4 py-2 text-sm text-white">Add Category</button>
                        <button id="openAddCourse" type="button" class="rounded-full bg-emerald-600 px-4 py-2 text-sm text-white">Add Course</button>
                    </div>

                    <button id="uploadMaterialButton" type="button" class="inline-flex items-center gap-2 rounded-full bg-yellow-400 px-4 py-2 text-sm font-semibold text-white transition hover:bg-yellow-500">
                        Upload Material
                    </button>

                    <div class="flex w-full max-w-md items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-2 shadow-sm sm:w-auto ml-3">
                        <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 104 4 4 4 0 00-4-4zm-6 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.817-4.817A6 6 0 012 12z" clip-rule="evenodd" />
                        </svg>
                        <label for="courseSearch" class="sr-only">Search courses</label>
                        <input id="courseSearch" type="search" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400" placeholder="Search materi..." />
                    </div>
                </div>
            </div>

            <!-- Uploaded Materials -->
            <div class="fade-up delay-3 mb-10">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-violet-600">Latest Materials</p>
                        <h2 class="mt-2 text-2xl font-bold text-slate-900">Uploaded Materials</h2>
                    </div>
                    <div id="materialsCount" class="text-sm text-slate-500">
                        <?= isset($materials) && count($materials) > 0 ? count($materials) . ' materials found' : 'No materials uploaded yet' ?>
                    </div>
                </div>

                <?php if (isset($materials) && $materials && count($materials) > 0): ?>
                    <div id="materialsGrid" class="mt-6 grid gap-6 lg:grid-cols-2">
                        <?php foreach ($materials as $material): ?>
                            <article class="material-card rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <span class="material-meta text-xs uppercase tracking-[0.3em] text-slate-500">
                                        <?= htmlspecialchars($categoryMap[$material->kategori_id ?? ''] ?? 'Uncategorized', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                    <span class="text-xs text-slate-400"><?= htmlspecialchars($material->tanggal_upload ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                                </div>

                                <h3 class="material-title mt-4 text-xl font-semibold text-slate-900">
                                    <?= htmlspecialchars($material->judul ?? 'Untitled Material', ENT_QUOTES, 'UTF-8') ?>
                                </h3>

                                <p class="material-description mt-3 text-sm text-slate-600"><?= nl2br(htmlspecialchars($material->deskripsi ?? '', ENT_QUOTES, 'UTF-8')) ?></p>

                                <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                    <a href="<?= htmlspecialchars(asset('storage/' . ($material->file_materi ?? '')), ENT_QUOTES, 'UTF-8') ?>" target="_blank" class="rounded-full bg-violet-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-700">
                                        Open PDF
                                    </a>
                                    <span class="material-course text-xs text-slate-400">
                                        <?= htmlspecialchars(!empty($material->course_id) ? ('Course: ' . ($courseMap[$material->course_id] ?? $material->course_id)) : 'No course', ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="mt-6 rounded-[2rem] border border-dashed border-slate-300 bg-slate-50 p-12 text-center">
                        <p class="text-sm text-slate-500">Belum ada materi yang diupload. Upload materi untuk melihat daftar di sini.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div id="uploadModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4">
                <div class="w-full max-w-2xl overflow-hidden rounded-[2rem] bg-white shadow-2xl">
                    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Upload Material</h2>
                            <p class="mt-1 text-sm text-slate-500">Masukkan informasi dan upload file materi.</p>
                        </div>
                        <button id="closeUploadModal" type="button" class="rounded-full bg-slate-100 px-3 py-2 text-slate-600 transition hover:bg-slate-200">✕</button>
                    </div>

                    <form action="/materials/upload" class="space-y-5 px-6 py-6" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="grid gap-4 sm:grid-cols-3">
                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Category</span>
                                <select name="category" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none">
                                    <option value="">Select category...</option>
                                    <?php if (isset($categories) && $categories): foreach ($categories as $cat): ?>
                                        <option value="<?= htmlspecialchars($cat->kategori_id ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                            <?= htmlspecialchars($cat->nama_kategori ?? $cat->name ?? $cat->nama ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </label>

                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Course</span>
                                <select name="course" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none">
                                    <option value="">Select course...</option>
                                    <?php if (isset($courses) && $courses): foreach ($courses as $course): ?>
                                        <option value="<?= htmlspecialchars($course->id ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                            <?= htmlspecialchars($course->nama_course ?? $course->title ?? 'Course', ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </label>

                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Title</span>
                                <input name="title" type="text" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" placeholder="Enter the title of the material..." required />
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
                            <input name="material_file" type="file" accept=".pdf" class="mx-auto mt-4 block w-full max-w-xs cursor-pointer text-sm text-slate-700" required />
                            <p class="mt-2 text-xs text-slate-400">File max. 500 MB</p>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                            <button id="cancelUpload" type="button" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Cancel</button>
                            <button type="submit" class="rounded-full bg-yellow-400 px-5 py-3 text-sm font-semibold text-white transition hover:bg-yellow-500">Upload Material</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="addCategoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
                <div class="bg-white rounded-xl max-w-md w-full p-6">
                    <h3 class="text-lg font-semibold mb-4">Add Category</h3>
                    <form action="/kategori/create" method="post" class="space-y-4">
                        <?= csrf_field() ?>
                        <input name="name" type="text" placeholder="Category name" class="w-full rounded px-3 py-2 border" required />
                        <div class="flex justify-end gap-2">
                            <button type="button" id="closeAddCategory" class="px-4 py-2 border rounded">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="addCourseModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-4">
                <div class="bg-white rounded-xl max-w-2xl w-full p-6">
                    <h3 class="text-lg font-semibold mb-4">Add Course</h3>
                    <form action="/course/create" method="post" class="grid grid-cols-1 gap-4">
                        <?= csrf_field() ?>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Category</span>
                                <select name="category" class="w-full rounded border px-3 py-2" required>
                                    <option value="">Select category...</option>
                                    <?php if (isset($categories) && $categories): foreach ($categories as $cat): ?>
                                        <option value="<?= htmlspecialchars($cat->kategori_id ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                            <?= htmlspecialchars($cat->nama_kategori ?? $cat->name ?? $cat->nama ?? '', ENT_QUOTES, 'UTF-8') ?>
                                        </option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </label>

                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Title</span>
                                <input name="title" type="text" placeholder="Course title" class="w-full rounded border px-3 py-2" required />
                            </label>
                        </div>

                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Description</span>
                            <textarea name="description" rows="4" class="w-full rounded border px-3 py-2" placeholder="Description"></textarea>
                        </label>

                        <div class="flex justify-end gap-2">
                            <button type="button" id="closeAddCourse" class="px-4 py-2 border rounded">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded">Save Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    (function () {
        var uploadButton = document.getElementById('uploadMaterialButton');
        var uploadModal = document.getElementById('uploadModal');
        var closeUploadModal = document.getElementById('closeUploadModal');
        var cancelUpload = document.getElementById('cancelUpload');

        var openAddCategory = document.getElementById('openAddCategory');
        var addCategoryModal = document.getElementById('addCategoryModal');
        var closeAddCategory = document.getElementById('closeAddCategory');

        var openAddCourse = document.getElementById('openAddCourse');
        var addCourseModal = document.getElementById('addCourseModal');
        var closeAddCourse = document.getElementById('closeAddCourse');

        function open(el) {
            if (!el) return;
            el.classList.remove('hidden');
            el.classList.add('flex');
        }

        function close(el) {
            if (!el) return;
            el.classList.add('hidden');
            el.classList.remove('flex');
        }

        uploadButton?.addEventListener('click', function () { open(uploadModal); });
        closeUploadModal?.addEventListener('click', function () { close(uploadModal); });
        cancelUpload?.addEventListener('click', function () { close(uploadModal); });
        uploadModal?.addEventListener('click', function (e) { if (e.target === uploadModal) close(uploadModal); });

        openAddCategory?.addEventListener('click', function () { open(addCategoryModal); });
        closeAddCategory?.addEventListener('click', function () { close(addCategoryModal); });
        addCategoryModal?.addEventListener('click', function (e) { if (e.target === addCategoryModal) close(addCategoryModal); });

        openAddCourse?.addEventListener('click', function () { open(addCourseModal); });
        closeAddCourse?.addEventListener('click', function () { close(addCourseModal); });
        addCourseModal?.addEventListener('click', function (e) { if (e.target === addCourseModal) close(addCourseModal); });
    })();
</script>

<script>
(function () {
    var searchInput = document.getElementById('courseSearch');
    var materialCards = Array.from(document.querySelectorAll('.material-card'));
    var materialsCount = document.getElementById('materialsCount');

    function updateMaterialsCount(count) {
        if (!materialsCount) return;
        if (count === 0) {
            materialsCount.textContent = 'No materials match your search';
        } else if (count === 1) {
            materialsCount.textContent = '1 material found';
        } else {
            materialsCount.textContent = count + ' materials found';
        }
    }

    function filterMaterials() {
        var term = searchInput.value.trim().toLowerCase();
        var visibleCount = 0;

        materialCards.forEach(function(card) {
            var title = card.querySelector('.material-title')?.textContent.toLowerCase() || '';
            var description = card.querySelector('.material-description')?.textContent.toLowerCase() || '';
            var category = card.querySelector('.material-meta')?.textContent.toLowerCase() || '';
            var course = card.querySelector('.material-course')?.textContent.toLowerCase() || '';
            var visible = !term || title.includes(term) || description.includes(term) || category.includes(term) || course.includes(term);

            card.style.display = visible ? '' : 'none';
            if (visible) visibleCount++;
        });

        updateMaterialsCount(visibleCount);
    }

    searchInput?.addEventListener('input', filterMaterials);
})();
</script>