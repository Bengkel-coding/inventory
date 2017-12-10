$(document).ready(function(){
    
    function icon_default_action(object_icon) {
        if (object_icon.hasClass('delete'))
            return 'delete';
        else if (object_icon.hasClass('active'))     
            return 'unpublish';
        else if (object_icon.hasClass('in-active'))     
            return 'publish';
    }
    
    
    $('a.icon.ajax.delete,a.icon.ajax.status').click(function(e){
        e.preventDefault();
        icon_button = $(this);
        icon_button_action  = icon_default_action(icon_button);
        icon_button_title   = icon_button.attr('data-warning-title');
        icon_button_title   = typeof icon_button_title == 'undefined'
                        ? 'Warning'
                        : icon_button_title;
        icon_button_message = icon_button.attr('data-warning-message');
        icon_button_message = typeof icon_button_message == 'undefined' 
                        ? 'Are you sure that you want to permanently '+icon_button_action+' the selected database objects?'
                        : icon_button_message;
        icon_button_link    = icon_button.attr('href');
                        
        jConfirm(icon_button_message,icon_button_title,function(r){
            if (r) {
                nous_process_message(icon_button_action);
                $.ajax({
                    url     : icon_button_link,
                    type    : 'POST',
                    success : function(xmsg){
                        xmsg = $.trim(xmsg);
                        if (xmsg == 'true') {
                            window.location.reload();
                        }
                    }   
                });
            }    
        });
        return false; 
    });
});