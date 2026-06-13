<?php
/* @var string $title */
/* @var string $page */
/* @var string $message */
/* @var object $course */
/* @var array $materials */
/* @var array $categories */
/* @var bool $notFound */
$dbStatus = $dbStatus ?? false;
$user = $user ?? null;
$userName = $user['nama'] ?? null;
$userPhoto = $user['foto_profil'] ?? null;

$categoryMap = [];
if (isset($categories) && $categories) {
    foreach ($categories as $cat) {
        $categoryMap[$cat->kategori_id ?? ''] = $cat->nama_kategori ?? $cat->name ?? $cat->nama ?? 'Category';
    }
}

function escape($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }
function nl2br_escape($v) { return nl2br(escape($v)); }
?>

<style>
    .detail-hero { background: linear-gradient(90deg,#EDE7FF 0%, #FFF3EC 100%); border-radius: 14px; padding: 28px; }
    .detail-panel { border-radius: 14px; background:#fff; padding:22px; border:1px solid #EEE7FF; box-shadow:0 18px 40px rgba(99,60,195,0.06); }
    .side-card { border-radius:12px; background:#fff; padding:18px; border:1px solid #F1ECFF; box-shadow:0 10px 30px rgba(99,60,195,0.04); }
    .badge-cat { display:inline-block; background:#FEEBC8; color:#92400E; padding:6px 12px; border-radius:8px; font-weight:700; }
    .btn-edit { background:#FBBF24; color:#111827; padding:8px 14px; border-radius:10px; font-weight:700; border:none; cursor:pointer; }
    .btn-delete { background:#EF4444; color:#fff; padding:8px 14px; border-radius:10px; font-weight:700; border:none; cursor:pointer; }
    .btn-confirm { background:#FFD08A; color:#111827; padding:12px 18px; border-radius:12px; font-weight:700; border:none; cursor:pointer; width:100%; }
    .back-btn { background: linear-gradient(90deg,#F99F8D, #FBBF9A); color:#fff; padding:10px 18px; border-radius:10px; display:inline-block; text-decoration:none; }
    .notfound-card { border-radius: 28px; background: #ffffff; padding: 48px 34px; box-shadow: 0 30px 60px rgba(15, 23, 42, 0.08); }
    .notfound-icon { width: 120px; height: 120px; border-radius: 50%; background: #F3E8FF; display: flex; align-items: center; justify-content: center; font-size: 46px; margin: 0 auto; color: #8B5CF6; }
    .notfound-title { color: #312E81; font-size: 2.25rem; font-weight: 800; margin-top: 24px; }
    .notfound-text { color: #6B7280; margin-top: 14px; }
    .btn-home { display: inline-flex; align-items: center; justify-content: center; margin-top: 28px; border-radius: 14px; background: #FBBF24; color: #111827; padding: 14px 28px; font-weight: 700; text-decoration: none; transition: opacity .2s ease; }
    .btn-home:hover { opacity: .95; }
</style>

<?php if (!empty($notFound)): ?>
    <div class="min-h-screen bg-slate-50 p-8">
        <div class="mx-auto max-w-4xl">
            <div class="notfound-card text-center">
                <div class="notfound-icon">📘</div>
                <h2 class="notfound-title">OOPS, Material not found</h2>
                <p class="notfound-text">material may have been removed</p>
                <a href="/home/courses" class="btn-home">Back to Home</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="min-h-screen bg-slate-50 p-8">
        <div class="mx-auto max-w-6xl space-y-6">
            <div class="detail-hero">
                <h2 class="text-2xl font-bold">Detail Material</h2>
                <p class="text-sm text-slate-600 mt-2">The following is learning material in the <strong><?= escape($categoryMap[$course->kategori_id ?? ''] ?? 'uncategorized') ?></strong> category.</p>
            </div>

            <div class="grid gap-6 lg:grid-cols-[2fr_360px]">
                <section class="detail-panel">
                    <div class="flex items-start gap-4">
                        <div style="width:72px;height:72px;border-radius:12px;background:#F3E8FF;display:flex;align-items:center;justify-content:center;font-size:28px">📚</div>
                        <div class="flex-1">
                            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px">
                                <div>
                                    <h3 style="font-size:24px;color:#452A75;margin:0;font-weight:800"><?= escape($course->nama_course ?? 'Untitled') ?></h3>
                                    <div style="margin-top:8px">
                                        <span class="badge-cat"><?= escape($categoryMap[$course->kategori_id ?? ''] ?? 'Course') ?></span>
                                    </div>
                                </div>
                                <div>
                                    <span style="display:inline-block;background:#10B981;color:#fff;padding:6px 10px;border-radius:8px;font-weight:700">NEW</span>
                                </div>
                            </div>

                            <hr style="border:none;border-top:1px solid #F1EAFE;margin:18px 0">

                            <p style="color:#6B7280;"><?= nl2br_escape($course->deskripsi ?? 'No description available.') ?></p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 style="color:#452A75;font-weight:700;margin-bottom:12px">Detail</h4>
                        <div style="color:#374151;line-height:1.8">
                            <?= nl2br_escape($course->deskripsi ?? 'No further details.') ?>
                        </div>
                    </div>
                </section>

                <aside class="space-y-6">
                    <div class="side-card">
                        <h4 style="margin:0 0 12px 0;color:#6B21A8;font-weight:700">Material Information</h4>
                        <div style="font-size:14px;color:#374151;line-height:1.8">
                            <div><strong>Category</strong> : <?= escape($categoryMap[$course->kategori_id ?? ''] ?? 'Uncategorized') ?></div>
                            <div><strong>Date</strong> : <?= escape($course->tanggal_upload ?? $course->created_at ?? '-') ?></div>
                        </div>

                        <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap">
                            <form method="get" action="/course/<?= escape($course->id ?? '') ?>/edit" style="display:inline">
                                <button type="submit" class="btn-edit">Edit</button>
                            </form>

                            <form method="post" action="/materials/delete" onsubmit="return confirm('Hapus materi ini?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= escape($course->id ?? '') ?>" />
                                <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </div>
                    </div>

                    <div class="side-card">
                        <button class="btn-confirm" onclick="alert('Confirmed');">Confirmation</button>
                    </div>
                </aside>
            </div>

            <div class="flex justify-end">
                <a href="/home/courses" class="back-btn">Back</a>
            </div>
        </div>
    </div>
<?php endif; ?>