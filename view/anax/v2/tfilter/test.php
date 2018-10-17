<?php

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1>Testing Textfilter</h1>

<!-- BBCode -->
<h2>BBCode Test</h2>
<h3>Source in bbcode.txt</h3>
<pre><?= wordwrap(htmlentities($textBBcode)) ?></pre>

<h3>Filter BBCode applied, source</h3>
<pre><?= wordwrap(htmlentities($htmlBBcode)) ?></pre>

<h3>Filter BBCode applied, HTML</h3>
<?= $htmlBBcodeNL2Br ?>

<!-- Clickable -->

<h2>Clickable Test</h2>
<h3>Source in clickable.txt</h3>
<pre><?= wordwrap(htmlentities($textclick)) ?></pre>

<h3>Source formatted as HTML</h3>
<?= $textclick ?>

<h3>Filter Clickable applied, source</h3>
<pre><?= wordwrap(htmlentities($htmlClick)) ?></pre>

<h3>Filter Clickable applied, HTML</h3>
<?= $htmlClick ?>

<!-- Markdown -->

<h2>Markdown Test</h2>

<h3>Markdown source in sample.md</h3>
<pre><?= $textMark ?></pre>

<h3>Text formatted as HTML source</h3>
<pre><?= htmlentities($htmlMark) ?></pre>

<h3>Text displayed as HTML</h3>
<?= $htmlMark ?>

<!-- NL2Br -->

<h2>nl2br Test</h2>

<h3>Source</h3>
<pre><?= $textNl2br ?></pre>

<h3>Text formatted as HTML source</h3>
<pre><?= htmlentities($htmlNl2br) ?></pre>

<h3>Text displayed as HTML</h3>
<?= $htmlNl2br ?>
