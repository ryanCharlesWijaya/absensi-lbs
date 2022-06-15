<?php

namespace App\Services;

use App\Models\Absensi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AbsensiService {
    public function updateStatus(int $absen_id, string $status) {
        $absen = Absensi::findOrFail($absen_id);

        $absen->update([
            "status" => $status,
            "tanggal_absen" => Carbon::now()->format("Y-m-d H:i:s")
        ]);
    }
}