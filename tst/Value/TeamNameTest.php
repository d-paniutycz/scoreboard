<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test\Value;

use Paniutycz\Scoreboard\Value\TeamName;
use PHPUnit\Framework\TestCase;

final class TeamNameTest extends TestCase
{

    public function testExceptionThrownIfNameIsEmptyString(): void
    {
        // assert
        self::expectException(InvalidTeamNameValueException::class);

        // act
        new TeamName('');
    }
}
