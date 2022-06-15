<?php

namespace App\Traits;

use App\Models\Pertemuan;
use Illuminate\Support\Facades\Validator;

trait PertemuanTrait
{
    protected function makeStoreValidator(Array $data)
    {
        return Validator::make($data, [
            "semester_id" => ["required", "int"],
            "judul" => ["required", "string"],
            "deskripsi" => ["required", "string"],
            "tanggal" => ["required", "date"],
            "file" => ["sometimes"],
        ]);
    }

    protected function storePertemuanInDatabase(Array $data)
    {
        return Pertemuan::create([
            "semester_id" => $data["semester_id"],
            "judul" => $data["judul"],
            "deskripsi" => $data["deskripsi"],
            "tanggal" => $data["tanggal"],
        ]);
    }

    protected function makeUpdateValidator(Array $data)
    {
        return Validator::make($data, [
            "judul" => ["required", "string"],
            "deskripsi" => ["sometimes", "string"],
            "tanggal" => ["required", "date"],
            "file" => ["sometimes"],
        ]);
    }

    protected function updatePertemuanInDatabase(Array $data, Pertemuan  $pertemuan)
    {
        return $pertemuan->update($data);
    }

}
