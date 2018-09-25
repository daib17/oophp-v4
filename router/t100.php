<?php

$app->router->any(["GET", "POST"], "t100/play", function () use ($app) {
    // Restart button or new game?
    if (isset($_POST["reset"]) || !isset($_SESSION["game"])) {
        $game = new \Daib\T100\Game();
        $game->init();
    } else {
        // Continue previous game
        $game = unserialize($_SESSION["game"]);
    }

    if (!$game->gameIsOver()) {
        if (isset($_POST["roll"])) {
            $game->roll();
        } elseif (isset($_POST["goCPU"])) {
            $game->cpuPlays();
        }
    }

    // Serialize object
    $_SESSION["game"] = serialize($game);

    // Add view and render page
    $app->page->add("anax/v2/t100/play", [
        "title" => "Tärningsspel 100",
        "game" => $game
    ]);
    return $app->page->render();
});
