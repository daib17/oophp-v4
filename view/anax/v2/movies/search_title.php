<?php

namespace Daib\T100;

/**
* Template file to render a view.
*/

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

include("navbar.php");

?>
<form method="get" action="search-title">
    <fieldset>
        <legend>Search by Title</legend>
        <p>
            <label>Title (use % as wildcard):
                <input type="search" name="searchTitle" value="<?= esc($searchTitle) ?>"/>
            </label>
        </p>
        <p>
            <input type="submit" name="doSearch" value="Search">
        </p>
    </fieldset>
</form>
<?php if ($res != null) : ?>
    <table>
        <tr class="first">
            <th>Rad</th>
            <th>Id</th>
            <th>Bild</th>
            <th>Titel</th>
            <th>År</th>
        </tr>
    <?php $id = -1; foreach ($res as $row) :
        $id++; ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $row->id ?></td>
            <td><img class="thumb" src="../<?= $row->image ?>"></td>
            <td><?= $row->title ?></td>
            <td><?= $row->year ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>
