<?php

namespace Daib\T100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DiceHand.
 */
class DiceHandTest extends TestCase
{
    /**
     * Test that roll method actual gives values withing range
     * for all dice in hand.
     */
    public function testRoll()
    {
        $diceHand = new DiceHand();
        $diceHand->roll();
        $values = $diceHand->values();
        foreach ($values as $val) {
            $this->assertTrue($val > 0 && $val < 7);
        }
    }

    /**
    * Test sum method.
    */
    public function testSum()
    {
        $diceHand = new DiceHand();
        $diceHand->roll();
        $values = $diceHand->values();
        $this->assertEquals(array_sum($values), $diceHand->sum());
    }

    /**
    * Test sum T100 method.
    */
    public function testSumT100()
    {
        $diceHand = new DiceHand();
        do {
            $diceHand->roll();
        } while (!in_array(1, $diceHand->values()));

        $this->assertEquals(0, $diceHand->sum(true));
    }

    /**
    * Test average method.
    */
    public function testAverage()
    {
        $diceHand = new DiceHand();
        $diceHand->roll();
        $values = $diceHand->values();
        $avg = round(array_sum($values) / count($values), 1);
        $this->assertEquals($avg, $diceHand->average());
    }
}
