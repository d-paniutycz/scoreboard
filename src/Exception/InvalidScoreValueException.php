<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Exception;

final class InvalidScoreValueException extends ScoreboardException
{
    private const TEMPLATE = 'Invalid score value: %s.';

    public function __construct(
        int $value,
    ) {
        parent::__construct(
            sprintf(self::TEMPLATE, $value)
        );
    }
}
