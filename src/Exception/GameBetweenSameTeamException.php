<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Exception;

use Paniutycz\Scoreboard\Value\TeamName;

final class GameBetweenSameTeamException extends ScoreboardException
{
    private const TEMPLATE = 'Game between same team name: %s.';

    public function __construct(
        TeamName $teamName,
    ) {
        parent::__construct(
            sprintf(self::TEMPLATE, $teamName->getValue())
        );
    }
}
