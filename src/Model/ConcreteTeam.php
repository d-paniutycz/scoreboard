<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Model;

use Paniutycz\Scoreboard\Value\TeamName;
use Paniutycz\Scoreboard\Value\TeamScore;

final class ConcreteTeam implements Team
{
    public function __construct(
        private readonly TeamName $name,
        private TeamScore $score,
    ) {
    }

    public function getName(): TeamName
    {
        return $this->name;
    }

    public function setScore(TeamScore $score): void
    {
        $this->score = $score;
    }

    public function getScore(): TeamScore
    {
        return $this->score;
    }

    public function equals(Team $team): bool
    {
        return $team->getName()->equals($this->name);
    }
}
