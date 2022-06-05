<?php

namespace App\Services;

use App\Models\Pertemuan;
use App\Models\Tugas;
use App\Traits\TugasTrait;
use Illuminate\Support\Facades\Validator;

class TugasService {
    use TugasTrait;

    public function createTugas(array $data)
    {        
        $validated = $this->createInsertValidator($data)->validate();

        $tugas = $this->storeTugasToDatabase($validated);

        $tugas->addMedia($validated["file"])
            ->toMediaCollection();

        return $tugas;
    }

    public function updateTugas(array $data, int $tugas_id)
    {        
        $tugas = Tugas::findOrFail($tugas_id);

        $validated = $this->createUpdateValidator($data)->validate();

        $this->updateTugasInDatabase($validated, $tugas);

        if (isset($validated["file"]))  {
            $tugas->getFirstMedia()->delete();

            $tugas->addMedia($validated["file"])
                ->toMediaCollection();
        }

        return $tugas;
    }
}