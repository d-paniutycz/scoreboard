<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Model;

use Paniutycz\Scoreboard\Value\TeamName;
use Paniutycz\Scoreboard\Value\TeamScore;

interface Team
{
    public function getName(): TeamName;

    public function getScore(): TeamScore;

    public function equals(Team $team): bool;
}
