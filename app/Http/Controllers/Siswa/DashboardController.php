<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\HasilQuiz;
use App\Models\JawabanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index() {    
        $siswa = Auth::user();
        $semester = $siswa->semesters[0];
        $jawaban_tugases = JawabanTugas::where("siswa_id", $siswa->id)->get(); 
        $hasil_quizzes = HasilQuiz::where("user_id", $siswa->id)->get();

        return view("siswa.dashboard.index", compact("jawaban_tugases", "hasil_quizzes"));
    }
}
