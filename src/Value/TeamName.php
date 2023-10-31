<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Value;

readonly class TeamName
{
    public function __construct(
        private string $value,
    ) {
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(TeamName $name): bool
    {
        return $name->getValue() === $this->value;
    }
}
