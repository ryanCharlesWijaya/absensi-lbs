<?php

namespace App\Services;

use App\Models\Pengumuman;
use Illuminate\Support\Facades\Validator;

class PengumumanService {
    public function createPengumuman(array $data)
    {
        $validated = Validator::make($data, [
            "judul" => ["required", "string"],
            "deskripsi" => ["required", "string"],
            "kategori" => ["required", "string"]
        ])->validate();

        $pengumuman = Pengumuman::create($validated);

        return $pengumuman;
    }

    public function updatePengumuman(array $data, int $pengumuman_id)
    {
        $pengumuman = Pengumuman::findOrFail($pengumuman_id);

        $validated = Validator::make($data, [
            "judul" => ["sometimes", "string"],
            "deskripsi" => ["sometimes", "string"],
            "kategori" => ["sometimes", "string"]
        ])->validate();

        $pengumuman->update($validated);

        return $pengumuman->refresh();
    }
}