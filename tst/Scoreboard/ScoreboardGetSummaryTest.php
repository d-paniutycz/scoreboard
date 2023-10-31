<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test\Scoreboard;

use Paniutycz\Scoreboard\Entity\ConcreteGameCollection;
use Paniutycz\Scoreboard\Entity\ConcreteGameFactory;
use Paniutycz\Scoreboard\Entity\GameCollection;
use Paniutycz\Scoreboard\Model\ConcreteTeamFactory;
use Paniutycz\Scoreboard\Policy\GameFilterByTotalScorePolicy;
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
            ['3', 'Mexico', 'Canada', 0, 5],
            ['2', 'Spain', 'Brazil', 10, 2],
            ['5', 'Germany', 'France', 2, 2],
            ['1', 'Uruguay', 'Italy', 6, 6],
            ['4', 'Argentina', 'Australia', 3, 1],
        ]);

        foreach ($games as $game) {
            $this->collection->set($game->getId(), $game);
        }

        // act
        $games = $this->scoreboard->getSummary(
            new GameFilterByTotalScorePolicy()
        );

        // assert
        $i = 1;
        foreach ($games as $game) {
            self::assertEquals($game->getId()->getValue(), $i++);
        }
    }
}
