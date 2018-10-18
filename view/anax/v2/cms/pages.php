<?php
if (!$res) {
    return;
}

include("navbar.php");

?>
<h1>Pages</h1>
<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Status</th>
        <th>Published</th>
        <th>Deleted</th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <?php if (empty($row->path)) : ?>
            <td><?= $row->title ?></td>
        <?php else : ?>
            <td><a href="page?path=<?= $row->path ?>"><?= $row->title ?></a></td>
        <?php endif; ?>
        <td><?= $row->type ?></td>
        <td><?= $row->status ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
