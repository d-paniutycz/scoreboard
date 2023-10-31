<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test\Scoreboard;

use Paniutycz\Scoreboard\Entity\ConcreteGameCollection;
use Paniutycz\Scoreboard\Entity\ConcreteGameFactory;
use Paniutycz\Scoreboard\Entity\Game;
use Paniutycz\Scoreboard\Entity\GameCollection;
use Paniutycz\Scoreboard\Model\ConcreteTeamFactory;
use Paniutycz\Scoreboard\Scoreboard;
use Paniutycz\Scoreboard\Test\GameFixture;
use PHPUnit\Framework\TestCase;

class ScoreboardGetSummaryTest extends TestCase
{
    private readonly GameCollection $collection;

    private readonly Scoreboard $scoreboard;

    protected function setUp(): void
    {
        $this->collection = new ConcreteGameCollection();

        $this->scoreboard = new Scoreboard(
            new ConcreteTeamFactory(),
            new ConcreteGameFactory(),
            $this->collection,
        );
    }

    public function testSummaryOfGamesByTotalScoreIsInCorrectOrder(): void
    {
        // arrange
        $games = GameFixture::createFromArray([
            ['a', 'Mexico', 'Canada', 0, 5],
            ['b', 'Spain', 'Brazil', 10, 2],
            ['c', 'Germany', 'France', 2, 2],
            ['d', 'Uruguay', 'Italy', 6, 6],
            ['e', 'Argentina', 'Australia', 3, 1],
        ]);

        /** @var Game $game */
        foreach ($games as $game) {
            $this->collection->set($game->getId(), $game);
        }

        // act
        $gameList = $this->scoreboard->getSummaryByTotalScore();

        $actualOrder = [];
        foreach ($gameList as $game) {
            $actualOrder[] = $game->getId()->getValue();
        }

        // assert
        $expectedOrder = ['d', 'b', 'a', 'e', 'c'];
        self::assertEquals($expectedOrder, $actualOrder);
    }
}
