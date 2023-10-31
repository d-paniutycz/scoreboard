<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard;

use Paniutycz\Scoreboard\Entity\Game;
use Paniutycz\Scoreboard\Entity\GameCollection;
use Paniutycz\Scoreboard\Entity\GameFactory;
use Paniutycz\Scoreboard\Exception\GameAlreadyExistsException;
use Paniutycz\Scoreboard\Model\TeamFactory;
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
     */
    public function startGame(TeamName $homeTeamName, TeamName $awayTeamName): Game
    {
        $homeTeam = $this->teamFactory->create($homeTeamName, new TeamScore(0));
        $awayTeam = $this->teamFactory->create($awayTeamName, new TeamScore(0));

        $game = $this->gameFactory->create($homeTeam, $awayTeam);

        $gameId = $game->getId();
        if ($this->gameCollection->has($gameId)) {
            throw new GameAlreadyExistsException($gameId);
        }

        $this->gameCollection->set($gameId, $game);

        return $game;
    }
}
