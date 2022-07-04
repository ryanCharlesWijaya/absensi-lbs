<?php

namespace App\Services;

use App\Models\ResourceSiswa;
use Illuminate\Support\Facades\Validator;

class ResourceSiswaService {
    public function createResourseSiswa(array $data)
    {
        $validated = Validator::make($data, [
            "file" => ["max:9192", "exclude_unless:url,null"],
            "url" => ["string", "exclude_unless:file,null"]
        ])->validate();

        $resource_siswa = ResourceSiswa::create($validated);
        if (isset($validated["file"])) $resource_siswa->addMedia($validated["file"])->toMediaCollection();

        return $resource_siswa;
    }

    public function deleteResoruceSiswa(int $resource_siswa_id)
    {
        $resource_siswa = ResourceSiswa::findOrFail($resource_siswa_id);

        return $resource_siswa->delete();
    }
}