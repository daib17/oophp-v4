<?php

namespace Daib\T100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
    * Test method ChangeTurn
    */
    public function testChangeTurn()
    {
        $game = new Game();
        $turnBefore = $game->getTurn();
        $game->changeTurn();
        $turnAfter = $game->getTurn();
        $this->assertFalse($turnBefore == $turnAfter);
    }

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
        // If value for player's hand is 0 then the turn changed
        $value = $game->getTotalValue(0);
        if ($value == 0) {
            $this->assertEquals(1, $game->getTurn());
        } else {
            $this->assertEquals(0, $game->getTurn());
        }
    }

    /**
    * Test method cpuPlays
    */
    public function testCpuPlays()
    {
        $game = new Game();
        $game->init();
        //  Change to cpu
        $game->changeTurn();
        $this->assertEquals("roll", $game->cpuPlays());
        // Let's force cpu to "stay"
        do {
            if ($game->getTurn() == 0) {
                $game->changeTurn();
            }
            $game->roll();
        } while ($game->cpuPlays() == "roll");
        $this->assertEquals("stay", $game->cpuPlays());
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
}
