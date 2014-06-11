jQuery(function($) {
    $( "#id-btn-dialog1" ).on('click', function(e) {
        e.preventDefault();
        
        var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
            modal: false,
            closeOnEscape: false
        })
    })
});