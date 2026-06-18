@extends('layouts.main')
@section('content')
@php
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

$userMap = [];
if (isset($users) && $users) {
    foreach ($users as $u) {
        $userMap[$u->id] = $u->nama;
    }
}

function escape($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function formatDate($value) {
    if (!$value) {
        return '-';
    }
    $ts = strtotime($value);
    return $ts ? date('d M Y', $ts) : escape($value);
}
@endphp

<style>
    /* Global Background Layout */
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

    /* Indikator Garis Vertikal Menu Aktif */
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

    /* Filter Pill Kuning Lebar Sesuai Gambar Mockup */
    .btn-filter-wide {
        background-color: #E2E8F0;
        color: #718096;
        font-weight: 600;
        text-align: center;
        padding: 10px 0;
        border-radius: 10px;
        transition: all 0.2s ease;
    }

    .btn-filter-wide.active, .btn-filter-wide:hover {
        background-color: #FFC436;
        color: #FFFFFF;
    }

    /* Custom Input Search Component */
    .search-wrapper {
        border: 1px solid #CBD5E0;
        border-radius: 10px;
        background: #FFFFFF;
    }

    /* List Baris Item Unduhan (Download Row Items) */
    .download-list-row {
        background-color: #F3EEFF;
        border-radius: 16px;
        transition: transform 0.2s ease;
    }

    .download-list-row:hover {
        transform: translateY(-2px);
    }

    /* Tombol Hapus Merah */
    .btn-action-delete {
        background-color: #E53E3E;
        color: #FFFFFF;
        font-weight: 700;
        font-size: 14px;
        padding: 10px 24px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.2s ease;
    }

    .btn-action-delete:hover {
        background-color: #C53030;
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
            <a href="/home/courses" class="nav-top-link">Course</a>
            <a href="/materials/upload" class="nav-top-link">Upload</a>
            <a href="/download" class="nav-top-link active">Download</a>
        </nav>

        <div class="flex items-center gap-4">
            <button class="text-slate-400 text-xl relative">
                🔔
                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
            </button>
            <div class="flex items-center gap-3">
                <img src="{{ $userPhoto ? escape($userPhoto) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80' }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover border border-purple-200" />
                <span class="font-bold text-slate-800 text-sm">{{ $userName ? escape($userName) : 'Kim Jennie' }}</span>
            </div>
        </div>
    </header>

    <div class="flex-1 grid grid-cols-1 lg:grid-cols-[260px_1fr]">
        
        <aside class="sidebar-container py-8 flex flex-col justify-between min-h-[calc(100vh-80px)]">
            <div class="space-y-1">
                <a href="/dashboard" class="sidebar-item-link">
                    <span class="text-lg">🏠</span> Home
                </a>
                <a href="/home/courses" class="sidebar-item-link">
                    <span class="text-lg">🗂️</span> Course
                </a>
                <a href="/download" class="sidebar-item-link active">
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

        <main class="p-8 space-y-6">
            
            <div class="hero-banner p-8 relative overflow-hidden flex flex-col md:flex-row justify-between items-center min-h-[180px]">
                <div class="space-y-3 z-10 text-center md:text-left">
                    <h2 class="text-3xl font-extrabold text-slate-800" style="color: #3B324E;">Download Materials</h2>
                    <p class="text-sm font-medium text-slate-500">Your saved study resources.</p>
                </div>
                <div class="hidden md:block pr-6 z-10">
                    <span class="text-8xl filter drop-shadow-sm">👨‍💻</span>
                </div>
            </div>

            <section class="grid grid-cols-1 md:grid-cols-[1fr_280px] gap-4 items-center">
                <button class="btn-filter-wide active w-full" data-filter="all">All</button>

                <div class="search-wrapper flex items-center gap-3 px-4 py-2.5 w-full">
                    <input id="downloadSearch" type="text" class="w-full text-sm text-slate-700 bg-transparent outline-none placeholder:text-slate-300" placeholder="Search Downloads..." />
                    <span class="text-slate-400 font-bold text-sm">🔍</span>
                </div>
            </section>

            <section id="downloadContainer" class="space-y-3.5">
                @if(isset($materials) && $materials && count($materials) > 0)
                    @foreach ($materials as $material)
@php $courseName = $courseMap[$material->course_id ?? ''] ?? 'Course Material';
                        $categoryName = $categoryMap[$material->kategori_id ?? ''] ?? 'General';
                        $dateText = formatDate($material->tanggal_upload ?? $material->updated_at ?? '');
                        
                        // Menentukan icon penanda berdasarkan nama file/judul agar dinamis dan interaktif
                        $cleanTitle = strtolower($material->judul ?? '');
                        $iconVisual = '📄'; // Default
                        if (strpos($cleanTitle, 'sql') !== false || strpos($cleanTitle, 'database') !== false) {
                            $iconVisual = '🗄️';
                        } elseif (strpos($cleanTitle, 'html') !== false || strpos($cleanTitle, 'css') !== false || strpos($cleanTitle, 'crud') !== false) {
                            $iconVisual = '💻';
                        } elseif (strpos($cleanTitle, 'design') !== false || strpos($cleanTitle, 'ui') !== false) {
                            $iconVisual = '🎨';
                        } @endphp
                        <div class="download-list-row p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border border-purple-100/40">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 bg-white rounded-xl flex items-center justify-center text-3xl shadow-sm border border-purple-50">
                                    {{ $iconVisual }}
                                </div>
                                <div class="space-y-0.5">
                                    <h3 class="text-base font-bold text-slate-800 tracking-tight">
                                        {{ $material->judul ?? 'Untitled Material' }}
                                    </h3>
                                    @if(!empty($material->user_id) && isset($userMap[$material->user_id]))
                                    <a href="/user/{{ $material->user_id }}" class="text-xs font-semibold text-purple-600 hover:text-purple-800 underline block mt-0.5 mb-1 transition-colors">
                                        Oleh: {{ $userMap[$material->user_id] }}
                                    </a>
                                    @endif
                                    <p class="text-xs font-semibold text-slate-400">
                                        3.2 MB • Downloaded on {{ $dateText }}
                                    </p>
                                </div>
                            </div>

                            <div class="w-full sm:w-auto flex justify-end">
                                <button type="button" class="btn-action-delete shadow-sm hover:opacity-95">
                                    🗑️ Delete
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="download-list-row p-8 text-center text-sm font-medium text-slate-400">
                        Belum ada riwayat berkas yang diunduh.
                    </div>
                @endif
            </section>

            <footer class="pt-4 flex justify-end">
                <a href="/home/courses" class="bg-[#F8A488] text-white font-bold px-6 py-3 rounded-xl shadow-md transition hover:opacity-90">
                    Back to Home
                </a>
            </footer>
        </main>
    </div>
</div>

<script>
// Driver interaktif pencarian berkas download lokal halaman frontend
(function () {
    var searchInput = document.getElementById('downloadSearch');
    var downloadRows = Array.from(document.querySelectorAll('#downloadContainer .download-list-row'));

    function filterDownloads() {
        var term = searchInput.value.trim().toLowerCase();
        downloadRows.forEach(function (row) {
            var title = row.querySelector('h3')?.textContent.toLowerCase() || '';
            if (!term || title.includes(term)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput?.addEventListener('input', filterDownloads);
})();
</script>
@endsection