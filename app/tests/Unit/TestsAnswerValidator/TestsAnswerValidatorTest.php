<?php

declare(strict_types=1);

namespace Tests\Unit\TestsAnswerValidator;

use App\Domain\Entity\TestQuestionsAnswer;
use App\Domain\Service\Tests\Validator\ImplictLogicAnswerValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TestsAnswerValidatorTest extends TestCase
{
    private array $answers = [];
    public function setUp(): void
    {
        $this->answers[] = $this->mockAnswer(true);
        $this->answers[] = $this->mockAnswer(false);
        $this->answers[] = $this->mockAnswer(true);
        $this->answers[] = $this->mockAnswer(false);
    }

    public function testFailEmptyAnswer()
    {
        $this->expectException(\InvalidArgumentException::class);
        (new ImplictLogicAnswerValidator())->validate($this->answers, []);
    }

    public function testFailAnswerOutOfRange()
    {
        $this->expectException(\OutOfRangeException::class);
        (new ImplictLogicAnswerValidator())->validate($this->answers, [9]);
    }

    /**
     * @dataProvider getAnswersCombinations
     */
    public function testCombinations(array $in, bool $expect)
    {
        $this->assertEquals(
            $expect,
            (new ImplictLogicAnswerValidator())->validate($this->answers, $in)->isCorrect
        );
    }

    private function getAnswersCombinations(): iterable
    {
        yield ['in' => [0, 1, 2], 'expect' => false];
        yield ['in' => [0, 1], 'expect' => false];
        yield ['in' => [0, 1, 2, 3], 'expect' => false];
        yield ['in' => [0, 2], 'expect' => true];
        yield ['in' => [0], 'expect' => true];
        yield ['in' => [2], 'expect' => true];
        yield ['in' => [2, 0], 'expect' => true];
    }

    private function mockAnswer(bool $isCorrect): TestQuestionsAnswer&MockObject
    {
        $mock = $this->createMock(TestQuestionsAnswer::class);
        $mock
            ->method('isCorrect')
            ->willReturn($isCorrect);

        return $mock;
    }
}