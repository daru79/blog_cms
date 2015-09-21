<?php include APPPATH.'views/admin/include/header.php'; ?>

<h2>Galeria</h2>

<?php echo form_open_multipart('admin/gallery'); ?>

<?php print form_upload('userfile'); ?>
<br>
<input type="submit" name="upload" value="załaduj fotę">

<?php print form_close(); ?>

<hr>

<?php foreach ($files as $file) { ?>
<div style="position: relative;">
<img src="<?php print base_url().'images/thumbs/'.$file; ?>" alt="">

<?php print form_open('admin/gallery/del_image'); ?>
    <?php print form_hidden('file_name', $file); ?>
    <button type="submit" name="button" style="position: absolute; top: 10px; left: 10px;">X</button>
<?php print form_close(); ?>
</div>
<?php } ?>

    <?php include APPPATH.'views/admin/include/footer.php'; ?>