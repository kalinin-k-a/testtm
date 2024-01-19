<?php

namespace App\Service\Tests\AnswerParser;

interface AnswerParser
{
    /**
     * @return int[]
     *
     * @throws \InvalidArgumentException
     */
    public function parse(string $answer): array;
}