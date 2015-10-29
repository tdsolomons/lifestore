
<title><?php echo $title ?></title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/search_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/deal_styles.css">
<h1>Create a deal</h1>
<h3>Please select an item</h3>
<div id="all_deals_container">
<table>
<?php

	if($items == NULL){
		echo '<div id="result_count_text"><h3>No items found eligible for creating a deal.</h3></div>';
	}else{
		//Showing Items

		foreach ($items as $object) {

			// getShippingTitle and printCurrencyInRs are from utility_helper.php (autoload)
			echo  '<tr>
						<td>
							<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
						</td>
						<td>
							<a href="'. base_url() .'item/item/?item='. $object->item_id .'"><h4>'. $object->title . '</h4></a>
							<br>
							<span class="item_price_span" >' . printCurrencyInRs($object->price)  . '</span>
							
							<br>
							<span>'. getShippingTitle($object->shipping_cost) . '</span>
							<br>
							<span>Available Quantity: ' . $object->available_quantity . '</span>';

			echo		'</td>
						<td>
							<a class="light_gray_button" href="'. base_url() . '/Deals/create_deal/?item=' . $object->item_id . '">Create a deal</a>
						</td>	
					</tr>';	
		}
	}
	
?>
</table>
</div>