<?php

namespace App\Services;

use App\Models\NilaiAkhir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NilaiAkhirService {
    public function createNilaiAkhir(array $data)
    {
        $validated = Validator::make($data, [
            "siswa_id" => ["required", "int"],
            "semester_id" => ["required", "int"],
            "nilai_praktek" => ["required", "int", "min:0", "max:100"],
            "nilai_ulangan" => ["required", "int", "min:0", "max:100"],
            "nilai_tugas" => ["required", "int", "min:0", "max:100"],
        ])->validate();

        $validated["guru_id"] = Auth::id();
        $validated["nilai_akhir"] = (($validated["nilai_praktek"] ?? 0) + ($validated["nilai_ulangan"] ?? 0) + ($validated["nilai_tugas"] ?? 0)) / 3;

        return NilaiAkhir::create($validated);
    }

    public function updateNilaiAkhir(array $data, int $nilai_akhir_id)
    {
        $nilai_akhir = NilaiAkhir::findOrFail($nilai_akhir_id);

        $validated = Validator::make($data, [
            "nilai_praktek" => ["required", "int", "min:0", "max:100"],
            "nilai_ulangan" => ["required", "int", "min:0", "max:100"],
            "nilai_tugas" => ["required", "int", "min:0", "max:100"],
        ])->validate();

        $validated["nilai_akhir"] = (($validated["nilai_praktek"] ?? 0) + ($validated["nilai_ulangan"] ?? 0) + ($validated["nilai_tugas"] ?? 0)) / 3;

        return $nilai_akhir->update($validated);
    }
}