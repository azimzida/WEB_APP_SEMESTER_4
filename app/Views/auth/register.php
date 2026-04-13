<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
?>

<div class="min-h-screen bg-gradient-to-br from-slate-100 via-violet-100 to-slate-200 py-12">
    <div class="mx-auto flex max-w-6xl flex-col overflow-hidden rounded-[2rem] bg-white shadow-2xl shadow-violet-200/40 lg:flex-row">
        <div class="flex w-full flex-col gap-8 p-8 sm:p-10 lg:w-1/2 lg:p-14">
            <div>
                <a href="/dashboard" class="inline-flex items-center gap-3 rounded-full bg-violet-100 px-4 py-2 text-sm font-semibold text-violet-700 hover:bg-violet-200 transition">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-violet-600 text-white">E</span>
                    Edu Share
                </a>
                <h1 class="mt-8 text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Buat akun baru</h1>
                <p class="mt-4 max-w-xl text-lg leading-8 text-slate-600"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
                <?php if (!empty($errors)): ?>
                    <div class="mt-6 rounded-3xl border border-rose-200 bg-rose-50 p-4 text-rose-700">
                        <ul class="list-disc list-inside space-y-1">
                            <?php foreach ($errors as $error): ?>
                                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

            <form method="POST" action="/register" class="space-y-6">
                <div>
                    <label for="fullname" class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                    <input id="fullname" name="fullname" type="text" placeholder="Masukan nama lengkap" class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 outline-none transition focus:border-violet-500 focus:ring-2 focus:ring-violet-200" />
                </div>

                <div>
                    <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
                    <input id="email" name="email" type="email" placeholder="Masukan email" class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 outline-none transition focus:border-violet-500 focus:ring-2 focus:ring-violet-200" />
                </div>

                <div>
                    <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukan password" class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 outline-none transition focus:border-violet-500 focus:ring-2 focus:ring-violet-200" />
                </div>

                <div>
                    <label for="phone" class="text-sm font-semibold text-slate-700">Nomor HP</label>
                    <input id="phone" name="phone" type="tel" placeholder="Masukan nomor HP" class="mt-3 w-full rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4 text-slate-900 outline-none transition focus:border-violet-500 focus:ring-2 focus:ring-violet-200" />
                </div>

                <button type="submit" class="w-full rounded-full bg-violet-600 px-6 py-4 text-sm font-semibold text-white shadow-lg shadow-violet-500/20 transition hover:bg-violet-700">Sign Up</button>
            </form>

            <p class="text-center text-sm text-slate-600">Sudah punya akun? <a href="/login" class="font-semibold text-violet-600 hover:text-violet-700">Login di sini</a></p>
        </div>

        <div class="relative hidden lg:block lg:w-1/2">
            <div class="absolute inset-0 bg-gradient-to-br from-violet-500 via-fuchsia-500 to-purple-500"></div>
            <div class="absolute inset-y-0 right-0 hidden w-1/2 rounded-bl-[2rem] bg-white/10 lg:block"></div>
            <div class="relative h-full p-10">
                <div class="absolute right-0 top-8 h-32 w-32 rounded-full bg-white/15 blur-3xl"></div>
                <div class="absolute left-10 bottom-10 h-40 w-40 rounded-full bg-white/20 blur-2xl"></div>
                <div class="relative mx-auto mt-16 h-full max-w-md rounded-[2rem] border border-white/20 bg-white/10 p-8 text-white backdrop-blur-xl">
                    <p class="text-sm uppercase tracking-[0.3em] text-white/70">Welcome to Edu Share</p>
                    <h2 class="mt-4 text-3xl font-semibold">Akses semua materi pembelajaran</h2>
                    <p class="mt-6 text-slate-100 leading-7">Daftar sekarang dan mulai belajar dengan panduan terstruktur, mentor, dan komunitas aktif.</p>
                    <div class="mt-10 grid gap-4">
                        <div class="rounded-[1.75rem] bg-white/10 p-5">
                            <p class="text-sm uppercase tracking-[0.3em] text-white/70">Kursus</p>
                            <p class="mt-3 font-semibold">Linux, SQL, JavaScript</p>
                        </div>
                        <div class="rounded-[1.75rem] bg-white/10 p-5">
                            <p class="text-sm uppercase tracking-[0.3em] text-white/70">Komunitas</p>
                            <p class="mt-3 font-semibold">Bergabung dengan pelajar lain</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
