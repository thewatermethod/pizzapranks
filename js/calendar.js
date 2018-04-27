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

					var calendarCategory = document.querySelector('#calendarCategory').value;
					
					var thisMonthAsNumber = self.thisMoment.format('M');
												
					fetch( wpApiSettings.root + 'wp/v2/media?posts_per_page=31&categories=' + calendarCategory + '&year=' + this.currentYear + '&monthnum=' + thisMonthAsNumber )
						.then(function(response) {
							return response.json();
						})
						.then(function( pixels ) {							 
							
							for (var index = 0; index < pixels.length; index++) {

								var pixel = pixels[index];						
								self.pixels[ pixel.id ] =  pixel;

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
					this.recalculateCalendar();
				},

				previousMonth: function(){
					this.thisMoment = this.thisMoment.subtract( 1, 'M' );
					this.recalculateCalendar();
				},

				showPixel: function( pixelId) {
					var pixel = {};
					pixel.title = this.pixels[pixelId].title.rendered; 
					pixel.desc = this.pixels[pixelId].alt_text;
					pixel.url = this.pixels[pixelId].media_details.sizes.full.source_url;
					this.selectedPixel = pixel;
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