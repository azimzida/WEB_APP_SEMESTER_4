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
                'beranda' => 'Home',
                'tentang' => 'About Us',
                'katalog' => 'Catalog',
            ];
            foreach ($tabs as $key => $label):
                $active = ($page === $key) ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200';
                $url = $key === 'beranda' ? '/dashboard' : ($key === 'tentang' ? '/about' : '/catalog');
            ?>
                <a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>" class="rounded-full px-4 py-2 <?= $active ?> transition">
                    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                </a>
            <?php endforeach; ?>
                <a href="/login" class="rounded-full px-4 py-2 bg-violet-600 text-white transition hover:bg-violet-700">Login</a>
        </nav>

        <header class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="mt-4 text-lg text-slate-600"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        </header>

        <section class="grid gap-8 lg:grid-cols-2">
            <article class="rounded-2xl bg-slate-50 p-6 shadow-sm">
                <h2 class="text-2xl font-semibold text-slate-900">About Edu Share</h2>
                <p class="mt-4 text-slate-700 leading-7">Write a short summary about the platform's mission, services provided, and the main values you want to share with users.</p>
                <div class="mt-6 space-y-4 text-slate-700">
                    <div>
                        <h3 class="font-semibold text-slate-900">Vision</h3>
                        <p class="mt-2">A place to describe Edu Share's long-term goals.</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900">Mission</h3>
                        <p class="mt-2">List the main mission points, such as self-directed learning, content access, and student-teacher collaboration.</p>
                    </div>
                </div>
            </article>

            <article class="rounded-2xl bg-slate-50 p-6 shadow-sm">
                <h2 class="text-2xl font-semibold text-slate-900">Page Content Template</h2>
                <ol class="mt-4 list-decimal space-y-3 pl-5 text-slate-700">
                    <li><span class="font-semibold text-slate-900">Section Title:</span> Share the background of the platform.</li>
                    <li><span class="font-semibold text-slate-900">Brief Profile:</span> Describe the main users and core benefits.</li>
                    <li><span class="font-semibold text-slate-900">Our Values:</span> Write the added value you offer.</li>
                    <li><span class="font-semibold text-slate-900">Development Plan:</span> List the features you plan to add.</li>
                </ol>
            </article>
        </section>

        <section class="mt-8 rounded-2xl bg-slate-900 p-6 text-white">
            <h2 class="text-2xl font-semibold">Contact & Team</h2>
            <p class="mt-4 leading-7 text-slate-200">Use this area to add contact details, address, or team members responsible for Edu Share.</p>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl bg-slate-800 p-4">
                    <h3 class="font-semibold">Contact</h3>
                    <p class="mt-2 text-slate-300">Email: contact@edushare.example</p>
                    <p class="text-slate-300">Phone: +62 812 3456 7890</p>
                </div>
                <div class="rounded-2xl bg-slate-800 p-4">
                    <h3 class="font-semibold">Team</h3>
                    <p class="mt-2 text-slate-300">Product Owner / Team Representative</p>
                    <p class="text-slate-300">Role and brief responsibility.</p>
                </div>
            </div>
        </section>

        <footer class="mt-10 border-t border-slate-200 pt-6 text-center text-sm text-slate-500">
            The About Us page is designed to make content entry easier.
        </footer>
    </div>
</div>
