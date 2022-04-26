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

        return $pertemuan;
    }

    public function updatePertemuan(Array $data, int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        $validated = $this->makeUpdateValidator($data)->validate();

        $this->updatePertemuanInDatabase($validated, $pertemuan);

        return $pertemuan->refresh();
    }
}
