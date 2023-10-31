<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard;

final readonly class Game
{
    public function __construct(
        private string $homeTeamName,
        private string $awayTeamName,
        private int $homeTeamScore = 0,
        private int $awayTeamScore = 0,
    ) {
    }

    public function getId(): string
    {
        return md5($this->homeTeamName . ':' . $this->awayTeamName);
    }

    public function getHomeTeamScore(): int
    {
        return $this->homeTeamScore;
    }

    public function getAwayTeamScore(): int
    {
        return $this->awayTeamScore;
    }
}
