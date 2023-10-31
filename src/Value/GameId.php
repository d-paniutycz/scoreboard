<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Value;

readonly class GameId
{
    public static function generate(): self
    {
        return new self(
            md5(
                random_bytes(16)
            )
        );
    }

    public function __construct(
        private string $value,
    ) {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
