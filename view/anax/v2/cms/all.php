<?php
if (!$res) {
    return;
}

include("navbar.php");

?>
<h1>Database Content</h1>
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Title</th>
        <th>Path</th>
        <th>Slug</th>
        <th>Type</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
    </tr>
    <?php $id = -1; foreach ($res as $row) :
        $id++; ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $row->id ?></td>
            <td><?= $row->title ?></td>
            <td><?= $row->path ?></td>
            <td><?= $row->type == "post" ? $row->slug : ""; ?></td>
            <td><?= $row->type ?></td>
            <td><?= $row->published ?></td>
            <td><?= $row->created ?></td>
            <td><?= $row->updated ?></td>
            <td><?= $row->deleted ?></td>
        </tr>
    <?php endforeach; ?>
</table>
