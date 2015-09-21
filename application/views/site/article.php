<?php include APPPATH.'views/site/include/header.php'; ?>

<h1><?php print $article->title; ?></h1>

<?php print $article->content; ?>

<hr>

<?php print validation_errors(); ?>

<?php if(!empty($comments)) { ?>
    <h2>Komentarze:</h2>
    
    
    
        <?php foreach ($comments as $row) { ?>

    <?php print mailto($row->email, $row->name); ?>
    <?php print $row->date; ?> |
    <?php print excerpt($row->content, 5); ?> |
    <br><br>

    <?php } ?>
<?php } else { ?>
<h2>Brak komentarzy, bądź pierwszy! ;)</h2>
<?php } ?>

<h2>Skomentuj ;)</h2>

<?php print validation_errors(); ?>

<?php print form_open(); ?>

<table>
    <tr>
        <td>Imię</td>
        <td><?php print form_input('name'); ?></td>
    </tr>
    <tr>
        <td>E-mail</td>
        <td><?php print form_input('email'); ?></td>
    </tr>
    <tr>
        <td>Treść</td>
        <td><?php print form_textarea('content'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php print form_submit('submit', 'Dodaj komentarz'); ?></td>
    </tr>
</table>
<?php print form_hidden('article_id', $article->id); ?>
<?php print form_hidden('date', date('Y-m-d')); ?>

<?php print form_close(); ?>

<?php include APPPATH.'views/site/include/footer.php'; ?>