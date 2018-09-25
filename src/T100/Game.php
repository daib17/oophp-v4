<?php
namespace Daib\T100;

/**
* A Game class. Runs the logic for the T100 game.
*/
class Game
{
    const TARGET = 100; // Points to win game.

    /**
    * @var Round $roundsArr array of arrays of Round objects.
    * @var int $turn integer for the actual turn (0:player, 1:cpu).
    */
    private $roundArr;
    private $turn;

    /**
    * Constructor initializes object Game.
    */
    public function __construct()
    {
        $this->roundArr = array();
        $this->roundArr[] = array();
        $this->roundArr[] = array();
        $this->turn = 0;
    }

    /**
    * Initialize game.
    *
    * @return void.
    */
    public function init(): void
    {
        $this->turn = 0;
        // add Round to player's array
        $this->roundArr[0][] = new Round();
    }

    /**
    * Roll hand for actual player.
    *
    * @return void.
    */
    public function roll(): void
    {
        $roundID = count($this->roundArr[0]) - 1;
        $this->roundArr[0][$roundID]->rollHand();
    }

    /**
    * Roll hand for cpu.
    *
    * @return void.
    */
    public function cpuPlays(): void
    {
        $this->turn = 1;
        // new Round for cpu
        $this->roundArr[1][] = new Round();
        // roll hand while not game over, sum not zero and cpu's points lower
        // than player's.
        do {
            $roundID = count($this->roundArr[1]) - 1;
            $this->roundArr[1][$roundID]->rollHand();
        } while (!$this->gameIsOver() &&
            $this->roundArr[1][$roundID]->getLastHandSum() != 0 &&
            $this->getTotalValue(1) < $this->getTotalValue(0));

        if (!$this->gameIsOver()) {
            $this->turnBackToPlayer();
        }
    }

    /**
    * Turn goes back to human after cpu played.
    *
    * @return void.
    */
    public function turnBackToPlayer(): void
    {
        $this->turn = 0;
        // add Round to player
        $this->roundArr[0][] = new Round();
    }

    /**
    * Get last hand sum for given player.
    *
    * @var int $index indicates the array (0: player, 1: cpu)
    *
    * @return int last hand's value. 0 if it contains a dice with value of 1.
    */
    public function getLastHandSum(int $index): int
    {
        $id = count($this->roundArr[$index]) - 1;
        return $this->roundArr[$index][$id]->getLastHandSum();
    }

    /**
    * Get last Round object in array.
    *
    * @var int $index indicates the array (0: player, 1: cpu)
    *
    * @return Round object Round.
    */
    public function getActualRound(int $index): Round
    {
        return $this->roundArr[$index][count($this->roundArr[$index]) - 1];
    }

    /**
    * Get number of Round objects in array.
    *
    * @var int $index indicates the array (0: player, 1: cpu)
    *
    * @return int amount of objects in array.
    */
    public function getRoundCount(int $index): int
    {
        return count($this->roundArr[$index]);
    }

    /**
    * Get total value for all the rounds in the array.
    *
    * @var int $index indicates the array (0: player, 1: cpu)
    *
    * @return int total value for all the hands in the round.
    */
    public function getTotalValue(int $index): int
    {
        $total = 0;
        foreach ($this->roundArr[$index] as $round) {
            $total += $round->getTotalValue();
        }
        return $total;
    }

    /**
    * Get actual turn (0:player, 1:cpu).
    *
    * @return int actual turn.
    */
    public function getTurn(): int
    {
        return $this->turn;
    }

    /**
    * Check if any player has reached the target point limit.
    *
    * @return bool true if game is over, false otherwise.
    */
    public function gameIsOver(): bool
    {
        return $this->getTotalValue(0) >= self::TARGET ||
        $this->getTotalValue(1) >= self::TARGET;
    }
}
