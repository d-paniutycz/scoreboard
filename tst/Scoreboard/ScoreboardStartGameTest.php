<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test\Scoreboard;

use Paniutycz\Scoreboard\Game;
use Paniutycz\Scoreboard\GameCollection;
use Paniutycz\Scoreboard\Scoreboard;
use PHPUnit\Framework\TestCase;

final class ScoreboardStartGameTest extends TestCase
{
    public function testGameCanBeStarted(): void
    {
        // arrange
        $collection = new GameCollection();
        $scoreboard = new Scoreboard($collection);

        // act
        $game = $scoreboard->startGame('home', 'away');

        // assert
        self::assertInstanceOf(Game::class, $game);
        self::assertTrue($collection->has($game->getId()));
    }

    public function testGameInitialScoreEqualsZero(): void
    {
        // arrange
        $scoreboard = new Scoreboard(
            new GameCollection()
        );

        // act
        $game = $scoreboard->startGame('home', 'away');

        // assert
        self::assertEquals(0, $game->getHomeTeamScore());
        self::assertEquals(0, $game->getAwayTeamScore());
    }
}
