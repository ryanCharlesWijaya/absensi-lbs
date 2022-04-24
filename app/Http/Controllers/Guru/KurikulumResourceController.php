<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Services\KurikulumService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Exception\NotFoundException;

class KurikulumResourceController extends Controller
{
    public function show($kurikulum_id, $media_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);
        $kurikulum_resource = $kurikulum->getMedia()->where("id", $media_id);

        if (!$kurikulum_resource->count()) throw new ModelNotFoundException();

        return view("guru.kurikulum.resource.resource-detail", compact("kurikulum_resource"));
    }

    public function create($kurikulum_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);

        return view("guru.kurikulum.resource.create-resource", compact("kurikulum"));
    }

    public function store(Request $request, KurikulumService $kurikulumService, $kurikulum_id)
    {
        DB::beginTransaction();

        try {
            $kurikulum = $kurikulumService->addKurikulumResource($request->all(), $kurikulum_id);

            DB::commit();
            return redirect(route("guru.kurikulum.show", ["kurikulum_id" => $kurikulum_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function download(Request $request, $kurikulum_id, $media_id)
    {
        $kurikulum = Kurikulum::findOrFail($kurikulum_id);
        $kurikulum_resource = $kurikulum->getMedia()->where("id", $media_id)->first();

        if (!$kurikulum_resource) throw new ModelNotFoundException();

        return response()->download($kurikulum_resource->getPath(), $kurikulum_resource->file_name);
    }

    public function delete(Request $request, KurikulumService $kurikulumService, $kurikulum_id, $media_id)
    {
        DB::beginTransaction();

        try {
            $kurikulum = $kurikulumService->deleteKurikulumResource($kurikulum_id, $media_id);

            DB::commit();
            return redirect(route("guru.kurikulum.show", ["kurikulum_id" => $kurikulum_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
