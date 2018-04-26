if( document.querySelector('#calendarApp') ){

		/*  Here's a Vue app */
		var calendarApp= new Vue({
			el: '#calendarApp',  //dom node to host our app
			data: { 	// the blood and guts of the app        
				pixels: null,
				thisMoment: null,
			},
		
			computed: { // here's where we can put data that is derived from other, changing variables

				currentMonth: function() {
					if( this.thisMoment == null ) {
						return; 
					}

					return this.thisMoment.format('MMMM');
				},	
				
				currentYear: function(){
					
					if( this.thisMoment == null ) {
						return; 
					}

					return this.thisMoment.format('YYYY');
				},

				daysAfterMonth: function(){

					if( this.thisMoment == null ) {
						return; 
					}

					var numberBlankDaysEnd = 6 - moment().endOf('month').weekday();
					var blankDaysEnd = [];
	
					for (var index = 0; index < numberBlankDaysEnd; index++) {
						blankDaysEnd.push( "day" );          
					}
					
					return blankDaysEnd;

				},

				daysBeforeMonth: function(){

					if( this.thisMoment == null ) {
						return; 
					}
				
					var days = this.thisMoment.startOf('month').weekday();
					var arr = [];
					
					for (var index = 0; index < days; index++) {
						arr.push(  {  day: index + 1, pixel: null }  );          
					}

					return arr;
				},

				daysInMonth: function() {

					if( this.thisMoment == null ) {
						return; 
					}

					var days = this.thisMoment.daysInMonth()
					var arr = [];
					
					for (var index = 0; index < days; index++) {
						arr.push(  {  day: index + 1, pixel: null }  );          
					}

					return arr;
				},

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


				 this.thisMoment = moment();
              
				/**
				 *  Here is where everything else that needs to happen as the vue app loads should live          
				 *
				 */
	
			},
	
			methods: {
				/* Methods are pretty self explanatory --  they are the functions that handle all the logic of the app*/
			
				nextMonth: function(){
					this.thisMoment = this.thisMoment.add( 1, 'M' );
				},

				previousMonth: function(){
					this.thisMoment = this.thisMoment.subtract( 1, 'M' );
			 	},
					
			} // closes methods
	
		});	 // closes new vue app
	
	} // closes document.querySelector