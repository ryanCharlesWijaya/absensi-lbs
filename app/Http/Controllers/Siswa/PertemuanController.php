<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kurikulum = $user->kurikulums()->first();
        $pertemuans = $kurikulum->pertemuans ?? [];

        return view("siswa.pertemuan.index", compact("pertemuans"));
    }

    public function show(int $pertemuan_id)
    {   
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        return view("siswa.pertemuan.pertemuan-detail", compact("pertemuan"));
    }

    public function downloadResource(int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        if (!$pertemuan->getFirstMedia()) throw new ModelNotFoundException();

        return response()->download($pertemuan->getFirstMedia()->getPath(), $pertemuan->getFirstMedia()->file_name);
    }

    public function absen(AbsenService $absenService, int $pertemuan_id)
    {
        DB::beginTransaction();
        try {
            $absenService->createAbsensi(Auth::id(), $pertemuan_id);

            DB::commit();
            return redirect(route("siswa.pertemuan.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}