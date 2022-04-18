<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $fillable = [
        "jawaban",
        "pilihan_a",
        "pilihan_b",
        "pilihan_c",
        "pilihan_d",
    ];

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, "quiz_soal");
    }
}
