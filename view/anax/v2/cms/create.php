<?php
include("navbar.php");

?>
<h1>Create</h1>
<form method="post">
    <fieldset>
        <legend>Create</legend>
        <select name="type">
            <option value="page">Page</option>
            <option value="post">Post</option>
        </select>
        <p>
            <label>Title:<br>
                <input type="text" name="contentTitle" default="A Title" required/>
            </label>
        </p>
        <p>
            <button type="submit" name="doCreate"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
            <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
        </p>
    </fieldset>
</form>
