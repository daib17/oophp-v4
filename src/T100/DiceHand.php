<?php
namespace Daib\T100;

/**
* A hand of dice.
*/
class DiceHand
{
    /**
    * @var Dice $dices   Array consisting of dice.
    * @var int  $values  Array consisting of last roll of the dice.
    */
    private $dices;
    private $values;

    /**
    * Constructor to initiate the dicehand with a number of dice.
    *
    * @param int $numberOfDices Number of dice to create, defaults to five.
    * @param int $nSides Number of sides on dice.
    */
    public function __construct(int $numberOfDices = 5, int $nSides = 6)
    {
        $this->dices = [];
        $this->values = [];

        for ($i = 0; $i < $numberOfDices; $i++) {
            $this->dices[$i] = new Dice($nSides);
            $this->values[$i] = null;
        }
    }

    /**
    * Roll all dice save their value.
    *
    * @return void.
    */
    public function roll(): void
    {
        for ($i = 0; $i < sizeof($this->dices); $i++) {
            $this->values[$i] = $this->dices[$i]->roll();
        }
    }

    /**
    * Get values of dice from last roll.
    *
    * @return array with values of the last roll.
    */
    public function values(): array
    {
        return $this->values;
    }

    /**
    * Get the sum of all dice.
    *
    * @var int  $t100 if true, sum becomes zero if there is a dice
    * with value of 1 in the hand.
    *
    * @return int the sum of all dice.
    */
    public function sum(bool $t100 = false): int
    {
        if ($t100) {
            if (in_array(1, $this->values)) {
                return 0;
            }
        }
        return array_sum($this->values);
    }

    /**
    * Get the average of all dice.
    *
    * @return float as the average of all dice.
    */
    public function average(): float
    {
        return round($this->sum() / sizeof($this->dices), 1);
    }
}
