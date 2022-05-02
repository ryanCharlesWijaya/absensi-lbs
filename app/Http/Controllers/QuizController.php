<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use App\Models\Quiz;
use App\Models\Soal;
use App\Services\QuizService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();

        return view("guru.quiz.index", compact("quizzes"));
    }

    public function create()
    {
        $soals = Soal::all();
        $pertemuans = Pertemuan::all();

        return view("guru.quiz.create-quiz", compact("soals", "pertemuans"));
    }

    public function store(Request $request, QuizService $quizService)
    {
        DB::beginTransaction();
        try {
            $quiz = $quizService->createQuiz($request->all());

            DB::commit();
            return redirect(route("guru.quiz.index"));
            // return redirect(route("guru.kurikulum.show", ["kurikulum_id" => $quiz->pertemuan->kurikulum->id]))->with(["message" => "kurikulum succesfully created"]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $soals = Soal::all();
        $pertemuans = Pertemuan::all();

        return view("guru.quiz.edit-quiz", compact("quiz", "soals", "pertemuans"));
    }

    public function update(Request $request, QuizService $quizService, int $quiz_id)
    {
        DB::beginTransaction();
        try {
            $quiz = $quizService->updateQuiz($request->all(), $quiz_id);

            DB::commit();
            return redirect(route("guru.quiz.index"));
            // return redirect(route("guru.kurikulum.show", ["kurikulum_id" => $quiz->pertemuan->kurikulum->id]))->with(["message" => "updated succesfully created"]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
