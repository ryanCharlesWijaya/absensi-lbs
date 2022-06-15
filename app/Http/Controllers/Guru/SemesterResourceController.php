<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Services\SemesterService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Exception\NotFoundException;

class SemesterResourceController extends Controller
{
    public function show($semester_id, $media_id)
    {
        $semester = Semester::findOrFail($semester_id);
        $semester_resource = $semester->getMedia()->where("id", $media_id);

        if (!$semester_resource->count()) throw new ModelNotFoundException();

        return view("guru.semester.resource.resource-details", compact("semester_resource"));
    }

    public function create($semester_id)
    {
        $semester = Semester::findOrFail($semester_id);

        return view("guru.semester.resource.create-resource", compact("semester"));
    }

    public function store(Request $request, SemesterService $semesterService, $semester_id)
    {
        DB::beginTransaction();

        try {
            $semester = $semesterService->addSemesterResource($request->all(), $semester_id);
            
            DB::commit();
            return redirect(route("guru.semester.show", ["semester_id" => $semester_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function download($semester_id, $media_id)
    {
        $semester = Semester::findOrFail($semester_id);
        $semester_resource = $semester->getMedia()->where("id", $media_id)->first();

        if (!$semester_resource) throw new ModelNotFoundException();

        return response()->download($semester_resource->getPath(), $semester_resource->file_name);
    }

    public function delete(SemesterService $semesterService, $semester_id, $media_id)
    {
        DB::beginTransaction();

        try {
            $semester = $semesterService->deleteSemesterResource($semester_id, $media_id);

            DB::commit();
            return redirect(route("guru.semester.show", ["semester_id" => $semester_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
