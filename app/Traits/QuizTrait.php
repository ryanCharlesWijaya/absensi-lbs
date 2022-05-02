<?php

namespace App\Traits;

use App\Models\Quiz;
use Illuminate\Support\Facades\Validator;

trait QuizTrait
{
    protected function makeInsertValidator(Array $data)
    {
        return Validator::make($data, [
            "soals" => ["required", "array"],
            "soals.*" => ["required", "int"],
            "tanggal_kadaluarsa" => ["required"],
            "pertemuan_id" => ["required", "int"]
        ]);
    } 

    protected function storeQuizToDatabase(Array $data)
    {
        return Quiz::create([
            "pertemuan_id" => $data["pertemuan_id"],
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
            "tanggal_kadaluarsa" => ["sometimes"],
            "pertemuan_id" => ["sometimes", "int"]
        ]);
    }

    protected function updateQuizInDatabase(Array $data, Quiz $quiz)
    {
        return $quiz->update($data);
    }
}
