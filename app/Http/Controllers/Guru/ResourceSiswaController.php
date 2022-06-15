<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\ResourceSiswa;
use App\Services\ResourceSiswaService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceSiswaController extends Controller
{
    public function index()
    {
        $resources = ResourceSiswa::all();

        return view("guru.resource-siswa.index", compact("resources"));
    }

    public function create()
    {
        return view("guru.resource-siswa.create-resource-siswa");
    }

    public function store(Request $request, ResourceSiswaService $resourceSiswaService)
    {
        DB::beginTransaction();

        try {
            $semester = $resourceSiswaService->createResourseSiswa($request->all());
            
            DB::commit();
            return redirect(route("guru.resourceSiswa.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function download(int $resource_siswa_id)
    {
        $semester = ResourceSiswa::findOrFail($resource_siswa_id);
        $semester_resource = $semester->getFirstMedia();

        if (!$semester_resource) throw new ModelNotFoundException();

        return response()->download($semester_resource->getPath(), $semester_resource->file_name);
    }

    public function delete(ResourceSiswaService $resourceSiswaService, int $resource_siswa_id)
    {
        DB::beginTransaction();

        try {
            $resourceSiswaService->deleteResoruceSiswa($resource_siswa_id);

            DB::commit();
            return redirect(route("guru.resourceSiswa.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
