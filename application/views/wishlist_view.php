
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/search_styles.css">
</head>>

<body>

<div id="left_side_bar">

</div> 

<div id="search_result_container">


<?php



		foreach ($items as $object) {



			// getShippingTitle and printCurrencyInRs are from utility_helper.php (autoload)
			echo  '<tr><td class="search_result_item">
					<table><tr>
						<td>
							<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
						</td>
						<td>
							
							<a href="'. base_url().'item/item/?item='.$object->itemid.'"><h4>'. $object->title . '</h4></a>
							<br>
							<p>'. $object->description . '</p>
							<br>
							
							<br>
							<a href="'. base_url().'wishlist/remove/'.$object->itemid.'">Remove from wish list</a>

							</span>
							
						</td>
					</tr></table>';

	}
	
?>

</div>
</body>