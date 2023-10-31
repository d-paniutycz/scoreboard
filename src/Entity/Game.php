<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use DateTimeImmutable;
use Paniutycz\Scoreboard\Model\Team;
use Paniutycz\Scoreboard\Value\GameId;

interface Game
{
    public function getId(): GameId;

    public function getHomeTeam(): Team;

    public function getAwayTeam(): Team;

    public function getTotalScore(): int;

    public function getLastUpdateTime(): ?DateTimeImmutable;

    public function isTeamInGame(Team $team): bool;
}
