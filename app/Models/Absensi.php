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
        "status"
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function pertemuan()
    {
        return $this->hasOne(Pertemuan::class, 'id', 'pertemuan_id');
    }
}
