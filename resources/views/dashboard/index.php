<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
$dbStatus = $dbStatus ?? false;
$dbStatusMessage = $dbStatusMessage ?? 'Database status unavailable.';
$user = $user ?? null;
$userName = $user['nama'] ?? null;
?>

<style>
    /* Background melengkung lembut khas layout Edu Share */
    .landing-bg {
        background-color: #FFFFFF;
        background-image: radial-gradient(circle 1000px at calc(100% - 100px) 40%, #F5F0FF 0%, #FAF7FF 60%, #FFFFFF 60.1%);
        background-attachment: fixed;
    }

    /* Modifikasi responsif jika di mobile agar gradasi membagi atas bawah */
    @media (max-width: 1023px) {
        .landing-bg {
            background: linear-gradient(180deg, #FFFFFF 40%, #FAF7FF 100%);
        }
    }

    /* Garis bawah aktif pada navigasi menu utama */
    .nav-link-active {
        color: #111827;
        position: relative;
    }

    .nav-link-active::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: #3E374B;
        border-radius: 99px;
    }

    /* Styling tombol navigasi kanan */
    .btn-nav-login {
        border: 2px solid #584B6B;
        color: #584B6B;
        font-weight: 600;
        border-radius: 12px;
        padding: 8px 24px;
        transition: all 0.2s ease;
    }

    .btn-nav-login:hover {
        background-color: #F3EEFF;
    }

    .btn-nav-signup {
        background: linear-gradient(180deg, #6C5E7F 0%, #4E4260 100%);
        color: #FFFFFF;
        font-weight: 600;
        border-radius: 12px;
        padding: 8px 24px;
        box-shadow: 0 4px 12px rgba(78, 66, 96, 0.2);
        transition: opacity 0.2s ease;
    }

    .btn-nav-signup:hover {
        opacity: 0.9;
    }

    /* Warna Teks Judul Hero Utama */
    .hero-title-dark {
        color: #111827;
    }

    .hero-title-purple {
        color: #584B6B;
    }

    /* Mockup Monitor Besar di Sebelah Kanan */
    .monitor-frame {
        background: #FFFFFF;
        border-radius: 32px;
        box-shadow: 0 40px 90px rgba(140, 120, 160, 0.15);
        border: 1px solid #EAF0F6;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .sidebar-item.active {
        background: #F3EEFF;
        color: #584B6B;
    }

    /* Card Course Mini di dalam monitor */
    .course-box {
        border-radius: 14px;
        padding: 14px;
        text-align: center;
        border: 1px solid #F1F5F9;
    }

    /* Floating bubble hiasan di latar belakang */
    .bubble-decoration {
        position: absolute;
        border-radius: 50%;
        background: #EBE6F8;
        opacity: 0.6;
        z-index: 0;
    }
</style>

<div class="min-h-screen landing-bg flex flex-col justify-between">
    <div class="mx-auto w-full max-w-7xl px-6 py-6 lg:px-12">
        
        <header class="flex items-center justify-between py-4 mb-16 relative z-10">
            <div class="flex items-center gap-2">
                <span class="text-3xl">🎓</span>
                <span class="text-2xl font-bold tracking-tight text-purple-900" style="color: #4E4260;">Edu Share</span>
            </div>

            <nav class="hidden md:flex items-center gap-8 text-base font-semibold text-slate-500">
                <a href="/dashboard" class="nav-link-active">Home</a>
                <a href="/home/courses" class="hover:text-slate-900 transition">Course</a>
                <a href="/materials/upload" class="hover:text-slate-900 transition">Upload</a>
                <a href="/download" class="hover:text-slate-900 transition">Download</a>
            </nav>

            <div class="flex items-center gap-3">
                <?php if ($user): ?>
                    <a href="/profile" class="rounded-full bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">Hi, <?= htmlspecialchars($userName, ENT_QUOTES, 'UTF-8') ?></a>
                    <a href="/logout" class="rounded-full bg-rose-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-rose-700">Logout</a>
                <?php else: ?>
                    <a href="/login" class="btn-nav-login text-sm">Login</a>
                    <a href="/register" class="btn-nav-signup text-sm">Sign Up</a>
                <?php endif; ?>
            </div>
        </header>

        <main class="relative grid gap-12 lg:grid-cols-2 lg:items-center pt-4">
            
            <div class="bubble-decoration w-16 h-16 top-[-40px] left-[20%]" style="width: 60px; height: 60px;"></div>
            <div class="bubble-decoration w-24 h-24 bottom-[-6px] left-[5%]" style="width: 90px; height: 90px;"></div>

            <div class="space-y-6 relative z-10">
                <h1 class="text-5xl font-bold tracking-tight leading-[1.15] sm:text-6xl">
                    <span class="hero-title-dark block">Share Knowledge.</span>
                    <span class="hero-title-purple block mt-1">Learn Together.</span>
                </h1>
                <p class="max-w-md text-base leading-relaxed text-slate-500 font-medium">
                    Edu Share is a web-based learning platform where students can share, discover, and access digital learning materials easily.
                </p>
            </div>

            <div class="w-full flex justify-center lg:justify-end relative">
                <div class="bubble-decoration absolute top-[-50px] right-[40%] w-24 h-24" style="width: 100px; height: 100px;"></div>
                <div class="bubble-decoration absolute bottom-[-40px] right-[10%] w-14 h-14" style="width: 50px; height: 50px;"></div>

                <div class="w-full max-w-xl monitor-frame p-6 relative z-10">
                    <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-5">
                        <div class="flex items-center gap-2">
                            <span class="text-purple-800 font-bold text-sm">🎓 Edu Share</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-400 text-sm">
                            <span>🔔</span>
                            <div class="w-6 h-6 rounded-full bg-purple-200"></div>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="w-1/4 space-y-1 hidden sm:block">
                            <div class="sidebar-item active">🏠 Home</div>
                            <div class="sidebar-item text-slate-400">👥 Course</div>
                            <div class="sidebar-item text-slate-400">📤 Upload</div>
                            <div class="sidebar-item text-slate-400">📥 Download</div>
                        </div>

                        <div class="w-full sm:w-3/4 space-y-5">
                            <div>
                                <p class="text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-3">Popular Course</p>
                                <div class="grid grid-cols-3 gap-3 text-center text-[10px]">
                                    <div class="course-box bg-purple-50 text-purple-800 border-purple-100">
                                        <div class="font-extrabold text-base mb-1">▶</div>
                                        <span class="text-[9px] font-bold block">Javascript-Basics</span>
                                    </div>
                                    <div class="course-box bg-orange-50 text-orange-700 border-orange-100">
                                        <div class="font-extrabold text-base mb-1">🎨</div>
                                        <span class="text-[9px] font-bold block">UI/UX Design</span>
                                    </div>
                                    <div class="course-box bg-teal-50 text-teal-700 border-teal-100">
                                        <div class="font-extrabold text-base mb-1">💾</div>
                                        <span class="text-[9px] font-bold block">Database 101</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <p class="text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-2">Recently Uploaded</p>
                                <div class="space-y-2 text-[10px] font-semibold">
                                    <div class="flex justify-between items-center bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                        <div class="flex items-center gap-2">
                                            <span class="text-orange-500">📄</span>
                                            <span class="text-slate-600">Programming Fundamentals.ppt</span>
                                        </div>
                                        <span class="text-slate-400 cursor-pointer hover:text-slate-700">📥</span>
                                    </div>
                                    <div class="flex justify-between items-center bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                        <div class="flex items-center gap-2">
                                            <span class="text-blue-500">📄</span>
                                            <span class="text-slate-600">Web Design Guide.odt</span>
                                        </div>
                                        <span class="text-slate-400 cursor-pointer hover:text-slate-700">📥</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-6 -left-6 flex items-end justify-between w-[108%] pointer-events-none px-4 z-20">
                        <span class="text-6xl filter drop-shadow-md">👩‍💻</span>
                        <span class="text-6xl filter drop-shadow-md" style="margin-bottom: -10px;">👨‍💻</span>
                    </div>
                </div>
            </div>

        </main>
    </div>
    
    <div class="py-4"></div>
</div>