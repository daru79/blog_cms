<?php include APPPATH.'views/admin/include/header.php'; ?>

<?php print validation_errors(); ?>

<?php print form_open(); ?>

<table>
    <tr>
        <td>Email</td>
        <td><?php print form_input('email'); ?></td>
    </tr>
    <tr>
        <td>Hasło</td>
        <td><?php print form_password('password'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php print form_submit('submit', 'Zaloguj'); ?></td>
    </tr>
</table>

<?php print form_close(); ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>