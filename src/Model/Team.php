<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Model;

use DateTimeImmutable;
use Paniutycz\Scoreboard\Value\TeamName;
use Paniutycz\Scoreboard\Value\TeamScore;

interface Team
{
    public function getName(): TeamName;

    public function setScore(TeamScore $score): void;

    public function getScore(): TeamScore;

    public function getLastUpdateTime(): ?DateTimeImmutable;

    public function equals(Team $team): bool;
}
