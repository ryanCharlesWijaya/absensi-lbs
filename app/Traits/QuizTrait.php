<?php

namespace App\Traits;

use App\Models\HasilQuiz;
use App\Models\Quiz;
use App\Models\Soal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait QuizTrait
{
    protected function makeInsertValidator(Array $data)
    {
        return Validator::make($data, [
            "soals" => ["required", "array"],
            "soals.*" => ["required", "int"],
            "durasi_quiz" => ["required", "int"],
            "tanggal_kadaluarsa" => ["required"],
            "pertemuan_id" => ["required", "int"]
    ]);
    } 

    protected function storeQuizToDatabase(Array $data)
    {
        return Quiz::create([
            "pertemuan_id" => $data["pertemuan_id"],
            "durasi_quiz" => $data["durasi_quiz"],
            "tanggal_kadaluarsa" => $data["tanggal_kadaluarsa"]
        ]);
    }

    protected function assignSoalsToQuiz(Array $data, Quiz $quiz)
    {
        foreach ($data["soals"] as $soal_id) {
            $quiz->soals()->attach($soal_id);
        }
    }

    protected function makeUpdateValidator(Array $data)
    {
        return Validator::make($data, [
            "soals" => ["sometimes", "array"],
            "soals.*" => ["sometimes", "int"],
            "durasi_quiz" => ["sometimes", "int"],
            "tanggal_kadaluarsa" => ["sometimes"],
            "pertemuan_id" => ["sometimes", "int"]
        ]);
    }

    protected function updateQuizInDatabase(Array $data, Quiz $quiz)
    {
        return $quiz->update($data);
    }

    protected function makeInsertHasilQuiz(Array $data)
    {
        return Validator::make($data, [
            "quiz_id" => ["required", "int"],
            "jawabans" => ["required", "array"],
        ]);
    }

    protected function storeHasilQuizToDatabase(Array $data, Quiz $quiz)
    {
        $total_jawaban_benar = 0;

        foreach ($data["jawabans"] as $soal_id => $jawaban) {
            $soal = Soal::findOrFail($soal_id);
            if (strtolower($soal->jawaban) == strtolower($jawaban)) $total_jawaban_benar++;
        }

        $nilai = ($total_jawaban_benar/ $quiz->soals()->count()) * 100;

        return HasilQuiz::create([
            "user_id" => Auth::id(),
            "quiz_id" => $data["quiz_id"],
            "nilai" => $nilai,
            "jawabans" => $data["jawabans"]
        ]);
    }
}
