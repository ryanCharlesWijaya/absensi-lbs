<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Services\AbsensiService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function absen(AbsensiService $absenService, int $pertemuan_id, int $absen_id)
    {
        DB::beginTransaction();
        try {
            $absenService->updateStatus($absen_id, "hadir");

            DB::commit();
            return redirect(route("siswa.pertemuan.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
