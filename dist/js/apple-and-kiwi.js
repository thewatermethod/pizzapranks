window.onload = function() {

    if( document.querySelector('#apple-and-kiwi') ){

        /*  Here's a Vue app */
        var calendarApp = new Vue({
            el: '#apple-and-kiwi',  //dom node to host our app
            data: { 	// the blood and guts of the app        

                comics: [],
                offset: 0,
                per_page: 5,

            },
        
            computed: { // here's where we can put data that is derived from other, changing variables

            },

            mounted: function(){

                // you see this 'var self = this;' a lot in this app, this is because 'this' is screwy in javascript
                var self = this;
                
                /**
                 *  This is where we store data that is loaded asynchronously, as in via javascript
                 * 
                 *  Important note -> instantiate an empty array in the data section above to represent the inital/default value of 
                 *  said async datas
                 *
                 */

                self.fetchComics();
                

                /**
                 *  Here is where everything else that needs to happen as the vue app loads should live          
                 *
                 */

                

            },

            methods: {
                /* Methods are pretty self explanatory --  they are the functions that handle all the logic of the app*/
            

                fetchComics: function(){                   

                    var self = this;		
                    var per_page = '?per_page=' + self.per_page;
                    var offset = '&offset=' + self.offset;

                    var url = wpApiSettings.root + 'wp/v2/comic' + per_page + offset;					

                    fetch( url  )
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function( comics ) {							 
                            
                            for (var index = 0; index < comics.length; index++) {
                                var comic = comics[index];
                                self.comics.push( comic );                            
                            }

                        });

                 
                 
                    
                },

                fetchImage: function( id ){                            
                                              
                    var url = wpApiSettings.root + 'wp/v2/media/' + id;					

                    fetch( url )

                        .then(function(response) {
                            return response.json();
                        })
                        .then(function( image ) {							                             
                            var comic = document.getElementById(id);
                            var minHeight = image.media_details.sizes.medium_large.height+25;
                            if( window.innerWidth > 1000 ){
                                comic.parentElement.setAttribute('style', 'min-height: ' + minHeight + 'px' )                          
                            }
                            comic.setAttribute( "src", image.media_details.sizes.medium_large.source_url );                                
                    });                  
                },


                loadMoreComics: function(){
                    this.offset += this.per_page;
                    this.fetchComics();
                },

                showMenu: function(){                    
                    jQuery('header.site-header div.main-menu').toggleClass('open');
                },
    
                    
            } // closes methods

        });	 // closes new vue app

    } // closes document.querySelector

}; // closes window on load