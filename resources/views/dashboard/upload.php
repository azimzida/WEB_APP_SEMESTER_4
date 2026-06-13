<?php
/* Halaman Upload Material
   Simpan sebagai resources/views/dashboard/upload.php
   Mengharapkan variabel: $categories (list), $courses (list), $user (optional)
*/
$dbStatus = $dbStatus ?? false;
$user = $user ?? null;
$userName = $user['nama'] ?? null;
$userPhoto = $user['foto_profil'] ?? null;

function escape($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }
?>

<style>
    .hero-upload {
        background: linear-gradient(90deg,#EDE7FF 0%, #FFF4EC 100%);
        border-radius: 18px;
    }
    .card-upload { border-radius: 18px; border: 1px solid #EEF2FF; background: #fff; box-shadow: 0 20px 50px rgba(15,23,42,0.06); }
    .input-rounded { width:100%; padding:12px 14px; border-radius:12px; border:1px solid #E6E9F2; background:#FAFBFF; outline:none; }
    .btn-primary { background:#FFC436; color:#111827; padding:10px 28px; border-radius:12px; font-weight:700; border:none; cursor:pointer; }
    .upload-drop { border-radius:12px; border:1px dashed #E6E9F2; padding:22px; background:#FBFAFF; display:flex; align-items:center; justify-content:space-between; gap:12px; }
    .small-muted { font-size:13px; color:#6B7280; }
</style>

<div class="min-h-screen bg-slate-50 py-8">
    <div class="mx-auto max-w-6xl px-6">
        <header class="hero-upload p-6 mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm uppercase tracking-widest text-violet-600">Upload Material</p>
                <h1 class="text-2xl font-bold text-slate-900 mt-2">Complete the form below to upload your study materials.</h1>
            </div>
            <div class="flex items-center gap-4">
                <?php if ($user): ?>
                    <img src="<?= escape($userPhoto ?: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80') ?>" alt="avatar" class="h-10 w-10 rounded-full object-cover"/>
                    <span class="text-sm font-semibold"><?= escape($userName) ?></span>
                <?php else: ?>
                    <a href="/login" class="px-4 py-2 rounded-full bg-violet-600 text-white">Login</a>
                <?php endif; ?>
            </div>
        </header>

        <main class="card-upload p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Upload Material</h2>

            <form action="/materials/upload" method="post" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 small-muted">Category</label>
                        <select name="category" class="input-rounded">
                            <option value="">Select category...</option>
                            <?php if (isset($categories) && $categories): foreach ($categories as $cat): ?>
                                <option value="<?= escape($cat->kategori_id ?? '') ?>"><?= escape($cat->nama_kategori ?? $cat->name ?? 'Category') ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 small-muted">Title</label>
                        <input name="title" type="text" class="input-rounded" placeholder="Enter the title of the material..." required />
                    </div>

                    <div class="md:col-span-1">
                        <label class="block mb-2 small-muted">Description</label>
                        <textarea name="description" rows="5" class="input-rounded" placeholder="A short description or explanation of the material..."></textarea>
                    </div>

                    <div class="md:col-span-1">
                        <label class="block mb-2 small-muted">Course (optional)</label>
                        <select name="course" class="input-rounded">
                            <option value="">Select course...</option>
                            <?php if (isset($courses) && $courses): foreach ($courses as $c): ?>
                                <option value="<?= escape($c->id ?? '') ?>"><?= escape($c->nama_course ?? $c->title ?? 'Course') ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 small-muted">Material Type (PDF)</label>
                        <div class="upload-drop" id="uploadDrop">
                            <div class="flex items-center gap-4">
                                <div style="font-size:26px">📄</div>
                                <div>
                                    <div class="font-semibold text-slate-800">Upload PDF</div>
                                    <div class="small-muted">Drag & drop pdf files here or click to select</div>
                                </div>
                            </div>

                            <div style="display:flex;align-items:center;gap:12px">
                                <label for="materialFile" class="inline-block bg-amber-400 text-white px-4 py-2 rounded-lg cursor-pointer font-semibold">+ Select PDF File</label>
                                <input id="materialFile" name="material_file" type="file" accept=".pdf" style="display:none" required />
                            </div>
                        </div>
                        <p class="small-muted mt-2">File max. 500 MB. Only PDF files allowed.</p>
                        <div class="mt-2 small-muted" id="selectedFileText"></div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <a href="/home/courses" class="px-4 py-2 rounded-lg border">Cancel</a>
                    <button type="submit" class="btn-primary">Upload Material</button>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
(function () {
    var input = document.getElementById('materialFile');
    var drop = document.getElementById('uploadDrop');
    var selectedText = document.getElementById('selectedFileText');

    drop.addEventListener('click', function (e) {
        input.click();
    });

    input.addEventListener('change', function () {
        var f = input.files[0];
        if (!f) return selectedText.textContent = '';
        selectedText.textContent = f.name + ' (' + Math.round(f.size/1024) + ' KB)';
    });

    // Drag/drop support
    drop.addEventListener('dragover', function (e) { e.preventDefault(); drop.style.borderColor = '#FBBF24'; });
    drop.addEventListener('dragleave', function (e) { drop.style.borderColor = ''; });
    drop.addEventListener('drop', function (e) {
        e.preventDefault();
        var files = e.dataTransfer.files;
        if (!files || files.length === 0) return;
        var f = files[0];
        if (f.type !== 'application/pdf') {
            alert('Only PDF files are allowed.');
            return;
        }
        // populate input (works in modern browsers)
        input.files = files;
        selectedText.textContent = f.name + ' (' + Math.round(f.size/1024) + ' KB)';
    });
})();
</script>