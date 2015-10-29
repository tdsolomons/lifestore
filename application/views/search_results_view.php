<?php
$currentSorting = $this->input->get('sorting');
function checkSelectedSorting($sorting, $currentSorting){
	if (strcmp($sorting, $currentSorting)== 0)
		return 'selected';
	else
		return '';
}
?>

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

	function gotoPage(page){
		window.location.href =  updateQueryStringParameter(document.URL, 'page' , page);	
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
	Sort:
	<select id="sort_option_combobox" onchange="onSortComboBoxChange()" >
		<option value="BM" <?php echo checkSelectedSorting('BM', $currentSorting); ?> >Best Match</option>
		<option value="TNLF" <?php echo checkSelectedSorting('TNLF', $currentSorting); ?> >Time: Newly listed first</option>
		<option value="PSLF" <?php echo checkSelectedSorting('PSLF', $currentSorting); ?> >Price + Shipping: Lowest first</option>
		<option value="PSHF" <?php echo checkSelectedSorting('PSHF', $currentSorting); ?> >Price + Shipping: Highest first</option>
		<option value="PLF" <?php echo checkSelectedSorting('PLF', $currentSorting); ?> >Price : Lowest first</option>
		<option value="PHF" <?php echo checkSelectedSorting('PHF', $currentSorting); ?> >Price : Highest first</option>
	</select>
</div>

<div id="search_filter_side_bar">
	<h3>Price Range</h3>
	<div id="price_range_validation_error">
		<img src="<?php echo asset_url(); ?>img/info_red.png" />
		Please enter min and max prices correctly before continuing.
	</div>
	Rs <input type="text" id="price_filter_min_textbox" width="50"
		<?php
			//Setting the value if set by user
			$minPrice = $this->input->get('minPrice');
			if($minPrice >0){
				echo ' value="'. $minPrice .'" ';
			}
		?>
	 />
	 <br>to <br>
	 Rs <input type="text" id="price_filter_max_textbox" width="50"
	 	<?php
			//Setting the value if set by user
			$maxPrice = $this->input->get('maxPrice');
			if($maxPrice >0){
				echo ' value="'. $maxPrice .'" ';
			}
		?>
	 />
	</br>
	</br>
	 <a href="#" id="price_range_filter_ok_button" onClick="onClickPriceRangeFilterOk()" class="light_gray_button" >Filter</a>

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
			// getShippingTitle and printCurrencyInRs are from utility_helper.php (autoload)
			echo  '<tr><td class="search_result_item">
					<table><tr>
						<td>
							<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
						</td>
						<td>
							
							<a href="'. base_url() .'item/item/?item='. $object->item_id .'"><h3>'. $object->title . '</h3></a>
							<br>
							<span class="item_price_span" >'. printCurrencyInRs($object->price) .'</span>
							<br>
							<span>'. getShippingTitle($object->shipping_cost) . '</span>
							<br>
							<span>Seller: <a href="">'. $object->username .'</a></span>
							
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
</div>