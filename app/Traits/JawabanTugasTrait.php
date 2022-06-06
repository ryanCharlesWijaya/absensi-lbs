<?php

namespace App\Traits;

use App\Models\JawabanTugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

trait JawabanTugasTrait {
    protected function makeInsertValidator(array $data)
    {
        return Validator::make($data, [
            "tugas_id" => ["required", "int"],
            "pesan" => ["required", "string"],
            "file" => ["required", "file"],
        ]);
    }

    protected function storeJawabanTugasToDatabase(array $data)
    {
        return JawabanTugas::create([
            "tugas_id" => $data["tugas_id"],
            "siswa_id" => Auth::id(),
            "pesan" => $data["pesan"],
        ]);
    }
}