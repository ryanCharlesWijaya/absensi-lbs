<?php

namespace App\Services;

use App\Models\Semester;
use App\Traits\SemesterTrait;

class SemesterService {
    use SemesterTrait;

    public function createSemester(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $semester = $this->storeSemesterInDatabase($validated);

        return $semester;
    }

    public function assignSiswa(Array $data, int $semester_id)
    {
        $semester = Semester::findOrFail($semester_id);

        $validated = $this->makeAssignSiswaValidator($data)->validate();

        $this->assignSiswaToSemester($validated, $semester);

        foreach ($semester->pertemuans as $pertemuan) $pertemuan->absensi()->create(["user_id" => $validated["siswa_id"]]);
    }

    public function updateSemester(Array $data, int $semester_id)
    {
        $semester = Semester::findOrFail($semester_id);

        $validated = $this->makeUpdateValidator($data)->validate();

        $this->updateSemesterInDatabase($validated, $semester);

        return $semester->refresh();
    }

    public function addSemesterResource($data, int $semester_id)
    {
        $semester = Semester::findOrFail($semester_id);

        $validated = $this->makeAddSemesterResourceValidator($data)->validate();

        $semester->addMedia($validated["file"])
            ->toMediaCollection();

        return $semester;
    }

    public function deleteSemesterResource(int $semester_id, int $media_id)
    {
        $semester = Semester::findOrFail($semester_id);

        $media = $semester->getMedia()->where("id", $media_id)->first();
        $media->delete();

        return $semester;
    }

    public function createSemesterPertemuan(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $semester = $this->storeSemesterInDatabase($validated);

        return $semester;
    }
}
