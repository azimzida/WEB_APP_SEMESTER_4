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
$courses = $courses ?? [];
$categories = $categories ?? [];
$materials = $materials ?? [];
$uploadMessage = $uploadMessage ?? null;
$uploadSuccess = $uploadSuccess ?? false;
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
                <a href="/home/material" class="fade-up delay-3 rounded-full px-4 py-2 bg-violet-600 text-white transition hover:bg-violet-700">Material</a>
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
            <?php if ($uploadMessage !== null): ?>
                <div class="mb-6 rounded-3xl border px-5 py-4 text-sm font-medium <?= $uploadSuccess ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : 'border-rose-200 bg-rose-50 text-rose-800' ?>">
                    <?= htmlspecialchars($uploadMessage, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <div class="fade-up delay-1 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-violet-600">All Lists</p>
                    <h1 class="mt-3 text-3xl font-extrabold text-slate-900">Share Learning Materials More Easily</h1>
                    <p class="mt-2 text-slate-600">The best place to share and find college study materials.</p>
                </div>
            </div>

            <!-- List Selector + Search + Upload -->
            <div class="fade-up delay-2 flex flex-col gap-4 mb-8 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex flex-wrap gap-3">
                    <button type="button" class="list-tab-button px-4 py-2 rounded-full bg-orange-400 text-white font-semibold text-sm transition hover:bg-orange-500" data-target="listMaterialSection">Material</button>
                </div>
                <div class="flex w-full max-w-2xl items-center gap-3 sm:w-auto flex-wrap">
                    <button id="uploadMaterialButton" type="button" class="inline-flex items-center gap-2 rounded-full bg-yellow-400 px-4 py-2 text-sm font-semibold text-white transition hover:bg-yellow-500">
                        Upload Material
                    </button>
                    <button id="addCourseButton" type="button" class="inline-flex items-center gap-2 rounded-full bg-violet-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-600">
                        + Course
                    </button>
                    <button id="addCategoryButton" type="button" class="inline-flex items-center gap-2 rounded-full bg-emerald-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-600">
                        + Category
                    </button>
                    <div class="flex w-full max-w-md items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-2 shadow-sm sm:w-auto">
                        <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 104 4 4 4 0 00-4-4zm-6 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.817-4.817A6 6 0 012 12z" clip-rule="evenodd" />
                        </svg>
                        <label for="courseSearch" class="sr-only">Search list items</label>
                        <input id="courseSearch" type="search" class="w-full bg-transparent text-sm text-slate-700 outline-none placeholder:text-slate-400" placeholder="Search daftar..." />
                    </div>
                </div>
            </div>

            <!-- Material Cards Grid -->
            <div id="listMaterialSection" class="list-section">
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php if (empty($materials)): ?>
                    <div class="col-span-full rounded-[1.75rem] border border-slate-100 bg-white p-10 text-center shadow-lg">
                        <h2 class="text-2xl font-bold text-slate-900">Belum ada materi tersedia</h2>
                        <p class="mt-3 text-slate-600">Silakan tambah materi di database terlebih dahulu, lalu muat ulang halaman ini.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($materials as $material): ?>
                        <?php
                            $materialTitle = $material['judul'] ?? 'Untitled Material';
                            $materialDescription = $material['deskripsi'] ?? '';
                            $courseTitle = $material['course_title'] ?? $material['nama_course'] ?? 'Course';
                            $categoryName = $material['kategori_name'] ?? $material['nama_kategori'] ?? 'General';
                            $uploadedAt = !empty($material['tanggal_upload']) ? date('d M Y', strtotime($material['tanggal_upload'])) : null;
                            $materialId = $material['id'] ?? $material['materi_id'] ?? $material['uuid'] ?? '';
                            $detailUrl = $materialId !== '' ? '/material/' . rawurlencode((string) $materialId) : '#';
                            $type = !empty($material['link_youtube']) ? 'video' : 'pdf';
                            $icon = $type === 'video' ? '▶️' : '📄';
                            $gradientClass = 'from-amber-400 to-amber-600';
                            $badgeBg = 'bg-amber-100';
                            $badgeText = 'text-amber-700';

                            $categoryKey = strtolower(trim($categoryName));
                            if (in_array($categoryKey, ['data base', 'database'], true)) {
                                $gradientClass = 'from-cyan-400 to-cyan-600';
                                $badgeBg = 'bg-cyan-100';
                                $badgeText = 'text-cyan-700';
                                $icon = '💾';
                            } elseif (in_array($categoryKey, ['programming', 'code', 'pemrograman'], true)) {
                                $gradientClass = 'from-blue-400 to-blue-600';
                                $badgeBg = 'bg-blue-100';
                                $badgeText = 'text-blue-700';
                                $icon = '💻';
                            } elseif (in_array($categoryKey, ['ui/ux design', 'ui/ux', 'design'], true)) {
                                $gradientClass = 'from-purple-400 to-purple-600';
                                $badgeBg = 'bg-purple-100';
                                $badgeText = 'text-purple-700';
                                $icon = '🎨';
                            }
                        ?>

                        <div class="list-item pop-in rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                            <div class="h-32 bg-gradient-to-br <?= $gradientClass ?> flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 opacity-10 bg-pattern"></div>
                                <span class="text-5xl relative z-10"><?= htmlspecialchars($icon, ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold <?= $badgeBg ?> <?= $badgeText ?>"><?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8') ?></span>
                                    <?php if ($type === 'video'): ?>
                                        <span class="inline-block rounded-full bg-red-100 px-3 py-1 text-[11px] font-semibold text-red-700">YouTube</span>
                                    <?php else: ?>
                                        <span class="inline-block rounded-full bg-slate-100 px-3 py-1 text-[11px] font-semibold text-slate-700">PDF</span>
                                    <?php endif; ?>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900"><?= htmlspecialchars($materialTitle, ENT_QUOTES, 'UTF-8') ?></h3>
                                <p class="mt-2 text-sm text-slate-600"><?= htmlspecialchars($materialDescription ?: 'Deskripsi belum tersedia.', ENT_QUOTES, 'UTF-8') ?></p>
                                <div class="mt-4 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                    <span class="text-sm font-medium text-slate-500"><?= htmlspecialchars($courseTitle, ENT_QUOTES, 'UTF-8') ?></span>
                                    <div class="flex flex-wrap gap-2">
                                        <?php if ($type === 'pdf' && $materialId !== ''): ?>
                                            <a href="/home/previewMaterial/<?= rawurlencode((string) $materialId) ?>" target="_blank" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Preview PDF</a>
                                        <?php endif; ?>
                                        <a href="<?= htmlspecialchars($detailUrl, ENT_QUOTES, 'UTF-8') ?>" class="bg-yellow-400 hover:bg-yellow-500 text-white px-6 py-2 rounded-full text-sm font-semibold transition inline-block">Detail</a>
                                    </div>
                                </div>
                                <?php if ($uploadedAt): ?>
                                    <p class="mt-3 text-xs text-slate-400">Uploaded on <?= htmlspecialchars($uploadedAt, ENT_QUOTES, 'UTF-8') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div id="listCourseSection" class="list-section hidden">
                <?php if (empty($courses)): ?>
                    <div class="col-span-full rounded-[1.75rem] border border-slate-100 bg-white p-10 text-center shadow-lg">
                        <h2 class="text-2xl font-bold text-slate-900">Belum ada course tersedia</h2>
                        <p class="mt-3 text-slate-600">Tambahkan course baru dengan tombol + Course.</p>
                    </div>
                <?php else: ?>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($courses as $course): ?>
                            <?php
                                $courseTitle = $course['nama_course'] ?? 'Untitled Course';
                                $courseDescription = $course['deskripsi'] ?? 'Deskripsi belum tersedia.';
                            ?>
                            <div class="list-item pop-in rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                                <div class="h-32 bg-slate-100 flex items-center justify-center">
                                    <span class="text-4xl text-violet-500">📚</span>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-slate-900"><?= htmlspecialchars($courseTitle, ENT_QUOTES, 'UTF-8') ?></h3>
                                    <p class="mt-3 text-sm text-slate-600"><?= htmlspecialchars($courseDescription, ENT_QUOTES, 'UTF-8') ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div id="listCategorySection" class="list-section hidden">
                <?php if (empty($categories)): ?>
                    <div class="col-span-full rounded-[1.75rem] border border-slate-100 bg-white p-10 text-center shadow-lg">
                        <h2 class="text-2xl font-bold text-slate-900">Belum ada kategori tersedia</h2>
                        <p class="mt-3 text-slate-600">Tambahkan kategori baru dengan tombol + Category.</p>
                    </div>
                <?php else: ?>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($categories as $category): ?>
                            <?php
                                $categoryName = $category['nama_kategori'] ?? 'Kategori';
                                $categorySlug = $category['slug'] ?? '';
                            ?>
                            <div class="list-item pop-in rounded-[1.75rem] overflow-hidden shadow-lg hover:shadow-2xl transition group bg-white border border-slate-100">
                                <div class="h-32 bg-slate-100 flex items-center justify-center">
                                    <span class="text-4xl text-emerald-500">🏷️</span>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-slate-900"><?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8') ?></h3>
                                    <p class="mt-3 text-sm text-slate-600"><?= htmlspecialchars($categorySlug, ENT_QUOTES, 'UTF-8') ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Upload Modal -->
            <div id="uploadModal" tabindex="-1" class="fixed inset-0 z-50 hidden items-start sm:items-center justify-center overflow-y-auto bg-slate-900/60 p-4">
                <div class="w-full max-w-2xl max-h-[calc(100vh-4rem)] overflow-y-auto rounded-[2rem] bg-white shadow-2xl">
                    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Upload Material</h2>
                            <p class="mt-1 text-sm text-slate-500">Masukkan informasi dan upload file materi.</p>
                        </div>
                        <button id="closeUploadModal" type="button" aria-label="Close upload modal" class="rounded-full bg-slate-100 px-3 py-2 text-slate-600 transition hover:bg-slate-200 focus:outline-none">✕</button>
                    </div>
                    <form action="/home/storeMaterial" class="space-y-5 px-6 py-6" method="post" enctype="multipart/form-data">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Course</span>
                                <select name="course_id" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none">
                                    <option value="">Pilih course...</option>
                                    <?php if (!empty($courses)): ?>
                                        <?php foreach ($courses as $c): ?>
                                            <?php $courseIdValue = $c['id'] ?? $c['course_id'] ?? ''; ?>
                                            <option value="<?= htmlspecialchars($courseIdValue, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($c['nama_course'] ?? 'Untitled Course', ENT_QUOTES, 'UTF-8') ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="" disabled>Tidak ada course tersedia</option>
                                    <?php endif; ?>
                                </select>
                            </label>
                            <label class="space-y-2">
                                <span class="text-sm font-semibold text-slate-700">Category</span>
                                <select name="kategori_id" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none">
                                    <option value="">Pilih kategori...</option>
                                    <?php foreach ($categories as $categoryOption): ?>
                                        <option value="<?= htmlspecialchars($categoryOption['kategori_id'] ?? '', ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($categoryOption['nama_kategori'] ?? $categoryOption['slug'] ?? 'Kategori', ENT_QUOTES, 'UTF-8') ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                        </div>

                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Judul Materi</span>
                            <input name="title" type="text" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" placeholder="Masukkan judul materi..." />
                        </label>

                        <div class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Tipe Konten</span>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="upload_type" value="pdf" checked class="w-4 h-4 text-violet-600">
                                    <span class="text-sm text-slate-600">File PDF</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="upload_type" value="video" class="w-4 h-4 text-violet-600">
                                    <span class="text-sm text-slate-600">YouTube Link</span>
                                </label>
                            </div>
                        </div>

                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Description</span>
                            <textarea name="description" rows="4" class="w-full resize-none rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" placeholder="A short description..."></textarea>
                        </label>

                        <div id="pdf-container" class="rounded-[1.5rem] border border-dashed border-slate-300 bg-slate-50 p-6 text-center">
                            <div class="mx-auto mb-4 inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-white text-3xl text-slate-400">📄</div>
                            <p class="text-sm font-semibold text-slate-900">Upload PDF</p>
                            <input name="file_materi" type="file" accept=".pdf" class="mx-auto mt-4 block w-full max-w-xs cursor-pointer text-sm text-slate-700" />
                        </div>

                        <div id="video-container" class="hidden rounded-[1.5rem] border border-dashed border-violet-300 bg-violet-50 p-6 text-center">
                            <div class="mx-auto mb-4 inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-white text-3xl text-red-500">▶️</div>
                            <p class="text-sm font-semibold text-slate-900">YouTube Link</p>
                            <input name="link_youtube" type="url" placeholder="https://www.youtube.com/watch?v=..." class="w-full mt-4 rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" />
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                            <button id="cancelUpload" type="button" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Cancel</button>
                            <button type="submit" class="rounded-full bg-yellow-400 px-5 py-3 text-sm font-semibold text-white transition hover:bg-yellow-500">Upload Material</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Course Modal -->
            <div id="courseModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4">
                <div class="w-full max-w-lg rounded-[2rem] bg-white shadow-2xl">
                    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Tambah Course</h2>
                            <p class="mt-1 text-sm text-slate-500">Buat course baru untuk materi pembelajaran.</p>
                        </div>
                        <button id="closeCourseModal" type="button" class="ml-4 flex-shrink-0 inline-flex items-center justify-center h-10 w-10 rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200 focus:outline-none" aria-label="Close modal">✕</button>
                    </div>
                    <form action="/home/storeCourse" class="space-y-4 px-6 py-6" method="post">
                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Nama Course</span>
                            <input name="course_name" type="text" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" placeholder="Masukkan nama course..." required />
                        </label>

                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Deskripsi (Opsional)</span>
                            <textarea name="course_description" rows="3" class="w-full resize-none rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" placeholder="Deskripsi singkat tentang course..."></textarea>
                        </label>

                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                            <button id="cancelCourse" type="button" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Batal</button>
                            <button type="submit" class="rounded-full bg-violet-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-violet-600">Tambah Course</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Category Modal -->
            <div id="categoryModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 p-4">
                <div class="w-full max-w-lg rounded-[2rem] bg-white shadow-2xl">
                    <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Tambah Kategori</h2>
                            <p class="mt-1 text-sm text-slate-500">Buat kategori baru untuk mengorganisir materi.</p>
                        </div>
                        <button id="closeCategoryModal" type="button" class="ml-4 flex-shrink-0 inline-flex items-center justify-center h-10 w-10 rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200 focus:outline-none" aria-label="Close modal">✕</button>
                    </div>
                    <form action="/home/storeCategory" class="space-y-4 px-6 py-6" method="post">
                        <label class="space-y-2">
                            <span class="text-sm font-semibold text-slate-700">Nama Kategori</span>
                            <input name="category_name" type="text" class="w-full rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none" placeholder="Masukkan nama kategori..." required />
                        </label>

                        <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                            <button id="cancelCategory" type="button" class="rounded-full border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Batal</button>
                            <button type="submit" class="rounded-full bg-emerald-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-600">Tambah Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    (function () {
        const uploadModal = document.getElementById('uploadModal');
        const closeUploadModal = document.getElementById('closeUploadModal');
        const cancelUpload = document.getElementById('cancelUpload');
        const uploadButton = document.getElementById('uploadMaterialButton');
        const courseModal = document.getElementById('courseModal');
        const closeCourseModal = document.getElementById('closeCourseModal');
        const cancelCourse = document.getElementById('cancelCourse');
        const addCourseButton = document.getElementById('addCourseButton');
        const categoryModal = document.getElementById('categoryModal');
        const closeCategoryModal = document.getElementById('closeCategoryModal');
        const cancelCategory = document.getElementById('cancelCategory');
        const addCategoryButton = document.getElementById('addCategoryButton');
        const searchInput = document.querySelector('#courseSearch');
        const listTabButtons = document.querySelectorAll('.list-tab-button');
        const listSections = document.querySelectorAll('.list-section');
        const radioType = document.querySelectorAll('input[name="upload_type"]');
        const pdfContainer = document.getElementById('pdf-container');
        const videoContainer = document.getElementById('video-container');

        function setActiveListSection(targetId) {
            listSections.forEach(function (section) {
                const isActive = section.id === targetId;
                section.classList.toggle('hidden', !isActive);
                if (isActive) {
                    section.querySelectorAll('.list-item').forEach(function (item) {
                        item.style.display = '';
                    });
                }
            });

            listTabButtons.forEach(function (button) {
                const isActive = button.dataset.target === targetId;
                button.classList.toggle('bg-orange-400', isActive);
                button.classList.toggle('text-white', isActive);
                button.classList.toggle('bg-slate-200', !isActive);
                button.classList.toggle('text-slate-700', !isActive);
            });
        }

        function filterListItems() {
            if (!searchInput) return;

            const query = searchInput.value.trim().toLowerCase();
            const activeSection = Array.from(listSections).find(function (section) {
                return !section.classList.contains('hidden');
            });
            if (!activeSection) return;

            const items = activeSection.querySelectorAll('.list-item');
            items.forEach(function (item) {
                const text = item.textContent.toLowerCase();
                item.style.display = query === '' || text.includes(query) ? '' : 'none';
            });
        }

        radioType.forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (this.value === 'video') {
                    pdfContainer.classList.add('hidden');
                    videoContainer.classList.remove('hidden');
                } else {
                    pdfContainer.classList.remove('hidden');
                    videoContainer.classList.add('hidden');
                }
            });
        });

        function openModal() {
            if (!uploadModal) return;

            const form = uploadModal.querySelector('form');
            if (form) form.reset();

            pdfContainer.classList.remove('hidden');
            videoContainer.classList.add('hidden');

            uploadModal.classList.remove('hidden');
            uploadModal.classList.add('flex');
            uploadModal.focus();
        }

        function closeModal() {
            if (!uploadModal) return;
            uploadModal.classList.add('hidden');
            uploadModal.classList.remove('flex');
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterListItems);
        }

        if (listTabButtons.length) {
            listTabButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    setActiveListSection(button.dataset.target || 'listMaterialSection');
                });
            });
        }

        setActiveListSection('listMaterialSection');

        if (uploadButton) {
            uploadButton.addEventListener('click', openModal);
        }

        if (closeUploadModal) {
            closeUploadModal.addEventListener('click', function (event) {
                event.preventDefault();
                closeModal();
            });
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

            uploadModal.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        }

        // Course modal handlers
        function openCourseModal() {
            if (!courseModal) return;
            const form = courseModal.querySelector('form');
            if (form) form.reset();
            courseModal.classList.remove('hidden');
            courseModal.classList.add('flex');
        }

        function closeCourseModalFn() {
            if (!courseModal) return;
            courseModal.classList.add('hidden');
            courseModal.classList.remove('flex');
        }

        if (addCourseButton) {
            addCourseButton.addEventListener('click', openCourseModal);
        }

        if (closeCourseModal) {
            closeCourseModal.addEventListener('click', closeCourseModalFn);
        }

        if (cancelCourse) {
            cancelCourse.addEventListener('click', closeCourseModalFn);
        }

        if (courseModal) {
            courseModal.addEventListener('click', function (event) {
                if (event.target === courseModal) {
                    closeCourseModalFn();
                }
            });
        }

        // Category modal handlers
        function openCategoryModal() {
            if (!categoryModal) return;
            const form = categoryModal.querySelector('form');
            if (form) form.reset();
            categoryModal.classList.remove('hidden');
            categoryModal.classList.add('flex');
        }

        function closeCategoryModalFn() {
            if (!categoryModal) return;
            categoryModal.classList.add('hidden');
            categoryModal.classList.remove('flex');
        }

        if (addCategoryButton) {
            addCategoryButton.addEventListener('click', openCategoryModal);
        }

        if (closeCategoryModal) {
            closeCategoryModal.addEventListener('click', closeCategoryModalFn);
        }

        if (cancelCategory) {
            cancelCategory.addEventListener('click', closeCategoryModalFn);
        }

        if (categoryModal) {
            categoryModal.addEventListener('click', function (event) {
                if (event.target === categoryModal) {
                    closeCategoryModalFn();
                }
            });
        }
    })();
</script>
