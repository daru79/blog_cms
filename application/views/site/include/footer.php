<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>
$(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
    });

    $( "#sortable" ).sortable({
        items: "tr",
        opacity: 0.5,
        axis: "y",
        
        update: function( event, ui ) {
            // Informacje o zmianie położenia są pakowane do tablicy z wykorzystaniem właściwości 'toArray' z API 'sortable'
            var order = $(this).sortable("toArray");
            
            // Przekazujemy dane za pomocą AJAXa
            $.ajax({
                type: "POST",
                url: "<?php print base_url('admin/pages/ajax'); ?>",
                data: {items: order},
                success: function(message) {
                    $("#text").html(message);
                
                }
            });
            
        }
    });
    $( "#sortable" ).disableSelection();
});
</script>