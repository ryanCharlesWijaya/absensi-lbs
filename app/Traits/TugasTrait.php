<?php

namespace App\Traits;

use App\Models\Tugas;
use Illuminate\Support\Facades\Validator;

trait TugasTrait {
    protected function createInsertValidator(array $data)
    {
        return Validator::make($data, [
            "pertemuan_id" => ["required", "int"],
            "judul" => ["required", "string"],
            "deskripsi" => ["required", "string"],
            "tanggal_kadaluarsa" => ["required"],
            "file" => ["required"]
        ]);
    }

    protected function storeTugasToDatabase(array $data)
    {
        return Tugas::create($data);
    }

    protected function createUpdateValidator(array $data)
    {
        return Validator::make($data, [
            "pertemuan_id" => ["sometimes", "int"],
            "judul" => ["sometimes", "string"],
            "deskripsi" => ["sometimes", "string"],
            "tanggal_kadaluarsa" => ["sometimes"],
            "file" => ["sometimes"]
        ]);
    }

    protected function updateTugasInDatabase(array $data, Tugas $tugas)
    {
        return $tugas->update($data);
    }
}