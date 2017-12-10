$(document).ready(function(){
    //Shadow navigation margin
    var wg_open_navigation = $('.wg_base_module_navigation ul li.root#open');    
    var wg_st_mn_timer     = 100; 
    
    /**
    $('.wg_base_module_navigation ul li.root').hover(
        function(){
            $this = $(this);
            
            if ($this.attr('id') == 'open') return;  
            
            $('.wg_base_module_navigation ul li.root#open').stop().children('ul.child').fadeOut(wg_st_mn_timer)
                             
            $this
                .addClass('hover')
                .children('ul.child')
                .css('z-index',20)
                .fadeIn(wg_st_mn_timer);
        },
        function() {
            $this = $(this);
            
            if ($this.attr('id') == 'open') return;
                        
            $this.removeClass('hover').children('ul.child').stop().fadeOut(wg_st_mn_timer,function(){
                $(this).css('z-index',0);
            });
                
            $('.wg_base_module_navigation ul li.root#open').children('ul.child').stop().fadeIn(wg_st_mn_timer);
        }
    );  
    **/
    
    slickWidth = 0;
    ulw = $('.wg_base_module_navigation ul').outerWidth();
    wdw = $('#wrapper').width();//$(window).width();
    lro = 0;
    if ($('li.root.hover').length > 0) {
        lro = $('li.root.hover').index()-1;
        toogleActive(lro,1); 
    }
    
    $('.wg_base_module_navigation ul li.root').hover(
        function() {
            $this = $(this);
            $.data(this, "timer", setTimeout($.proxy(function() {
                if ($this.attr('id') == 'open') return;
                
                idx = $('.wg_base_module_navigation ul li.root.hover').index();
                $('.wg_base_module_navigation ul li.root.hover').removeClass('hover'); 
                toogleActive(idx-1,0);
                
                idx = $this.index();                       
                $this.addClass('hover');              
                toogleActive (idx-1,1);
            }, this), 500));
        }, function() {
          clearTimeout($.data(this, "timer"));
        }
    );
    function toogleActive(index,type) {
        if (index < 0) return;
        if (type == 1)
            $('ul.child').eq(index).addClass('active');
        else
            $('ul.child').eq(index).removeClass('active');
    }    
    
    function slick_navigation() { 
        wdw = $('#wrapper').width();//$(window).width();
        slickWidth = wdw-80;
        ndw = $('#navigation-slick-children').height()-30;
        $('#app_navigation').next('div').height(ndw <= 0 ? 22 : ndw);
        
        if (ulw > wdw) {
            $('#snbp,#snbn').css('visibility','visible');
            $('#slick-navigation').width(slickWidth);
            
            $('#snbn').show();
        }
    }   
    
    $('#snbn').click(function(){
        //$('.wg_base_module_navigation').css('margin-left',-slickWidth);
        $('.wg_base_module_navigation').animate({marginLeft:-slickWidth},300);
        $(this).hide();
        $('#snbp').show();
    });   
    
    $('#snbp').click(function(){
        //$('.wg_base_module_navigation').css('margin-left','0');
        $('.wg_base_module_navigation').animate({marginLeft:0},300);
        $(this).hide();
        $('#snbn').show();
    });
    $(window).resize(slick_navigation).trigger('resize');    
});