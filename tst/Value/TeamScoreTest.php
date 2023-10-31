<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test\Value;

use Paniutycz\Scoreboard\Exception\InvalidScoreValueException;
use Paniutycz\Scoreboard\Value\TeamScore;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class TeamScoreTest extends TestCase
{
    #[DataProvider('invalidScoreProvider')]
    public function testExceptionThrownIfScoreIsInvalid(int $score): void
    {
        // assert
        self::expectException(InvalidScoreValueException::class);

        // act
        new TeamScore($score);
    }

    public static function invalidScoreProvider(): array
    {
        return [
            [-1],
            [PHP_INT_MAX],
        ];
    }
}
