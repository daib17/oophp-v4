<?php
session_name("guess");
session_start();

require "config.php";
require "autoload.php";

// Page title
$title = "Guess my number (SESSION)";

// Error message
$exMessage = null;

if (isset($_POST["doReset"])) {
    $game = new Guess();
    $guess = null;
} else if (isset($_SESSION["game"])) {
    // Unserialize object
    $game = unserialize($_SESSION["game"]);
    $guess = $_POST["guess"] ?? null;
} else {
    $number = $_POST["number"] ?? -1;
    $tries = $_POST["tries"] ?? 6;
    $guess = $_POST["guess"] ?? null;
    $game = new Guess($number, $tries);
}

// Make a guess
$res = null;
if (isset($_POST["doGuess"])) {
    try {
        $res = $game->makeGuess($guess);
    } catch (GuessException $e) {
        $exMessage = $e->getMessage();
    }
}

// Serialize object
$_SESSION['game'] = serialize($game);

require __DIR__ . "/view/session_view.php";
