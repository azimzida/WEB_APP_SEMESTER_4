<div align="center">

<!-- Animated Header -->
<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=200&section=header&text=EduShare&fontSize=80&fontColor=fff&animation=twinkling&fontAlignY=35&desc=Platform%20Berbagi%20Materi%20Edukasi&descAlignY=60&descSize=20" width="100%"/>

<!-- Badges -->
<p>
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/Composer-PSR--4-885630?style=for-the-badge&logo=composer&logoColor=white"/>
  <img src="https://img.shields.io/badge/Pattern-MVC-FF6B6B?style=for-the-badge&logo=abstract&logoColor=white"/>
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge"/>
</p>

<p>
  <img src="https://readme-typing-svg.demolab.com?font=Fira+Code&size=22&duration=3000&pause=500&color=6C63FF&center=true&vCenter=true&width=600&lines=📚+Berbagi+Materi+Edukasi+dengan+Mudah;⚡+PHP+Native+%2B+Laravel-like+Architecture;🔐+Sistem+Autentikasi+yang+Aman;🗂️+Kelola+Kursus+dan+Materi"/>
</p>

</div>

---

## 📖 Tentang Project

> **EduShare** adalah aplikasi web berbasis PHP native untuk berbagi materi edukasi antar pengguna. Dibangun dengan arsitektur **MVC (Model-View-Controller)** yang terinspirasi dari Laravel, namun menggunakan **native PHP** dengan **PSR-4 autoloading** via Composer — tanpa framework berat!

<div align="center">

```
╔═══════════════════════════════════════════════════════════╗
║                  🎯 FITUR UNGGULAN                        ║
╠═══════════════════════════════════════════════════════════╣
║  📤  Upload & Berbagi Materi Edukasi                      ║
║  👤  Sistem Login & Registrasi Pengguna                   ║
║  📂  Manajemen Kursus & Kategori                          ║
║  🏠  Dashboard Personal                                   ║
║  🔒  Session Management yang Aman                         ║
║  📊  Profil Pengguna                                      ║
╚═══════════════════════════════════════════════════════════╝
```

</div>

---

## 🏗️ Arsitektur Sistem

