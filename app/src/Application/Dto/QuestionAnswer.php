<?php

namespace App\Application\Dto;

final readonly class QuestionAnswer
{
    public function __construct(
       public int $id,
       public string $caption,
    ) {
    }
}