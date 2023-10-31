<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test\Value;

use Paniutycz\Scoreboard\Exception\InvalidTeamScoreValueException;
use Paniutycz\Scoreboard\Value\TeamScore;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class TeamScoreTest extends TestCase
{
    #[DataProvider('invalidScoreProvider')]
    public function testExceptionThrownIfScoreIsNotInRange(int $score): void
    {
        // assert
        self::expectException(InvalidTeamScoreValueException::class);

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
