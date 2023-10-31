<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard;

use Paniutycz\Scoreboard\Entity\Game;
use Paniutycz\Scoreboard\Entity\GameCollection;
use Paniutycz\Scoreboard\Entity\GameFactory;
use Paniutycz\Scoreboard\Exception\GameAlreadyExistsException;
use Paniutycz\Scoreboard\Exception\GameNotFoundException;
use Paniutycz\Scoreboard\Exception\TeamAlreadyInGameException;
use Paniutycz\Scoreboard\Model\Team;
use Paniutycz\Scoreboard\Model\TeamFactory;
use Paniutycz\Scoreboard\Value\GameId;
use Paniutycz\Scoreboard\Value\TeamName;
use Paniutycz\Scoreboard\Value\TeamScore;

final readonly class Scoreboard
{
    public function __construct(
        private TeamFactory $teamFactory,
        private GameFactory $gameFactory,
        private GameCollection $gameCollection,
    ) {
    }

    /**
     * @throws GameAlreadyExistsException
     * @throws TeamAlreadyInGameException
     */
    public function startGame(TeamName $homeTeamName, TeamName $awayTeamName): Game
    {
        $homeTeam = $this->teamFactory->create($homeTeamName, new TeamScore(0));
        $this->assertTeamNotInOtherGame($homeTeam);

        $awayTeam = $this->teamFactory->create($awayTeamName, new TeamScore(0));
        $this->assertTeamNotInOtherGame($awayTeam);

        $game = $this->gameFactory->create($homeTeam, $awayTeam);

        $gameId = $game->getId();
        if ($this->gameCollection->has($gameId)) {
            throw new GameAlreadyExistsException($gameId);
        }

        $this->gameCollection->set($gameId, $game);

        return clone $game;
    }

    /**
     * @throws TeamAlreadyInGameException
     */
    private function assertTeamNotInOtherGame(Team $team): void
    {
        /** @var Game $game */
        foreach ($this->gameCollection as $game) {
            if ($game->isTeamInGame($team)) {
                throw new TeamAlreadyInGameException($team->getName(), $game->getId());
            }
        }
    }

    /**
     * @throws GameNotFoundException
     */
    public function finishGame(GameId $gameId): void
    {
        if (!$this->gameCollection->has($gameId)) {
            throw new GameNotFoundException($gameId);
        }

        $this->gameCollection->unset($gameId);
    }

    /**
     * @throws GameNotFoundException
     */
    public function updateScore(GameId $gameId, TeamScore $homeTeamScore, TeamScore $awayTeamScore): Game
    {
        if (!$this->gameCollection->has($gameId)) {
            throw new GameNotFoundException($gameId);
        }

        $game = $this->gameCollection->get($gameId);

        $game->getHomeTeam()->setScore($homeTeamScore);
        $game->getAwayTeam()->setScore($awayTeamScore);

        return clone $game;
    }

    private function compareGames(Game $a, Game $b): int
    {
        if ($a->getTotalScore() == $b->getTotalScore()) {
            return $b->getLastUpdateTime() <=> $a->getLastUpdateTime();
        }

        return $b->getTotalScore() <=> $a->getTotalScore();
    }

    public function getSummaryByTotalScore(): array
    {
        $games = iterator_to_array($this->gameCollection);

        usort($games, [$this, 'compareGames']);

        return $games;
    }
}
