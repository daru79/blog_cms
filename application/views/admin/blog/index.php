<?php include APPPATH.'views/admin/include/header.php'; ?>

<h2>Lista artykułów</h2>

<?php print anchor('admin/blog/create', 'Utwórz artykuł'); ?>
<br>
<br>

<?php if(!empty($blog)) { ?>

<?php foreach ($blog as $row) { ?>

<?php print $row->id; ?> |
<?php print $row->title; ?> |
<?php print $row->alias; ?> |
<?php print $row->date; ?> |
<?php print $row->views; ?> |
<?php print excerpt($row->content, 5); ?> |
<?php print anchor('admin/blog/edit/'.$row->id, 'Edycja'); ?> |
<?php print anchor('admin/blog/delete/'.$row->id, 'Kasuj', array('onclick' => "return confirm('Czy na pewno chcesz usunąć?');")); ?>
<br><br>

<?php } ?>
<?php } else { ?>
<h2>Brak artykułów</h2>
<?php } ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>