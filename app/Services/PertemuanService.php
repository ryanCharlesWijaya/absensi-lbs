<?php

namespace App\Services;

use App\Models\Pertemuan;
use App\Traits\PertemuanTrait;

class PertemuanService {
    use PertemuanTrait;

    public function createPertemuan(Array $data)
    {
        $validated = $this->makeStoreValidator($data)->validate();

        $pertemuan = $this->storePertemuanInDatabase($validated);

        $pertemuan->addMedia($validated["file"])
            ->toMediaCollection();

        return $pertemuan;
    }

    public function updatePertemuan(Array $data, int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        $validated = $this->makeUpdateValidator($data)->validate();

        $this->updatePertemuanInDatabase($validated, $pertemuan);

        if (isset($validated["file"])) {
            $pertemuan->getFirstMedia()
                ? $pertemuan->getFirstMedia()->delete()
                : null;

            $pertemuan->addMedia($validated["file"])
                ->toMediaCollection();
        }

        return $pertemuan->refresh();
    }

    public function deletePertemuan(int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);
        $pertemuan = $pertemuan->first();
        $pertemuan->delete();

        return $pertemuan;
    }
}
