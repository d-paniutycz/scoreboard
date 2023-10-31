<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use ArrayIterator;
use Paniutycz\Scoreboard\Value\GameId;
use Traversable;

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

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->collection);
    }

    public function unset(GameId $gameId): void
    {
        unset($this->collection[$gameId->getValue()]);
    }
}
