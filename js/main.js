(function($) {   

    var fonts = ['VT323', 'Slabo 27px', 'Libre Baskerville'];

    loadFonts( fonts ); 

    function loadFonts( families ){
        WebFont.load({
            google: {
              families: families
            }
        });        
    } 

})( jQuery );


