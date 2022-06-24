<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Pertemuan extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        "semester_id",
        "judul",
        "deskripsi",
        "tanggal",
    ];

    public function semester()
    {
        return $this->hasOne(Semester::class, "id", "semester_id");
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, "pertemuan_id");
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function tugas()
    {
        return $this->hasOne(Tugas::class);
    }

    public function getCanAbsenAttribute()
    {
        $now = Carbon::now()->format("Y-m-d");

        return $this->tanggal == $now;
    }

    public function getHasAbsenAttribute()
    {
        return $this->absensi()->where("user_id", Auth::id())->where("status", "hadir")->count();
    }

    public function getHasKumpulTugasAttribute()
    {
        return Auth::user()->jawaban_tugas()->where("tugas_id", $this->tugas->id)->count();
    }

    public function getHasKerjainQuizAttribute()
    {
        return Auth::user()->hasil_quiz()->where("quiz_id", $this->quiz->id)->count();
    }
}
