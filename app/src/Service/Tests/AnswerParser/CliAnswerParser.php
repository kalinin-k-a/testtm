<?php

namespace App\Service\Tests\AnswerParser;

class CliAnswerParser implements AnswerParser
{
    public function parse(string $answer): array
    {
        if (!preg_match('/^(?:\d+[, ]?)+$/', $answer)) {
            throw new \InvalidArgumentException('Bad answer format');
        }

        $numbers = preg_split('/[, ]+/', $answer);
        array_walk($numbers, fn(&$n) => (int)$n);

        return $numbers;
    }
}