<?php

namespace App\Traits;

use App\Models\Kurikulum;
use Illuminate\Support\Facades\Validator;

trait KurikulumTrait
{
    protected function makeStoreValidator(Array $data)
    {
        return Validator::make($data, [
            "guru_id" => ["nullable", "int"],
            "kelas" => ["required", "min:1", "max:12"],
            "tahun_ajaran"=> ["required", "string"],
        ]);
    }

    protected function storeKurikulumInDatabase(Array $data)
    {
        return Kurikulum::create([
            "guru_id" => $data["guru_id"] ?? null,
            "kelas" => $data["kelas"],
            "tahun_ajaran" => $data["tahun_ajaran"]
        ]);
    }

    protected function makeUpdateValidator(Array $data)
    {
        return Validator::make($data, [
            "guru_id" => ["sometimes", "nullable", "int"],
            "kelas" => ["sometimes", "min:1", "max:12"],
            "tahun_ajaran"=> ["sometimes", "string"],
        ]);
    }

    protected function updateKurikulumInDatabase(Array $data, Kurikulum $kurikulum)
    {
        return $kurikulum->update($data);
    }

    protected function makeAddKurikulumResourceValidator(Array $data)
    {
        return Validator::make($data, [
            "file" => ["required", "max:4096", "mimes:pdf,jpeg,jpg,png,docx"]
        ]);
    }
}
