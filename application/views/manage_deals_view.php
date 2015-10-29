
<title><?php echo $title ?></title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/search_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/deal_styles.css">
<h1>Manage Deals</h1>
<a class="colored_button" href="<?php echo base_url() . '/Deals/select_item' ?>">Create a deal</a>
<div id="all_deals_container">
<table>
<th><td>Deal</td><td>End Date</td><td>Status</td><td>Action</td></th>
<?php

	if($deals == NULL){
		echo '<div id="result_count_text"><h3>You have not created any deals.</h3></div>';
	}else{
		//Showing Deals

		foreach ($deals as $object) {
			$end_date = date_create($object->end_time);
			// getShippingTitle and printCurrencyInRs are from utility_helper.php (autoload)
			echo  '<tr>
						<td>
							<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
						</td>
						<td>
							<a href="'. base_url() .'item/item/?item='. $object->item_id .'"><h4>'. $object->title . '</h4></a>
							<br>
							<span class="item_price_span" >' . printCurrencyInRs($object->price - $object->price/100 * $object->off_percentage) . '</span>
							
							<br>
							<span class="item_prev_price_span" >' . printCurrencyInRs($object->price) . '</span> | '. $object->off_percentage .'% OFF
							<br>
							<span>'. getShippingTitle($object->shipping_cost) . '</span>';
			
				if ($object->available_quantity < 5) {
					echo '<br><span class="deal_gone_message"><strong>Almost gone</strong></span>';
				}


			echo		'</td>
							<td>
							'. date_format($end_date, 'Y-m-d H:i:s') .'
							</td>
							<td>
							' . $object->deal_status . '
							</td>
							<td>';
						if (strcmp($object->deal_status, 'Active')  == 0 ) {
							echo '<a href="'. base_url() .'/Deals/end_deal/?deal='. $object->deal_id .'" class="light_gray_button">End Deal</a>';
						}	
							
			echo			'</td>
						
					<span id="countdown'. $object->deal_id .'"></span>
					<script>
						// set the date  counting down to
						var target_date'. $object->deal_id .' = new Date("'. $object->end_time . '").getTime();
						 
						// variables for time units
						var days, hours, minutes, seconds;
						 
						// get tag element
						var countdown = document.getElementById("countdown'. $object->deal_id .'");
						 
						// update the tag with id "countdown" every 1 second
						setInterval(function () {
						 
						    // find the amount of "seconds" between now and target
						    var current_date = new Date().getTime();
						    var seconds_left = (target_date - current_date) / 1000;
						 
						    // do some time calculations
						    days = parseInt(seconds_left / 86400);
						    seconds_left = seconds_left % 86400;
						     
						    hours = parseInt(seconds_left / 3600);
						    seconds_left = seconds_left % 3600;
						     
						    minutes = parseInt(seconds_left / 60);
						    seconds = parseInt(seconds_left % 60);
						     
						    // format countdown string + set tag value
						    countdown.innerHTML = days + "d, " + hours + "h, "
						    + minutes + "m, " + seconds + "s";  
						 
						}, 1000);	
					</script>
					<td></tr>';	
		}
	}
	
?>
</table>
</div>