<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class JawabanTugas extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        "tugas_id",
        "siswa_id",
        "nilai",
        "pesan",
        "tanggal_pengumpulan",
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, "tugas_id");
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, "siswa_id");
    }
}
