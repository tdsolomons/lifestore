<?php
$currentSorting = $this->input->get('sorting');
function checkSelectedSorting($sorting, $currentSorting){
	if (strcmp($sorting, $currentSorting)== 0)
		return 'selected';
	else
		return '';
}
?>
<title>Search Results</title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){
		hidePriceRangeError();
		$("#price_filter_min_textbox").change(function(){
			var min = document.getElementById("price_filter_min_textbox").value;
			if(isNaN(min)){
				document.getElementById("price_filter_min_textbox").value = '';
				showPriceRangeError();
			}else{
				hidePriceRangeError();
			}
		});


		$("#price_filter_max_textbox").change(function(){
			var max = document.getElementById("price_filter_max_textbox").value;
			if(isNaN(max)){
				document.getElementById("price_filter_max_textbox").value = '';
				showPriceRangeError();
			}else{
				hidePriceRangeError();
			}
		});

	});	

	//Sort comboBox change event
	function onSortComboBoxChange(){
		var selectedValue = document.getElementById("sort_option_combobox").value;
		window.location.href =  updateQueryStringParameter(document.URL, 'sorting' , selectedValue);
	}

	//Fiter Ok Button Click Event
	function onClickPriceRangeFilterOk(){
		var min = document.getElementById("price_filter_min_textbox").value;
		var max = document.getElementById("price_filter_max_textbox").value;
		var url = "";
		if(!isNaN(min)){
			url =  updateQueryStringParameter(document.URL, 'minPrice' , document.getElementById("price_filter_min_textbox").value);
		}
		if(!isNaN(max)){
			url = updateQueryStringParameter(url, 'maxPrice' , document.getElementById("price_filter_max_textbox").value);
		}
		window.location.href =  url;

	}

	function hidePriceRangeError(){
		document.getElementById("price_range_validation_error").style.display = 'none';
		document.getElementById("price_range_validation_error").style.visibility = "hidden"
	}

	function showPriceRangeError(){
		document.getElementById("price_range_validation_error").style.display = 'block';
		document.getElementById("price_range_validation_error").style.visibility = "visible"
	}

	//Condition Type Checkbox
	function onConditionTypeChange(conditionTypeId){
		var count = document.getElementById("condition_types_count").value;
		var conditionParamValue = '';
		var numOFValuesAdded = 0;
		for (i = 1; i <= count; i++) {
			var value = document.getElementById("checkbox_cond_" + i ).checked;
			if( value != null && value == true){
				if (numOFValuesAdded > 0)
					conditionParamValue +=  ',';
				conditionParamValue +=  i ;
				numOFValuesAdded += 1;
			}
		};
		
		window.location.href =  updateQueryStringParameter(document.URL, 'cond' , conditionParamValue);
	}
	
	//Free shipping checkbox
	function onFreeShippingCheck(){
		window.location.href =  updateQueryStringParameter(document.URL, 'freeShip' , document.getElementById("free_shipping_checkbox").checked);
	}

	function onAllListingTypeClick(){
		window.location.href =  updateQueryStringParameter(document.URL, 'itemType' , 'all');
	}

	function onAuctionTypeClick(){
		window.location.href =  updateQueryStringParameter(document.URL, 'itemType' , 'auction');
	}

	function onBuyNowTypeClick(){
		window.location.href =  updateQueryStringParameter(document.URL, 'itemType' , 'buynow');
	}

	function onRemoveSellerFilterClick(){
		window.location.href =  updateQueryStringParameter(document.URL, 'seller' , '');
	}

	function gotoPage(page){
		window.location.href =  updateQueryStringParameter(document.URL, 'page' , page);	
	}

	function onFollowSearch(){
		window.location.href =  document.URL.replace("/query/", "/follow/");
	}

	function on_unfollow_search(followed_search_id){
		window.location.href =  updateQueryStringParameter(document.URL, 
														'followed_search', 
														followed_search_id).replace("/query/", 
																					"/unfollow/");
	}

	//This function insert or update the parameters in a URL 
	function updateQueryStringParameter(uri, key, value) {
		  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
		  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
		  if (uri.match(re)) {
		    return uri.replace(re, '$1' + key + "=" + value + '$2');
		  }
		  else {
		    return uri + separator + key + "=" + value;
		  }
	}

