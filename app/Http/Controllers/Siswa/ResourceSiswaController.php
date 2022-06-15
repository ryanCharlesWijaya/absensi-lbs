<?php

namespace App\Http\Controllers\Siswa;

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

        return view("siswa.resource-siswa.index", compact("resources"));
    }

    public function download(int $resource_siswa_id)
    {
        $semester = ResourceSiswa::findOrFail($resource_siswa_id);
        $semester_resource = $semester->getFirstMedia();

        if (!$semester_resource) throw new ModelNotFoundException();

        return response()->download($semester_resource->getPath(), $semester_resource->file_name);
    }
}
