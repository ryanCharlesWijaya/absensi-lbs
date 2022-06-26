<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $semesters = $user->semesters;

        return view("siswa.semester.index", compact("semesters"));
    }

    public function show($semester_id)
    {
        $semester = Semester::findOrFail($semester_id);

        return view("siswa.semester.semester-detail", compact("semester"));
    }
}