</script>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/search_styles.css">

<div id="search_top_options_bar">
	Order by:
	<select id="sort_option_combobox" onchange="onSortComboBoxChange()" >
		<option value="BM" <?php echo checkSelectedSorting('BM', $currentSorting); ?> >Best Match</option>
		<option value="TNLF" <?php echo checkSelectedSorting('TNLF', $currentSorting); ?> >Time: Newly listed first</option>
		<option value="PSLF" <?php echo checkSelectedSorting('PSLF', $currentSorting); ?> >Price + Shipping: Lowest first</option>
		<option value="PSHF" <?php echo checkSelectedSorting('PSHF', $currentSorting); ?> >Price + Shipping: Highest first</option>
		<option value="PLF" <?php echo checkSelectedSorting('PLF', $currentSorting); ?> >Price : Lowest first</option>
		<option value="PHF" <?php echo checkSelectedSorting('PHF', $currentSorting); ?> >Price : Highest first</option>
	</select>
	<?php

	$itemType = "";
	if($this->input->get('itemType') != NULL){
		$itemType = $this->input->get('itemType');
	}else{
		$itemType = 'all';
	}

	if ($itemType == 'all') {
	 	echo '<input class="item_type_button selected" type="button" onclick="onAllListingTypeClick()" value="All Listings"/>';
	}else{
		echo '<input class="item_type_button" type="button" onclick="onAllListingTypeClick()" value="All Listings"/>';
	}

	if ($itemType == 'auction') {
		echo '<input class="item_type_button selected" type="button" onclick="onAuctionTypeClick()" value="Auction"/>';
	}else{
		echo '<input class="item_type_button" type="button" onclick="onAuctionTypeClick()" value="Auction"/>';
	}

	if ($itemType == 'buynow') {
		echo '<input class="item_type_button selected" type="button" onclick="onBuyNowTypeClick()" value="Buy It Now"/>';
	}else{
		echo '<input class="item_type_button" type="button" onclick="onBuyNowTypeClick()" value="Buy It Now"/>';
	}

	if ($this->input->get('seller') != NULL) {
		echo '<span id="seller_filter_span" ><a href="#" onclick="onRemoveSellerFilterClick()" id="remove_seller"> </a>
				Items for sale from <strong><a href="'. base_url() .'Profile/seller/?seller='. $sellerId  .'">' . $sellerUsername[0]->username . '</a></strong></span>';
	}

	//Follow search section
	if (isset($_SESSION['user_id'])) {
		echo '<div id="follow_search_container" >';
		//checking if current search is followed
		if ($this->input->get('followed') != NULL) {
			$followed_search_id = $this->input->get('followed');
			
			echo '<a class="extraButton" onclick="on_unfollow_search('. $followed_search_id .')" >Unfollow this search</a>';
		}else{
			echo '<a class="extraButton" onclick="onFollowSearch()" title="Get email notifications when new item added matching this search criteria">Follow this search</a>';
		}

		echo '<a href="'. base_url() .'search/all_followed_searches/" >View all followed searches</a>
			</div>';
	}
	?>
	
	
	
