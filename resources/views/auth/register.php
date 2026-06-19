<?php
/* @var string $title */
/* @var string $name */
/* @var string $page */
/* @var string $message */
?>

<style>
    /* Background utama split: kiri putih, kanan ungu melengkung menggunakan radial-gradient */
    .page-bg {
        background-color: #FFFFFF;
        background-image: radial-gradient(circle 900px at calc(100% - 100px) 30%, #7E7089 0%, #5E526A 55%, #FFFFFF 55.1%);
        background-attachment: fixed;
    }

    /* Responsif untuk layar mobile/tablet agar gradasinya membagi atas-bawah */
    @media (max-width: 1023px) {
        .page-bg {
            background: linear-gradient(180deg, #FFFFFF 50%, #5E526A 50%);
        }
    }

    /* Floating soft circles background di sebelah kiri */
    .hero-container {
        position: relative;
    }
    
    .hero-container::before {
        content: '';
        position: absolute;
        width: 120px;
        height: 120px;
        background: #E8E5F7;
        border-radius: 50%;
        top: 15%;
        left: 10%;
        z-index: 0;
        opacity: 0.7;
    }

    /* Desain mockup monitor/dashboard di sebelah kiri */
    .mockup-monitor {
        background: #FFFFFF;
        border-radius: 28px;
        box-shadow: 0 30px 70px rgba(165, 140, 190, 0.25);
        border: 1px solid #E2E8F0;
        z-index: 10;
        position: relative;
    }

    .sidebar-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .sidebar-btn.active {
        background: #EEF2FF;
        color: #4338CA;
    }

    .mini-card {
        border-radius: 12px;
        padding: 12px;
        border: 1px solid #F1F5F9;
    }

    /* Desain form panel di sebelah kanan (Transparan Gelap / Glassmorphism) */
    .form-panel-dark {
        background: transparent;
        color: #FFFFFF;
    }

    /* Mengubah warna teks judul Sign Up sesuai request */
    .text-signup-title {
        color: #3E374B;
    }

    /* Label input dengan warna abu-abu elegan sesuai foto */
    .label-custom {
        color: #A3A3A3;
        font-size: 0.95rem;
        margin-bottom: 6px;
        display: block;
    }

    /* Input pill gelap transparan */
    .input-pill-dark {
        width: 100%;
        border-radius: 999px;
        border: none;
        background: rgba(0, 0, 0, 0.18);
        padding: 14px 24px;
        color: #FFFFFF;
        outline: none;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: background 0.3s ease;
    }

    .input-pill-dark:focus {
        background: rgba(0, 0, 0, 0.25);
    }

    /* Tombol Sign Up ungu glossy gradual */
    .submit-btn-dark {
        width: 100%;
        border-radius: 999px;
        background: linear-gradient(180deg, #7C6E8F 0%, #584B6B 100%);
        color: #FFFFFF;
        padding: 14px 24px;
        font-weight: 600;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.2);
        transition: opacity 0.2s ease;
    }

    .submit-btn-dark:hover {
        opacity: 0.9;
    }
</style>

<div class="min-h-screen page-bg flex items-center">
    <div class="mx-auto w-full max-w-7xl px-6 py-12 lg:px-12 flex flex-col lg:flex-row items-center justify-between gap-16">
        
        <div class="w-full lg:w-1/2 hero-container flex flex-col justify-center items-start">
            <div class="flex items-center gap-2 mb-12 z-10">
                <span class="text-3xl text-indigo-600">🎓</span>
                <span class="text-2xl font-bold text-purple-900 tracking-tight">Edu Share</span>
            </div>

            <div class="w-full max-w-xl relative z-10">
                <img src="<?= asset('images/bg-card.png') ?>" alt="Edu Share Dashboard Mockup" class="w-full h-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-300">
            </div>
        </div>

        <div class="w-full lg:w-5/12 flex justify-center lg:justify-end z-10">
            <div class="w-full max-w-md form-panel-dark">
                <div class="mb-8">
                    <h1 class="text-4xl font-semibold tracking-wide text-signup-title">Sign Up</h1>
                </div>

                <form method="POST" action="/register" class="space-y-5">
                    <?= csrf_field() ?>

                    <div>
                        <label for="fullname" class="label-custom">Name</label>
                        <input id="fullname" name="fullname" type="text" class="input-pill-dark" required />
                    </div>

                    <div>
                        <label for="email" class="label-custom">Email</label>
                        <input id="email" name="email" type="email" class="input-pill-dark" required />
                    </div>

                    <div>
                        <label for="password" class="label-custom">Password</label>
                        <input id="password" name="password" type="password" class="input-pill-dark" required />
                    </div>

                    <div>
                        <label for="phone" class="label-custom">Telephone</label>
                        <input id="phone" name="phone" type="tel" class="input-pill-dark" required />
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="submit-btn-dark">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>