(function($) {   

    var fonts = ['VT323', 'Slabo 27px'];
    loadFonts( fonts ); 

    $headerSiteHeader = jQuery('header.site-header');
    $(window).scroll( function(){
       
        if( jQuery(window).scrollTop() > 60 ) {
             if( !$headerSiteHeader.hasClass('darker') ){
                 $headerSiteHeader.addClass('darker');
             }
        } else {
             if( $headerSiteHeader.hasClass('darker') ){   
                 $headerSiteHeader.removeClass('darker');
             }
        }
     } );

     $headerSiteHeader.click( function(){
         console.log('test');
     });


     $('#menuToggle').click( function(){      
        $(this).toggleClass('toggled');
        $('header.site-header .main-menu').toggleClass('open');
     });

})( jQuery );

function loadFonts( families ){
    WebFont.load({
        google: {
          families: families
        }
    });        
} 