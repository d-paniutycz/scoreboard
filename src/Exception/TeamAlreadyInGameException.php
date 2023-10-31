<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Exception;

use Paniutycz\Scoreboard\Value\GameId;
use Paniutycz\Scoreboard\Value\TeamName;

final class TeamAlreadyInGameException extends ScoreboardException
{
    private const TEMPLATE = 'Team name: %s already in game id: %s.';

    public function __construct(
        TeamName $teamName,
        GameId $gameId,
    ) {
        parent::__construct(
            sprintf(self::TEMPLATE, $teamName->getValue(), $gameId->getValue())
        );
    }
}
