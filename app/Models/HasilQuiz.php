<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilQuiz extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "user_id",
        "quiz_id",
        "nilai",
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', "user_id");
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'id', "quiz_id");
    }
}
