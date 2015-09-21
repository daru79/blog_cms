<?php include APPPATH.'views/admin/include/header.php'; ?>

<h2>Lista komentarzy</h2>

<br>
<br>

<?php if(!empty($comments)) { ?>

<?php foreach ($comments as $row) { ?>

<?php print $row->id; ?> |
<?php print $row->article_id; ?> |
<?php print mailto($row->email, $row->name); ?>
<?php print $row->date; ?> |
<?php print excerpt($row->content, 5); ?> |
<?php print anchor('admin/comments/edit/'.$row->id, 'Edycja'); ?> |
<?php print anchor('admin/comments/delete/'.$row->id, 'Kasuj', array('onclick' => "return confirm('Czy na pewno chcesz usunąć?');")); ?>
<br><br>

<?php } ?>
<?php } else { ?>
<h2>Brak komentarzy</h2>
<?php } ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>