<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Services\SoalService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    public function index()
    {
        $soals = Soal::all();

        return view("guru.soal.index", compact("soals"));
    }

    public function show(int $soal_id)
    {
        $soal = Soal::findOrFail($soal_id);

        return view("guru.soal.soal-detail", compact("soal"));
    }

    public function create()
    {
        return view("guru.soal.create-soal");
    }

    public function store(Request $request, SoalService $soalService)
    {
        DB::beginTransaction();
        try {
            $soal = $soalService->createSoal($request->all());

            DB::commit();

            return redirect(route("guru.soal.index"))->with(["message" => "soal created successfully"]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit($soal_id)
    {
        $soal = Soal::findOrFail($soal_id);

        return view("guru.soal.edit-soal", compact("soal"));
    }

    public function update(Request $request, SoalService $soalService, int $soal_id)
    {
        DB::beginTransaction();
        try {
            $soal = $soalService->updateSoal($request->all(), $soal_id);

            DB::commit();

            return redirect(route("guru.soal.index"))->with(["message" => "soal updated successfully"]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $soal_id)
    {
        DB::beginTransaction();
        try {
            Soal::findOrFail($soal_id)->delete();

            DB::commit();

            return redirect(route("guru.soal.index"))->with(["message" => "soal deleted successfully"]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
