<?php

$app->router->any("GET|POST", "t100/play", function () use ($app) {

    $game = $app->session->get("game");

    if (!$game || $app->request->getPost("reset")) {
        $game = new \Daib\T100\Game();
        $game->init();
    }

    if (!$game->gameIsOver()) {
        if ($app->request->getPost("roll")) {
            $game->roll();
        } elseif ($app->request->getPost("goCPU")) {
            $game->cpuPlays();
        }
    }

    $app->session->set("game", $game);

    // Add view and render page
    $app->page->add("anax/v2/t100/play", [
        "title" => "Tärningsspel 100",
        "game" => $game
    ]);
    return $app->page->render();
});
