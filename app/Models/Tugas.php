<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tugas extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        "pertemuan_id",
        "judul",
        "deskripsi",
        "tanggal_kadaluarsa",
        "url"
    ];

    public function getHasExpiredAttribute()
    {
        $now = Carbon::now()->subDays(1)->format("Y-m-d H:i:s");

        return $this->tanggal_kadaluarsa < $now;
    }

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, "pertemuan_id");
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanTugas::class, "tugas_id");
    }
}
