<?php
/**
 * Show all movies.
 */
$app->router->any("GET|POST", "tfilter/test", function () use ($app) {
    $title = "TextFilter";

    $textFilter = new \Daib\TFilter\TFilter();

    $textBBcode = file_get_contents(__DIR__ . "/../text/bbcode.txt");
    $htmlBBcode = $textFilter->parse($textBBcode, "bbcode");
    $htmlBBcodeNL2Br = $textFilter->nl2br($htmlBBcode);

    $textclick = file_get_contents(__DIR__ . "/../text/clickable.txt");
    $htmlClick = $textFilter->parse($textclick, "link");

    $textMark = file_get_contents(__DIR__ . "/../text/sample.md");
    $htmlMark = $textFilter->parse($textMark, "markdown");

    // $textNl2br = "First sentence.\nSecond sentence";
    $textNl2br = file_get_contents(__DIR__ . "/../text/nl2br.txt");
    $htmlNl2br = $textFilter->parse($textNl2br, "nl2br");

    $app->page->add("anax/v2/tfilter/test", [
        "textBBcode" => $textBBcode,
        "htmlBBcode" => $htmlBBcode,
        "htmlBBcodeNL2Br" => $htmlBBcodeNL2Br,
        "textclick" => $textclick,
        "htmlClick" => $htmlClick,
        "textMark" => $textMark,
        "htmlMark" => $htmlMark,
        "textNl2br" => $textNl2br,
        "htmlNl2br" => $htmlNl2br
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
