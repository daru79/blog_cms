<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<?php print anchor(site_url(), 'Strona główna'); ?> 
<?php if($loggedin == TRUE) {  ?>
<?php print anchor('admin/panel', 'Panel admina'); ?> 
<?php print anchor('admin/users', 'Użytkownicy'); ?> 
<?php print anchor('admin/blog', 'Blog'); ?> 
<?php print anchor('admin/comments', 'Komentarze'); ?> 
<?php print anchor('admin/pages', 'Strony'); ?> 
<?php print anchor('admin/gallery', 'Galeria'); ?> 
<?php print anchor('admin/panel/logout', 'Wyloguj'); ?> 
<?php } ?>