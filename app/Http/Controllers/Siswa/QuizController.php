<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\Quiz;
use App\Services\QuizService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function kerjakanQuiz(int $pertemuan_id, int $quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        return view("siswa.quiz.kerjakan-quiz", compact("quiz", "pertemuan"));
    }

    public function kumpulQuiz(Request $request, QuizService $quizService, int $pertemuan_id, int $quiz_id)
    {
        DB::beginTransaction();
        try {
            $hasil_quiz = $quizService->kumpulQuiz($request->all(), $quiz_id);

            DB::commit();
            return redirect(route("siswa.pertemuan.index"));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
