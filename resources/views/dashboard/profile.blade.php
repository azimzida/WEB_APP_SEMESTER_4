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
$userName = $user['nama'] ?? '';
$userEmail = $user['email'] ?? '';
$userPhone = $user['no_telp'] ?? '';
$userPhoto = $user['foto_profil'] ?? null;

function escape($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function getPhotoSrc($photoData) {
    if (empty($photoData)) return '';
    if (strpos($photoData, 'http') === 0 || strpos($photoData, 'data:image') === 0) {
        return $photoData;
    }
    $mime = 'image/jpeg';
    if (strpos($photoData, "\x89PNG") === 0) $mime = 'image/png';
    elseif (strpos($photoData, "GIF8") === 0) $mime = 'image/gif';
    elseif (strpos($photoData, "RIFF") === 0 && strpos(substr($photoData, 8, 4), "WEBP") === 0) $mime = 'image/webp';
    return 'data:' . $mime . ';base64,' . base64_encode($photoData);
}

$userPhotoSrc = getPhotoSrc($userPhoto);

$courseMap = [];
if (isset($courses) && is_iterable($courses)) {
    foreach ($courses as $c) {
        $courseMap[$c->id] = $c->nama_course ?? $c->title ?? 'Untitled Course';
    }
}
@endphp

<style>
    body {
        margin: 0;
        font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        background: #F8F5FF;
    }
    .page-shell {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 22px 36px;
        background: #FFFFFF;
        border-bottom: 1px solid #E6E8F0;
        box-shadow: 0 16px 42px rgba(15, 23, 42, 0.08);
    }
    .brand-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .brand-icon {
        width: 46px;
        height: 46px;
        border-radius: 18px;
        background: linear-gradient(135deg, #7C3AED 0%, #C084FC 100%);
        color: #FFFFFF;
        font-size: 1.5rem;
        font-weight: 800;
        display: grid;
        place-items: center;
    }
    .brand-name {
        font-size: 1.35rem;
        font-weight: 800;
        color: #2D3748;
    }
    .topnav {
        display: flex;
        align-items: center;
        gap: 28px;
    }
    .topnav a {
        color: #9096A3;
        text-decoration: none;
        font-weight: 700;
        transition: color .2s ease;
    }
    .topnav a:hover,
    .topnav a.active {
        color: #2D3748;
    }
    .topbar-right {
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .topbar-right button {
        background: #F8F5FF;
        border: none;
        border-radius: 999px;
        width: 42px;
        height: 42px;
        font-size: 1.15rem;
        cursor: pointer;
    }
    .topbar-user {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #2D3748;
        font-weight: 700;
    }
    .topbar-user img {
        width: 42px;
        height: 42px;
        border-radius: 999px;
        object-fit: cover;
    }
    .layout-body {
        display: grid;
        grid-template-columns: 260px 1fr;
        gap: 24px;
        width: calc(100% - 72px);
        max-width: 1420px;
        margin: 32px auto 64px;
        padding: 0 24px;
    }
    .sidebar {
        background: #FFFFFF;
        border-radius: 32px;
        border: 1px solid #E9E8F8;
        padding: 28px 22px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .sidebar nav {
        display: grid;
        gap: 10px;
    }
    .sidebar a {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 18px;
        border-radius: 18px;
        text-decoration: none;
        color: #718096;
        font-weight: 700;
        transition: background .2s ease, color .2s ease;
    }
    .sidebar a:hover,
    .sidebar a.active {
        background: #F5F3FF;
        color: #4C51BF;
    }
    .sidebar-footer a {
        display: block;
        width: 100%;
        text-align: center;
        background: #5B21B6;
        color: #FFFFFF;
        padding: 14px 0;
        border-radius: 18px;
        text-decoration: none;
        font-weight: 700;
    }
    .panel {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .hero-card {
        background: linear-gradient(135deg, #EDE7FF 0%, #FFF3EC 100%);
        border-radius: 30px;
        padding: 36px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 24px;
        align-items: center;
    }
    .hero-text h1 {
        margin: 0;
        font-size: 2.4rem;
        color: #2D2A43;
        letter-spacing: -0.03em;
    }
    .hero-text p {
        margin: 12px 0 0;
        color: #5B6680;
        font-size: 0.98rem;
        max-width: 520px;
    }
    .hero-visual {
        width: 100%;
        max-width: 180px;
        height: 180px;
        background: #F8F2FF;
        border-radius: 28px;
        display: grid;
        place-items: center;
        font-size: 4rem;
    }
    .content-card {
        background: #FFFFFF;
        border-radius: 32px;
        border: 1px solid #F0EEFA;
        padding: 32px;
        box-shadow: 0 28px 60px rgba(33, 20, 120, 0.06);
    }
    .profile-header {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        align-items: center;
        justify-content: space-between;
    }
    .avatar-block {
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .avatar-view-container {
        position: relative;
        width: 140px;
        height: 140px;
    }
    .avatar-main-image {
        width: 140px;
        height: 140px;
        border-radius: 999px;
        object-fit: cover;
        border: 4px solid #5B21B6;
    }
    .avatar-icon-fallback {
        width: 140px;
        height: 140px;
        border-radius: 999px;
        background: #EEEAFD;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 4px solid #5B21B6;
        font-size: 3rem;
    }
    .camera-badge-icon {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 40px;
        height: 40px;
        border-radius: 999px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        cursor: pointer;
    }
    .profile-form {
        display: grid;
        gap: 20px;
    }
    .profile-field {
        display: grid;
        gap: 10px;
    }
    .profile-label {
        font-size: 0.95rem;
        font-weight: 700;
        color: #4A5568;
    }
    .profile-input {
        width: 100%;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        background: #F3F4F6;
        padding: 16px 18px;
        color: #2D3748;
        font-size: 0.98rem;
    }
    .profile-input:focus {
        outline: none;
        border-color: #A78BFA;
        background: #F8F5FF;
    }
    .profile-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 12px;
    }
    .btn-upload-photo,
    .btn-delete-photo,
    .btn-save-changes,
    .btn-back-home {
        border: none;
        border-radius: 16px;
        font-weight: 700;
        cursor: pointer;
    }
    .btn-upload-photo {
        background: #7C3AED;
        color: #FFFFFF;
        padding: 16px 28px;
    }
    .btn-delete-photo {
        background: #EF4444;
        color: #FFFFFF;
        padding: 16px 28px;
    }
    .btn-save-changes {
        background: #FBBF24;
        color: #1F2937;
        padding: 16px 30px;
    }
    .btn-back-home {
        background: #F97316;
        color: #FFFFFF;
        padding: 16px 28px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .file-preview-text {
        margin-top: 8px;
        font-size: 12px;
        color: #718096;
        max-width: 150px;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .photo-input {
        display: none;
    }
    @media (max-width: 1024px) {
        .layout-body { grid-template-columns: 1fr; }
        .sidebar { min-height: auto; }
        .topnav { display: none; }
    }
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

<div class="page-shell">
    <header class="topbar">
        <div class="brand-title" style="gap: 8px;">
            <span style="font-size: 1.875rem;">🎓</span>
            <span style="font-size: 1.5rem; font-weight: 700; letter-spacing: -0.025em; color: #4E4260;">Edu Share</span>
        </div>

        <nav class="topnav">
            <a href="/dashboard">Home</a>
            <a href="/home/courses">Course</a>
            <a href="/materials/upload">Upload</a>
            <a href="/download">Download</a>
        </nav>

        <div class="topbar-right">
            <button type="button" aria-label="Notifications">🔔</button>
            <div class="topbar-user">
                <img src="{{ $userPhotoSrc ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80' }}" alt="Avatar">
                <span>{{ $userName ? escape($userName) : 'User' }}</span>
            </div>
        </div>
    </header>

    <div class="layout-body">
        <aside class="sidebar">
            <nav>
                <a href="/dashboard">🏠 Home</a>
                <a href="/home/courses">🗂️ Course</a>
                <a href="/download">📥 Download</a>
                <a href="/profile" class="active">👤 Profile</a>
            </nav>

            <div class="sidebar-footer">
                <a href="/logout">Log Out</a>
            </div>
        </aside>

        <section class="panel">
            <div class="hero-card">
                <div class="hero-text">
                    <h1>Edit Profile</h1>
                    <p>Update your account information and change your profile photo.</p>
                </div>
                <div class="hero-visual">👩‍💻</div>
            </div>

            @if(session()->has('success'))
                <div id="success-alert" class="alert-box alert-success">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 1.25rem;">✨</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('success-alert').remove()" class="alert-close">✕</button>
                </div>
            @endif

            @if(session()->has('error'))
                <div id="error-alert" class="alert-box alert-error">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 1.25rem;">⚠️</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="document.getElementById('error-alert').remove()" class="alert-close">✕</button>
                </div>
            @endif

            <div class="content-card">
                <div class="profile-header">
                    <div class="avatar-block">
                        <div class="avatar-view-container">
                            @if($userPhotoSrc)
                                <img id="avatar-preview" src="{{ $userPhotoSrc }}" alt="Avatar" class="avatar-main-image">
                            @else
                                <div id="avatar-fallback" class="avatar-icon-fallback">👤</div>
                                <img id="avatar-preview" src="" alt="Avatar" class="avatar-main-image hidden">
                            @endif

                            <label for="foto_profil" class="camera-badge-icon" title="Ubah Foto Profil">📷</label>
                        </div>
                    </div>

                    <div class="profile-actions">
                        <form action="/profile/upload" method="post" enctype="multipart/form-data">
                            @php if (function_exists('csrf_field')) echo csrf_field(); @endphp
                            <input type="file" id="foto_profil" name="photo" accept="image/*" class="photo-input" onchange="previewImage(event)">
                            <button type="submit" class="btn-upload-photo">Upload Photo</button>
                        </form>

                        @if($userPhotoSrc)
                            <form action="/profile/delete" method="post">
                                @php if (function_exists('csrf_field')) echo csrf_field(); @endphp
                                <button type="submit" class="btn-delete-photo" onclick="return confirm('Hapus foto profil?');">Delete Photo</button>
                            </form>
                        @endif
                    </div>
                </div>

                <form action="/profile/update" method="post" class="profile-form">
                    @php if (function_exists('csrf_field')) echo csrf_field(); @endphp

                    <div class="profile-field">
                        <label class="profile-label">Name</label>
                        <input type="text" name="name" class="profile-input" value="{{ $userName }}" placeholder="Enter your full name">
                    </div>

                    <div class="profile-field">
                        <label class="profile-label">Email</label>
                        <input type="email" name="email" class="profile-input" value="{{ $userEmail }}" placeholder="name@example.com">
                    </div>

                    <div class="profile-field">
                        <label class="profile-label">Telephone</label>
                        <input type="text" name="telephone" class="profile-input" value="{{ $userPhone }}" placeholder="e.g. 08123456789">
                    </div>

                    <div class="profile-actions">
                        <button type="submit" class="btn-save-changes">Save Changes</button>
                        <a href="/dashboard" class="btn-back-home">Back to Home</a>
                    </div>
                </form>
            </div>

            <div class="content-card" style="margin-top: 24px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <h3 style="color: #2D2A43; font-size: 1.5rem; font-weight: 800; margin: 0;">Grafik Kunjungan Profil</h3>
                    <a href="/user/{{ $user['id'] ?? '' }}" target="_blank" style="background: #F3F4F6; color: #4B5563; padding: 8px 16px; border-radius: 12px; text-decoration: none; font-size: 0.9rem; font-weight: 700; transition: background 0.2s;" onmouseover="this.style.background='#E5E7EB'" onmouseout="this.style.background='#F3F4F6'">Lihat Profil Publik</a>
                </div>
                <div style="width: 100%; height: 300px;">
                    <canvas id="profileVisitsChart"></canvas>
                </div>
            </div>

            <div class="content-card" style="margin-top: 24px;">
                <h3 style="color: #2D2A43; font-size: 1.5rem; font-weight: 800; margin: 0 0 16px 0;">Materi yang Diupload</h3>
                @if(!empty($userMaterials) && count($userMaterials) > 0)
                    <div style="display: grid; gap: 16px;">
                        @php 
                        $modulColors = [
                            ['bg' => '#F8F5FF', 'border' => '#E9E2FF', 'text' => '#4E4260'], // Purple
                            ['bg' => '#F0FDF4', 'border' => '#BBF7D0', 'text' => '#166534'], // Green
                            ['bg' => '#FFFBEB', 'border' => '#FEF08A', 'text' => '#854D0E'], // Yellow
                            ['bg' => '#EFF6FF', 'border' => '#BFDBFE', 'text' => '#1E40AF'], // Blue
                            ['bg' => '#FEF2F2', 'border' => '#FECACA', 'text' => '#991B1B'], // Red
                            ['bg' => '#FFF5F5', 'border' => '#FED7D7', 'text' => '#9B2C2C'], // Pink
                            ['bg' => '#F0F9FF', 'border' => '#BAE6FD', 'text' => '#075985']  // Sky Blue
                        ];
                        $colorIndex = 0;
                        @endphp
                        @foreach ($userMaterials as $material)
@php $colorTheme = $modulColors[$colorIndex % count($modulColors)];
                            $colorIndex++; @endphp
                            <div style="border: 1px solid {{ $colorTheme['border'] }}; border-radius: 16px; padding: 16px; background: {{ $colorTheme['bg'] }}; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; transition: transform 0.2s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.02);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                                <div>
                                    <h4 style="margin: 0; font-size: 1.1rem; color: {{ $colorTheme['text'] }}; font-weight: 800;">{{ $material->judul }}</h4>
                                    <p style="margin: 4px 0 0; font-size: 0.9rem; color: #718096; font-weight: 600;">
                                        Course: {{ $courseMap[$material->course_id] ?? 'Unknown Course' }}
                                    </p>
                                </div>
                                <div style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center;">
                                    <a href="/home/previewMaterial/{{ $material->id }}" target="_blank" style="background: #10B981; color: white; padding: 10px 18px; border-radius: 12px; text-decoration: none; font-size: 0.9rem; font-weight: bold; transition: opacity 0.2s ease;">Lihat PDF</a>
                                    <a href="/materials/{{ $material->id }}/edit" style="background: #6366F1; color: white; padding: 10px 18px; border-radius: 12px; text-decoration: none; font-size: 0.9rem; font-weight: bold; transition: opacity 0.2s ease;">Edit Material</a>
                                    <form action="/materials/delete" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?');" style="margin: 0;">
                                        @php if (function_exists('csrf_field')) echo csrf_field(); @endphp
                                        <input type="hidden" name="id" value="{{ $material->id }}">
                                        <button type="submit" style="background: #EF4444; color: white; border: none; padding: 10px 18px; border-radius: 12px; font-size: 0.9rem; font-weight: bold; cursor: pointer; transition: opacity 0.2s ease;">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="border: 2px dashed #E2E8F0; border-radius: 16px; padding: 32px; text-align: center; color: #A0AEC0; font-weight: 600;">
                        Belum ada materi yang diupload.
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>

<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('avatar-preview');
    const fallback = document.getElementById('avatar-fallback');
    const file = input.files && input.files[0];

    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        if (preview) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        if (fallback) {
            fallback.classList.add('hidden');
        }
    };
    reader.readAsDataURL(file);
}
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    fetch('/api/profile-visits')
        .then(response => response.json())
        .then(data => {
            if(data.error) return;
            const ctx = document.getElementById('profileVisitsChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Kunjungan',
                        data: data.data,
                        borderColor: '#7C3AED',
                        backgroundColor: 'rgba(124, 58, 237, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#FFFFFF',
                        pointBorderColor: '#7C3AED',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1, precision: 0 }
                        }
                    }
                }
            });
        });
});
</script>
@endsection