<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Semester extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "guru_id",
        "sekolah_id",
        "kurikulum_id",
        "semester",
        "kelas",
        "tahun_ajaran",
    ];

    public function guru()
    {
        return $this->hasOne(User::class, "id", "guru_id");
    }

    public function siswas()
    {
        return $this->belongsToMany(User::class, 'semester_users');
    }

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, "id", "sekolah_id");
    }

    public function pertemuans()
    {
        return $this->hasMany(Pertemuan::class, "semester_id");
    }

    public function nilai_akhirs()
    {
        return $this->hasMany(NilaiAkhir::class, "semester_id");
    }
}
