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
        $this->newRound();
    }

    /**
    * Add new Round object to array for actual player.
    *
    * @return void.
    */
    public function newRound(): void
    {
        $this->roundArr[$this->turn][] = new Round();
    }

    /**
    * Swaps turn between player and cpu.
    *
    * @return void.
    */
    public function changeTurn(): void
    {
        $this->turn = ($this->turn == 0 ? 1 : 0);
        $this->newRound();
    }

    /**
    * Roll hand for actual player and changes turn.
    *
    * @return void.
    */
    public function roll(): void
    {
        $id = count($this->roundArr[$this->turn]) - 1;
        $this->roundArr[$this->turn][$id]->rollHand();
        if ($this->roundArr[$this->turn][$id]->getLastHandSum() == 0) {
            $this->changeTurn();
        }

        // cpu?
        if ($this->turn > 0) {
            $this->cpuPlays();
        }
    }

    /**
    * Algorithm for cpu that chooses between roll och stay depending on
    * the player's points and also the accumulated points in the actual
    * round.
    *
    * @return string cpu action, roll or stay.
    */
    public function cpuPlays(): string
    {
        if ($this->getTotalValue(0) > 85 ||
        $this->getActualRound(1)->getTotalValue() < 15) {
            return "roll";
        } else {
            return "stay";
        }
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
    * Get total value for all the hands in the array.
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
