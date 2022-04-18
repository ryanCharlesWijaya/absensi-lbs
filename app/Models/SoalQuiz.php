<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        "quiz_id",
        "soal_id",
    ];
}
