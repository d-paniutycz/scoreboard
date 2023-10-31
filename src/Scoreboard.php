<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard;

final readonly class Scoreboard
{
    public function __construct(
        private GameCollection $gameCollection,
    ) {
    }

    public function startGame(string $homeTeamName, string $awayTeamName): Game
    {
        $game = new Game($homeTeamName, $awayTeamName);

        if ($this->gameCollection->has($game->getId())) {
            throw new \Exception('Game id:' . $game->getId() . ' already exists');
        }

        $this->gameCollection->set($game->getId(), $game);

        return $game;
    }
}
