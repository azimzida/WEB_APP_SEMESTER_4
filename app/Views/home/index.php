<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
?>

<div class="container mx-auto px-4 py-10">
    <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-lg shadow-slate-200/50">
        <nav class="mb-6 flex flex-wrap justify-center gap-3 text-sm font-medium" data-animate>
            <?php
            $tabs = [
                'beranda' => 'Beranda',
                'about' => 'Tentang Kami',
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
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl opacity-0 translate-y-6 transition duration-700 ease-out" data-animate><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="mt-4 text-lg text-slate-600 opacity-0 translate-y-6 transition duration-700 ease-out delay-150" data-animate><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        </header>

        <main class="grid gap-6 md:grid-cols-2">
            <section class="rounded-2xl bg-slate-50 p-6 opacity-0 translate-y-6 transition duration-700 ease-out" data-animate>
                <h2 class="text-2xl font-semibold text-slate-900">What you get</h2>
                <ul class="mt-4 space-y-3 text-slate-700">
                    <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">✓</span> Clean MVC structure</li>
                    <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">✓</span> Controller, model, and view separation</li>
                    <li class="flex gap-3"><span class="mt-1 inline-flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">✓</span> Easy extensibility for Edu Share</li>
                </ul>
            </section>

            <section class="rounded-2xl bg-slate-900 p-6 text-white">
                <h2 class="text-2xl font-semibold">Get started</h2>
                <p class="mt-4 leading-7 text-slate-200">Buka `app/Controllers`, `app/Models`, dan `app/Views` untuk menambahkan fitur baru.</p>
                <div class="mt-6 rounded-2xl bg-slate-800 p-4">
                    <code class="block overflow-x-auto text-sm text-slate-100">/index.php?url=home/about</code>
                </div>
            </section>
        </main>

        <footer class="mt-10 border-t border-slate-200 pt-6 text-center text-sm text-slate-500">
            Built with PHP, MVC, and Tailwind CSS.
        </footer>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const elements = document.querySelectorAll('[data-animate]');
        const observerOptions = {
            threshold: 0.15,
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('opacity-100', 'translate-y-0');
                entry.target.classList.remove('opacity-0', 'translate-y-6');
                observer.unobserve(entry.target);
            });
        }, observerOptions);

        elements.forEach(element => {
            observer.observe(element);
        });
    });
</script>
