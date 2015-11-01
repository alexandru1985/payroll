$(document).ready(function() {
    $('.sterge').click(function(event) {
        event.preventDefault();


        /** Create div element for delete confirmation dialog*/
        var dynamicDialog = $('<div id="conformBox">' +
                '<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0; ">' +
                '</span>Are you sure to delete the item?</div>');

        dynamicDialog.dialog({
//                title : "Are you sure?",
            closeOnEscape: true,
            modal: true,
            buttons:
                    [{
                            text: "Yes",
                            click: function delete_id(id) {
                                
                                $(this).dialog("close");
                                
                           
                            
                                window.location.href = 'verificare.php?delete_id=' + id;
                            
                            }
                        },
                        {
                            text: "No",
                            click: function() {
                                $(this).dialog("close");
                            }
                        }]
        });
        return false;
    });
});
 