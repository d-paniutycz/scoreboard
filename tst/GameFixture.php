<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test;

use Paniutycz\Scoreboard\Entity\ConcreteGame;
use Paniutycz\Scoreboard\Entity\Game;
use Paniutycz\Scoreboard\Model\ConcreteTeam;
use Paniutycz\Scoreboard\Value\GameId;
use Paniutycz\Scoreboard\Value\TeamName;
use Paniutycz\Scoreboard\Value\TeamScore;

final readonly class GameFixture
{
    public static function create(
        ?string $gameId = null,
        string $homeTeamName = 'home',
        string $awayTeamName = 'away',
        int $homeTeamScore = 0,
        int $awayTeamScore = 0,
    ): Game {
        return new ConcreteGame(
            is_null($gameId) ? GameId::generate() : new GameId($gameId),
            new ConcreteTeam(
                new TeamName($homeTeamName),
                new TeamScore($homeTeamScore),
            ),
            new ConcreteTeam(
                new TeamName($awayTeamName),
                new TeamScore($awayTeamScore),
            ),
        );
    }

    /**
     * @return array<Game>
     */
    public static function createFromArray(array $gameDataList): array
    {
        foreach ($gameDataList as $gameData) {
            $games[] = GameFixture::create(...$gameData);
        }

        return $games ?? [];
    }
}
