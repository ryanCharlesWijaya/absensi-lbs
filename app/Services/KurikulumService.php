<?php

namespace App\Services;

use App\Models\Kurikulum;
use Illuminate\Support\Facades\Validator;

class KurikulumService {
    public function createKurikulum(array $data)
    {
        $validated = Validator::make($data, [
            "nama" => ["required", "string"]
        ])->validate();

        $kurikulum = Kurikulum::create($validated);

        return $kurikulum;
    }

    public function updateKurikulum(array $data, int $kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        $validated = Validator::make($data, [
            "nama" => ["required", "string"]
        ])->validate();

        $kurikulum->update($validated);

        return $kurikulum;
    }
}