<?php print anchor(site_url(), 'Strona główna'); ?> 
<?php print anchor(site_url(), 'Blog'); ?> 
<?php print anchor(base_url('gallery'), 'Galeria'); ?> 

<?php if(!empty($pages)) { ?>
    <?php foreach($pages as $row) { ?>
        <?php print anchor('page/'.$row->alias, $row->title); ?>
    <?php } ?>
<?php } ?>