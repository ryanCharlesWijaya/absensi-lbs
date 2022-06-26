<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Services\AbsensiService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PertemuanController extends Controller
{
    public function downloadResource(int $pertemuan_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        if (!$pertemuan->getFirstMedia()) throw new ModelNotFoundException();

        return response()->download($pertemuan->getFirstMedia()->getPath(), $pertemuan->getFirstMedia()->file_name);
    }
}