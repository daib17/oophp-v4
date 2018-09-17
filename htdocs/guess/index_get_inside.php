<?php
require "config.php";
require "autoload.php";

// Page title
$title = "Guess my number (GET)";

// Error message
$exMessage = null;

if (isset($_GET["doReset"])) {
    $number = -1;
    $tries = 6;
    $guess = null;
} else {
    $number = $_GET["number"] ?? -1;
    $tries = $_GET["tries"] ?? 6;
    $guess = $_GET["guess"] ?? null;
}

// Start game
$game = new Guess($number, $tries);

// Make a guess
$res = null;
if (isset($_GET["doGuess"])) {
    try {
        $res = $game->makeGuess($guess);
    } catch (GuessException $e) {
        $exMessage = $e->getMessage();
    }
}

require __DIR__ . "/view/get_view.php";
