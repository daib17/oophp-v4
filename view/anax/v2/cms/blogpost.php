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
        <p><i>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i>
        <?php if ($content->deleted != null) : ?>
        <span class="deleted"> Deleted: <?= $content->deleted ?></span>
        <?php endif;?>
        </p>
    </header>
    <!-- <?= esc($content->data) ?> -->
    <?= $textFilter->parse(esc($content->data), $filters); ?>
</article>
