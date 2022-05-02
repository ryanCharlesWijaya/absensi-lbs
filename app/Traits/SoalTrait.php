<?php

namespace App\Traits;

use App\Models\Soal;
use Illuminate\Support\Facades\Validator;

trait SoalTrait
{
    protected function makeStoreValidator(Array $data)
    {
        return Validator::make($data, [
            "kelas" => ["required", "int"],
            "soal" => ["required", "string"],
            "jawaban" => ["required", "in:a,b,c,d"],
            "pilihan_a" => ["required", "string"],
            "pilihan_b" => ["required", "string"],
            "pilihan_c" => ["required", "string"],
            "pilihan_d" => ["required", "string"],
        ]);
    }

    protected function storeSoalToDatabase(Array $data)
    {
        return Soal::create([
            "kelas" => $data["kelas"],
            "soal" => $data["soal"],
            "jawaban" => $data["jawaban"],
            "pilihan_a" => $data["pilihan_a"],
            "pilihan_b" => $data["pilihan_b"],
            "pilihan_c" => $data["pilihan_c"],
            "pilihan_d" => $data["pilihan_d"],
        ]);
    }

    protected function makeUpdateValidator(Array $data)
    {
        return Validator::make($data, [
            "kelas" => ["sometimes", "int"],
            "soal" => ["sometimes", "string"],
            "jawaban" => ["sometimes", "in:a,b,c,d"],
            "pilihan_a" => ["sometimes", "string"],
            "pilihan_b" => ["sometimes", "string"],
            "pilihan_c" => ["sometimes", "string"],
            "pilihan_d" => ["sometimes", "string"],
        ]);
    }
    
    protected function updateSoalInDatabase(Array $data, Soal $soal)
    {
        return $soal->update($data);
    }
}
