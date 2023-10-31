<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Value;

readonly class TeamScore
{
    public function __construct(
        private int $value,
    ) {
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
