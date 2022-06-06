<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        "tugas_id",
        "siswa_id",
        "nilai",
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
