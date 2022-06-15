<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Sekolah;
use App\Services\SekolahService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SekolahController extends Controller
{
    public function index()
    {
        $sekolahs = Sekolah::all();

        return view("guru.sekolah.index", compact("sekolahs"));
    }

    public function create()
    {
        return view("guru.sekolah.create-sekolah");
    }

    public function store(Request $request, SekolahService $sekolahService)
    {
        DB::beginTransaction();
        try {
            $sekolah = $sekolahService->createSekolah($request->all());

            DB::commit();
            return redirect(route("guru.sekolah.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit($sekolah_id)
    {
        $sekolah = Sekolah::findOrFail($sekolah_id);

        return view("guru.sekolah.edit-sekolah", compact("sekolah"));
    }

    public function update(Request $request, SekolahService $sekolahService, int $sekolah_id)
    {
        DB::beginTransaction();
        try {
            $sekolah = $sekolahService->updateSekolah($request->all(), $sekolah_id);

            DB::commit();
            return redirect(route("guru.sekolah.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Request $request, int $sekolah_id)
    {
        DB::beginTransaction();
        try {
            $sekolah = Sekolah::findOrFail($sekolah_id);
            $sekolah->delete();

            DB::commit();
            return redirect(route("guru.sekolah.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
