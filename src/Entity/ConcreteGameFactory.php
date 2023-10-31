<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use Paniutycz\Scoreboard\Model\Team;
use Paniutycz\Scoreboard\Value\GameId;

final readonly class ConcreteGameFactory implements GameFactory
{
    public function create(Team $homeTeam, Team $awayTeam): Game
    {
        $gameId = GameId::generate();

        return new ConcreteGame($gameId, $homeTeam, $awayTeam);
    }
}
