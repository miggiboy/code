<?php

namespace App\Modules\Quiz;

use App\{Quiz, Question, Answer};

class QuizStoring
{

    public function add($testName, $subjectId, $comment, $questions, $answers)
    {
        $quiz = Quiz::create([
            'title'             => $testName,
            'comment'           => $comment,
            'subject_id'        => $subjectId,
        ]);

        for ($i=0; $i < count($questions); $i++) {

            $question = Question::create([
                'text'          => $questions[$i],
                'quiz_id'       => $quiz->id,
            ]);

            for ($j=0; $j < count($answers[$i]); $j++) {
                Answer::create([
                    'text'          => $answers[$i][$j]['text'],
                    'is_right'      => $answers[$i][$j]['is_right'],
                    'question_id'   => $question->id,
                ]);
            }
        }
        return true;
    }
}
