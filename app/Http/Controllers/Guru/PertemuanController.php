<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Semester;
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
        $quizzes = $pertemuan->quiz ? [$pertemuan->quiz] : [];
        $tugases = $pertemuan->tugas ? [$pertemuan->tugas] : [];

        return view("guru.semester.pertemuan.pertemuan-detail", compact("pertemuan", "quizzes", "tugases"));
    }

    public function create()
    {
        return view("guru.semester.pertemuan.create-pertemuan");
    }

    public function store(Request $request, PertemuanService $pertemuanService)
    {

        DB::beginTransaction();
        try {
            $pertemuanService->createPertemuan($request->all());
            DB::commit();
            return redirect(route("guru.semester.show", ["semester_id" => $request->input("semester_id")]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(Request $request, int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        return view("guru.semester.pertemuan.edit-pertemuan", compact("pertemuan"));
    }

    public function update(Request $request, PertemuanService $pertemuanService, int $pertemuan_id)
    {

        DB::beginTransaction();
        try {
            $pertemuanService->updatePertemuan($request->all(), $pertemuan_id);
            DB::commit();
            
            return redirect(route("guru.semester.show", ["semester_id" => Pertemuan::findOrFail($pertemuan_id)->semester->id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(PertemuanService $pertemuanService, $pertemuan_id)
    {
        DB::beginTransaction();

        try {
            $semester_id = Pertemuan::findOrFail($pertemuan_id)->semester->id;
            $pertemuan = $pertemuanService->deletePertemuan($pertemuan_id);

            DB::commit();
            return redirect(route("guru.semester.show", ["semester_id" => $semester_id]));

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
