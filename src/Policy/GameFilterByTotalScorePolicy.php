<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Policy;

use Paniutycz\Scoreboard\Entity\Game;
use Paniutycz\Scoreboard\Entity\GameCollection;

class GameFilterByTotalScorePolicy implements GameFilterPolicy
{
    public function filter(GameCollection $collection): array
    {
        /** @var array<Game> $games */
        $games = iterator_to_array($collection);

        usort($games, [$this, 'compareGames']);

        return $games;
    }

    private function compareGames(Game $a, Game $b): int
    {
        if ($a->getTotalScore() === $b->getTotalScore()) {
            return $b->getLastUpdateTime() <=> $a->getLastUpdateTime();
        }

        return $b->getTotalScore() <=> $a->getTotalScore();
    }
}
