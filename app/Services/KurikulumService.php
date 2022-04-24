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

    public function addKurikulumResource($data, int $kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        $validated = $this->makeAddKurikulumResourceValidator($data)->validate();

        $kurikulum->addMedia($validated["file"])
            ->toMediaCollection();

        return $kurikulum;
    }

    public function deleteKurikulumResource(int $kurikulum_id, int $media_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        $media = $kurikulum->getMedia()->where("id", $media_id)->first();
        $media->delete();

        return $kurikulum;
    }
}