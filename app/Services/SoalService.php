<?php

namespace App\Services;

use App\Models\Soal;
use App\Traits\SoalTrait;

class SoalService {
    use SoalTrait;

    public function createSoal(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $soal = $this->storeSoalToDatabase($validated);

        return $soal->refresh();
    }

    public function updateSoal(Array $data, int $soal_id)
    {
        $soal = Soal::findOrFail($soal_id);

        $validated = $this->makeUpdateValidator($data)->validate();

        $this->updateSoalInDatabase($validated, $soal);

        return $soal->refresh();
    }
}