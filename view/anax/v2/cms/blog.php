<?php
if (!$res) {
    return;
}

include("navbar.php");

$textFilter = new \Daib\TFilter\TFilter();

?>
<h1>Blog</h1>
<article>
<?php foreach ($res as $row) : ?>
<section>
    <header>
        <h1><a href="blogpost?slug=<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i>
        <?php if ($row->deleted != null) : ?>
        <span class="deleted"> Deleted: <?= $row->deleted ?></span>
        <?php endif;?>
        </p>
    </header>
    <?php
    if ($row->filter) {
        $filters = explode(",", $row->filter);
    } else {
        $filters = "";
    }
    ?>
    <?= $textFilter->parse(esc($row->data), $filters); ?>

</section>
<?php endforeach; ?>
</article>
