<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Services\AbsensiService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function updateStatus(Request $request, AbsensiService $absensiService, int $pertemuan_id, int $absensi_id, string $status)
    {
        DB::beginTransaction();
        try {
            $absensiService->updateStatus($absensi_id, $status);            

            DB::commit();
            return back();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
