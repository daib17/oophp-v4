<?php
/**
* Show all database content.
*/
$app->router->any("GET|POST", "cms/all", function () use ($app) {
    $title = "CMS";

    $cms = new \Daib\CMS\Content($app);
    $res = $cms->getAllContent();

    $app->page->add("anax/v2/cms/all", [
        "res" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Admin.
*/
$app->router->any("GET|POST", "cms/admin", function () use ($app) {
    $title = "CMS";

    $cms = new \Daib\CMS\Content($app);
    $res = $cms->getAllContent();

    $app->page->add("anax/v2/cms/admin", [
        "res" => $res,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Reset database.
*/
$app->router->any("GET|POST", "cms/reset", function () use ($app) {
    $title = "CMS";

    $cms = new \Daib\CMS\Content($app);
    $output = $cms->resetDatabase();

    $app->page->add("anax/v2/cms/reset", [
        "output" => $output,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Edit.
*/
$app->router->any("GET|POST", "cms/edit", function () use ($app) {
    $title = "CMS";
    $errorMsg = getGet("errorMsg", "");

    $app->db->connect();
    $contentId = getPost("contentId") ?: getGet("id");
    if (!is_numeric($contentId)) {
        die("Not valid for content id.");
    }

    if (hasKeyPost("doDelete")) {
        header("Location: delete?id=$contentId");
        exit;
    } elseif (hasKeyPost("doSave")) {
        $params = getPost([
            "contentTitle",
            "contentPath",
            "contentSlug",
            "contentData",
            "contentType",
            "contentFilter",
            "contentPublish",
            "contentId"
        ]);

        // Avoid UNIQUE exceptions from duplicated empty strings in db
        if (!$params["contentSlug"]) {
            $params["contentSlug"] = null;
        }

        if (!$params["contentPath"]) {
            $params["contentPath"] = null;
        }

        // Check for duplicated path
        $sql = "SELECT * FROM content WHERE path = ?;";
        $res = $app->db->executeFetch($sql, [$params["contentPath"]]);
        if ($res && $res->id != $params["contentId"]) {
            $errorMsg = "Path already in use: {$params['contentPath']}";
            header("Location: edit?id=$contentId&errorMsg=$errorMsg");
            exit;
        }

        // Create slug if empty
        if (!$params["contentSlug"] && $params["contentType"] == "post") {
            $params["contentSlug"] = slugify($params["contentTitle"]);
        }

        // Check for duplicated slug
        if ($params["contentType"] == "post") {
            $sql = "SELECT * FROM content WHERE slug = ?;";
            $res = $app->db->executeFetch($sql, [$params["contentSlug"]]);
            if ($res && $res->id != $params["contentId"]) {
                $errorMsg = "Slug already in use: {$params['contentSlug']}";
                header("Location: edit?id=$contentId&errorMsg=$errorMsg");
                exit;
            }
        }

        $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
        $app->db->execute($sql, array_values($params));
        header("Location: edit?id=$contentId");
        exit;
    }

    $sql = "SELECT * FROM content WHERE id = ?;";
    $content = $app->db->executeFetch($sql, [$contentId]);

    $app->page->add("anax/v2/cms/edit", [
        "content" => $content,
        "errorMsg" => $errorMsg
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Create.
*/
$app->router->any("GET|POST", "cms/create", function () use ($app) {
    $title = "CMS";

    $cms = new \Daib\CMS\Content($app);
    if (hasKeyPost("doCreate")) {
        $id = $cms->create();
        header("Location: edit?id=$id");
        exit;
    }

    $app->page->add("anax/v2/cms/create", [
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Delete.
*/
$app->router->any("GET|POST", "cms/delete", function () use ($app) {
    $title = "CMS";

    $app->db->connect();
    $contentId = getPost("contentId") ?: getGet("id");
    if (!is_numeric($contentId)) {
        die("Not valid for content id.");
    }

    if (hasKeyPost("doDelete")) {
        $contentId = getPost("contentId");
        $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
        $app->db->execute($sql, [$contentId]);
        header("Location: admin");
        exit;
    }

    $sql = "SELECT id, title FROM content WHERE id = ?;";
    $content = $app->db->executeFetch($sql, [$contentId]);

    $app->page->add("anax/v2/cms/delete", [
        "content" => $content,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Pages.
*/
$app->router->any("GET|POST", "cms/pages", function () use ($app) {
    $title = "CMS";

    $cms = new \Daib\CMS\Content($app);
    $res = $cms->getAllPages();

    $app->page->add("anax/v2/cms/pages", [
        "res" => $res
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Single page.
*/
$app->router->any("GET|POST", "cms/page", function () use ($app) {
    $title = "CMS";

    $path = getGet("path");

    $cms = new \Daib\CMS\Content($app);
    $content = $cms->getSinglePage($path);

    $app->page->add("anax/v2/cms/page", [
        "content" => $content
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Blog.
*/
$app->router->any("GET|POST", "cms/blog", function () use ($app) {
    $title = "CMS";

    $cms = new \Daib\CMS\Content($app);
    $res = $cms->getBlog();

    $app->page->add("anax/v2/cms/blog", [
        "res" => $res
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* Blogpost.
*/
$app->router->any("GET|POST", "cms/blogpost", function () use ($app) {
    $title = "CMS";

    $slug = getGet("slug");

    $cms = new \Daib\CMS\Content($app);
    $content = $cms->getBlogPost($slug);

    $app->page->add("anax/v2/cms/blogpost", [
        "content" => $content
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
* 404 - Page not found.
*/
$app->router->any("GET|POST", "cms/", function () use ($app) {
    $title = "CMS";

    $app->page->add("anax/v2/cms/404", [
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});
