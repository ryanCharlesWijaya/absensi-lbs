<?php

namespace App\Services;

use App\Models\Kurikulum;
use App\Traits\KurikulumTrait;

class KurikulumService {
    use KurikulumTrait;

    public function createKurikulum(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $kurikulum = $this->storeKurikulumInDatabase($validated);

        return $kurikulum;
    }

    public function updateKurikulum(Array $data, int $kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        $validated = $this->makeUpdateValidator($data)->validate();

        $this->updateKurikulumInDatabase($validated, $kurikulum);

        return $kurikulum->refresh();
    }
}