</div>
<div id="left_side_bar">
<div id="search_filter_side_bar">
	<h3>Price Range</h3>
	<div id="price_range_validation_error">
		<img src="<?php echo asset_url(); ?>img/info_red.png" />
		Please enter min and max prices correctly before continuing.
	</div>
	Rs <input type="text" id="price_filter_min_textbox" class="price_filter_textbox" width="20"
		<?php
			//Setting the value if set by user
			$minPrice = $this->input->get('minPrice');
			if($minPrice >0){
				echo ' value="'. $minPrice .'" ';
			}
		?>
	 />
	 <br>to <br>
	 Rs <input type="text" id="price_filter_max_textbox" class="price_filter_textbox" width="2"
	 	<?php
			//Setting the value if set by user
			$maxPrice = $this->input->get('maxPrice');
			if($maxPrice >0){
				echo ' value="'. $maxPrice .'" ';
			}
		?>
	 />
	 <a href="#" id="price_range_filter_ok_button" onClick="onClickPriceRangeFilterOk()" class="light_gray_button" >OK</a>

	<h3>Delivery Options</h3>
	<input type="checkbox" name="free_shipping" id="free_shipping_checkbox" value="free_shipping" onClick="onFreeShippingCheck();" 
	<?php 
		//Checking if freeshipping was checked by the user
		$freeShip = $this->input->get('freeShip');
		if($this->input->get('freeShip')=='true'){
			echo 'checked';
		}
	 ?>
	>Free Shipping<br>

	<h3>Condition</h3>
	<?php

		foreach ($conditionTypes as $object) {
			$conditionTypeChecked = '';
			foreach ($checkedConditionTypes as $objectCheckedConditionType ) {
				if(strcmp($object->condition_id, $objectCheckedConditionType) == 0 )
					$conditionTypeChecked = "checked";
			}

			echo('<input type="checkbox"  onClick="onConditionTypeChange(' 
				. $object->condition_id . ');" title="'.  $object->condition_description .'" id="checkbox_cond_' 
				. $object->condition_id .'" value="' . $object->condition_id . '" ' . $conditionTypeChecked . ' />' 
				. $object->condition_title . '</br>');
		}
		echo ('<input type="hidden" id="condition_types_count" value="' . count($conditionTypes) . '"/>');

	?>

</div>

<div id="recently_viewed_items_container">
	
<?php 
	
	if (isset($recentlyViewdItems)) {
		echo '<h3>Recently viewed items</h3>
			<table>';
		foreach ($recentlyViewdItems as $object) {

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

			echo '<tr><td>
					<div class="recenly_viewed_item">
					<table>
					<tr><td>
						<img width="100" height="100" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
					</td></tr>
					<tr><td>
						<a href="'. $itemLinkSlot .'">'. $object->title .'</a>
					</td></tr>
					<tr><td> 
					' . $itemPriceSlot . '
					</td></tr>

					</table>
					</div>
				</td></tr>';
		}

		echo '</table>
			<a href="'. base_url() . 'search/clearHistory/">Clear History</a>';
	}

?>
	
</div>
</div> 

<div id="search_result_container">
<table>

<?php

	$keywords = $this->input->get('keywords');
	if($items == NULL){
		$keywordString = "";
		if (isset($keywords) && strlen($keywords)>0)
			$keywordString = " for <strong>$keywords</strong>";
		echo '<div id="result_count_text">No matching results found' . $keywordString . '</div>';
	}else{
		$keywordString = "";
		if (isset($keywords) && strlen($keywords)>0)
			$keywordString = " for <strong>$keywords</strong>";
		echo '<div id="result_count_text">'. $resultRowCount .' Results found' . $keywordString . '</div>';
		//Showing Items
		

		foreach ($items as $object) {

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

			// getShippingTitle and printCurrencyInRs are from utility_helper.php (autoload)
			echo  '<tr><td class="search_result_item">
					<table><tr>
						<td>
							<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
						</td>
						<td>
							
							<a href="'. $itemLinkSlot .'"><h4>'. $object->title . '</h4></a>
							<br>
							'. $itemPriceSlot .'
							<br>
							<span>'. getShippingTitle($object->shipping_cost) . '</span>
							<br>
							<span>Seller: <a href="'. base_url() .'Profile/seller/?seller='. $object->seller  .'">'. $object->username .'</a>

							</span>
							
						</td>
					</tr></table>
					<td></tr>';
		}
	}
	
?>
<table>
	<div id="page_navigator">
		<?php

		$countPerPage = getResultsPerPageCount();
		$pagesCount = ceil($resultRowCount/ $countPerPage);
		if($pagesCount == 0)
			$pagesCount = 1;
		if($page == NULL)
			$page = 1;



		for ($i=1; $i <= $pagesCount ; $i++) { 
			if ($page == $i) {
				echo '<a  class="light_gray_button_disabled"  >' . $i . '</a>';
			}else
				echo '<a href="#" class="light_gray_button" onClick="gotoPage('. $i .')" >' . $i . '</a>';
		}

		?>
	</div>
</table>
</div>