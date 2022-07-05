<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Pertemuan;
use App\Models\User;
use App\Services\SemesterService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = (Auth::user()->is_admin)
            ? Semester::paginate(16)
            : Auth::user()->teached_semesters()->paginate(16);
            
        return view("guru.semester.index", compact("semesters"));
    }

    public function show(int $semester_id)
    {
        $semester = Semester::findOrFail($semester_id);
        $pertemuans = $semester->pertemuans;

        return view("guru.semester.semester-detail", compact("semester", "pertemuans"));
    }

    public function showAssignSiswa($semester_id)
    {
        $semester = Semester::findOrFail($semester_id);
        $siswas = User::role("siswa");

        foreach ($semester->siswas as $siswa) {
            $siswas = $siswas->where("id", "<>", $siswa->id);
        }

        $siswas = $siswas->get();

        return view("guru.semester.siswa.assign-siswa", compact("siswas", "semester"));
    }

    public function assignSiswa(Request $request, SemesterService $semesterService, int $semester_id)
    {
        DB::beginTransaction();
        try {
            $semesterService->assignSiswa($request->all(), $semester_id);

            DB::commit();
            return redirect(route("guru.semester.show", ["semester_id" => $semester_id]))->with(["success" => "successfully assigned siswa"]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }   
    }

    public function detachSiswa(Request $request, SemesterService $semesterService, int $semester_id)
    {
        DB::beginTransaction();
        try {
            $semesterService->detachSiswa($request->all(), $semester_id);

            DB::commit();
            return redirect(route("guru.semester.show", ["semester_id" => $semester_id]))->with(["success" => "successfully detach siswa"]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }   
    }

    public function create()
    {
        return view("guru.semester.create-semester");
    }

    public function store(Request $request, SemesterService $semesterService)
    {
        DB::beginTransaction();
        try {
            $semesterService->createSemester($request->all());

            DB::commit();            
            return redirect(route("guru.semester.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(Request $request, int $semester_id)
    {
        $semester = Semester::findOrFail($semester_id);

        return view("guru.semester.edit-semester", compact("semester"));
    }

    public function update(Request $request, SemesterService $semesterService, int $semester_id)
    {
        DB::beginTransaction();
        try {
            $semester = $semesterService->updateSemester($request->all(), $semester_id);

            DB::commit();
            return redirect(route("guru.semester.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
