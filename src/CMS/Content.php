<?php

namespace Daib\CMS;

/**
* Class Content.
*/
class Content
{
    private $app;

    /**
    * Constructor
    */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
    * Get all content from database.
    *
    * @return array resultset
    */
    public function getAllContent()
    {
        $this->app->db->connect();
        $sql = "SELECT * FROM content;";
        $res = $this->app->db->executeFetchAll($sql);
        return $res;
    }



    /**
    * Restore database.
    *
    * @return string output from mysql command
    */
    public function resetDatabase()
    {
        $file   = "../sql/content/setup.sql";
        $mysql  = "/usr/bin/mysql";
        $output = null;

        // Local database
        $host = "localhost";
        $database = "oophp";
        $login = "user";
        $password = "pass";

        if (isset($_POST["reset"]) || isset($_GET["reset"])) {
            $command = "$mysql -h{$host} -u{$login} -p{$password} $database < $file 2>&1";
            $output = [];
            $status = null;
            exec($command, $output, $status);
            $output = "<p>The command was: <code>$command</code>.<br>The command exit status was $status."
            . "<br>The output from the command was:</p><pre>"
            . print_r($output, 1);
        }

        return $output;
    }


    /**
    *  Insert row in database with title, type and slug.
    *
    * @return integer last inserted id
    */
    public function create()
    {
        $title = getPost("contentTitle");
        $type = getPost("type");
        $slug = ($type == "post") ? slugify($title) : null;
        $this->app->db->connect();
        $sql = "INSERT INTO content (title, type, slug) VALUES (?, ?, ?);";
        $this->app->db->execute($sql, [$title, $type, $slug]);
        return $this->app->db->lastInsertId();
    }



    /**
    * Get all rows from database where type is 'page'
    *
    * @return array resultset
    */
    public function getAllPages()
    {
        $this->app->db->connect();
        $sql = <<<EOD
SELECT
*,
CASE
WHEN (deleted <= NOW()) THEN "isDeleted"
WHEN (published <= NOW()) THEN "isPublished"
ELSE "notPublished"
END AS status
FROM content
WHERE type=?
;
EOD;
        $res = $this->app->db->executeFetchAll($sql, ["page"]);
        return $res;
    }



    /**
    * Get single page.
    *
    * @param string $path page's path column in database
    *
    * @return array array resultset from database query
    */
    public function getSinglePage($path)
    {
        $this->app->db->connect();
        $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
path = ?
AND type = ?
AND published <= NOW()
;
EOD;
        $content = $this->app->db->executeFetch($sql, [$path, "page"]);
        return $content;
    }



    /**
    * Get all entries from database with type 'blog'.
    *
    * @return array resulset
    */
    public function getBlog()
    {
        $this->app->db->connect();
        $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
ORDER BY published DESC
;
EOD;
        $res = $this->app->db->executeFetchAll($sql, ["post"]);
        return $res;
    }



    /**
    * Get blog post.
    *
    * @param string $slug blog post's slug column in database
    *
    * @return array row from database as object
    */
    public function getBlogPost($slug)
    {
        $this->app->db->connect();
        $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
slug = ?
AND type = ?
AND published <= NOW()
ORDER BY published DESC
;
EOD;
        $content = $this->app->db->executeFetch($sql, [$slug, "post"]);
        return $content;
    }
}
