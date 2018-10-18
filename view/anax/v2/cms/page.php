<?php
include("navbar.php");

$textFilter = new \Daib\TFilter\TFilter();
if ($content->filter) {
    $filters = explode(",", $content->filter);
} else {
    $filters = "";
}


?>
<article>
    <header>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= esc($content->modified_iso8601) ?>" pubdate><?= esc($content->modified) ?></time></i>
            <?php if ($content->deleted != null) : ?>
            <span class="deleted"> Deleted: <?= $content->deleted ?></span>
            <?php endif;?>
            </p>
        </p>
    </header>
    <!-- <?= $content->data ?> -->
    <?= $textFilter->parse(esc($content->data), $filters); ?>
</article>
