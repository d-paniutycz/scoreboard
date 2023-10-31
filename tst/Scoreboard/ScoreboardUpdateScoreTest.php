<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test\Scoreboard;

use Paniutycz\Scoreboard\Entity\ConcreteGameCollection;
use Paniutycz\Scoreboard\Entity\ConcreteGameFactory;
use Paniutycz\Scoreboard\Entity\GameCollection;
use Paniutycz\Scoreboard\Exception\GameNotFoundException;
use Paniutycz\Scoreboard\Model\ConcreteTeamFactory;
use Paniutycz\Scoreboard\Scoreboard;
use Paniutycz\Scoreboard\Test\GameFixture;
use Paniutycz\Scoreboard\Value\GameId;
use Paniutycz\Scoreboard\Value\TeamScore;
use PHPUnit\Framework\TestCase;

final class ScoreboardUpdateScoreTest extends TestCase
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

    public function testGameScoreCanBeUpdated(): void
    {
        // arrange
        $game = GameFixture::create();
        $gameId = $game->getId();

        $this->collection->set($game->getId(), $game);

        // act
        $this->scoreboard->updateScore($gameId, new TeamScore(1), new TeamScore(2));

        // assert
        $game = $this->collection->get($game->getId());

        self::assertNotNull($game);
        self::assertEquals(1, $game->getHomeTeam()->getScore->getValue());
        self::assertEquals(2, $game->getAwayTeam()->getScore->getValue());
    }

    public function testGameScoreCantBeUpdatedIfGameNotFound(): void
    {
        // arrange
        $gameId = GameId::generate();

        // assert
        self::expectException(GameNotFoundException::class);

        // act
        $this->scoreboard->updateScore($gameId);
    }
}
