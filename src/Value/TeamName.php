<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Value;

use Paniutycz\Scoreboard\Exception\InvalidTeamNameValueException;

readonly class TeamName
{
    private string $value;

    public function __construct(
        string $value,
    ) {
        if (empty($value)) {
            throw new InvalidTeamNameValueException('empty');
        }

        $this->value = $value;
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
