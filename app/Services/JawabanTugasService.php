<?php

namespace App\Services;

use App\Models\Tugas;
use App\Traits\JawabanTugasTrait;

class JawabanTugasService {
    use JawabanTugasTrait;

    public function uploadJawabanTugas(array $data, int $tugas_id)
    {
        $validated = $this->makeInsertValidator($data)->validate();

        $jawaban_tugas = $this->storeJawabanTugasToDatabase($validated);

        $jawaban_tugas->addMedia($validated["file"])
            ->toMediaCollection();

        return $jawaban_tugas;
    }
}