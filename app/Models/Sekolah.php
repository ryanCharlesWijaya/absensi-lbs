<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama",
        "alamat",
        "nomor_telepon",
    ];

    public function users()
    {
        return $this->hasMany(User::class, "sekolah_id");
    }
}
