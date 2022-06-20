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
            "kategori" => ["required", "string"],
            "file" =>  ["sometimes", "image"]
        ])->validate();

        $pengumuman = Pengumuman::create($validated);

        if ($validated["file"]) $pengumuman->addMedia($validated["file"])->toMediaCollection();

        return $pengumuman;
    }

    public function updatePengumuman(array $data, int $pengumuman_id)
    {
        $pengumuman = Pengumuman::findOrFail($pengumuman_id);

        $validated = Validator::make($data, [
            "judul" => ["sometimes", "string"],
            "deskripsi" => ["sometimes", "string"],
            "kategori" => ["sometimes", "string"],
            "file" =>  ["sometimes", "image"]
        ])->validate();

        $pengumuman->update($validated);

        if ($validated["file"]) {
            if ($pengumuman->getFirstMedia()) $pengumuman->getFirstMedia()->delete();

            $pengumuman->addMedia($validated["file"])->toMediaCollection();
        }

        return $pengumuman->refresh();
    }
}