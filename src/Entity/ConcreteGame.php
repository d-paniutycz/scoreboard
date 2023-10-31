<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Entity;

use DateTimeImmutable;
use Paniutycz\Scoreboard\Exception\GameBetweenSameTeamException;
use Paniutycz\Scoreboard\Model\Team;
use Paniutycz\Scoreboard\Value\GameId;

final readonly class ConcreteGame implements Game
{
    /**
     * @throws GameBetweenSameTeamException
     */
    public function __construct(
        private GameId $id,
        private Team $homeTeam,
        private Team $awayTeam,
    ) {
        if ($this->homeTeam->equals($this->awayTeam)) {
            throw new GameBetweenSameTeamException($this->homeTeam->getName());
        }
    }

    public function getId(): GameId
    {
        return $this->id;
    }

    public function getHomeTeam(): Team
    {
        return $this->homeTeam;
    }

    public function getAwayTeam(): Team
    {
        return $this->awayTeam;
    }

    public function getTotalScore(): int
    {
        return $this->homeTeam->getScore()->getValue() + $this->awayTeam->getScore()->getValue();
    }

    public function getLastUpdateTime(): ?DateTimeImmutable
    {
        return max(
            $this->homeTeam->getLastUpdateTime(),
            $this->awayTeam->getLastUpdateTime(),
        );
    }

    public function isTeamInGame(Team $team): bool
    {
        return $team->equals($this->homeTeam) || $team->equals($this->awayTeam);
    }
}
