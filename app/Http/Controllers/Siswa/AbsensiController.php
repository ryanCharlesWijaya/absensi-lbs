<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
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
            return redirect(route("siswa.semester.show", Pertemuan::find($pertemuan_id)->semester->id));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
