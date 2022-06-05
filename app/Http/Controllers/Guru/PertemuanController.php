<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Kurikulum;
use App\Services\PertemuanService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PertemuanController extends Controller
{
    public function show(int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);
        $quizzes = $pertemuan->quizzes;
        $tugases = $pertemuan->tugas ? [$pertemuan->tugas] : [];

        return view("guru.kurikulum.pertemuan.pertemuan-detail", compact("pertemuan", "quizzes", "tugases"));
    }

    public function create()
    {
        return view("guru.kurikulum.pertemuan.create-pertemuan");
    }

    public function store(Request $request, PertemuanService $pertemuanService)
    {

        DB::beginTransaction();
        try {
            $pertemuanService->createPertemuan($request->all());
            DB::commit();
            return redirect(route("guru.kurikulum.show", ["kurikulum_id" => $request->input("kurikulum_id")]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(Request $request, int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        return view("guru.kurikulum.pertemuan.edit-pertemuan", compact("pertemuan"));
    }

    public function update(Request $request, PertemuanService $pertemuanService, int $pertemuan_id)
    {

        DB::beginTransaction();
        try {
            $pertemuanService->updatePertemuan($request->all(), $pertemuan_id);
            DB::commit();
            
            return redirect(route("guru.kurikulum.show", ["kurikulum_id" => Pertemuan::findOrFail($pertemuan_id)->kurikulum->id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(PertemuanService $pertemuanService, $pertemuan_id)
    {
        DB::beginTransaction();

        try {
            $kurikulum_id = Pertemuan::findOrFail($pertemuan_id)->kurikulum->id;
            $pertemuan = $pertemuanService->deletePertemuan($pertemuan_id);

            DB::commit();
            return redirect(route("guru.kurikulum.show", ["kurikulum_id" => $kurikulum_id]));

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
