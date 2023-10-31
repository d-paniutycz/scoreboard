<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Model;

use DateTimeImmutable;
use Paniutycz\Scoreboard\Value\TeamName;
use Paniutycz\Scoreboard\Value\TeamScore;

final class ConcreteTeam implements Team
{
    private DateTimeImmutable $lastUpdateTime;

    public function __construct(
        private readonly TeamName $name,
        private TeamScore $score,
    ) {
        $this->lastUpdateTime = new DateTimeImmutable();
    }

    public function getName(): TeamName
    {
        return $this->name;
    }

    public function setScore(TeamScore $score): void
    {
        $this->score = $score;

        $this->lastUpdateTime = new DateTimeImmutable();
    }

    public function getScore(): TeamScore
    {
        return $this->score;
    }

    public function getLastUpdateTime(): ?DateTimeImmutable
    {
        return $this->lastUpdateTime;
    }

    public function equals(Team $team): bool
    {
        return $team->getName()->equals($this->name);
    }
}
