<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Value;

use Paniutycz\Scoreboard\Exception\InvalidScoreValueException;

readonly class TeamScore
{
    private int $value;

    /**
     * @throws InvalidScoreValueException
     */
    public function __construct(
        int $value,
    ) {
        echo $value;
        if ($value < 0 || $value > PHP_INT_MAX - 1) {
            throw new InvalidScoreValueException($value);
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
