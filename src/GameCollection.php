<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard;

final class GameCollection
{
    private array $collection = [];

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->collection);
    }

    public function set(string $key, mixed $value): void
    {
        $this->collection[$key] = $value;
    }
}
