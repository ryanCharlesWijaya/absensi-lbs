<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        "pertemuan_id",
        "tanggal_kadaluarsa",
    ];

    public function detachAllSoals()
    {
        $this->soals()->detach();
    }

    public function pertemuan()
    {
        return $this->hasOne(Pertemuan::class, "id", "pertemuan_id");
    }

    public function soals()
    {
        return $this->belongsToMany(Soal::class, "quiz_soal");
    }

    public function hasil_quizzes()
    {
        return $this->hasMany(HasilQuiz::class, "quiz_id");
    }
}
