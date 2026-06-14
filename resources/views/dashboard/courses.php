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

function escape($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
?>

<style>
    /* Global Background EduShare */
    .edu-bg {
        background-color: #FFFFFF;
    }

    /* Kustomisasi Sidebar Kiri */
    .sidebar-container {
        background: #FFFFFF;
        border-right: 2px solid #E2E8F0;
    }

    .sidebar-item-link {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 14px 24px;
        font-weight: 600;
        color: #A0AEC0;
        transition: all 0.2s ease;
    }

    .sidebar-item-link:hover, .sidebar-item-link.active {
        color: #4A4A4A;
    }

    .sidebar-item-link.active {
        position: relative;
    }

    /* Indikator Garis Vertikal Tebal di Kanan Menu Aktif */
    .sidebar-item-link.active::after {
        content: '';
        position: absolute;
        right: 0;
        top: 25%;
        width: 4px;
        height: 50%;
        background-color: #2D3748;
        border-radius: 4px 0 0 4px;
    }

    /* Navigasi Atas */
    .nav-top-link {
        font-weight: 600;
        color: #A0AEC0;
        transition: color 0.2s ease;
        position: relative;
    }

    .nav-top-link:hover, .nav-top-link.active {
        color: #2D3748;
    }

    .nav-top-link.active::after {
        content: '';
        position: absolute;
        bottom: -16px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #2D3748;
        border-radius: 99px;
    }

    /* Banner Header Atas Kanan */
    .hero-banner {
        background: linear-gradient(135deg, #E2D7FF 0%, #F5F0FF 50%, #FFF3FA 100%);
        border-radius: 24px;
    }

    /* Filter Kategori Bulat */
    .btn-filter {
        background-color: #E2E8F0;
        color: #718096;
        font-weight: 600;
        padding: 8px 24px;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .btn-filter.active, .btn-filter:hover {
        background-color: #FFC436;
        color: #FFFFFF;
    }

    /* Custom Input Search Component */
    .search-wrapper {
        border: 1px solid #CBD5E0;
        border-radius: 10px;
        background: #FFFFFF;
    }

    /* Default fallback card style */
    .course-item-card {
        background: linear-gradient(135deg, #6B7280 0%, #9CA3AF 100%);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.03);
    }

    /* Manajemen Warna Gradasi Presisi Untuk Setiap Jenis Card */
    .card-gradient-database { background: linear-gradient(135deg, #4FA8B7 0%, #76C1CE 100%); }
    .card-gradient-design { background: linear-gradient(135deg, #7A69CD 0%, #A396EB 100%); }
    .card-gradient-programming { background: linear-gradient(135deg, #4274CD 0%, #6E97E2 100%); }
    .card-gradient-php { background: linear-gradient(135deg, #C25D6B 0%, #E08593 100%); }
    .card-gradient-relational { background: linear-gradient(135deg, #D49C43 0%, #ECC078 100%); }
    .card-gradient-prototyping { background: linear-gradient(135deg, #3BB092 0%, #63CEB3 100%); }
    .card-gradient-orange { background: linear-gradient(135deg, #F97316 0%, #FB923C 100%); }
    .card-gradient-purple { background: linear-gradient(135deg, #8B5CF6 0%, #A78BFA 100%); }

    .badge-category {
        background: rgba(255, 255, 255, 0.25);
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 8px;
    }

    /* Tombol Kontrol di dalam Card */
    
    .btn-card-detail {
        background-color: #FFC436;
        color: #FFFFFF;
        font-weight: 700;
        font-size: 13px;
        padding: 8px 32px;
        border-radius: 10px;
        transition: opacity 0.2s ease;
    }

    .btn-card-detail:hover {
        opacity: 0.9;
    }

    .btn-card-download {
        background-color: #718096;
        color: #FFFFFF;
        padding: 8px 14px;
        border-radius: 10px;
        transition: background-color 0.2s ease;
    }

    .btn-card-download:hover {
        background-color: #4A5568;
    }

    /* Alert box styling */
    .alert-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-radius: 18px;
        margin-bottom: 24px;
        font-weight: 600;
        font-size: 0.95rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.02);
        animation: fadeIn 0.3s ease;
    }
    .alert-success {
        background: #E6FDF4;
        color: #047857;
        border: 1px solid #A7F3D0;
    }
    .alert-error {
        background: #FEE2E2;
        color: #B91C1C;
        border: 1px solid #FCA5A5;
    }
    .alert-close {
        background: none;
        border: none;
        color: inherit;
        font-size: 1.2rem;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.2s ease;
        padding: 0 8px;
    }
    .alert-close:hover {
        opacity: 1;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="min-h-screen edu-bg flex flex-col">
    <header class="w-full bg-white border-b border-slate-200 px-8 py-5 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-3xl">🎓</span>
            <span class="text-2xl font-bold tracking-tight text-purple-900" style="color: #4E4260;">Edu Share</span>
        </div>
        
        <nav class="hidden md:flex items-center gap-10 text-base">
            <a href="/dashboard" class="nav-top-link">Home</a>
            <a href="/home/courses" class="nav-top-link active">Course</a>
            <a href="/materials/upload" class="nav-top-link">Upload</a>
            <a href="/download" class="nav-top-link">Download</a>
        </nav>

        <div class="flex items-center gap-4">
            <button class="text-slate-400 text-xl relative">
                🔔
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <div class="flex items-center gap-3">
                <img src="<?= $userPhoto ? escape($userPhoto) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80' ?>" alt="Avatar" class="w-9 h-9 rounded-full object-cover border border-purple-200" />
                <span class="font-bold text-slate-800 text-sm"><?= $userName ? escape($userName) : 'Kim Jennie' ?></span>
            </div>
        </div>
    </header>

    <div class="flex-1 grid grid-cols-1 lg:grid-cols-[260px_1fr]">
        
        <aside class="sidebar-container py-8 flex flex-col justify-between min-h-[calc(100vh-80px)]">
            <div class="space-y-1">
                <a href="/dashboard" class="sidebar-item-link">
                    <span class="text-lg">🏠</span> Home
                </a>
                <a href="/home/courses" class="sidebar-item-link active">
                    <span class="text-lg">🗂️</span> Course
                </a>
                <a href="/download" class="sidebar-item-link">
                    <span class="text-lg">📥</span> Download
                </a>
                <a href="/profile" class="sidebar-item-link">
                    <span class="text-lg">👤</span> Profile
                </a>
            </div>

            <div class="px-6 space-y-6">
                <div class="w-full flex justify-center">
                    <div class="relative p-2 bg-purple-50 rounded-2xl">
                        <span class="text-6xl">📚</span>
                    </div>
                </div>
                <a href="/logout" class="w-full block text-center bg-indigo-600 text-white font-semibold text-sm py-3 rounded-xl shadow-lg shadow-indigo-200 transition hover:bg-indigo-700">
                    Log Out
                </a>
            </div>
        </aside>

        <main class="p-8 space-y-8">
            <?php if (session()->has('success')): ?>
                <div id="success-alert" class="alert-box alert-success">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 1.25rem;">✨</span>
                        <span><?= escape(session('success')) ?></span>
                    </div>
                    <button onclick="document.getElementById('success-alert').remove()" class="alert-close">✕</button>
                </div>
            <?php endif; ?>

            <?php if (session()->has('error')): ?>
                <div id="error-alert" class="alert-box alert-error">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 1.25rem;">⚠️</span>
                        <span><?= escape(session('error')) ?></span>
                    </div>
                    <button onclick="document.getElementById('error-alert').remove()" class="alert-close">✕</button>
                </div>
            <?php endif; ?>

            <div class="hero-banner p-8 relative overflow-hidden flex flex-col md:flex-row justify-between items-center min-h-[180px]">
                <div class="space-y-3 z-10 text-center md:text-left">
                    <h2 class="text-3xl font-extrabold text-slate-800" style="color: #3B324E;">Share Learning Materials More Easily</h2>
                    <p class="text-sm font-medium text-slate-500">The best place to share and find college study materials.</p>
                    <div class="pt-2 flex flex-wrap gap-3">
                        <a href="/materials/upload" class="bg-[#FFC436] text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition hover:opacity-90 inline-block">
                            + Upload Materi
                        </a>
                        <button onclick="toggleCategoryModal(true)" type="button" class="bg-indigo-600 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition hover:bg-indigo-700">
                            + Kategori
                        </button>
                    </div>
                </div>
                <div class="hidden md:block pr-6 z-10">
                    <span class="text-8xl filter drop-shadow-sm">👨‍💻</span>
                </div>
            </div>

            <section class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="flex flex-wrap gap-2 items-center">
                    <button class="btn-filter active">All</button>
                    <button class="btn-filter" data-category="database">Data Base</button>
                    <button class="btn-filter" data-category="programming">Programming</button>
                    <button class="btn-filter" data-category="design">UI/UX Design</button>
                    
                    <?php if (isset($categories) && $categories): foreach ($categories as $cat): ?>
                        <button class="btn-filter" data-category="<?= escape($cat->kategori_id) ?>">
                            <?= escape($cat->nama_kategori ?? $cat->name ?? $cat->nama ?? 'Category') ?>
                        </button>
                    <?php endforeach; endif; ?>

                    <button onclick="toggleCategoryModal(true)" type="button" class="bg-purple-100 text-purple-700 font-bold px-4 py-2 rounded-lg transition hover:bg-purple-200 text-sm">
                        + Kategori
                    </button>
                </div>

                <div class="search-wrapper flex items-center gap-3 px-4 py-2 w-full max-w-xs">
                    <input id="courseSearch" type="text" class="w-full text-sm text-slate-700 bg-transparent outline-none placeholder:text-slate-300" placeholder="Search Materials..." />
                    <span class="text-slate-400 font-bold text-sm">🔍</span>
                </div>
            </section>

            <section class="space-y-6">
                <?php if (isset($courses) && $courses && count($courses) > 0): ?>
                    <div id="courseGrid" class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        <?php 
                        $gradients = [
                            'card-gradient-programming',
                            'card-gradient-design',
                            'card-gradient-php',
                            'card-gradient-database',
                            'card-gradient-orange',
                            'card-gradient-purple',
                            'card-gradient-prototyping',
                            'card-gradient-relational'
                        ];
                        foreach ($courses as $index => $course): 
                            $gradientClass = $gradients[$index % count($gradients)];
                        ?>
                            <article class="course-item-card <?= $gradientClass ?> flex flex-col justify-between min-h-[190px]">
                                <div class="p-5 flex justify-between items-start">
                                    <div class="text-white space-y-2">
                                        <h3 class="text-xl font-bold tracking-tight">
                                            <?= escape($course->nama_course ?? $course->title ?? 'Untitled Course') ?>
                                        </h3>
                                        <span class="badge-category inline-block">
                                            <?= escape($categoryMap[$course->kategori_id ?? ''] ?? 'Course Material') ?>
                                        </span>
                                    </div>
                                    <div class="text-4xl opacity-90 filter drop-shadow">
                                        <?php if(strpos($gradientClass, 'database') !== false || strpos($gradientClass, 'relational') !== false): ?>
                                            🗄️
                                        <?php elseif(strpos($gradientClass, 'design') !== false || strpos($gradientClass, 'prototyping') !== false): ?>
                                            🎨
                                        <?php else: ?>
                                            💻
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php 
                                $materiId = '';
                                if (isset($materials)) {
                                    foreach ($materials as $m) {
                                        if ($m->course_id == ($course->id ?? '')) {
                                            $materiId = $m->id;
                                            break;
                                        }
                                    }
                                }
                                $detailLink = $materiId ? "/home/previewMaterial/" . escape($materiId) : "/course/" . escape($course->id ?? '');
                                ?>
                                <div class="bg-white px-5 py-4 flex items-center justify-between border-t border-slate-50">
                                    <a href="<?= $detailLink ?>" <?= $materiId ? 'target="_blank"' : '' ?> class="btn-card-detail">
                                        Detail
                                    </a>
                                    <button type="button" class="btn-card-download">
                                        📥
                                    </button>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-12 text-center">
                        <p class="text-sm text-slate-400 font-medium">Belum ada course yang tersedia saat ini.</p>
                    </div>
                <?php endif; ?>
            </section>

            <footer class="pt-6 flex justify-end gap-3">
                <button onclick="window.location.reload();" class="p-3 bg-[#E2E8F0] rounded-xl hover:bg-slate-300 transition text-lg">
                    🔄
                </button>
                <a href="/dashboard" class="bg-[#F8A488] text-white font-bold px-6 py-3 rounded-xl shadow-md transition hover:opacity-90">
                    Back to Home
                </a>
            </footer>
        </main>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div id="categoryModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm transition-all duration-300">
    <div class="bg-white rounded-3xl p-6 w-full max-w-md shadow-2xl border border-slate-100 transform scale-95 transition-transform duration-300" id="categoryModalCard">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-slate-800">Tambah Kategori Baru</h3>
            <button onclick="toggleCategoryModal(false)" class="text-slate-400 hover:text-slate-600 text-xl font-semibold">✕</button>
        </div>

        <form action="/kategori/create" method="post" class="space-y-4">
            <?= csrf_field() ?>
            <div>
                <label class="block text-sm font-semibold text-slate-600 mb-2">Nama Kategori</label>
                <input name="name" type="text" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 outline-none focus:border-purple-500 focus:bg-white transition" placeholder="Masukkan nama kategori baru..." required />
            </div>

            <div class="flex gap-3 justify-end pt-2">
                <button type="button" onclick="toggleCategoryModal(false)" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit" class="bg-purple-600 text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition hover:bg-purple-700">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleCategoryModal(show) {
    const modal = document.getElementById('categoryModal');
    const card = document.getElementById('categoryModalCard');
    if (show) {
        modal.classList.remove('hidden');
        setTimeout(() => {
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }, 10);
    } else {
        card.classList.remove('scale-100');
        card.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 150);
    }
}

// Close modal when clicking outside of the modal card
window.addEventListener('click', function (e) {
    const modal = document.getElementById('categoryModal');
    if (e.target === modal) {
        toggleCategoryModal(false);
    }
});
</script>

<script>
// Filter interaktif frontend untuk fungsionalitas kotak pencarian & tombol kategori
(function () {
    var searchInput = document.getElementById('courseSearch');
    var courseCards = Array.from(document.querySelectorAll('#courseGrid > article'));
    var categoryButtons = Array.from(document.querySelectorAll('.btn-filter'));
    var activeCategory = '';

    function filterCourses() {
        var term = searchInput.value.trim().toLowerCase();
        courseCards.forEach(function (card) {
            var title = card.querySelector('h3')?.textContent.toLowerCase() || '';
            var category = card.querySelector('.badge-category')?.textContent.toLowerCase() || '';
            
            var matchesText = !term || title.includes(term) || category.includes(term);
            var matchesCategory = !activeCategory || category.includes(activeCategory.toLowerCase());

            card.style.display = matchesText && matchesCategory ? '' : 'none';
        });
    }

    categoryButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            activeCategory = button.textContent.trim() === 'All' ? '' : button.getAttribute('data-category') || button.textContent.trim();
            categoryButtons.forEach(function (btn) {
                btn.classList.remove('active');
            });
            button.classList.add('active');
            filterCourses();
        });
    });

    searchInput?.addEventListener('input', filterCourses);
})();
</script>