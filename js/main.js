(function($) {   

    var $grid;

    var titleFamilies = [
        'Luckiest Guy',
        'Bevan',    
        'Gravitas One',   
    ];

    var bodyFamilies = [
        'Slabo 27px'
    ];

    var vt323 = ['VT323'];

    loadFonts( vt323 );
    
    if( $('body').hasClass('home') ){                             
        loadFonts( bodyFamilies );
        loadFonts( titleFamilies );
        reFontify();                           
        $grid = initMasonry();
    } 
   

    function loadFonts( families ){
        WebFont.load({
            google: {
              families: families
            }
        });        
    } 

    function redrawLayout(){
        $grid.masonry('layout');
    }

  
    function reFontify(){
        $('.entry-title').each( function( index ) { 
            $( this ).css( 'font-family', titleFamilies[ getRandomInt(0, titleFamilies.length )] );     
        });  
    }
    
    function initMasonry() {       
       return $('#main').masonry({
            itemSelector: 'article',
            gutter: 5
        });
    }


    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min)) + min; //The maximum is exclusive and the minimum is inclusive
    }

    $( document.body ).on( 'post-load', function () {
        $grid.masonry('layout');
    } );


})( jQuery );


