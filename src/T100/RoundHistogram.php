<?php

namespace Daib\T100;

/**
* A round which has the ability to present data to be used
* for creating a histogram.
*/
class RoundHistogram extends Round implements HistogramInterface
{
    use HistogramTrait;

    /**
    * Get max value for the histogram.
    *
    * @return int with the max value.
    */
    public function getHistogramMax()
    {
        return self::SIDES;
    }

    /**
    * Overwrite method. Roll hand and store values in array.
    *
    * @return void
    */
    public function rollHand(): void
    {
        parent::rollHand();
        foreach ($this->getLastHandValues() as $val) {
            array_push($this->serie, $val);
        }
    }
}
