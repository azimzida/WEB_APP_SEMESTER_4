# EduShare Web Application - Project Structure & Setup

## Deskripsi
EduShare adalah aplikasi web untuk berbagi materi edukasi dengan struktur yang mirip Laravel tetapi menggunakan native PHP dengan PSR-4 autoloading via Composer.

## Struktur Project

```
WEB_APP_SEMESTER_4/
├── app/
│   ├── bootstrap.php          # Entry point, load Composer autoloader
│   ├── Core/                  # Core framework classes
│   │   ├── App.php            # Router & dispatcher
│   │   ├── Controller.php     # Base controller class
│   │   ├── Database.php       # Database connection (singleton)
│   │   ├── Model.php          # Base model class
│   │   └── SessionManager.php # Session management
│   ├── Controllers/           # Request handlers
│   │   ├── HomeController.php
│   │   └── AuthController.php
│   ├── Models/                # Data access layer
│   │   ├── UserModel.php
│   │   ├── HomeModel.php
│   │   ├── CourseModel.php
│   │   ├── KategoriModel.php
│   │   └── MateriModel.php
│   └── Views/                 # Template files
│       ├── auth/
│       ├── dashboard/
│       ├── errors/
│       └── layouts/
├── uploads/                   # User uploads directory
│   └── materials/
├── vendor/                    # Composer dependencies (auto-generated)
├── index.php                  # Public entry point
├── composer.json              # Composer configuration
├── composer.lock              # Dependency lock file
└── .gitignore                 # Git ignore file
```

## Namespace Structure (PSR-4)

Semua class di project ini menggunakan namespace PSR-4 yang dipetakan melalui Composer:

- `App\Core\*` → `app/Core/*.php`
- `App\Controllers\*` → `app/Controllers/*.php`
- `App\Models\*` → `app/Models/*.php`

## Setup & Installation

### 1. Install Dependencies
```bash
composer install
```

Ini akan:
- Generate `vendor/autoload.php` yang digunakan untuk autoloading
- Generate `composer.lock` untuk consistency

### 2. Database Setup
- Buka `schema.sql` dan jalankan di MySQL
- Update kredensial database di `app/Core/Database.php`:
  ```php
  $host = '127.0.0.1';
  $port = 3306;
  $name = 'edushare';
  $user = 'root';
  $pass = '';
  ```

### 3. Web Server Setup
- Point root directory ke folder project
- Pastikan `.htaccess` dikonfigurasi dengan benar untuk routing

## Cara Kerja Autoloading

### Dengan Composer (Production)
```php
// app/bootstrap.php
require_once dirname(__DIR__) . '/vendor/autoload.php';
new \App\Core\App();
```

Composer secara otomatis akan load class sesuai namespace:
```php
use App\Controllers\HomeController;
use App\Models\UserModel;
use App\Core\Database;

// Class akan di-require otomatis
$controller = new HomeController();
$model = new UserModel();
```

### Fallback Manual Autoloading
Jika Composer belum diinstall, bootstrap.php akan fallback ke manual autoloading.

## Routing

Routes mengikuti pattern Laravel-style:

- `/` → HomeController@index
- `/auth/login` → AuthController@login
- `/auth/register` → AuthController@register
- `/auth/logout` → AuthController@logout
- `/home/about` → HomeController@about
- `/home/material` → HomeController@material

Routing di-handle oleh `App\Core\App` yang mem-parse URL dari `$_GET['url']`.

## Membuat Controller Baru

```php
<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class YourController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Your Page'];
        $this->view('your_view', $data);
    }

    public function create()
    {
        $model = $this->model('YourModel');
        // Your logic here
    }
}
```

## Membuat Model Baru

```php
<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Database;
use PDOException;

class YourModel extends Model
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->db->query('SELECT * FROM your_table');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
```

## Database Connection

Menggunakan singleton pattern melalui `App\Core\Database`:

```php
use App\Core\Database;

$pdo = Database::getConnection();
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
```

## Session Management

Gunakan `App\Core\SessionManager`:

```php
use App\Core\SessionManager;

$session = new SessionManager();
$session->login($user['email']);
$session->isLoggedIn();
$session->getUser();
$session->logout();
```

## Best Practices

1. **Selalu gunakan namespace** - Hindari class tanpa namespace
2. **Type hints** - Gunakan type hints untuk parameter dan return values
3. **Immutability** - Jangan ubah superglobals langsung, gunakan SessionManager
4. **Error handling** - Catch exceptions dari Database atau Model
5. **View escaping** - Selalu escape output di views untuk XSS prevention
6. **File uploads** - Validasi MIME type dan ukuran file

## Troubleshooting

### Class Not Found Error
- Pastikan namespace di class file sesuai dengan file location
- Jalankan `composer dump-autoload` untuk regenerate autoloader

### Database Connection Error
- Pastikan MySQL service berjalan
- Verifikasi kredensial database di `Database.php`
- Database akan auto-create jika tidak ada

### 404 Not Found
- Pastikan `.htaccess` dikonfigurasi dengan benar
- Check URL routing di `App.php`
- Pastikan Controller dan method ada

## Migrasi dari Manual Autoload ke Composer

Jika pernah menggunakan manual autoloading sebelumnya:

1. ✅ Semua class sudah memiliki namespace
2. ✅ composer.json sudah dikonfigurasi
3. ✅ bootstrap.php sudah load vendor/autoload.php
4. ✅ App.php sudah support namespace routing

Cukup jalankan `composer install` dan project siap digunakan!

## Maintenance

### Update Composer
```bash
composer update
```

### Check for Updates
```bash
composer outdated
```

### Generate Autoloader (setelah menambah class baru)
```bash
composer dump-autoload
```

---

**Version:** 1.0  
**Last Updated:** April 2026
