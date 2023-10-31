<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use IteratorAggregate;
use Paniutycz\Scoreboard\Value\GameId;

interface GameCollection extends IteratorAggregate
{
    public function has(GameId $gameId): bool;

    public function set(GameId $gameId, Game $game): void;
}
