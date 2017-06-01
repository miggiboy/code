<?php

namespace App\Modules\Quiz;

class QuizParsing
{

    public function parse($quizText)
    {
        $quizText = QuizParsing::toSingleString($quizText);
        $quizText = QuizParsing::setMarkers($quizText);
        $parsedQuiz = QuizParsing::getParsedQuiz($quizText);

        return $parsedQuiz;
    }


    /**
     * Turns quiz text into a single line
     * by replacing end of line characters by nothing
     *
     */
    public function toSingleString($quizText)
    {
        return str_replace(PHP_EOL, '', $quizText);
    }


    public function setMarkers($quizText)
    {
        $quizText = QuizParsing::markAnswers($quizText);
        $quizText = QuizParsing::markQuestions($quizText);
        $quizText = QuizParsing::deleteCharEscaping($quizText);

        return $quizText;
    }

    /**
     * Marks answer's letters by special symbols
     */

    public function markAnswers($quizText)
    {
        $pattern = '/(?<!\\\\)[A-Za-zА-Яа-я](\s?)[)]/u';
        // TODO: letter)
        return preg_replace($pattern, '!ANS!', $quizText);
    }

    public function markQuestions($quizText)
    {
        $pattern = '/(?<!\\\\)(\s?)(\d+)[.]/';
        return preg_replace($pattern, '!QUES!', $quizText);
    }

    public function deleteCharEscaping($quizText)
    {
        return str_replace('\\', '', $quizText);
    }

    public function getParsedQuiz($quizText)
    {
        $quizPart = QuizParsing::chunkByQuestions($quizText);
        $quizPart = QuizParsing::deleteEmptyValues($quizPart);
        $quizData = QuizParsing::matchAnswers($quizPart);

        return $quizData;
    }

    public function chunkByQuestions($quizText)
    {
        return explode('!QUES!', $quizText);
    }

    public function deleteEmptyValues($quizData)
    {
        foreach ($quizData as $key => $value) {
            $value = trim($value);
        }

        return array_filter($quizData);
    }

    public function matchAnswers($quizData)
    {
        $q = 0; //Questions counter

        foreach ($quizData as $value) {

            $quesWithAns = explode('!ANS!', $value); //One question with its answers
            $questions[$q] = trim($quesWithAns[0]);  //First element is question, others are answers

            $a = 0; // Question answers counter

            for ($j=1; $j < count($quesWithAns); $j++) {

                $answers[$q][$a]['is_right'] = (
                    $quesWithAns[$j] !== str_replace('+++', '', $quesWithAns[$j])
                );

                $answers[$q][$a]['text'] = str_replace('+++', '', $quesWithAns[$j]);

                $a++;
            }

            $q++;
        }

        return ['questions' => $questions, 'answers' => $answers];
    }
}
