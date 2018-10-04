<?php

namespace Daib\T100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class RoundHistogram.
 */
class RoundHistogramTest extends TestCase
{
    /**
    * Test method getHistogramMax.
    */
    public function testGetHistogramMax()
    {
        $round = new RoundHistogram();
        $this->assertEquals(6, $round->getHistogramMax());
    }

    /**
    * Test method rollHand.
    */
    public function testRollHand()
    {
        $round = new RoundHistogram();
        $round->rollHand();
        $this->assertFalse(empty($round->getHistogramSerie()));
    }
}
