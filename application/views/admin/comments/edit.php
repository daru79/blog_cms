<?php include APPPATH.'views/admin/include/header.php'; ?>

<?php print validation_errors(); ?>

<?php print form_open(); ?>

<table>
    <tr>
        <td>Podpis</td>
        <td><?php print $comment->name; ?></td>
    </tr>
    <tr>
        <td>Treść</td>
        <td><?php print form_textarea('content', set_value('content', $comment->content)); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php print form_submit('submit', 'Edytuj komentarz'); ?></td>
    </tr>
</table>

<?php print form_close(); ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>