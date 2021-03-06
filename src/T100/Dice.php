<?php
namespace Daib\T100;

/**
* A dice.
*/
class Dice
{
    /**
    * @var int $sides number of sides.
    * @var int $lastRoll value obtained in last roll.
    */
    private $sides;
    private $lastRoll;

    /**
    * Constructor initializes dice object.
    *
    * @param int $sides number of sides. Default is 6.
    */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
        $this->lastRoll = null;
    }

    /**
    * Roll dice and return value.
    *
    * @return int value.
    */
    public function roll(): int
    {
        $this->lastRoll = rand(1, $this->sides);
        return $this->lastRoll;
    }

    /**
    * Getter for variable lastRoll.
    *
    * @return int as value of last roll.
    */
    public function getLastRoll(): int
    {
        return $this->lastRoll;
    }
}
