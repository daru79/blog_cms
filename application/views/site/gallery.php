<?php include APPPATH.'views/site/include/header.php'; ?>

<h2>Galeria</h2>

<?php foreach ($files as $file) { ?>
    <img src="<?php print base_url().'images/thumbs/'.$file; ?>" alt="">
<?php } ?>

<?php include APPPATH.'views/site/include/footer.php'; ?>