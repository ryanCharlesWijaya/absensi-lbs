<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\Pertemuan;
use App\Models\User;
use App\Services\KurikulumService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KurikulumController extends Controller
{
    public function index()
    {
        $kurikulums = Kurikulum::paginate(16);

        return view("guru.kurikulum.index", compact("kurikulums"));
    }

    public function show(int $kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);
        $pertemuans = Pertemuan::all();

        return view("guru.kurikulum.kurikulum-detail", compact("kurikulum", "pertemuans"));
    }

    public function showAssignSiswa($kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);
        $siswas = User::role("siswa");

        foreach ($kurikulum->siswas as $siswa) {
            $siswas = $siswa->where("id", "<>", $siswa->id);
        }

        $siswas = $siswas->get();

        return view("guru.kurikulum.siswa.assign-siswa", compact("siswas", "kurikulum"));
    }

    public function assignSiswa(Request $request, KurikulumService $kurikulumService, int $kurikulum_id)
    {
        DB::beginTransaction();
        try {
            $kurikulumService->assignSiswa($request->all(), $kurikulum_id);

            DB::commit();
            return redirect(route("guru.kurikulum.show", ["kurikulum_id" => $kurikulum_id]))->with(["success" => "successfully assigned siswa"]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }   
    }

    public function create()
    {
        return view("guru.kurikulum.create-kurikulum");
    }

    public function store(Request $request, KurikulumService $kurikulumService)
    {
        DB::beginTransaction();
        try {
            $kurikulumService->createKurikulum($request->all());

            DB::commit();            
            return redirect(route("guru.kurikulum.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(Request $request, int $kurikulum_id)
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
