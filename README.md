<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=200&section=header&text=EduShare&fontSize=80&fontColor=fff&animation=twinkling&fontAlignY=35&desc=Platform%20Berbagi%20Materi%20Pembelajaran%20Digital&descAlignY=60&descSize=20" width="100%"/>

<p>
  <img src="https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/Composer-PSR--4-885630?style=for-the-badge&logo=composer&logoColor=white"/>
  <img src="https://img.shields.io/badge/Pattern-MVC-FF6B6B?style=for-the-badge&logo=abstract&logoColor=white"/>
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge"/>
</p>

<p>
  <img src="https://readme-typing-svg.demolab.com?font=Fira+Code&size=22&duration=3000&pause=500&color=6C63FF&center=true&vCenter=true&width=600&lines=📚+Berbagi+Materi+Pembelajaran+Digital;⚡+PHP+Native+%2B+Laravel-like+Architecture;🔐+Sistem+Autentikasi+Session-based;🗂️+Kelola+Kursus%2C+Kategori+%26+Materi;👤+Dashboard+Personal+%26+Profil+User"/>
</p>

</div>

---

## 📖 Tentang Project

> **EduShare** adalah platform web berbasis PHP native untuk berbagi materi pembelajaran keterampilan digital antar pengguna. Dibangun dengan arsitektur **MVC (Model-View-Controller)** terinspirasi dari Laravel, menggunakan **native PHP** dengan **PSR-4 autoloading** via Composer — tanpa framework berat!
>
> Proyek ini dikembangkan sebagai tugas akhir mata kuliah **Pemrograman Web** — Semester 4, Program Studi Sistem Informasi, UPN "Veteran" Jawa Timur, 2026.

<div align="center">

```
╔═══════════════════════════════════════════════════════════╗
║                  🎯 FITUR UNGGULAN                        ║
╠═══════════════════════════════════════════════════════════╣
║  📤  Upload & Berbagi Materi Pembelajaran Digital         ║
║  👤  Sistem Login & Registrasi Pengguna                   ║
║  📂  Manajemen Kursus & Kategori (4 Kategori Tersedia)   ║
║  🏠  Dashboard Personal & Halaman Guest                   ║
║  🔒  Session Management yang Aman                         ║
║  📊  Profil Pengguna                                      ║
║  ⚙️   Admin Dashboard Pengelolaan Konten                  ║
║  📥  Fitur Download Materi dengan Log Aktivitas           ║
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
│                              ┌─────────────────────┘           │
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
│   │   ├── 🗄️  Database.php          ← Koneksi DB (Singleton Pattern + PDO)
│   │   ├── 📦  Model.php             ← Base model class
│   │   └── 🔐  SessionManager.php   ← Manajemen sesi login
│   │
│   ├── 📂 Controllers/               ← Request handlers
│   │   ├── 🏠  HomeController.php    ← Dashboard, about, material, profile
│   │   └── 🔑  AuthController.php    ← Login, register, logout
│   │
│   ├── 📂 Models/                    ← Data access layer
│   │   ├── 👤  UserModel.php         ← Manajemen data pengguna
│   │   ├── 🏠  HomeModel.php         ← Data untuk homepage & dashboard
│   │   ├── 📚  CourseModel.php       ← Manajemen kursus (PHP, MySQL, Tailwind, dll)
│   │   ├── 🗂️  KategoriModel.php     ← Kategori materi (Programming, Database, dll)
│   │   └── 📄  MateriModel.php       ← Upload, download & manajemen materi
│   │
│   └── 📂 Views/                     ← Template files
│       ├── 📂 auth/
│       │   ├── login.php             ← Halaman login
│       │   └── register.php          ← Halaman registrasi
│       ├── 📂 dashboard/
│       │   ├── index.php             ← Dashboard utama (user login)
│       │   ├── about.php             ← Halaman tentang EduShare
│       │   ├── courses.php           ← Daftar kursus yang tersedia
│       │   ├── guest.php             ← Tampilan untuk non-login user
│       │   ├── material.php          ← Upload & tampil materi pembelajaran
│       │   └── profile.php           ← Profil pengguna
│       ├── 📂 errors/
│       │   └── 404.php               ← Halaman error 404
│       └── 📂 layouts/
│           └── main.php              ← Layout utama (header, navbar, footer)
│
├── 📂 uploads/
│   └── 📂 materials/                 ← File materi yang diupload pengguna
│
├── 📄 index.php                      ← Public entry point
├── 📄 schema.sql                     ← Skema database MySQL (kategori, course, materi)
├── 📄 composer.json                  ← Konfigurasi Composer PSR-4
├── 📄 composer.lock                  ← Lock file Composer
├── 📄 .htaccess                      ← URL rewriting (mod_rewrite)
├── 📄 .gitignore                     ← Ignore vendor/ & environment files
├── 📄 test_autoload.php              ← Script verifikasi autoloading
├── 📄 SETUP.md                       ← Panduan setup lengkap
└── 📄 VERIFICATION.md                ← Checklist verifikasi struktur project
```

