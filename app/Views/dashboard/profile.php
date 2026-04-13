<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
$dbStatus = $dbStatus ?? false;
$dbStatusMessage = $dbStatusMessage ?? 'Database status unavailable.';
$user = $user ?? null;
$userName = $user['nama'] ?? null;
$userEmail = $user['email'] ?? null;
$userPhone = $user['no_telp'] ?? 'Belum diisi';
$userRole = $user['role'] ?? 'Pengguna';
$userJoined = $user['created_at'] ?? 'Tidak tersedia';
$userPhoto = $user['foto_profil'] ?? null;
?>

<div class="min-h-screen bg-slate-100">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="flex flex-col gap-6 rounded-[2rem] bg-white px-6 py-6 shadow-2xl shadow-slate-200/20 lg:flex-row lg:items-center lg:justify-between lg:px-10 lg:py-8">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-violet-500 text-xl font-bold text-white">E</div>
                <div>
                    <div class="mb-2 flex items-center">
                        <span class="h-3 w-3 rounded-full <?= $dbStatus ? 'bg-emerald-500' : 'bg-rose-500' ?>" title="<?= htmlspecialchars($dbStatusMessage, ENT_QUOTES, 'UTF-8') ?>"></span>
                    </div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-violet-600">Edu Share</p>
                    <p class="text-xs text-slate-500">Learn easier and more structured</p>
                </div>
            </div>

            <div class="md:hidden">
                <button id="hamburger" class="text-slate-600 text-2xl">☰</button>
            </div>

            <nav id="nav" class="hidden md:flex flex-wrap items-center gap-3 text-sm font-medium text-slate-600">
                <a href="/dashboard" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">Home</a>
                <a href="/about" class="rounded-full px-4 py-2 bg-slate-100 text-slate-900 transition hover:bg-slate-200">About</a>
                <?php if ($user): ?>
                    <div class="ml-4 flex items-center gap-3">
                        <a href="/profile" class="flex items-center gap-3 rounded-full bg-slate-100 text-slate-900 transition hover:bg-slate-200 px-3 py-2">
                            <?php if (!empty($userPhoto)): ?>
                                <img src="<?= htmlspecialchars($userPhoto, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($userName ?: 'Profile', ENT_QUOTES, 'UTF-8') ?>" class="h-10 w-10 rounded-full object-cover" />
                            <?php else: ?>
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-600 text-sm font-semibold text-white"><?= strtoupper(substr($userName ?? ($userEmail ?? 'U'), 0, 1)) ?></span>
                            <?php endif; ?>
                            <span class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($userName ?? ($userEmail ?? 'User'), ENT_QUOTES, 'UTF-8') ?></span>
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

        <section class="mt-10 grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-start">
            <div class="space-y-6">
                <span class="inline-flex rounded-full bg-violet-100 px-4 py-2 text-sm font-semibold text-violet-700">Profil Saya</span>
                <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Halo, <?= htmlspecialchars($userName ?? 'Pengguna', ENT_QUOTES, 'UTF-8') ?></h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-600"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>

                <?php if ($user): ?>
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-lg">
                        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                            <div class="flex items-center gap-5">
                                <?php if (!empty($userPhoto)): ?>
                                    <img id="profile-photo-preview" src="<?= htmlspecialchars($userPhoto, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?>" class="h-24 w-24 rounded-full object-cover" />
                                <?php else: ?>
                                    <span id="profile-photo-preview" class="flex h-24 w-24 items-center justify-center rounded-full bg-violet-600 text-4xl font-bold text-white"><?= strtoupper(substr($userName ?? 'U', 0, 1)) ?></span>
                                <?php endif; ?>
                                <div>
                                    <h2 class="text-2xl font-semibold text-slate-900"><?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?></h2>
                                    <p class="text-sm text-slate-500"><?= htmlspecialchars($userRole, ENT_QUOTES, 'UTF-8') ?></p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 sm:flex-row">
                                <button id="open-photo-modal" type="button" class="inline-flex items-center justify-center rounded-full bg-violet-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-violet-700">Edit Photo</button>
                                <?php if (!empty($userPhoto)): ?>
                                    <form action="/profile/delete" method="post" class="inline">
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus foto profil?');" class="inline-flex items-center justify-center rounded-full bg-red-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-red-700">Delete Photo</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                                <p class="text-sm text-slate-500">Email</p>
                                <p class="mt-2 text-lg font-semibold text-slate-900"><?= htmlspecialchars($userEmail, ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                                <p class="text-sm text-slate-500">Nomor Telepon</p>
                                <p class="mt-2 text-lg font-semibold text-slate-900"><?= htmlspecialchars($userPhone, ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                                <p class="text-sm text-slate-500">Role</p>
                                <p class="mt-2 text-lg font-semibold text-slate-900"><?= htmlspecialchars($userRole, ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">
                                <p class="text-sm text-slate-500">Bergabung sejak</p>
                                <p class="mt-2 text-lg font-semibold text-slate-900"><?= htmlspecialchars($userJoined, ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-8 shadow-lg">
                        <h2 class="text-2xl font-semibold text-slate-900">Kamu belum login</h2>
                        <p class="mt-4 text-slate-600">Silakan masuk terlebih dahulu untuk melihat halaman profil.</p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="/login" class="rounded-full bg-violet-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-violet-700">Login</a>
                            <a href="/register" class="rounded-full bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-200">Register</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>

<div id="photo-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/70 p-4">
    <div class="w-full max-w-xl rounded-[2rem] bg-white p-6 shadow-2xl">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900">Edit Foto Profil</h2>
                <p class="mt-1 text-sm text-slate-500">Pilih file foto untuk memperbarui avatar profil Anda.</p>
            </div>
            <button id="close-photo-modal" type="button" class="rounded-full bg-slate-100 px-3 py-2 text-slate-700 transition hover:bg-slate-200">×</button>
        </div>

        <form id="photo-upload-form" action="/profile/upload" method="post" enctype="multipart/form-data" class="mt-6">
            <label class="block text-sm font-medium text-slate-700">Foto baru</label>
            <input id="photo-input" name="photo" type="file" accept="image/*" required class="mt-2 block w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700" />

            <div id="upload-preview" class="mt-4 hidden rounded-3xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-sm text-slate-500">Pratinjau</p>
                <img id="upload-preview-image" src="#" alt="Preview Foto" class="mt-3 h-32 w-32 rounded-full object-cover" />
            </div>

            <div class="mt-6 flex flex-wrap gap-3 justify-end">
                <button id="cancel-photo-modal" type="button" class="rounded-full border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Batal</button>
                <button type="submit" class="rounded-full bg-violet-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-violet-700">Simpan Foto</button>
            </div>
        </form>
    </div>
</div>

<script>
    const openPhotoModal = document.getElementById('open-photo-modal');
    const closePhotoModal = document.getElementById('close-photo-modal');
    const cancelPhotoModal = document.getElementById('cancel-photo-modal');
    const photoModal = document.getElementById('photo-modal');
    const photoInput = document.getElementById('photo-input');
    const uploadPreview = document.getElementById('upload-preview');
    const uploadPreviewImage = document.getElementById('upload-preview-image');

    if (openPhotoModal && photoModal) {
        const showModal = () => photoModal.classList.remove('hidden');
        const hideModal = () => {
            photoModal.classList.add('hidden');
            photoInput.value = '';
            uploadPreview.classList.add('hidden');
            uploadPreviewImage.src = '#';
        };

        openPhotoModal.addEventListener('click', showModal);
        closePhotoModal.addEventListener('click', hideModal);
        cancelPhotoModal.addEventListener('click', hideModal);

        photoInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (!file) {
                uploadPreview.classList.add('hidden');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                uploadPreviewImage.src = e.target.result;
                uploadPreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        });
    }
</script>
