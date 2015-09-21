<?php include APPPATH.'views/admin/include/header.php'; ?>

<?php print validation_errors(); ?>

<?php print form_open(); ?>

<table>
    <tr>
        <td>Tytuł</td>
        <td><?php print form_input('title'); ?></td>
    </tr>
    <tr>
        <td>Alias</td>
        <td><?php print form_input('alias'); ?></td>
    </tr>
    <tr>
        <td>Data</td>
        <td><?php print form_input('date', date('Y-m-d'), 'id="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Treść</td>
        <td><?php print form_textarea('content'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php print form_submit('submit', 'Dodaj artykuł'); ?></td>
    </tr>
</table>

<?php print form_close(); ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>