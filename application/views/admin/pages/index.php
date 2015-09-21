<?php include APPPATH.'views/admin/include/header.php'; ?>

<h2>Lista stron</h2>

<?php print anchor('admin/pages/create', 'Utwórz stronę'); ?>
<br>
<br>

<p id="text"></p>
    


<?php if(!empty($pages)) { ?>
<table id="sortable">

<?php foreach ($pages as $row) { ?>
    <tr id="<?php print $row->id; ?>"> <!-- Każdemu elementowi 'tr' trzeba nadać unikalne id coby mogły być zapisywane unikalne wartości do tablicy 'order' za pomocą metody 'toArray' -->
        <td><?php print $row->id; ?></td>
        <td><?php print $row->title; ?></td>
        <td><?php print $row->alias; ?></td>
        <td><?php print excerpt($row->content, 5); ?></td>
        <td><?php print anchor('admin/pages/edit/'.$row->id, 'Edycja'); ?></td>
        <td><?php print anchor('admin/pages/delete/'.$row->id, 'Kasuj', array('onclick' => "return confirm('Czy na pewno chcesz usunąć?');")); ?></td>
    </tr>

<?php } ?>
</table>

<?php } else { ?>
    <h2>Brak stron</h2>
<?php } ?>

<?php include APPPATH.'views/admin/include/footer.php'; ?>