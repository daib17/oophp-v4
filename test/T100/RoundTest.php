<?php

namespace Daib\T100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Round.
 */
class RoundTest extends TestCase
{
    /**
     * Test that rollHand actually creates DiceHand object and
     * appends them to $hands array.
     */
    public function testRollHand()
    {
        $round = new Round();
        $round->rollHand();
        $this->assertEquals(1, $round->getHandsCount());
        $round->rollHand();
    }

    /**
    * Test getLastHand method.
    */
    public function testLastHand()
    {
        // Test empty round
        $round = new Round();
        $this->assertNull($round->getLastHand());
        // Test object in round instance of DiceHand
        $round->rollHand();
        $res = $round->getLastHand();
        $this->assertInstanceOf("\Daib\T100\DiceHand", $res);
    }

    /**
    * Test getLastHand method.
    */
    public function testGetLastHandValues()
    {
        $round = new Round();
        // test empty array first
        $this->assertTrue(empty($round->getLastHandValues()));
        // add hand now
        $round->rollHand();
        $last = $round->getLastHand();
        $exp = $last->values();
        $this->assertEquals($exp, $round->getLastHandValues());
    }

    /**
    * Test getLastHandSum
    */
    public function testGetLastHandSum()
    {
        $round = new Round();
        // Test empty array
        $this->assertNull($round->getLastHandSum());
        // Add hand now
        $round->rollHand();
        $hand = $round->getLastHand();
        $this->assertEquals($hand->sum(true), $round->getLastHandSum());
    }

    /**
    * Test getValue method.
    */
    public function testGetValue()
    {
        // Test with non zero value $hands
        do {
            $round = new Round();
            $round->rollHand(); // 1st hand
            $sum1 = $round->getLastHandSum();
            $round->rollHand(); // 2st hand
            $sum2 = $round->getLastHandSum();
        } while ($sum1 == 0 || $sum2 == 0);
        $this->assertEquals($sum1 + $sum2, $round->getValue());

        // Test with at least one zero value hand
        do {
            $round = new Round();
            $round->rollHand(); // 1st hand
            $sum1 = $round->getLastHandSum();
            $round->rollHand(); // 2st hand
            $sum2 = $round->getLastHandSum();
        } while ($sum1 != 0 && $sum2 != 0);
        $this->assertEquals(0, $round->getValue());
    }

    /**
    * Test getAllHands method.
    */
    public function testGetAllHands()
    {
        $round = new Round();
        $this->assertEquals(0, count($round->getAllHands()));
        $round->rollHand();
        $this->assertEquals(1, count($round->getAllHands()));
    }
}
