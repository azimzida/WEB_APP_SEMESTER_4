<?php
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

$userPhotoSrc = '';
if (!empty($userPhoto)) {
    $userPhotoSrc = $userPhoto;
}
?>

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
        <div class="brand-title">
            <div class="brand-icon">E</div>
            <div class="brand-name">Edu Share</div>
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
                <img src="<?= $userPhotoSrc ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80' ?>" alt="Avatar">
                <span><?= $userName ? escape($userName) : 'User' ?></span>
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

            <div class="content-card">
                <div class="profile-header">
                    <div class="avatar-block">
                        <div class="avatar-view-container">
                            <?php if ($userPhotoSrc): ?>
                                <img id="avatar-preview" src="<?= escape($userPhotoSrc) ?>" alt="Avatar" class="avatar-main-image">
                            <?php else: ?>
                                <div id="avatar-fallback" class="avatar-icon-fallback">👤</div>
                                <img id="avatar-preview" src="" alt="Avatar" class="avatar-main-image hidden">
                            <?php endif; ?>

                            <label for="foto_profil" class="camera-badge-icon" title="Ubah Foto Profil">📷</label>
                        </div>
                    </div>

                    <div class="profile-actions">
                        <form action="/profile/upload" method="post" enctype="multipart/form-data">
                            <?php if (function_exists('csrf_field')) echo csrf_field(); ?>
                            <input type="file" id="foto_profil" name="photo" accept="image/*" class="photo-input" onchange="previewImage(event)">
                            <button type="submit" class="btn-upload-photo">Upload Photo</button>
                        </form>

                        <?php if ($userPhotoSrc): ?>
                            <form action="/profile/delete" method="post">
                                <?php if (function_exists('csrf_field')) echo csrf_field(); ?>
                                <button type="submit" class="btn-delete-photo" onclick="return confirm('Hapus foto profil?');">Delete Photo</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

                <form action="/profile/update" method="post" class="profile-form">
                    <?php if (function_exists('csrf_field')) echo csrf_field(); ?>

                    <div class="profile-field">
                        <label class="profile-label">Name</label>
                        <input type="text" name="name" class="profile-input" value="<?= escape($userName) ?>" placeholder="Enter your full name">
                    </div>

                    <div class="profile-field">
                        <label class="profile-label">Email</label>
                        <input type="email" name="email" class="profile-input" value="<?= escape($userEmail) ?>" placeholder="name@example.com">
                    </div>

                    <div class="profile-field">
                        <label class="profile-label">Telephone</label>
                        <input type="text" name="telephone" class="profile-input" value="<?= escape($userPhone) ?>" placeholder="e.g. 08123456789">
                    </div>

                    <div class="profile-actions">
                        <button type="submit" class="btn-save-changes">Save Changes</button>
                        <a href="/dashboard" class="btn-back-home">Back to Home</a>
                    </div>
                </form>
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