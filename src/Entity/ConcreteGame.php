<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use Paniutycz\Scoreboard\Model\Team;
use Paniutycz\Scoreboard\Value\GameId;

final readonly class ConcreteGame implements Game
{
    public function __construct(
        private GameId $id,
        private Team $homeTeam,
        private Team $awayTeam,
    ) {
    }

    public function getId(): GameId
    {
        return $this->id;
    }

    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }
}
