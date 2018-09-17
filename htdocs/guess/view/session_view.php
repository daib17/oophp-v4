<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
</head>
<body>
    <h1><?= $title ?></h1>

    <p>Guess a number between 1 and 100, you have <?= $game->tries() ?> tries left.</p>

    <form method="POST">
        <input type="hidden" name="number" value="<?= $game->number() ?>">
        <input type="hidden" name="tries" value="<?= $game->tries() ?>">
        <input type="text" name="guess" value="<?= $guess ?>" autofocus>
        <input type="submit" name="doGuess" value="Make a guess">
        <input type="submit" name="doCheat" value="Cheat">
        <input type="submit" name="doReset" value="Reset game">
    </form>

    <?php if (isset($res)) : ?>
        <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
    <?php endif; ?>

    <?php if (isset($_POST["doCheat"])) : ?>
        <p>Cheat: <?= $game->number() ?></p>
    <?php endif; ?>

    <?php if (isset($exMessage)) : ?>
        <p class="error">GuessException: <?= $exMessage ?></p>
    <?php endif; ?>
</body>
</html>
