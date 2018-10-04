<?php

namespace Daib\T100;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Histogram.
 */
class HistogramTest extends TestCase
{
    /**
    * Test method getSerie.
    */
    public function testGetSerie()
    {
        $histo = new Histogram();
        $roundHistogram = new RoundHistogram();
        $this->assertTrue(empty($histo->getSerie()));
        $roundHistogram->rollHand();
        $histo->injectData($roundHistogram);
        $this->assertFalse(empty($histo->getSerie()));
    }

    /**
    * Test method getAsText.
    */
    public function testGetAsText()
    {
        $histo = new Histogram();
        $roundHistogram = new RoundHistogram();
        $this->assertEquals("", $histo->getAsText());
        $roundHistogram->rollHand();
        $histo->injectData($roundHistogram);
        $this->assertFalse($histo->getAsText() == "");
    }
}