```
┌─────────────────────────────────────────────────────────────────┐
│                        REQUEST FLOW                             │
│                                                                 │
│   Browser ──► index.php ──► bootstrap.php ──► App (Router)     │
│                                                    │            │
│                              ┌─────────────────────┘            │
│                              ▼                                  │
│                     ┌──────────────┐                            │
│                     │  Controller  │◄──── SessionManager        │
│                     └──────┬───────┘                            │
│                            │                                    │
│               ┌────────────┼────────────┐                       │
│               ▼            ▼            ▼                       │
│           [ Model ]    [ View ]    [ Database ]                 │
│           (Data)      (Template)   (MySQL/PDO)                  │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📁 Struktur Project

```
WEB_APP_SEMESTER_4/
│
├── 📂 app/
│   ├── 📄 bootstrap.php              ← Entry point, load Composer autoloader
│   │
│   ├── 📂 Core/                      ← Framework inti
│   │   ├── ⚙️  App.php               ← Router & dispatcher
│   │   ├── 🎮  Controller.php        ← Base controller class
│   │   ├── 🗄️  Database.php          ← Koneksi DB (Singleton Pattern)
│   │   ├── 📦  Model.php             ← Base model class
│   │   └── 🔐  SessionManager.php   ← Manajemen sesi login
│   │
│   ├── 📂 Controllers/               ← Request handlers
│   │   ├── 🏠  HomeController.php
│   │   └── 🔑  AuthController.php
│   │
│   ├── 📂 Models/                    ← Data access layer
│   │   ├── 👤  UserModel.php
│   │   ├── 🏠  HomeModel.php
│   │   ├── 📚  CourseModel.php
│   │   ├── 🗂️  KategoriModel.php
│   │   └── 📄  MateriModel.php
│   │
│   └── 📂 Views/                     ← Template files
│       ├── 📂 auth/
│       │   ├── login.php
│       │   └── register.php
│       ├── 📂 dashboard/
│       │   ├── index.php
│       │   ├── about.php
│       │   ├── courses.php
│       │   ├── guest.php
│       │   ├── material.php
│       │   └── profile.php
│       ├── 📂 errors/
│       │   └── 404.php
│       └── 📂 layouts/
│           └── main.php
│
├── 📂 uploads/
│   └── 📂 materials/                 ← File materi yang diupload
│
├── 📄 index.php                      ← Public entry point
├── 📄 schema.sql                     ← Skema database MySQL
├── 📄 composer.json                  ← Konfigurasi Composer
├── 📄 .htaccess                      ← URL rewriting
├── 📄 SETUP.md
└── 📄 VERIFICATION.md
```

---

## 🗺️ Routing Table

| Method | URL | Controller | Action |
|--------|-----|------------|--------|
| GET | `/` | HomeController | index |
| GET | `/auth/login` | AuthController | login |
| POST | `/auth/login` | AuthController | login |
| GET | `/auth/register` | AuthController | register |
| POST | `/auth/register` | AuthController | register |
| GET | `/auth/logout` | AuthController | logout |
| GET | `/home/about` | HomeController | about |
| GET | `/home/material` | HomeController | material |

---

## 🛠️ Tech Stack

<div align="center">

| Layer | Teknologi |
|-------|-----------|
| **Backend** | PHP 8.x (Native) |
| **Database** | MySQL 8.0 |
| **Autoloading** | Composer (PSR-4) |
| **Pattern** | MVC Architecture |
| **DB Driver** | PDO |
| **Auth** | Session-based |
| **Web Server** | Apache + .htaccess |

</div>

---

## 🚀 Cara Instalasi

### Prasyarat
Pastikan sudah terinstall:
- PHP 8.x atau lebih tinggi
- MySQL / MariaDB
- Composer
- Apache Web Server (atau XAMPP/Laragon)

### Langkah-langkah

**1. Clone Repository**
```bash
git clone https://github.com/azimzida/WEB_APP_SEMESTER_4.git
cd WEB_APP_SEMESTER_4
```

**2. Install Dependencies via Composer**
```bash
composer install
```

**3. Setup Database**
```bash
# Buka MySQL dan jalankan schema:
mysql -u root -p < schema.sql
```

Atau import `schema.sql` melalui phpMyAdmin.

**4. Konfigurasi Koneksi Database**

Edit file `app/Core/Database.php`:
```php
$host = '127.0.0.1';
$port = 3306;
$name = 'edushare';    // ← Nama database
$user = 'root';        // ← Username MySQL
$pass = '';            // ← Password MySQL
```

**5. Konfigurasi Web Server**

Pastikan document root mengarah ke folder project dan `.htaccess` sudah aktif (mod_rewrite enabled).

**6. Jalankan Aplikasi**

Buka browser dan akses:
```
http://localhost/WEB_APP_SEMESTER_4
```

---

## 🔧 Namespace Structure (PSR-4)

```php
// composer.json autoload mapping:
"autoload": {
    "psr-4": {
        "App\\": "app/"
    }
}
```

| Namespace | Path |
|-----------|------|
| `App\Core\*` | `app/Core/*.php` |
| `App\Controllers\*` | `app/Controllers/*.php` |
| `App\Models\*` | `app/Models/*.php` |

---

## 💡 Contoh Penggunaan

### Membuat Controller Baru
```php
<?php

namespace App\Controllers;

use App\Core\Controller;

class MaterialController extends Controller
{
    public function index()
    {
        $model = $this->model('MateriModel');
        $data = [
            'title'    => 'Daftar Materi',
            'materials' => $model->findAll(),
        ];
        $this->view('dashboard/material', $data);
    }
}
```

### Membuat Model Baru
```php
<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Database;
use PDO;

class MateriModel extends Model
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM materi');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
```

### Menggunakan Session Manager
```php
use App\Core\SessionManager;

$session = new SessionManager();

// Login
$session->login($user['email']);

// Cek status login
if ($session->isLoggedIn()) {
    $user = $session->getUser();
}

// Logout
$session->logout();
```

---

## 🔍 Perbandingan dengan Laravel

| Aspek | Laravel | EduShare (Native PHP) |
|-------|---------|----------------------|
| Namespace | PSR-4 | ✅ PSR-4 |
| Autoloading | Composer | ✅ Composer |
| Routing | `routes/web.php` | ✅ URL parsing di `App.php` |
| Controllers | `app/Http/Controllers` | ✅ `app/Controllers` |
| Models | `app/Models` | ✅ `app/Models` |
| Views | `resources/views` | ✅ `app/Views` |
| Database | Eloquent ORM | ✅ PDO Singleton |
| Session | Laravel Session | ✅ `SessionManager.php` |

---

## 🐛 Troubleshooting

<details>
<summary><b>❌ Class Not Found Error</b></summary>

```bash
# Pastikan namespace sesuai dengan path file
# Jalankan perintah ini untuk regenerate autoloader:
composer dump-autoload
```
</details>

<details>
<summary><b>❌ Database Connection Error</b></summary>

- Pastikan service MySQL sedang berjalan
- Cek kredensial di `app/Core/Database.php`
- Pastikan database `edushare` sudah dibuat dan schema sudah diimport
</details>

<details>
<summary><b>❌ 404 Not Found</b></summary>

- Pastikan `mod_rewrite` Apache sudah aktif
- Cek konfigurasi `.htaccess`
- Verifikasi nama Controller dan method sudah benar
</details>

---

## 📋 Checklist Status Project

- [x] Composer + PSR-4 Autoloading
- [x] Namespace implementation (Core, Controllers, Models)
- [x] MVC Architecture
- [x] Database Connection (Singleton Pattern)
- [x] Session Management
- [x] Authentication (Login & Register)
- [x] Routing System
- [x] View Templates
- [x] File Upload (Materials)
- [x] Error Handling (404 Page)

---

## 👨‍💻 Developer

<div align="center">

**azimzida**

[![GitHub](https://img.shields.io/badge/GitHub-azimzida-181717?style=for-the-badge&logo=github)](https://github.com/azimzida)

</div>

---

<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=100&section=footer" width="100%"/>

**EduShare** — Berbagi Ilmu, Tumbuh Bersama 📚

*Semester 4 Web Application Project · April 2026*

</div>
