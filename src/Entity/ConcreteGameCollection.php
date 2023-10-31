<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use Paniutycz\Scoreboard\Value\GameId;

class ConcreteGameCollection implements GameCollection
{
    /** @var array<string, Game> */
    private array $collection = [];

    public function has(GameId $gameId): bool
    {
        return array_key_exists($gameId->getValue(), $this->collection);
    }

    public function set(GameId $gameId, Game $game): void
    {
        $this->collection[$gameId->getValue()] = $game;
    }
}
