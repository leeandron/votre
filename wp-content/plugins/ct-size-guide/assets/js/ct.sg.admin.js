jQuery(document).ready(function () {
    if (jQuery.fn.editTable) {
        jQuery('.ct_single_size_table:not(.template) .ct_edit_table').each( function(){
            jQuery(this).editTable(); } );
    }
    if (jQuery.fn.wpColorPicker) {
        jQuery('.ct-sg-color').wpColorPicker();
    }

    // add table btn
    jQuery('button.ct-addTable').click( function(){
        var textareas = jQuery('textarea.ct_edit_table');
        var tables = jQuery('table.inputtable, table.wh');

        var copy = textareas.last().clone();
        copy.attr( 'name', 'ct_size_guide[' + textareas.length + '][table]' );
        copy.insertAfter( tables.last() );
        copy.editTable();
        // tables.last().clone().insertAfter( tables.last() );
    } )

    // del table btn
    jQuery('button.ct-delTable').click( function(){
        var textareas = jQuery('textarea.ct_edit_table');
        var tables = jQuery('table.inputtable, table.wh');
        if ( tables.length > 1 && textareas.length > 1 ) {
            tables.last().remove();
            textareas.last().remove();
        }
    } )

});