<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Model;

use Paniutycz\Scoreboard\Value\TeamName;
use Paniutycz\Scoreboard\Value\TeamScore;

final readonly class ConcreteTeam implements Team
{
    public function __construct(
        private TeamName $name,
        private TeamScore $score,
    ) {
    }

    public function getName(): TeamName
    {
        return $this->name;
    }

    public function getScore(): TeamScore
    {
        return $this->score;
    }
}
