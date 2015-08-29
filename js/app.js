/*

@renardsuper
https://learn.jquery.com/code-organization/concepts/

*/
;(function($){

	FastClick.attach(document.body); // instantiate FastClick 

	console.log(app_globals);

	var 	APP 	= 	APP || {},
	 		$win 	= 	$(window),
			$doc	=	$(document),

			Modernizr = window.Modernizr,
			scrolledByUser = false,
    		isTouch = Modernizr.touch && navigator.userAgent.match(/(iPhone|iPod|iPad)|BlackBerry|Android/);

			APP = {

		_: function () {

			this.loader._();

			this.routing._();


			this.autoscroll._();
			
			this.magnificpopup._();
			this.flexslider._();

			this.events._();
			this.ajax._();
			this.mobileNav._();

			this.parallax._();
		
			this.helpers._();

			this.googleMap._();
			

		},

		// test device

		responsive: {
            breakpoints: [
                {
                    device: 'smartphoneP',
                    minWidth: 0, maxWidth: 567
                },
                {
                    device: 'smartphoneL',
                    minWidth: 568, maxWidth: 767
                },
                {
                    device: 'tabletP',
                    minWidth: 768, maxWidth: 900
                },
                {
                    device: 'tabletL',
                    minWidth: 901, maxWidth: 1024
                },
                {
                    device: 'desktop',
                    minWidth: 1025
                }
            ],

            testDevice: function(device) {
                var breakpoints = APP.responsive.breakpoints,
                    winWidth = $(window).width();

                for (var i=0; i<breakpoints.length; i++) {
                    var breakpoint = breakpoints[i];
                    if (breakpoint.maxWidth == undefined || breakpoint.maxWidth >= winWidth && breakpoint.minWidth <= winWidth) {
                        if (device == undefined) return breakpoint.device
                        else {
                            if (device == breakpoint.device) return true;
                            else return false;
                        }
                    }
                };
            }
        },


		routing : {

			_: function() {


				var self = this;

				this.route = '';

				this.$mainNav = $('nav.main');

				this.$mainNav.find('a').on('click', function(e){
					e.preventDefault();
					//location.replace("http://www.w3schools.com");
					var the_id = $(this).attr("href");

					$('html, body').animate({
						scrollTop:$(the_id).offset().top - $('header').outerHeight() / 2 
					}, 'easeInOutQuint');

					document.location.hash = the_id;


				})



				this.$routes = $('[data-route]');

				this.paths = {}; 


				this.$routes.each(function(){

				
					self.paths['path'] = {"route" : $(this).attr('data-route'), "position" : $(this).position().top}

					//console.log($(this).position().top);

				})

				console.log(this.paths); 



			},

			_init : function() {



			},

			_updateURL: function() {


			}


		},

		loader : {

			_: function() {
				$('body').imagesLoaded( function() {
					function waitwait(){
					  $('body').addClass('loaded');
					}
					setTimeout(waitwait, 1000);
				});
			}

		},



		autoscroll : {

			options : {
				animScrollSpeed: 1000,
				easing: "easeInOutQuint"
			},

			_: function() {

				var self = this,
					options = this.options;

				this.$h = $(app_globals.url_hash);

				if(this.$h.length){
					$('html, body').animate({scrollTop: self.$h.position().top }, options.animScrollSpeed, options.easing);
				}
			
			}

		},

		magnificpopup : {

			_: function() {

				var self = this;

				$('.content a img').each(function() {

					var self = this;

				    $(this).magnificPopup({
				        delegate: 'a', 
				        type: 'image',
				        closeOnContentClick: false, 
				        closeOnBgClick: false,
				        showCloseBtn: true,
				        closeMarkup: '<a class="btn icn close">close</a>',
				        gallery: {
				        	enabled:true
				        },
				        callbacks: {
				        	open: function() {
						      $('a.btn.close').on('click', function(){
						      	$.magnificPopup.close();
						      })
						    }
				        }
				    });
				});


			}
		},

		events : {

			_: function(){

				var self = this;

				this.$as 			= $('#programme').find('.overview article');
				this.$overlay 		= $('#ajax-overlay');

				this.$as.on('click', 'a', function(e) {
					e.preventDefault();
					self._load( $(this).attr('href') );
				});

			},

			_load : function(url) {

				var self = this;

				console.log(url);

				// load 7 derniers get_all_posts
				jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'get_post_by_url',
						param: url
					},
					dataType: 'html',
					success: function(response) {
						//self._showOverlay(response);
						//$('#blog').find('.isotope').append(response);

					}

				});

			}

		},

		ajax : {
			_: function(){

				var self = this;

				this.$as 			= $('a.ajax');
				this.$overlay 		= $('#ajax-overlay');



				this._init();

				this._loadMore();

			},

			_init : function() {

				var self = this;

				// get_all_posts
				jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'get_posts_by_offset'
					},
					dataType: 'html',
					success: function(response) {
						//self._showOverlay(response);
						$('#blog').find('.overview').append(response)
						.find('li').last().addClass('end');
						//APP.helpers.equalheights._();
						//self._initOverlay();
						//self._initIsotope();
					}
				});


			},

			_initOverlay : function() {

				var self = this;

				$('a.ajax').on('click', function(e) {
					e.preventDefault();
					//$('body').removeClass('loaded');
					self._request('get_post_by_url', $(this).attr('href'));
				});


			},

			_request : function(action, param) {

				var self = this;
				jQuery.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
					action: action,
					param: param
					},
					dataType: 'html',
					success: function(response) {
						//self._showOverlay(response);
					}
				});

			},

			_showOverlay : function(response) {

				var self = this;

				this.$overlay.addClass('show').find('.content').empty().append(response);
				this.$overlay.find('a.close').on('click', function(e){
					e.preventDefault();
					self._hideOverlay();
				})
				$('body').addClass('noscroll');

			},

			_hideOverlay : function() {

				$('body').removeClass('noscroll');
				this.$overlay.removeClass('show');

			},

			_loadMore : function() {

				var self = this;

				$('.loadmore').on('click', function(e) {
					var self = this;
					// request
					$('body').removeClass('loaded');
					e.preventDefault();
					// define offset post to load
					var count = $('#blog').find('li').length;

						jQuery.ajax({
							url: ajaxurl,
							type: 'POST',
							data: {
							action: 'get_posts_by_offset',
							param: count
							},
							dataType: 'html',
							success: function(response) {
								$('#blog').find('.overview').append(response)
									.find('li')
									.removeClass('end')
									.last().addClass('end');
							
								APP.helpers.equalheights._();
								$('body').addClass('loaded');
								if(response == '') $('.loadmore').hide();

							},

						});

				})

			}

		},

		flexslider : {
			_: function() {

				var self = this;

				  $('.flexslider').flexslider({
				    	animation: "fade",
				    	controlsContainer: $(".custom-controls-container"),
				    	customDirectionNav: $(".custom-navigation a"),
			    	    animationLoop: true,
			    	    smoothHeight: false
				    	    /*
						    itemWidth: 210,
						    itemMargin: 5,
						    minItems: 1,
						    maxItems: 2
						    */
				  });
				
			}

		},

		mobileNav : {
			_: function(){
				var self = this;
				this.$m = $('nav.mobile');
				this.$t = $('.hamburger');
				this.$t.on('click', function(e){
					e.preventDefault();
					$this = $(this);
					$this.toggleClass('active');
					self._open();
				});
			},
			_open: function(){
				var self = this;
				this.$m.toggleClass('open');

				this.$hrefs = this.$m.find('a');

				this.$hrefs.on('click', function(){
					self._close();
				})
			},
			_close: function(){
				this.$m.removeClass('open');
				this.$t.removeClass('active');
			}
		},

		/* parallax */

		parallax : {  
			options : {
				speed: 0.1
			},
			_: function(){
				var self = this;
				this.$els = $('.parallax');
				this.$els.each(function(){
					var $el = $(this);
					$win.on("scroll", function(e){
				    	var scrolled = $win.scrollTop() - $el.position().top;
	    				$el.css('background-position', '50% ' + (50 + scrolled * self.options.speed ) + '%');
					});
				})
			}
		},

		// this helpers will help, youpi ;-)
		// they improve HTML/CSS
		// they dont have any dependecies such as plugins

		helpers : {

			_: function() {
				this.animation._();

				this.equalheights._();

				this.factsheet._();
				this.fader._();
				this.fixHeader._();

				this.jumbotron._();

				this.scrollDown._();
				this.scrollHome._();
				this.scrollTo._();

				this.winHeight._();
				
			},

			// equalize elements heights
			// "programme articles", "blog articles"

			equalheights : {

				_: function() {
	                var self = this;
	                self._equalize();
	                $win.on('load resize', self._equalize);
            	},

	            _equalize: function() {

	                $(".equalHeights").each(function() {
	                    var currentTallest = 0,
	                        currentRowStart = 0,
	                        currentDiv = 0,
	                        rowDivs = new Array(),
	                        $this,
	                        topPosition = 0;
	                    
	                    $(this).children().each(function() {
	                        var $this = $(this);
	                        
	                        if ($this.is(':visible')) {
	                            $this.height('auto');
	                            topPosition = $this.position().top;

	                            if (currentRowStart != topPosition) {
	                                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
	                                    rowDivs[currentDiv].height(currentTallest);
	                                }
	                                rowDivs.length = 0;
	                                currentRowStart = topPosition;
	                                currentTallest = $this.height();
	                                rowDivs.push($this);
	                            } else {
	                                rowDivs.push($this);
	                                currentTallest = (currentTallest < $this.height()) ? ($this.height()) : (currentTallest);
	                            }

	                            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
	                                rowDivs[currentDiv].height(currentTallest);
	                            }
	                        }
	                    });
	                });
	            
				}

			},

			// css3 animations trigger
			// animate elements getting in viewport

			animation : {

				_: function() {

					$win.on('load scroll resize', function() {

						$('.animation').each(function(){
						var imagePos = $(this).offset().top;
						var topOfWindow = $(window).scrollTop();
							if (imagePos < topOfWindow+600 ) {
								var a = $(this).attr('data-animation');
								$(this).addClass(a);
							}
						});

					});

				}

			},

			// animate and fix the header

			fixHeader : {
				_: function() {
					var self = this;
					this.$h = $('header');
					$win.on('scroll load resize' , function() {
					    var top = $(this).scrollTop();
					    //console.log(top);
					    // if statement to do changes
					    // hide().css({'top':-30}).show()
					    top >= $win.height()-self.$h.outerHeight() ? 
						    self.$h.addClass('fixme').animate({top:0}, 'slow', 'swing') 
					    : self.$h.removeClass('fixme');
					});
				}
			},

			scrollDown : {
				options : {
					animScrollSpeed: 1000,
					easing: "easeInOutQuint"
				},
				_: function() {
					this.$sfm = $('.scrollDown');
					if ( !this.$sfm.length ) return;
					var options = this.options;
					this.$sfm.on('click', function(e){
						e.preventDefault();
						var  $wH = $win.height();
						$('html, body').animate({scrollTop: $wH }, options.animScrollSpeed, options.easing);
					});
				}
			},

			scrollHome : {
				options : {
					animScrollSpeed: 1000,
					easing: "easeInOutQuint"
				},
				_: function() {
					this.$sfm = $('.scrollHome');
					if(this.$sfm.length < 1) return;
					var options = this.options;
					this.$sfm.on('click', function(e){
						e.preventDefault();
						$('html, body').animate({scrollTop: 0 }, options.animScrollSpeed, options.easing);
					});
				}
			},

			scrollTo : {
				options : {
					animScrollSpeed: 1000,
					easing: "easeInOutQuint"
				},
				_: function() {
					this.$sfm = $('.scrollTo');
					var headerH = $('header').outerHeight();
					if(this.$sfm.length < 1) return;
					var options = this.options;
					this.$sfm.on('click', function(e){
						e.preventDefault();
						var anchor = $(this).attr('href');
						$('html, body').animate({scrollTop: $(anchor).position().top - headerH }, options.animScrollSpeed, options.easing);
					});
				}
			},

			winHeight : {
				_: function() {

					$win.on('load resize', function(){
						this.$as = $('.winHeight');
						this.$as.css({'height':$win.height()});
					})
				}
			},

			fader : {
				options : { 
				},
				_: function() {
					var self 	= 	this;
					this.$fs 	= 	$('.fade');
					if(this.$fs.length < 1){ return false };
					$doc.on('scroll', function(){
						self.$fs.each(function(){
							var $this = $(this);
							self._fade($this);
						})	
					});

				},
				_fade: function (O) {
					var oXP 	= O.offset().top,
						docXP 	= $doc.scrollTop(), 
						opacity;
					oXP > docXP ? opacity = ((oXP - docXP * 100) / oXP ) * - 0.01 : opacity = 1 ;
					O.css({ 'opacity': 1 - opacity })
				}
			},

			jumbotron : {
				options : { 
				},
				_: function() {
					var self 	= 	this;
					this.$j 	= 	$('.hero-jumbotron');
					this.posX;
					if(this.$j.length < 1 ){ return false };
					this._init(); // position in the screen
					
					$doc.on('load scroll resize', function(){
						var top = self.posX - $doc.scrollTop() * -0.5 ;
						self.$j.css({ 'top': top })
						//self._init();
					});
				},
				_init: function() {
					this.posX = ($win.height() / 2 ) - (this.$j.outerHeight() / 2) ;
					this.$j.css({ 'top' : this.posX });
				}
			},

			factsheet : {

				_: function() {

					var self = this;

					this.$fs = $('#factsheet');

					$win.on('load scroll resize', function(){

						if( self.$fs.visible() && !self.$fs.hasClass('counted')) {
							// add class to prevent reinit
							self.$fs.addClass('counted');

							$('.count').each(function () {
							    $(this).prop('Counter',0).animate({
							        Counter: $(this).text()
							    }, {
							        duration: 4000,
							        easing: 'swing',
							        step: function (now) {
							            $(this).text(Math.ceil(now));
							        }
							    });
							});

						}
					})

				}


			}

		},

		// Google Map configuration
		// app_globals.lat/lng are global custom fields in wp backend
		// otherwise nothing special to know, 
		// yes, it's also an information for you :-) 
		// cheers!

		googleMap : {

			options : {
				mapOptions: {
					center: { lat: app_globals.lat, lng: app_globals.lng },
					zoom: 13,
					minZoom:6,
					disableDefaultUI: true,
					panControl: true,
					keyboardShortcuts: true,
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL 
					},
					rotateControl: false,
					streetViewControl: false,
					draggable: $(document).width() > 480 ? true : false, // otherwise blocked on the map
					panControl: false,
					scrollwheel: false,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					//styles:[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"administrative.country","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.country","elementType":"labels.text","stylers":[{"visibility":"simplified"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"30"}]},{"featureType":"administrative.neighborhood","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"gamma":"0.00"},{"lightness":"74"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"lightness":"3"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
						//styles:[{"stylers":[{"visibility":"simplified"}]},{"stylers":[{"color":"#131314"}]},{"featureType":"water","stylers":[{"color":"#131313"},{"lightness":7}]},{"elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":25}]}]
					styles:[{"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] }, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] }, {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] }, {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 }, {"lightness": 45 } ] }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] }, {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] }, {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] }, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#46bcec"}, {"visibility": "on"} ] } ] }
			},

			_: function() {

				var options = this.options, self = this;

				this.map;
				this.marker;
				this.markers = new Array();

				this.map = new google.maps.Map(document.getElementById('map-canvas'), options.mapOptions);
				google.maps.event.addDomListener(window, 'load');

				var myLatlng = new google.maps.LatLng(app_globals.lat,app_globals.lng);

				this._addMarker(myLatlng, 'title');

				//this._fitToMarkers();
				/*
				google.maps.event.addDomListener(window, 'resize', function() {
    				self.map.setCenter(options.center);
				});*/

			},

			_addMarker: function(myLatlng,title) {

				var iconSVG = {     
					path: 'M67.013,56.38C67.013,39.326,33.503,0,33.503,0S-0.003,39.326-0.003,56.38 c0,11.501,4.764,22.177,14.949,27.921c-1.289-1.914-2.068-4.008-2.068-6.123c0-9.965,6.543-13.106,19.059-15.924 c7.68-1.724,15.381-3.704,22.197-7.132v13.651c-0.463,8.358-3.628,14.424-8.464,18.239C60.272,82.602,67.013,70.079,67.013,56.38z',
					fillColor: 'gold',
					fillOpacity: 1,     
					scale: 1,
					strokeColor: 'gold',     
					strokeWeight: 0 
				};

				this.marker = new google.maps.Marker({
				     position: myLatlng,
				     title: title,
				     icon: iconSVG
				});

				this.marker.setMap(this.map);
				this.markers.push(this.marker); 
				
			},

			_fitToMarkers: function() {

				var markers = this.markers;
				var bounds = new google.maps.LatLngBounds();

				for(i=0;i<markers.length;i++) {
					bounds.extend(markers[i].getPosition());
				}

				this.map.fitBounds(bounds);

			}

		},


		/* Google Analytics */

		googleAnalytics : {

			options : {

			},
			_: function(){

			}

		}     

	};

	APP._();

})( jQuery );