---

## 🗄️ Database Schema

Database EduShare terdiri dari 3 tabel utama:

```sql
-- Tabel kategori materi
CREATE TABLE kategori (
    kategori_id  INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(100) NOT NULL,
    slug         VARCHAR(100) UNIQUE,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel kursus
CREATE TABLE course (
    id           INT PRIMARY KEY AUTO_INCREMENT,
    nama_course  VARCHAR(255) NOT NULL,
    deskripsi    TEXT,
    created_by   INT,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel materi pembelajaran
CREATE TABLE materi (
    id             INT PRIMARY KEY AUTO_INCREMENT,
    user_id        INT,
    course_id      INT NOT NULL,
    kategori_id    INT NOT NULL,
    judul          VARCHAR(255) NOT NULL,
    deskripsi      TEXT,
    file_materi    LONGBLOB,
    tanggal_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id)   REFERENCES course(id)   ON DELETE CASCADE,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE CASCADE
);
```

**Sample Data Kategori:**
- Programming
- Database
- UI/UX Design
- Web Development

**Sample Data Kursus:**
- PHP Dasar
- MySQL & Database
- Web Design dengan Tailwind

---

## 🗺️ Routing Table

| Method | URL | Controller | Action |
|--------|-----|------------|--------|
| GET | `/` | HomeController | index |
| GET | `/home/about` | HomeController | about |
| GET | `/home/material` | HomeController | material |
| GET | `/home/profile` | HomeController | profile |
| GET | `/home/courses` | HomeController | courses |
| GET | `/auth/login` | AuthController | login |
| POST | `/auth/login` | AuthController | login |
| GET | `/auth/register` | AuthController | register |
| POST | `/auth/register` | AuthController | register |
| GET | `/auth/logout` | AuthController | logout |

---

## 🛠️ Tech Stack

<div align="center">

| Layer | Teknologi |
|-------|-----------|
| **Backend** | PHP 8.x (Native) |
| **Database** | MySQL 8.0 (filess.io hosting) |
| **Autoloading** | Composer (PSR-4) |
| **Pattern** | MVC Architecture + Singleton DB |
| **DB Driver** | PDO |
| **Auth** | Session-based (SessionManager) |
| **Web Server** | Apache + .htaccess (mod_rewrite) |
| **Version Control** | Git + GitHub |

</div>

---

## 🚀 Cara Instalasi

### Prasyarat
- PHP 8.x atau lebih tinggi
- MySQL / MariaDB
- Composer
- Apache Web Server (XAMPP / Laragon)

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

Import `schema.sql` via phpMyAdmin atau jalankan:
```bash
mysql -u root -p < schema.sql
```

**4. Konfigurasi Koneksi Database**

Edit `app/Core/Database.php`:
```php
$host = '127.0.0.1';
$port = 3306;
$name = 'edushare';   // Nama database
$user = 'root';       // Username MySQL
$pass = '';           // Password MySQL
```

**5. Aktifkan mod_rewrite Apache**

