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
            "kurikulum_id" => ["required", "int"],
            "sekolah_id" => ["required", "int"],
            "semester" => ["required", "int"],
            "kelas" => ["required", "min:1", "max:12"],
            "tahun_ajaran"=> ["required", "string"],
        ]);
    }

    protected function storeSemesterInDatabase(Array $data)
    {
        return Semester::create([
            "guru_id" => $data["guru_id"] ?? null,
            "kurikulum_id" => $data["kurikulum_id"],
            "sekolah_id" => $data["sekolah_id"],
            "semester" => $data["semester"],
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
            "kurikulum_id" => ["required", "int"],
            "sekolah_id" => ["required", "int"],
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
