<?php

namespace App\Inrastructure\Presenter;

use App\Domain\Entity\TestsSessionAnswer;

class ListResultPresenter
{
    /**
     * @param TestsSessionAnswer[] $answers
     *
     * @return string
     */
    public function present(array $answers): string
    {
        $result = '';
        foreach ($answers as $answer) {
            $result .= "Question: " . $answer->getQuestion()->getCaption() . "\n";
            $result .= "Shown answers: \n";
            foreach ($answer->getSnapshot()->possibleAnswers as $i => $answerText) {
                $result .= " {$i}: {$answerText}\n";
            }

            $result .= "Your answers: " . implode(', ', $answer->getSnapshot()->userAnswerNumbers) . "\n";
            $result .= "Result: " . (["wrong", "correct"][$answer->isCorrect()]) . "\n";
            $result .= "\n";
        }

        return $result;
    }
}