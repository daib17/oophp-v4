<?php
require "config.php";
require "autoload.php";

// Page title
$title = "Guess my number (POST)";

// Error message
$exMessage = null;

if (isset($_POST["doReset"])) {
    $number = -1;
    $tries = 6;
    $guess = null;
} else {
    $number = $_POST["number"] ?? -1;
    $tries = $_POST["tries"] ?? 6;
    $guess = $_POST["guess"] ?? null;
}

// Start game
$game = new Guess($number, $tries);

// Do a guess
$res = null;
if (isset($_POST["doGuess"])) {
    try {
        $res = $game->makeGuess($guess);
    } catch (GuessException $e) {
        $exMessage = $e->getMessage();
    }
}

require __DIR__ . "/view/post_view.php";
