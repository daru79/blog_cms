<?php include APPPATH.'views/admin/include/header.php'; ?>

<h2>Lista użytkowników</h2>

<?php print anchor('admin/users/create', 'Utwórz użytkownika'); ?>
<br>
<br>

<?php if(!empty($users)) { ?>

<?php foreach ($users as $row) { ?>

<?php print $row->id; ?> |
<?php print $row->name; ?> |
<?php print $row->email; ?> |
<?php print anchor('admin/users/edit/'.$row->id, 'Edycja'); ?> |
<?php print anchor('admin/users/delete/'.$row->id, 'Kasuj', array('onclick' => "return confirm('Czy na pewno chcesz usunąć?');")); ?>
<br><br>

<?php } ?>
<?php } else { ?>
<h2>Brak użytkowników</h2>
<?php } ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>