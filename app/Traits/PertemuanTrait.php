<?php

namespace App\Traits;

use App\Models\Pertemuan;
use Illuminate\Support\Facades\Validator;

trait PertemuanTrait
{
    protected function makeStoreValidator(Array $data)
    {
        return Validator::make($data, [
            "kurikulum_id" => ["nullable", "int"],
            "tanggal" => ["required", "date"],
        ]);
    }

    protected function storePertemuanInDatabase(Array $data)
    {
        return Pertemuan::create([
            "kurikulum_id" => $data["kurikulum_id"] ?? null,
            "Tanggal" => $data["tanggal"],
        ]);
    }

    protected function makeUpdateValidator(Array $data)
    {
        return Validator::make($data, [
            "kurikulum_id" => ["sometimes","nullable", "int"],
            "tanggal" => ["sometimes", "date"],
        ]);
    }

    protected function updatePertemuanInDatabase(Array $data, Pertemuan $pertemuan)
    {
        return $pertemuan->update($data);
    }

}
