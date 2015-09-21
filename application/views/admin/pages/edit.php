<?php include APPPATH.'views/admin/include/header.php'; ?>

<?php print validation_errors(); ?>

<?php print form_open(); ?>

<table>
    <tr>
        <td>Tytuł</td>
        <td><?php print form_input('title', set_value('value', $page->title)); ?></td>
    </tr>
    <tr>
        <td>Alias</td>
        <td><?php print form_input('alias', set_value('value', $page->alias)); ?></td>
    </tr>
    <tr>
        <td>Treść</td>
        <td><?php print form_textarea('content', set_value('value', $page->content)); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php print form_submit('submit', 'Edytuj stronę'); ?></td>
    </tr>
</table>

<?php print form_close(); ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>