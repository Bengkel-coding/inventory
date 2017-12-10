var obj_window        = $(window);
var obj_window_width  = obj_window.width();
var obj_window_height = obj_window.height();
var obj_reposition    = [];


String.prototype.repeat = function(num)
{
    return new Array( num + 1 ).join( this );
}

// We suggets window resize calling from this point
function window_resize_handler() {
    obj_window_width  = obj_window.width();
    obj_window_height = obj_window.height();
        
    if (obj_reposition.length >= 1) {
        $.each(obj_reposition,function(i){
            var o = $(this);
            
            o.css({
                'position'  : 'fixed',                    
                top         : parseInt((obj_window_height-o.outerHeight())/2),
                left        : parseInt((obj_window_width-o.outerWidth())/2)
            }).animate({opacity:1},500);
        });
    }
}

function enable_masking_layer(html) {    
    disable_masking_layer();
    
    $('body').addClass('noScroll');
    
    msg = typeof html == 'boolean' ? '' : html;
    
    $('body').append('<div id="transparent-masking"></div><div id="masking-html" class="masking-html-container"></div>');
        
    $('#masking-html').html('<div id="masking-html-close">X</div><div class="clear break4"></div>'+msg);
    
    if (typeof html !== 'boolean') {
        setTimeout(function(){
            $('#masking-html').css({
                top     : ($(window).height()-$('#masking-html').outerHeight())/2,            
                left    : ($(window).width()-$('#masking-html').outerWidth())/2
            });
        },5);
        
        $(window).bind('resize',function(){
            masking_el    = $('#masking-html');
            masking_el.css({
                top         : ($(window).height()-masking_el.outerHeight())/2,            
                left        : ($(window).width()-masking_el.outerWidth())/2
            })     
        });
    }
    
    $('#masking-html-close,#transparent-masking').unbind('click').bind('click',function(){
        disable_masking_layer();
    })
}

function disable_masking_layer() {
    $('body').removeClass('noScroll');
    $('#transparent-masking').remove();
    $('#masking-html').remove();
}

function nous_disable_message() {
    $('#nous-waiting-layering').remove();
}

function nous_process_message(message,full) {
    if ($.inArray(message,['publish','unpublish']) !== -1) {
        action = message+'ing';
    } else if (message == 'update') {
        action = 'updating';
    } else if (message == 'delete') {
        action = 'deleting';
    }
    
    nous_message = typeof full == 'undefined' 
                        ? 'Please wait while '+action+' your database objects. Do not close or refresh your browser.' 
                        : message; 
    
    $('body').append('<div id="nous-waiting-layering">'+
                        '<div class="nous-waiting-container" style="width:80%;">'+
                            '<div class="nous_message_container">'+
                                '<div class="spinner"></div><div class="message">'+nous_message+'</div><div class="clear"></div>'+
                            '</div>'+
                        '</div>'+
                    '</div>');
    
    
    var ww = $(window).width();
    var wh = $(window).height();
    var ew = ww*80/100;
    
    var mtop   = parseInt((wh-46)/2);
    var mleft  = parseInt((ww-ew)/2);
    
    $('.nous-waiting-container').css({
        'top'   : mtop,
        'left'  : mleft
    });
        
    $(window).bind('resize',function(){
        ww = $(window).width();
        wh = $(window).height();
        ew = ww*80/100;    
        mtop   = parseInt((wh-46)/2);
        mleft  = parseInt((ww-ew)/2);
        
        $('.nous-waiting-container').css({
            'top'   : mtop,
            'left'  : mleft
        });
    });
}

function center_middle(element) {
    if (typeof element != 'undefined' && $(element).length >= 1) {
        obj_reposition.push($(element));
    }
        
    window_resize_handler();           
}

function uploadify_maker(obj,option) {
    defaults = {
        'swf'           : bs_root+'assets/__system/lib/js/uploadify-3.2/uploadify.swf',    
        'uploader'      : bs_root+'assets/__system/lib/js/uploadify-3.2/uploadify.php',
        'buttonText'    : 'SELECT FILES',
    };
    
    if (typeof option != 'undefined') {
        $.each(option,function(ky,va){
            defaults[ky] = va;    
        });
    }
    
    obj.uploadify(defaults);
}

function createCookie(name,value,days) {
    if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function cute_url(string) {
    separator = typeof separator == 'undefined' ? '-' : separator;
    string = $.trim(string).toLowerCase();                
    string = string.replace(/[ ~`!@#$%^&*()\/\\\'\\[\]\{\}_=?;:<>.,+\|"]/g, separator);
    string = string.replace(/-{2,}/g,separator);
    string = string.replace(/_{2,}/g,separator);
    string = string.replace(/\//g,separator);
    string = string.replace(/^-/,'');
    string = string.replace(/-$/,'');
    return string.toLowerCase();
}

function enable_popUp(html,close) {
    speed   = 200;
    disable = 30;
    time    = $('.masking-html').length > 0 ? disable+10 : 10;
    
    function disable_popUp() {
        $('.masking-html')
        .stop(true,true)
        .animate({
            opacity : 0
        },disable,function(){
            $('#transparent-masking').remove();
            $('.masking-html').remove();
            $('body').removeClass('noScroll');
        });    
    }
    
    disable_popUp();
    
    if (html === false) return;
        
    setTimeout(function(){
        $('body').addClass('noScroll');
        
        masking_html = $('<div/>',{
           'class'  : 'masking-html masking-html-container',
           'style'  : 'opacity:0'
        });
        
        // Add masking layer 0 (for background);
        $('body').append('<div id="transparent-masking"></div>');
        $('#transparent-masking').unbind('click').bind('click',function(){
                //$('.masking-html').stop(true,true);
                disable_popUp();
            });
            
        // Add masking layer 1 (for message)
        if (typeof close == 'undefined')        
            masking_html.html('<div class="masking-html-close">X</div><div class="clear break4"></div>'+html);
        else
            masking_html.html(html);
        
        masking_html.appendTo('body')
            .css({
                top         : ($(window).height()-masking_html.outerHeight())/2,            
                left        : ($(window).width()-masking_html.outerWidth())/2
            })
            .stop(true,true)
            .animate({
                opacity : 1
            },speed,function(){
                $('.masking-html-close').unbind('click').bind('click',function(){
                    //$('.masking-html').stop(true,true);
                    disable_popUp();
                });
            });
        setTimeout(function(){
            center_middle('.masking-html');
        },30);
    },time);
}

$(document).ready(function(){
    obj_window.resize(window_resize_handler).trigger('resize');     
    
    if ($('.item-tool.sort_by').length > 0) {
        //Sort By Handler        
        $('.item-tool.sort_by')
                .find('.checkbox')
                .children('input')
                .click(function(){
                    _chkbx     =  $(this);
                    _sibling   = _chkbx.parent('.checkbox').next('.label');
                    _chkbx_val = _chkbx.val();
                    if (_chkbx_val == 'on') {
                        _chkbx.val('asc')
                        _sibling.removeClass('asc desc').addClass('asc');
                    } else if (_chkbx_val == 'asc') {
                        _chkbx.val('desc');
                        _sibling.removeClass('asc desc').addClass('desc');
                        return false;
                    } else if (_chkbx_val == 'desc') {
                        _chkbx.val('on');
                        _sibling.removeClass('asc desc');
                        _chkbx.attr('checked');
                    }  
                    //return false;
        });
    }  
});


