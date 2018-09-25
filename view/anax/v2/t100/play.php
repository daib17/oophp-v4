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
    <?php if (empty($game->getActualRound(0)->getAllHands())) : ?>
        <p>Roll your dice!</p>
    <?php endif; ?>
    <?php foreach ($game->getActualRound(0)->getAllHands() as $key => $hand) : ?>
        <p><?= implode(", ", $hand->values()); ?>
            (<?= $hand->sum(true); ?> points)</p>
    <?php endforeach; ?>
    <p>Round: <?= $game->getActualRound(0)->getTotalValue(); ?></p>
    <p>Total: <?= $game->getTotalValue(0); ?></p>
    <?php if ($game->getTurn() == 0 && !$game->gameIsOver()) : ?>
        <?php if (!empty($game->getActualRound(0)->getAllHands()) && $game->getLastHandSum(0) == 0) : ?>
            <form method="post">
                <input type="submit" name="goCPU" value="Round is zero. Click so CPU can play...">
            </form>
        <?php else : ?>
            <form method="post">
                <input type="submit" name="roll" value="Roll" />
                <input type="submit" name="goCPU" value="Stay" />
            </form>
        <?php endif; ?>
    <?php elseif (!$game->gameIsOver()) : ?>
        <p>Wait your turn...</p>
    <?php endif; ?>
</div>

<div class="right">
    <h2>CPU</h2>
    <?php if ($game->getRoundCount(1) > 0) : ?>
        <?php foreach ($game->getActualRound(1)->getAllHands() as $key => $hand) : ?>
            <p><?= implode(", ", $hand->values()); ?>
                (<?= $hand->sum(true); ?> points)</p>
        <?php endforeach; ?>
        <p>Round: <?= $game->getActualRound(1)->getTotalValue(); ?></p>
        <p>Total: <?= $game->getTotalValue(1); ?></p>
    <?php endif; ?>
    <p>Waiting for my turn...</p>
</div>
