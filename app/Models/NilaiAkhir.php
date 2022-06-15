<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAkhir extends Model
{
    use HasFactory;

    protected $fillable = [
        "guru_id",
        "siswa_id",
        "semester_id",
        "nilai",
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, "siswa_id");
    }

    public function guru()
    {
        return $this->belongsTo(User::class, "guru_id");
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, "semester_id");
    }
}
