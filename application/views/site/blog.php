<?php include APPPATH.'views/site/include/header.php'; ?>

<h1>Witaj na blogu</h1>

<?php if(!empty($blog)) { ?>

<?php foreach ($blog as $row) { ?>

<?php print anchor('article/'.$row->alias, $row->title); ?> |
<?php print $row->title; ?> |
<?php print $row->date; ?> |
<?php print excerpt($row->content, 5); ?> |

<br><br>

<?php } ?>
<?php } else { ?>
<h2>Brak artykułów</h2>
<?php } ?>

<?php print $pagination; ?>

<?php include APPPATH.'views/site/include/footer.php'; ?>