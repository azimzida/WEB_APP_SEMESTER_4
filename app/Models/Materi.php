<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'course_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'file_materi',
        'tanggal_upload',
    ];
}
