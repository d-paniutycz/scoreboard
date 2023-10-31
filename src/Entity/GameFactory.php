<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use Paniutycz\Scoreboard\Model\Team;

interface GameFactory
{
    public function create(Team $homeTeam, Team $awayTeam): Game;
}
