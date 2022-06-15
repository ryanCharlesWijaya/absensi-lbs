<?php

namespace App\Traits;

use App\Models\Semester;
use Illuminate\Support\Facades\Validator;

trait SemesterTrait
{
    protected function makeStoreValidator(Array $data)
    {
        return Validator::make($data, [
            "guru_id" => ["nullable", "int"],
            "kelas" => ["required", "min:1", "max:12"],
            "tahun_ajaran"=> ["required", "string"],
        ]);
    }

    protected function storeSemesterInDatabase(Array $data)
    {
        return Semester::create([
            "guru_id" => $data["guru_id"] ?? null,
            "kelas" => $data["kelas"],
            "tahun_ajaran" => $data["tahun_ajaran"]
        ]);
    }

    protected function makeAssignSiswaValidator(Array $data)
    {
        return Validator::make($data, [
            "siswa_id" => ["required", "int"]
        ]);
    }

    protected function assignSiswaToSemester(Array $data, Semester $semester)
    {
        return $semester->siswas()->attach($data["siswa_id"]);
    }

    protected function makeUpdateValidator(Array $data)
    {
        return Validator::make($data, [
            "guru_id" => ["sometimes", "nullable", "int"],
            "kelas" => ["sometimes", "min:1", "max:12"],
            "tahun_ajaran"=> ["sometimes", "string"],
        ]);
    }

    protected function updateSemesterInDatabase(Array $data, Semester $semester)
    {
        return $semester->update($data);
    }

    protected function makeAddSemesterResourceValidator(Array $data)
    {
        return Validator::make($data, [
            "file" => ["required", "max:4096", "mimes:pdf,jpeg,jpg,png,docx"]
        ]);
    }
}
