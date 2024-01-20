<?php

declare(strict_types=1);

namespace App\Inrastructure\Types;

use App\Domain\ValueObjects\AnswerSnapshot;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class AnswerSnapshotType extends Type
{
    const NAME = 'answer_snapshot';

    private const KEY_ALL_ANSWERS = 0;
    private const KEY_USER_ANSWERS = 1;

    public function getName()
    {
        return self::NAME;
    }

    /**
     * @param AnswerSnapshot $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return json_encode([self::KEY_ALL_ANSWERS => $value->possibleAnswers, self::KEY_USER_ANSWERS => $value->userAnswerNumbers]);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $decoded = json_decode($value, true);
        if (!$decoded || !isset($decoded[self::KEY_ALL_ANSWERS]) || !isset($decoded[self::KEY_USER_ANSWERS])) {
            throw new \LogicException('Broken data in db');
        }

        return new AnswerSnapshot($decoded[self::KEY_ALL_ANSWERS], $decoded[self::KEY_USER_ANSWERS], );
    }
    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return $platform->getStringTypeDeclarationSQL();
    }
}