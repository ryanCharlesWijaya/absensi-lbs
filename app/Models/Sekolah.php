<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sekolah extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "nama",
        "deskripsi",
        "alamat",
        "nomor_telepon",
        "kategori"
    ];

    public function users()
    {
        return $this->hasMany(User::class, "sekolah_id");
    }
}
