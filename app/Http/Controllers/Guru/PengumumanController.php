<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Services\PengumumanService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::all();

        return view("guru.pengumuman.index", compact("pengumumans"));
    }

    public function create()
    {
        return view("guru.pengumuman.create-pengumuman");
    }

    public function store(Request $request, PengumumanService $pengumumanService)
    {
        DB::beginTransaction();
        try {
            $pengumuman = $pengumumanService->createPengumuman($request->all());

            DB::commit();
            return redirect(route("guru.pengumuman.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(int $pengumuman_id)
    {
        $pengumuman = Pengumuman::findOrFail($pengumuman_id);

        return view('guru.pengumuman.edit-pengumuman', compact("pengumuman"));
    }

    public function update(Request $request, PengumumanService $pengumumanService, int $pengumuman_id)
    {
        DB::beginTransaction();
        try {
            $pengumuman = $pengumumanService->updatePengumuman($request->all(), $pengumuman_id);

            DB::commit();
            return redirect(route("guru.pengumuman.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $pengumuman_id)
    {
        DB::beginTransaction();
        try {
            Pengumuman::destroy($pengumuman_id);

            DB::commit();
            return redirect(route("guru.pengumuman.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
