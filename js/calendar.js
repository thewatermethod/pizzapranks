if( document.querySelector('#calendarApp') ){

		/*  Here's a Vue app */
		var calendarApp= new Vue({
			el: '#calendarApp',  //dom node to host our app
			data: { 	// the blood and guts of the app
        
        pixels: null,
        
        currentYear: null,
        currentMonth: null,        
        
        daysInMonth: [],
        blankDaysBeginning: [],
        blankDaysEnd: [],


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

        this.currentMonth = moment().format('MMMM');
        this.currentYear = moment().format('YYYY');

        var numberBlankDaysBegin = 6 - moment().startOf('month').weekday();
        var numberBlankDaysEnd = 6 - moment().endOf('month').weekday();
        console.log( numberBlankDaysEnd );
        var numberDaysInMonth = moment().daysInMonth();
        
        for (var index = 0; index < numberDaysInMonth; index++) {
          this.daysInMonth.push(  {  day: index + 1, pixel: null }  );          
        }

        for (var index = 0; index < numberBlankDaysEnd; index++) {
          this.blankDaysEnd.push( "day" );          
        }

              
				/**
				 *  Here is where everything else that needs to happen as the vue app loads should live          
				 *
				 */
	
			},
	
			methods: {
				/* Methods are pretty self explanatory --  they are the functions that handle all the logic of the app*/
      
        nextMonth: function(){
         // this.currentMonth = this.currentMonthsubtract( 1, 'M' );

        },

				previousMonth: function(){
         // this.currentMonth = this.currentMonth().add( 1, 'M' );
			  },
					
			} // closes methods
	
		});	 // closes new vue app
	
	} // closes document.querySelector