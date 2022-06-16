<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\HasilQuiz;
use App\Models\Pertemuan;
use App\Models\Quiz;
use App\Models\Soal;
use App\Services\QuizService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function show(int $pertemuan_id, int $quiz_id)
    {
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);
        $quiz = Quiz::findOrFail($quiz_id);

        return view("guru.quiz.quiz-detail", compact("pertemuan", "quiz"));
    }

    public function create(int $pertemuan_id)
    {
        $soals = Soal::all();
        $pertemuan = Pertemuan::findOrFail($pertemuan_id);

        return view("guru.quiz.create-quiz", compact("soals", "pertemuan"));
    }

    public function reviewHasilQuiz(int $pertemuan_id, int $hasil_quiz_id)
    {
        $hasil_quiz_siswa = HasilQuiz::findOrFail($hasil_quiz_id);
        $quiz = $hasil_quiz_siswa->quiz;
        $pertemuan = $quiz->pertemuan;

        return view("guru.quiz.review-quiz", compact("hasil_quiz_siswa", "quiz", "pertemuan"));
    }

    public function store(Request $request, QuizService $quizService, int $pertemuan_id)
    {
        DB::beginTransaction();
        try {
            $quiz = $quizService->createQuiz($request->all());

            DB::commit();
            return redirect(route("guru.semester.pertemuan.show", ["pertemuan_id" => $pertemuan_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit(int $pertemuan_id, int $quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $soals = Soal::all();
        $pertemuans = Pertemuan::all();

        return view("guru.quiz.edit-quiz", compact("quiz", "soals", "pertemuans"));
    }

    public function update(Request $request, QuizService $quizService, int $pertemuan_id, int $quiz_id)
    {
        DB::beginTransaction();
        try {
            $quiz = $quizService->updateQuiz($request->all(), $quiz_id);

            DB::commit();
            return redirect(route("guru.semester.pertemuan.show", ["pertemuan_id" => $pertemuan_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(int $pertemuan_id, int $quiz_id)
    {
        DB::beginTransaction();
        try {
            Quiz::findOrFail($quiz_id)->delete();

            DB::commit();
            return redirect(route("guru.semester.pertemuan.show", ["pertemuan_id" => $pertemuan_id]));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
