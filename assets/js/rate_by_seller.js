
                                $(document).ready(function(){
								 $('.ratings_stars').hover(
								   // Handles the mouseover
								   function() {
									  $(this).prevAll().andSelf().addClass('ratings_over');
									  $(this).nextAll().removeClass('ratings_vote'); 
								   },
								   // Handles the mouseout
								   function() {
									  $(this).prevAll().andSelf().removeClass('ratings_over');
									  set_votes($(this).parent());
								  }
								 );
								
								  
								  //load the current value..............
								 $('.rate_widget').each(function(i) {
									var widget = this;
									var name = $(widget).attr('id').slice(1);
									var out_data = {
										widget_id : name,
										fetch: 1
									};
									$.post(
										'http://sep.tagfie.com/UserAccount/buyerRatings',
										out_data,
										function(INFO) {
											$(widget).data( 'fsr', INFO );
											set_votes(widget);
										},
										'json'
									);
								});
								
								
								function set_votes(widget) {
								
									var avg = $(widget).data('fsr').buyer_rating;
									
									$(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
									$(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote'); 
								}
																
								
								
							  $('.ratings_stars').bind('click', function() {
  var star = this;
								var widget = $(this).parent();
								var name =  widget.attr('id').slice(1);
								var clicked_data = {
									clicked_on : $(star).attr('class'),
									widget_id : name
								};
								$.post(
									'http://sep.tagfie.com/UserAccount/buyerRatings',
									clicked_data,
									function(INFO) {
										widget.data( 'fsr', INFO );
										set_votes(widget);
									},
									'json'
								); 
							  });
								
								
								
								
								});
              