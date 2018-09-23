<?php

namespace Daib\T100;

/**
* Template file to render a view.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1><?= $title ?></h1>

<div>
    <form method="post">
        <input type="submit" name="reset" value="Restart game">
    </form>
</div>

<?php if ($game->gameIsOver()) : ?>
    <?php if ($game->getTotalValue(0) >= 100) : ?>
        <div class="wrapper">
            <p class="green">Game Over - Player wins</p>
        </div>
    <?php else : ?>
        <div class="wrapper">
            <p class="red">Game Over - CPU wins</p>
        </div>
    <?php endif;?>
<?php endif; ?>

<div class="left">
    <h2>Player</h2>
    <?php if (!empty($game->getActualRound(0)->getLastHandValues())) : ?>
        <p><?= implode(", ", $game->getActualRound(0)->getLastHandValues()) ?></p>
    <?php else : ?>
        <p>Roll your dice!</p>
    <?php endif; ?>
    <p>Hand: <?= $game->getActualRound(0)->getLastHandSum() ?></p>
    <p>Round: <?= $game->getActualRound(0)->getTotalValue() ?></p>
    <p>Total: <?= $game->getTotalValue(0) ?></p>
    <?php if ($game->getTurn() == 0 && !$game->gameIsOver()) : ?>
        <form method="post">
            <input type="submit" name="roll" value="Roll" />
            <input type="submit" name="stay" value="Stay" />
        </form>
    <?php elseif (!$game->gameIsOver()) : ?>
        <p>Wait your turn...</p>
    <?php endif; ?>
</div>

<div class="right">
    <h2>CPU</h2>
    <?php if ($game->getRoundCount(1) > 0) : ?>
        <?php if (!empty($game->getActualRound(1)->getLastHandValues())) : ?>
            <p><?= implode(", ", $game->getActualRound(1)->getLastHandValues()) ?></p>
        <?php else : ?>
            <p>Roll your dice!</p>
        <?php endif; ?>
        <p>Hand: <?= $game->getActualRound(1)->getLastHandSum() ?></p>
        <p>Round: <?= $game->getActualRound(1)->getTotalValue() ?></p>
        <p>Total: <?= $game->getTotalValue(1) ?></p>
    <?php endif; ?>
    <?php if ($game->getTurn() == 1 && !$game->gameIsOver()) : ?>
        <form method="post">
            <?php if ($game->cpuPlays() == "roll") : ?>
                <input type="submit" name="roll" value="Roll them for me please" />
            <?php else : ?>
                <input type="submit" name="stay" value="I wanna stay" />
            <?php endif;?>
        </form>
    <?php elseif (!$game->gameIsOver()) : ?>
        <p>Waiting for my turn...</p>
    <?php endif; ?>
</div>
