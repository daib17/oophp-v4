<?php
/**
 * Show all movies.
 */
$app->router->any("GET|POST", "movies/all", function () use ($app) {
    $title = "Movies | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("anax/v2/movies/index", [
        "res" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Search movie by title.
 */
$app->router->any("GET|POST", "movies/search-title", function () use ($app) {
    $title = "Search title | oophp";
    $searchTitle = getGet("searchTitle");
    $res = null;

    if ($searchTitle) {
        $app->db->connect();
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $res = $app->db->executeFetchAll($sql, [$searchTitle]);
    }

    $app->page->add("anax/v2/movies/search_title", [
        "searchTitle" => $searchTitle,
        "res" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Search movie by year.
 */
$app->router->any("GET|POST", "movies/search-year", function () use ($app) {
    $title = "Search year | oophp";
    $doSearch = getGet("doSearch");
    $year1 = getGet("year1", 1900);
    $year2 = getGet("year2", 2100);
    $res = null;
    $app->db->connect();
    if ($year1 && $year2) {
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $res = $app->db->executeFetchAll($sql, [$year1, $year2]);
    } elseif ($year1) {
        $sql = "SELECT * FROM movie WHERE year >= ?;";
        $res = $app->db->executeFetchAll($sql, [$year1]);
    } elseif ($year2) {
        $sql = "SELECT * FROM movie WHERE year <= ?;";
        $res = $app->db->executeFetchAll($sql, [$year2]);
    }

    $app->page->add("anax/v2/movies/search_year", [
        "doSearch" => $doSearch,
        "year1" => $year1,
        "year2" => $year2,
        "res" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Movie select.
 */
$app->router->any("GET|POST", "movies/select", function () use ($app) {
    $movieId = getPost("movieId");
    $app->db->connect();
    if (getPost("doDelete")) {
        $sql = "DELETE FROM movie WHERE id = ?;";
        $app->db->execute($sql, [$movieId]);
    } elseif (getPost("doAdd")) {
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
        $movieId = $app->db->lastInsertId();
        header("Location: edit?movieId=$movieId");
        exit;
    } elseif (getPost("doEdit") && is_numeric($movieId)) {
        header("Location: edit?movieId=$movieId");
        exit;
    }

    $title = "Select a movie";
    $sql = "SELECT id, title FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $app->page->add("anax/v2/movies/select", [
        "res" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Movie edit.
 */
$app->router->any("GET|POST", "movies/edit", function () use ($app) {
    $title = "Update movie";

    $movieId    = getPost("movieId") ?: getGet("movieId");
    $movieTitle = getPost("movieTitle");
    $movieYear  = getPost("movieYear");
    $movieImage = getPost("movieImage");

    $app->db->connect();
    if (getPost("doSave")) {
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        header("Location: edit?movieId=$movieId");
    }

    $sql = "SELECT * FROM movie WHERE id = ?;";
    $movie = $app->db->executeFetchAll($sql, [$movieId]);
    $movie = $movie[0];

    $app->page->add("anax/v2/movies/edit", [
        "movie" => $movie,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
