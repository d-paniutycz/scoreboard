<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Model;

use Paniutycz\Scoreboard\Value\TeamName;
use Paniutycz\Scoreboard\Value\TeamScore;

final readonly class ConcreteTeamFactory implements TeamFactory
{
    public function create(TeamName $name, TeamScore $score): Team
    {
        return new ConcreteTeam($name, $score);
    }
}
