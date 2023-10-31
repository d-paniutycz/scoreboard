<?php

declare(strict_types=1);

namespace Paniutycz\Scoreboard\Test\Scoreboard;

use Paniutycz\Scoreboard\Entity\ConcreteGameCollection;
use Paniutycz\Scoreboard\Entity\ConcreteGameFactory;
use Paniutycz\Scoreboard\Entity\Game;
use Paniutycz\Scoreboard\Entity\GameCollection;
use Paniutycz\Scoreboard\Exception\GameBetweenSameTeamException;
use Paniutycz\Scoreboard\Exception\TeamAlreadyInGameException;
use Paniutycz\Scoreboard\Model\ConcreteTeamFactory;
use Paniutycz\Scoreboard\Scoreboard;
use Paniutycz\Scoreboard\Test\GameFixture;
use Paniutycz\Scoreboard\Value\TeamName;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ScoreboardStartGameTest extends TestCase
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

    public function testGameCanBeStarted(): void
    {
        // act
        $game = $this->scoreboard->startGame(
            new TeamName('home'),
            new TeamName('away'),
        );

        // assert
        self::assertInstanceOf(Game::class, $game);
        self::assertTrue(
            $this->collection->has(
                $game->getId()
            )
        );
    }

    public function testGameInitialScoreEqualsZero(): void
    {
        // act
        $game = $this->scoreboard->startGame(
            new TeamName('home'),
            new TeamName('away'),
        );

        // assert
        self::assertEquals(0, $game->getHomeTeam()->getScore()->getValue());
        self::assertEquals(0, $game->getAwayTeam()->getScore()->getValue());
    }

    #[DataProvider('teamNamesProvider')]
    public function testGameCantBeStartedIfOneOfTeamIsInOtherGame(string $homeTeamName, string $awayTeamName): void
    {
        // arrange
        $game = GameFixture::create(null, $homeTeamName, $awayTeamName);

        $this->collection->set($game->getId(), $game);

        // assert
        self::expectException(TeamAlreadyInGameException::class);

        // act
        $this->scoreboard->startGame(
            new TeamName('home'),
            new TeamName('away'),
        );
    }

    public static function teamNamesProvider(): array
    {
        return [
            ['home', 'away'],
            ['homeA', 'away'],
            ['home', 'awayA'],
        ];
    }

    public function testGameCantBeStartedIfBetweenSameTeam(): void
    {
        // assert
        self::expectException(GameBetweenSameTeamException::class);

        // act
        $this->scoreboard->startGame(
            new TeamName('home'),
            new TeamName('home'),
        );
    }
}
