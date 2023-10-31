<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Exception;

use Paniutycz\Scoreboard\Value\GameId;

final class GameNotFoundException extends ScoreboardException
{
    private const TEMPLATE = 'Game with id: %s not found.';

    public function __construct(
        GameId $gameId,
    ) {
        parent::__construct(
            sprintf(self::TEMPLATE, $gameId->getValue())
        );
    }
}
