if( document.querySelector('#calendarApp') ){

		/*  Here's a Vue app */
		var calendarApp= new Vue({
			el: '#calendarApp',  //dom node to host our app
			data: { 	// the blood and guts of the app        
				pixels: [],
				selectedPixel: false,

				initialMoment: moment(),
				thisMoment: null,

				currentMonth: '',
				currentYear: '',

				days: [],
				
				per_page: 31,	

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



				/**
				 *  Here is where everything else that needs to happen as the vue app loads should live          
				 *
				 */

				this.thisMoment = moment();
				this.recalculateCalendar();
	
			},
	
			methods: {
				/* Methods are pretty self explanatory --  they are the functions that handle all the logic of the app*/
			
				backToCalendar: function(){
					this.selectedPixel = false;
				},

				calendarGrid: function(){

					var gridTemplateRows = 'grid-template-rows:';
		
					var numberOfRows = this.days.length/7;

					for (var index = 0; index < numberOfRows; index++) {
						gridTemplateRows += '3em ';						
					}

					gridTemplateRows += ';';

					return gridTemplateRows;

				},

				fetchPixels: function(){
					
					var self = this;
					self.pixels = [];

					var calendarCategory = document.querySelector('#calendarCategory').value;
					
					var thisMonthAsNumber = self.thisMoment.format('M');												

					if(self.per_page > 100 ) {
						self.per_page = 100;
					} 
					var per_page = 'per_page=' + self.per_page;

					var url = wpApiSettings.root + 'wp/v2/media?' + per_page + '&categories=' + calendarCategory;					

					fetch( url  )
						.then(function(response) {
							return response.json();
						})
						.then(function( pixels ) {							 
							
							for (var index = 0; index < pixels.length; index++) {

								var pixel = pixels[index];						
								self.pixels.push( pixel );

								for (var x = 0; x < self.days.length; x++) {

									var day = self.days[x];		
					
									if ( moment(day.moment).isSame( moment(pixel.date), 'day' ) ){
										day.pixel = pixel;
									}

								}								
							}

						});

					
				},

				nextMonth: function(){
					this.thisMoment = this.thisMoment.add( 1, 'M' );
					
					if( this.per_page > 31 ){
						this.per_page = this.per_page - 31;
					} else {
						this.per_page = 31;
					}

					this.recalculateCalendar();
				},

				previousMonth: function(){
					this.thisMoment = this.thisMoment.subtract( 1, 'M' );
					
					if( this.per_page == 31 || this.per_page > 31){
						this.per_page += 31;
					} else {
						this.per_page = 31;
					}				
					
					this.recalculateCalendar();
				},

				showPixel: function( key ) {
					//console.log( key );
					var pixel = this.days[key].pixel;
					this.selectedPixel = {};
					this.selectedPixel.title = pixel.title.rendered; 
					this.selectedPixel.desc = pixel.alt_text;
					this.selectedPixel.url = pixel.media_details.sizes.full.source_url;
					
				},

				recalculateCalendar: function() {

					if( this.thisMoment == null ) {
						return; 
					}
	
					this.currentMonth = this.thisMoment.format('MMM');			
					this.currentYear = this.thisMoment.format('YYYY');

					this.days = [];				
					
					var days = this.thisMoment.startOf('month').weekday();			
					
					for (var index = 0; index < days; index++) {					       
						this.days.push({  day: null, pixel: false, class: 'day blank flex flex-column', moment: '' });
					}	

					var days = this.thisMoment.daysInMonth()
					
					for (var index = 0; index < days; index++) {	
						var dayOfMonth = index + 1;
						var momentDay = moment( dayOfMonth + ' ' + this.currentMonth + ' ' + this.currentYear + ' 00:00 EST' ).format(); 
						this.days.push( {  day: dayOfMonth, pixel: false, class: 'day flex flex-column', moment: momentDay }  );    
					}	
				
					var numberBlankDaysEnd = 6 - this.thisMoment.endOf('month').weekday();
		
					for (var index = 0; index < numberBlankDaysEnd; index++) {						 
						this.days.push({  day: null, pixel: false, class: 'day blank flex flex-column', moment: '' });
					}
					
					this.fetchPixels();
						
				},
					
			} // closes methods
	
		});	 // closes new vue app
	
	} // closes document.querySelector