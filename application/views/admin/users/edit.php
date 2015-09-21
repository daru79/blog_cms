<?php include APPPATH.'views/admin/include/header.php'; ?>

<?php print validation_errors(); ?>

<?php print form_open(); ?>

<table>
    <tr>
        <td>Imię</td>
        <td><?php print form_input('name', set_value('value', $user->name)); ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php print form_input('email', set_value('value', $user->email)); ?></td>
    </tr>
    <tr>
        <td>Hasło</td>
        <td><?php print form_password('password'); ?></td>
    </tr>
    <tr>
        <td>Potwierdź hasło</td>
        <td><?php print form_password('passconf'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php print form_submit('submit', 'Edytuj użytkownika'); ?></td>
    </tr>
</table>

<?php print form_close(); ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>