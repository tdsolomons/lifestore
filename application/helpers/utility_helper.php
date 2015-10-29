<?php
	function asset_url(){
		return base_url().'assets/';
	}

	function getShippingTitle($shippingCost){
		if($shippingCost == 0){
			return 'Free Shipping';
		}else{
			return 'Shipping Cost: '. printCurrencyInRs($shippingCost);
		}
	}

	function printCurrencyInRs($money){
		//Returns currency as Rs 20,500.00
		return 'Rs ' .  number_format($money, 2);
	}

	function getResultsPerPageCount(){
		return 6;
	}

	function getTimeLeftForDate($time){
		
		$date=strtotime($time);//Converted to a PHP date (a second count)

		//Calculate difference
		$diff=$date-time();//time returns current time in seconds
		$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
		$hours=round(($diff-$days*60*60*24)/(60*60));

		if ($days >= 0 && $hours >= 0) {
			return $days . "d ". $hours ."h left";
		}else{
			return "Ended ". abs($days) . "d ". $hours ."h ago";
		}
		
	}

	function humanTiming ($time)
	{
		$time = strtotime($time);
	    $time = time() - $time; // to get the time since that moment

	    $tokens = array (
	        31536000 => 'year',
	        2592000 => 'month',
	        604800 => 'week',
	        86400 => 'day',
	        3600 => 'hour',
	        60 => 'minute',
	        1 => 'second'
	    );

	    foreach ($tokens as $unit => $text) {
	        if ($time < $unit) continue;
	        $numberOfUnits = floor($time / $unit);
	        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	    }

	}

?>