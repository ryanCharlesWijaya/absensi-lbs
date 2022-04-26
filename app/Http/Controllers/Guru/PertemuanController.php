<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Services\PertemuanService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    public function index()
    {
        $kurikulums = Pertemuan::paginate(16);

        return view("guru.kurikulum.pertemuan.index", compact("pertemuans"));
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
            return redirect(route("guru.kurikulum.pertemuan.index"));
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
            $kurikulum = $pertemuanService->updatePertemuan($request->all(), $pertemuan_id);

            DB::commit();
            return redirect(route("guru.kurikulum.pertemuan.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
