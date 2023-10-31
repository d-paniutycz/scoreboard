<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Policy;

use Paniutycz\Scoreboard\Entity\Game;
use Paniutycz\Scoreboard\Entity\GameCollection;

interface GameFilterPolicy
{
    /**
     * @return array<Game>
     */
    public function filter(GameCollection $collection): array;
}
