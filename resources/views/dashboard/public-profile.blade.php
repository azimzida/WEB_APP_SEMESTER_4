@extends('layouts.main')
@section('content')
@php
/* @var string $title */
/* @var string $page */
/* @var object $profileUser */
/* @var array $materials */
/* @var array $courses */
/* @var bool $isOwner */

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
$profilePhotoSrc = getPhotoSrc($profileUser->foto_profil);

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
        text-decoration: none;
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
    .profile-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .profile-name {
        font-size: 2rem;
        font-weight: 800;
        color: #2D3748;
        margin: 0;
    }
    .profile-email {
        font-size: 1.1rem;
        color: #718096;
        margin: 0;
    }
    @media (max-width: 1024px) {
        .layout-body { grid-template-columns: 1fr; }
        .sidebar { min-height: auto; }
        .topnav { display: none; }
    }
</style>

<div class="page-shell">
    <header class="topbar">
        <a href="/dashboard" class="brand-title">
            <span style="font-size: 1.875rem;">🎓</span>
            <span style="font-size: 1.5rem; font-weight: 700; letter-spacing: -0.025em; color: #4E4260;">Edu Share</span>
        </a>



        <div class="topbar-right">
            <button type="button" aria-label="Notifications">🔔</button>
            @if($user)
            <div class="topbar-user">
                <img src="{{ $userPhotoSrc ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80' }}" alt="Avatar">
                <span>{{ $userName ? escape($userName) : 'User' }}</span>
            </div>
            @else
            <div class="topbar-user">
                <a href="/login" style="color: #5B21B6; text-decoration: none; font-weight: bold;">Login</a>
            </div>
            @endif
        </div>
    </header>

    <div class="layout-body">
        @if($user)
        <aside class="sidebar">
            <nav>
                <a href="/home/courses">🔙 Back to Course</a>
            </nav>
        </aside>
        @else
        <aside class="sidebar">
            <nav>
                <a href="/home/courses">🔙 Back to Course</a>
            </nav>
        </aside>
        @endif

        <section class="panel">

            <div class="content-card">
                <div class="profile-header">
                    <div class="avatar-view-container">
                        @if($profilePhotoSrc)
                            <img src="{{ $profilePhotoSrc }}" alt="Avatar" class="avatar-main-image">
                        @else
                            <div class="avatar-icon-fallback">👤</div>
                        @endif
                    </div>
                    <div class="profile-info">
                        <h1 class="profile-name">{{ $profileUser->nama }}</h1>
                        <p class="profile-email">Pengguna Edu Share</p>
                    </div>
                </div>
            </div>

            <div class="content-card">
                <h3 style="color: #2D2A43; font-size: 1.5rem; font-weight: 800; margin: 0 0 16px 0;">Materi dari {{ $profileUser->nama }}</h3>
                @if(!empty($materials) && count($materials) > 0)
                    <div style="display: grid; gap: 16px;">
                        @php 
                        $modulColors = [
                            ['bg' => '#F8F5FF', 'border' => '#E9E2FF', 'text' => '#4E4260'],
                            ['bg' => '#F0FDF4', 'border' => '#BBF7D0', 'text' => '#166534'],
                            ['bg' => '#FFFBEB', 'border' => '#FEF08A', 'text' => '#854D0E'],
                            ['bg' => '#EFF6FF', 'border' => '#BFDBFE', 'text' => '#1E40AF'],
                        ];
                        $colorIndex = 0;
                        @endphp
                        @foreach ($materials as $material)
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="border: 2px dashed #E2E8F0; border-radius: 16px; padding: 32px; text-align: center; color: #A0AEC0; font-weight: 600;">
                        Belum ada materi yang dibagikan.
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>

@endsection