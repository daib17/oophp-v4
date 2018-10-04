<?php

namespace Daib\T100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
    * Test method getRoundCount
    */
    public function testGetRoundCount()
    {
        $game = new Game();
        $game->init();
        $this->assertEquals(1, $game->getRoundCount(0));
    }

    /**
    * Test method roll
    */
    public function testRoll()
    {
        $game = new Game();
        $game->init();
        $game->roll();
        $this->assertTrue($game->getLastHandSum(0) > -1);
    }

    /**
    * Test method cpuPlays
    */
    public function testCpuPlays()
    {
        $game = new Game();
        $game->init();
        $game->cpuPlays();
        $this->assertEquals(1, $game->getRoundCount(1));
    }

    /**
    * Test method getActualRound
    */
    public function testGetActualRound()
    {
        $game = new Game();
        $game->init();
        $this->assertInstanceof("\Daib\T100\Round", $game->getActualRound(0));
    }

    /**
    * Test method gameIsOver
    */
    public function testGameIsOver()
    {
        $game = new Game();
        $game->init();
        $this->assertFalse($game->gameIsOver());
    }

    /**
    * Test method getTurn.
    */
    public function testGetTurn()
    {
        $game = new Game();
        $game->init();
        $this->assertEquals(0, $game->getTurn());
    }

    /**
    * Test method getTurn.
    */
    public function testprintHistogram()
    {
        $game = new Game();
        $game->init();
        $this->assertFalse($game->printHistogram(0) == "");
        $this->assertTrue($game->printHistogram(1) == "");
    }
}
