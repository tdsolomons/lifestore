<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/category_section_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/home_styles.css">

<div id="latest_items_container">
	
<?php 
	
	if ($latestItemsByFollowingSellers) {

		echo '<h3>Latest items from the sellers you follow</h3>
				<table><tr>';
		foreach ($latestItemsByFollowingSellers as $object) {

			$itemPriceSlot = "";
			$itemLinkSlot = "";
			if (isset($object->price)) {
				$itemPriceSlot = '<span class="item_price_span" >' . printCurrencyInRs($object->price) . '</span>';
				$itemLinkSlot = base_url() .'item/item/?item='. $object->item_id;
			}else if(isset($object->starting_bid)){
				$itemPriceSlot = 'Bidding starts at </br>
								<span class="item_price_span" >' . printCurrencyInRs($object->starting_bid) . '</span>
								<br>
								<span class="time_left_span">'. getTimeLeftForDate($object->end_datetime) .'</span>';
				$itemLinkSlot = base_url() .'item/AuctionItem/?item='. $object->item_id;
			}

			echo '<td style="width:25%">
					<div class="latest_item_container">
					<table>
					<tr><td>
						<img width="250" height="250" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
					</td></tr>
					<tr><td>
						<a href="'. $itemLinkSlot .'">'. $object->title .'</a>
					</td></tr>
					<tr><td> 
					' . $itemPriceSlot . '
					</td></tr>
					<tr><td>

						<strong>By Seller <a href="'. base_url() .'Profile/seller/?seller='. $object->seller  .'">'. $object->username .'</a></strong>

					</td></tr>
					</table>
					</div>
				</td>';
		}

		echo '</tr></table>';
	}

?>
	
</div>

<div id="latest_items_container">
	
<?php 
	
	if ($trending_items) {

		echo '<h3>Trending</h3>
				<table><tr>';
		foreach ($trending_items as $object) {

			$itemPriceSlot = "";
			$itemLinkSlot = "";
			if (isset($object->price)) {
				$itemPriceSlot = '<span class="item_price_span" >' . printCurrencyInRs($object->price) . '</span>';
				$itemLinkSlot = base_url() .'item/item/?item='. $object->item_id;
			}else if(isset($object->starting_bid)){
				$itemPriceSlot = 'Bidding starts at </br>
								<span class="item_price_span" >' . printCurrencyInRs($object->starting_bid) . '</span>
								<br>
								<span class="time_left_span">'. getTimeLeftForDate($object->end_datetime) .'</span>';
				$itemLinkSlot = base_url() .'item/AuctionItem/?item='. $object->item_id;
			}

			echo '<td style="width:25%">
					<div class="latest_item_container">
					<table>
					<tr><td>
						<img width="250" height="250" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
					</td></tr>
					<tr><td>
						<a href="'. $itemLinkSlot .'">'. $object->title .'</a>
					</td></tr>
					<tr><td> 
					' . $itemPriceSlot . '
					</td></tr>
					<tr><td>

						<strong>By Seller <a href="'. base_url() .'Profile/seller/?seller='. $object->seller  .'">'. $object->username .'</a></strong>

					</td></tr>
					</table>
					</div>
				</td>';
		}

		echo '</tr></table>';
	}

?>
	
</div>


<div id="latest_items_container">
	
<?php 
	
	if ($others_viewed) {

		echo '<h3>Other users recently viewed </h3>
				<table><tr>';
		foreach ($others_viewed as $object) {

			$itemPriceSlot = "";
			$itemLinkSlot = "";
			if (isset($object->price)) {
				$itemPriceSlot = '<span class="item_price_span" >' . printCurrencyInRs($object->price) . '</span>';
				$itemLinkSlot = base_url() .'item/item/?item='. $object->item_id;
			}else if(isset($object->starting_bid)){
				$itemPriceSlot = 'Bidding starts at </br>
								<span class="item_price_span" >' . printCurrencyInRs($object->starting_bid) . '</span>
								<br>
								<span class="time_left_span">'. getTimeLeftForDate($object->end_datetime) .'</span>';
				$itemLinkSlot = base_url() .'item/AuctionItem/?item='. $object->item_id;
			}

			echo '<td style="width:25%">
					<div class="latest_item_container">
					<table>
					<tr><td>
						<img width="250" height="250" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
					</td></tr>
					<tr><td>
						<a href="'. $itemLinkSlot .'">'. $object->title .'</a>
					</td></tr>
					<tr><td> 
					' . $itemPriceSlot . '
					</td></tr>
					<tr><td>

						<strong>By Seller <a href="'. base_url() .'Profile/seller/?seller='. $object->seller  .'">'. $object->username .'</a></strong>

					</td></tr>
					</table>
					</div>
				</td>';
		}

		echo '</tr></table>';
	}

?>
	
</div>



<h2>Shop by Category</h2>
<table id="category_table">
<?php

	$column = 1;
	echo "<tr>";
	foreach ($categories as $object) {
		echo '<td><img src="'. asset_url() .'img/category_images/' . $object->category_id 
				. '.svg" width="70" height="70" /><a href="search/category/?category=' 
				. $object->category_id . '">' . $object->category_name . '</a></td>';
		if ($column % 3 == 0) {
			echo "</tr><tr>";
			$column = 1;
		}else{
			$column += 1;
		}
 	}

?>
</table>
