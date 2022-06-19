<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Services\KurikulumService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KurikulumController extends Controller
{
    public function index()
    {
        $kurikulums = Kurikulum::all();

        return view("guru.kurikulum.index", compact("kurikulums"));
    }

    public function show(int $kurikulum_id)
    {
        $kurikulum = Kurikulum::find($kurikulum_id);

        return view("guru.kurikulum.kurikulum-detail", compact("kurikulum"));
    }

    public function create()
    {
        return view("guru.kurikulum.create-kurikulum");
    }

    public function store(Request $request, KurikulumService $kurikulumService)
    {
        DB::beginTransaction();
        try {
            $kurikulum = $kurikulumService->createKurikulum($request->all());

            DB::commit();
            return redirect(route("guru.kurikulum.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(int $kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        return view("guru.kurikulum.edit-kurikulum", compact("kurikulum"));
    }

    public function update(Request $request, KurikulumService $kurikulumService, int $kurikulum_id)
    {
        DB::beginTransaction();
        try {
            $kurikulum = $kurikulumService->updateKurikulum($request->all(), $kurikulum_id);

            DB::commit();
            return redirect(route("guru.kurikulum.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
