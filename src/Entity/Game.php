<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use Paniutycz\Scoreboard\Model\Team;
use Paniutycz\Scoreboard\Value\GameId;

interface Game
{
    public function getId(): GameId;

    public function getHomeTeam(): Team;

    public function getAwayTeam(): Team;

    public function isTeamInGame(Team $team): bool;
}
