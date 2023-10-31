<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Exception;

final class InvalidTeamNameValueException extends ScoreboardException
{
    private const TEMPLATE = 'Invalid name value: %s.';

    public function __construct(
        string $value,
    ) {
        parent::__construct(
            sprintf(self::TEMPLATE, $value)
        );
    }
}
