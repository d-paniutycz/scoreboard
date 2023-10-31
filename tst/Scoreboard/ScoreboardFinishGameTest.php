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
use PHPUnit\Framework\TestCase;

class ScoreboardFinishGameTest extends TestCase
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

    public function testGameCanBeFinished(): void
    {
        // arrange
        $game = GameFixture::create();
        $gameId = $game->getId();

        $this->collection->set($gameId, $game);

        // act
        $this->scoreboard->finishGame($gameId);

        // assert
        self::assertFalse($this->collection->has($gameId));
    }

    public function testGameHaveExistToBeFinished(): void
    {
        // arrange
        $gameId = GameId::generate();

        // assert
        self::expectException(GameNotFoundException::class);

        // act
        $this->scoreboard->finishGame($gameId);
    }
}
