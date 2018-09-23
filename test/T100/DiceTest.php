<?php

namespace Daib\T100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Test roll method.
     */
    public function testRoll()
    {
        $dice = new Dice();
        $res = $dice->roll();
        $this->assertTrue($res > 0 && $res < 7);
    }

    /**
    * Test getLastRoll method.
    */
    public function testGetLastRoll()
    {
        $dice = new Dice();
        $res = $dice->roll();
        $this->assertEquals($res, $dice->getLastRoll());
    }
}
