<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
?>

<div class="container mx-auto px-4 py-10">
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-lg shadow-slate-200/50">
        <nav class="mb-6 flex flex-wrap justify-center gap-3 text-sm font-medium">
            <?php
            $tabs = [
                'beranda' => 'Beranda',
                'tentang' => 'Tentang Kami',
                'katalog' => 'Katalog',
            ];
            foreach ($tabs as $key => $label):
                $active = ($page === $key) ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200';
                $url = $key === 'beranda' ? '/index.php?url=home/index' : "/index.php?url=home/$key";
            ?>
                <a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>" class="rounded-full px-4 py-2 <?= $active ?> transition">
                    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <header class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="mt-4 text-lg text-slate-600"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        </header>

        <section class="grid gap-8 lg:grid-cols-2">
            <article class="rounded-2xl bg-slate-50 p-6 shadow-sm">
                <h2 class="text-2xl font-semibold text-slate-900">Tentang Edu Share</h2>
                <p class="mt-4 text-slate-700 leading-7">Tulis ringkasan singkat tentang misi organisasi, layanan yang disediakan, dan nilai utama yang ingin disebarkan kepada pengguna.</p>
                <div class="mt-6 space-y-4 text-slate-700">
                    <div>
                        <h3 class="font-semibold text-slate-900">Visi</h3>
                        <p class="mt-2">Tempat untuk menuliskan tujuan jangka panjang Edu Share.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900">Misi</h3>
                        <p class="mt-2">Cantumkan poin-poin misi utama, seperti pengembangan belajar mandiri, akses materi, dan kolaborasi siswa-guru.</p>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl bg-slate-50 p-6 shadow-sm">
                <h2 class="text-2xl font-semibold text-slate-900">Template Isi Halaman</h2>
                <ol class="mt-4 list-decimal space-y-3 pl-5 text-slate-700">
                    <li><span class="font-semibold text-slate-900">Judul Seksi:</span> Ceritakan latar belakang platform.</li>
                    <li><span class="font-semibold text-slate-900">Profil Singkat:</span> Jelaskan siapa pengguna utama dan manfaat utama.</li>
                    <li><span class="font-semibold text-slate-900">Nilai Kami:</span> Tuliskan nilai tambah yang ditawarkan.</li>
                    <li><span class="font-semibold text-slate-900">Rencana Pengembangan:</span> Isi dengan fitur yang ingin ditambahkan.</li>
                </ol>
            </article>
        </section>

        <section class="mt-8 rounded-2xl bg-slate-900 p-6 text-white">
            <h2 class="text-2xl font-semibold">Kontak & Tim</h2>
            <p class="mt-4 leading-7 text-slate-200">Gunakan area ini untuk menambahkan kontak, alamat, atau anggota tim yang bertanggung jawab atas Edu Share.</p>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-slate-800 p-4">
                    <h3 class="font-semibold">Kontak</h3>
                    <p class="mt-2 text-slate-300">Email: contact@edushare.example</p>
                    <p class="text-slate-300">Telepon: +62 812 3456 7890</p>
                </div>
                <div class="rounded-2xl bg-slate-800 p-4">
                    <h3 class="font-semibold">Tim</h3>
                    <p class="mt-2 text-slate-300">Nama Penanggung Jawab / Tim Produk</p>
                    <p class="text-slate-300">Jabatan dan peran singkat.</p>
                </div>
            </div>
        </section>

        <footer class="mt-10 border-t border-slate-200 pt-6 text-center text-sm text-slate-500">
            Halaman Tentang Kami di desain untuk mempermudah pengisian konten.
        </footer>
    </div>
</div>
