<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Kurikulum extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "guru_id",
        "kelas",
        "tahun_ajaran",
    ];

    public function guru()
    {
        return $this->hasOne(User::class, "id", "guru_id");
    }

    public function siswas()
    {
        return $this->belongsToMany(User::class, 'kurikulum_users');
    }

    public function pertemuans()
    {
        return $this->hasMany(Pertemuan::class, "kurikulum_id");
    }
}
