<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pertemuan extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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
        return $this->hasOne(Quiz::class);
    }

    public function tugas()
    {
        return $this->hasOne(Tugas::class);
    }
}
