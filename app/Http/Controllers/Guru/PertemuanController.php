<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Kurikulum;
use App\Services\PertemuanService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    public function index()
    {
        $pertemuans = Pertemuan::paginate(16);
        $kurikulums = Kurikulum::all(); 
        return view("guru.kurikulum.pertemuan.index", compact("pertemuans","kurikulums"));
    }

    public function create()
    {
        $kurikulums = Kurikulum::all();
        return view("guru.kurikulum.pertemuan.create-pertemuan", compact("kurikulums"));
    }

    public function store(Request $request, PertemuanService $pertemuanService)
    {

        DB::beginTransaction();
        try {
            $pertemuanService->createPertemuan($request->all());
            
            DB::commit();
            return redirect(route("guru.kurikulum.pertemuan.index"));
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(Request $request, int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);
        $kurikulums = Kurikulum::all(); 

        return view("guru.kurikulum.pertemuan.edit-pertemuan", compact("pertemuan","kurikulums"));
    }

    public function update(Request $request, PertemuanService $pertemuanService, int $pertemuan_id)
    {
        DB::beginTransaction();
        try {
            $kurikulum = $pertemuanService->updatePertemuan($request->all(), $pertemuan_id);

            DB::commit();
            return redirect(route("guru.kurikulum.pertemuan.index"));
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(Request $request, PertemuanService $pertemuanService, $pertemuan_id)
    {
        DB::beginTransaction();

        try {
            $pertemuan = $pertemuanService->deletePertemuan($pertemuan_id);

            DB::commit();
            return redirect(route("guru.kurikulum.pertemuan.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
    
}
