<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $fillable = [
        "kurikulum_id",
        "judul",
        "deskripsi",
        "tanggal",
    ];

    public function kurikulum()
    {
        return $this->hasOne(Kurikulum::class, "id", "kurikulum_id");
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, "pertemuan_id");
    }

    public function quiz()
    {
        return $this->hasMany(Quiz::class, "pertemuan_id");
    }
}
