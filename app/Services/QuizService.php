<?php

namespace App\Services;

use App\Models\Quiz;
use App\Traits\QuizTrait;

class QuizService {
    use QuizTrait;

    public function createQuiz(Array $data)
    {
        $validated = $this->makeInsertValidator($data)->validate();

        $quiz = $this->storeQuizToDatabase($validated);

        $this->assignSoalsToQuiz($data, $quiz);

        return $quiz->refresh();
    }

    public function updateQuiz(Array $data, int $quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        $validated = $this->makeUpdateValidator($data)->validate();

        $this->updateQuizInDatabase($validated, $quiz);

        $quiz->detachAllSoals();

        $this->assignSoalsToQuiz($data, $quiz);

        return $quiz->refresh();
    }

    public function kumpulQuiz(Array $data, int $quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        $validated = $this->makeInsertHasilQuiz($data, $quiz_id)->validate();

        $hasil_quiz = $this->storeHasilQuizToDatabase($validated, $quiz);

        return $hasil_quiz;
    }
}