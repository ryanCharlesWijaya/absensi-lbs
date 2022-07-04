<?php

namespace App\Services;

use App\Models\Sekolah;
use Illuminate\Support\Facades\Validator;

class SekolahService {
    public function createSekolah(array $data)
    {
        $validated = Validator::make($data, [
            "nama" => ["required", "string"],
            "deskripsi" => ["required", "string"],
            "alamat" => ["required", "string"],
            "nomor_telepon" => ["required", "string", "min:9", "max:15"],
            "kategori" => ["required", "string"],
            "fotos" => ["array"],
            "fotos.*" => ["image"]
        ])->validate();

        $sekolah = Sekolah::create($data);

        if (isset($validated["fotos"])) foreach ($validated["fotos"] as $foto) $sekolah->addMedia($foto)->toMediaCollection();

        return $sekolah;
    }

    public function updateSekolah(array $data, int $sekolah_id)
    {
        $sekolah = Sekolah::findOrFail($sekolah_id);

        $validated = Validator::make($data, [
            "nama" => ["sometimes", "string"],
            "deskripsi" => ["sometimes", "string"],
            "alamat" => ["sometimes", "string"],
            "nomor_telepon" => ["sometimes", "string", "min:9", "max:15"],
            "kategori" => ["sometimes", "string"],
            "fotos" => ["sometimes", "array"],
            "fotos.*" => ["image"]
        ])->validate();

        $sekolah->update($data);

        if ($sekolah->getFirstMedia() && $validated["fotos"]) {
            $medias = $sekolah->getMedia();
            foreach ($medias as $media) $media->delete();
            foreach ($validated["fotos"] as $foto) $sekolah->addMedia($foto)->toMediaCollection();
        }

        return $sekolah;
    }
}