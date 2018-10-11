<?php

namespace Daib\T100;

/**
* Template file to render a view.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

include("navbar.php");

?>
<form method="POST" action="edit">
    <fieldset>
        <legend>Edit</legend>
        <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>
        <p>
            <label>Title:<br>
                <input type="text" name="movieTitle" value="<?= $movie->title ?>"/>
            </label>
        </p>
        <p>
            <label>Year:<br>
                <input type="number" name="movieYear" value="<?= $movie->year ?>"/>
            </p>
            <p>
                <label>Image:<br>
                    <input type="text" name="movieImage" value="<?= $movie->image ?>"/>
                </label>
            </p>
            <p>
                <input type="submit" name="doSave" value="Save">
            </p>
        </fieldset>
    </form>
