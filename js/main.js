(function($) {   

    var fonts = ['VT323', 'Slabo 27px', 'Libre Baskerville'];

    loadFonts( fonts ); 

    $(window).scroll( function(){
        $headerSiteHeader = $('header.site-header');
       if( $(window).scrollTop() > 100 ) {
            if( !$headerSiteHeader.hasClass('darker') ){
                $headerSiteHeader.addClass('darker');
            }
       } else {
            if( $headerSiteHeader.hasClass('darker') ){   
                $headerSiteHeader.removeClass('darker');
            }
       }
    });

})( jQuery );

function loadFonts( families ){
    WebFont.load({
        google: {
          families: families
        }
    });        
} 