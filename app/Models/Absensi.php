<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    public $fillable = [
        "id",
        "user_id",
        "pertemuan_id",
        "tanggal_absen",
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function pertemuan()
    {
        return $this->hasOne(Pertemuan::class, 'pertemuan_id');
    }
}
