<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function updateStatus(Request $request, int $pertemuan_id, int $absensi_id, string $status)
    {
        try {
            DB::beginTransaction();
            $absensi = Absensi::findOrFail($absensi_id);

            $absensi->update(["status" => $status]);

            DB::commit();
            return back();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
