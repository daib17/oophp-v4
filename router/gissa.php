<?php
/**
 * Guess game specific routes.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Guess my number with GET.
 */
$app->router->get("gissa/get", function () use ($app) {
    $data = [
        "title" => "Gissa mitt nummer (GET)",
    ];

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
    $game = new \Daib\Guess\Guess($number, $tries);

    // Error message
    $exMessage = null;

    // Make a guess
    $res = null;
    if (isset($_GET["doGuess"])) {
        try {
            $res = $game->makeGuess($guess);
        } catch (\Daib\Guess\GuessException $e) {
            $exMessage = $e->getMessage();
        }
    }

    $data["game"] = $game;
    $data["res"] = $res;
    $data["guess"] = $guess;
    $data["exMessage"] = $exMessage;

    // Add view and render page
    $app->page->add("anax/v2/guess/get", $data);
    return $app->page->render();
});


/**
 * Guess my number with POST.
 */
$app->router->any(["GET", "POST"], "gissa/post", function () use ($app) {
    $data = [
        "title" => "Gissa mitt nummer (POST)",
    ];

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
    $game = new \Daib\Guess\Guess($number, $tries);

    // Error message
    $exMessage = null;

    // Do a guess
    $res = null;
    if (isset($_POST["doGuess"])) {
        try {
            $res = $game->makeGuess($guess);
        } catch (\Daib\Guess\GuessException $e) {
            $exMessage = $e->getMessage();
        }
    }

    $data["game"] = $game;
    $data["res"] = $res;
    $data["guess"] = $guess;
    $data["exMessage"] = $exMessage;

    // Add view and render page
    $app->page->add("anax/v2/guess/post", $data);
    return $app->page->render();
});

/**
 * Guess my number with SESSION.
 */
$app->router->any(["GET", "POST"], "gissa/session", function () use ($app) {

    // Start session if no session available
    if (session_status() < 2) {
        start_session();
    }

    $data = [
        "title" => "Gissa mitt nummer (SESSION)",
    ];

    // Error message
    $exMessage = null;

    if (isset($_POST["doReset"])) {
        $game = new \Daib\Guess\Guess();
        $guess = null;
    } else if (isset($_SESSION["game"])) {
        // Unserialize object
        $game = unserialize($_SESSION["game"]);
        $guess = $_POST["guess"] ?? null;
    } else {
        $number = $_POST["number"] ?? -1;
        $tries = $_POST["tries"] ?? 6;
        $guess = $_POST["guess"] ?? null;
        $game = new \Daib\Guess\Guess($number, $tries);
    }

    // Make a guess
    $res = null;
    if (isset($_POST["doGuess"])) {
        try {
            $res = $game->makeGuess($guess);
        } catch (\Daib\Guess\GuessException $e) {
            $exMessage = $e->getMessage();
        }
    }

    // Serialize object
    $_SESSION["game"] = serialize($game);

    $data["game"] = $game;
    $data["res"] = $res;
    $data["guess"] = $guess;
    $data["exMessage"] = $exMessage;

    // Add view and render page
    $app->page->add("anax/v2/guess/post", $data);
    return $app->page->render();
});
