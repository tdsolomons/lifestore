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
		return 4;
	}

?>