Pastikan `.htaccess` aktif dan `mod_rewrite` sudah diaktifkan di konfigurasi Apache.

**6. Jalankan Aplikasi**
```
http://localhost/WEB_APP_SEMESTER_4
```

**7. Verifikasi Setup**
```bash
php test_autoload.php
```

---

## 🔧 Namespace Structure (PSR-4)

```json
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
        $data  = [
            'title'     => 'Daftar Materi EduShare',
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
        $stmt = $this->db->query('SELECT * FROM materi ORDER BY tanggal_upload DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
```

### Menggunakan Session Manager
```php
use App\Core\SessionManager;

$session = new SessionManager();

// Login user
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
# Regenerate Composer autoloader
composer dump-autoload

# Pastikan namespace sesuai path file:
# app/Controllers/HomeController.php → namespace App\Controllers;
```
</details>

<details>
<summary><b>❌ Database Connection Error</b></summary>

- Pastikan MySQL service sedang berjalan di XAMPP
- Cek kredensial di `app/Core/Database.php`
- Pastikan database sudah dibuat dan `schema.sql` sudah diimport
- Cek port MySQL (default: 3306)
</details>

<details>
<summary><b>❌ 404 Not Found</b></summary>

- Pastikan `mod_rewrite` Apache sudah aktif
- Cek konfigurasi `.htaccess` di root folder
- Verifikasi nama Controller dan method sudah sesuai routing
</details>

<details>
<summary><b>❌ Upload File Gagal</b></summary>

- Pastikan folder `uploads/materials/` memiliki permission write (755/777)
- Cek konfigurasi `upload_max_filesize` dan `post_max_size` di `php.ini`
- Pastikan `max_execution_time` cukup untuk file berukuran besar
</details>

---

## 📋 Checklist Status Project

- [x] Composer + PSR-4 Autoloading
- [x] Namespace implementation (Core, Controllers, Models)
- [x] MVC Architecture (Laravel-like)
- [x] Database Schema (kategori, course, materi)
- [x] Database Connection (Singleton PDO Pattern)
- [x] Session Management (SessionManager.php)
- [x] Authentication — Login & Register (AuthController)
- [x] Routing System (App.php URL parsing)
- [x] View Templates + Layout (main.php)
- [x] Dashboard (index, guest, about, profile, courses, material)
- [x] File Upload (uploads/materials/)
- [x] Error Handling (404 Page)
- [x] .htaccess URL Rewriting
- [x] Composer autoload verification (test_autoload.php)
- [ ] Unit Testing & Integration Testing
- [ ] Deployment ke Hosting (filess.io)

---

## 👨‍💻 Tim Pengembang — Grup 7

<div align="center">

| Nama | NPM | Peran | GitHub |
|------|-----|-------|--------|
| Azim Saqyal Huda | 24082010257 | Project Manager & Backend Dev | [![GitHub](https://img.shields.io/badge/GitHub-azimzida-181717?style=flat&logo=github)](https://github.com/azimzida) |
| Muhammad Fawwaz Sulthon | 24082010272 | Backend Developer | [![GitHub](https://img.shields.io/badge/GitHub-fawwaz1024-181717?style=flat&logo=github)](https://github.com/fawwaz1024) |
| Melinda Citrasena Cahyaningrum | 24082010247 | Frontend Developer | [![GitHub](https://img.shields.io/badge/GitHub-melindacitra09-181717?style=flat&logo=github)](https://github.com/melindacitra09) |

**Dosen Pengampu:**
Nambi Sembilu, S.Kom., M.Kom.

**Program Studi Sistem Informasi — Fakultas Ilmu Komputer**
**UPN "Veteran" Jawa Timur · Pemrograman Web · 2026**

</div>

---

<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&color=gradient&customColorList=6,11,20&height=100&section=footer" width="100%"/>

**EduShare** — Berbagi Ilmu, Tumbuh Bersama 📚

*Semester 4 Web Application Project · Pemrograman Web · April 2026*

</div>
