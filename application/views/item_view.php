<?php



	$title = '';

	$description = '';

	$posted_date;

	$itemObject;

	foreach ($items as $object) {

		$title = $object->title ;

		$description = $object->description;

		$posted_date=$object->posted_date;

		$itemObject = $object;

	}

	

	$avail_qty;

	

	foreach($quantity as $row)

    { 

    	$avail_qty = $row->available_quantity;

    }

	

	if(isset($_GET['tempQty'])){

		

		$_SESSION['tempQty'] = $_GET['tempQty'];

		//$x = $_SESSION['tempQty'];

		

		//$y = "i001";

		//$_S[vg]=$_S[vg].","."i002";

		//i001, i002, i003

		echo $_SESSION['tempQty']."<br/>";

	}

	

	

	if(isset($_GET['tempColor'])){

		

		$_SESSION['tempColor'] = $_GET['tempColor'];

		echo $_SESSION['tempColor']."<br/>";

	}

	

	//itemName

	if(isset($_GET['itemName'])){

		

		$_SESSION['itemName'] = $_GET['itemName'];

		echo $_SESSION['itemName']."<br/>";

	}

?>

<html>

<head>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/deal_styles.css">


<script type="text/javascript">



	$(document).ready(function(){

		hideQtyValidationError();

		hideColorValidationError();

	});	



	function clickImg(s)

	{

		//var imge=document.getElementById("product");

		//imge.innerHTML="<img src=\"img/item_images/"+s +"\" />";

		var xmlhttp;

		if (window.XMLHttpRequest)

  			{// code for IE7+, Firefox, Chrome, Opera, Safari

 				 xmlhttp=new XMLHttpRequest();

 			 }

			else

 			 {// code for IE6, IE5

 				 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

				}

			xmlhttp.onreadystatechange=function()

 			 {

  			if (xmlhttp.readyState==4 && xmlhttp.status==200)

			{

				alert("dasdadad");

    //document.getElementById("product").innerHTML="<img src=\"img/item_images/"+s +"\" />";

   			 }

  		}

		xmlhttp.send();

	}	



	function validateForm(){



		//Quantity validation

		var x = document.forms["buyForm"]["qty"].value;

		if (x == null || x == "") {

		    showQtyValidationError();

		    return false;

		}else{

			hideQtyValidationError();

		}



		//Color field validation
		if (document.getElementById("color")){

			var x = document.forms["buyForm"]["color"].value;

			if (x == null || x == "") {

			    showColorValidationError();

			    return false;

			}else{

				hideColorValidationError();

			}
		}

	}



	function hideQtyValidationError(){

		document.getElementById("qty_validation_error").style.display = 'none';

		document.getElementById("qty_validation_error").style.visibility = "hidden";

	}



	function showQtyValidationError(){

		document.getElementById("qty_validation_error").style.display = 'block';

		document.getElementById("qty_validation_error").style.visibility = "visible";

	}



	function hideColorValidationError(){

		if(document.getElementById("color_validation_error") != null){

			document.getElementById("color_validation_error").style.display = 'none';

			document.getElementById("color_validation_error").style.visibility = "hidden";

		}

	}



	function showColorValidationError(){

		if(document.getElementById("color_validation_error") != null){

			document.getElementById("color_validation_error").style.display = 'block';

			document.getElementById("color_validation_error").style.visibility = "visible";

		}

	}

	

	$(function(){

		$('.thumb-images').css('margin-top','20px');

		$('.thumb-images').css('border','1px solid #666');

		$('.thumb-images').mouseenter(function(){			

			

			var src = $(this).attr('src');

			$('#main-image').attr('src',src);

			

			

		});

	});

	

		function addCart(){

			//alert('asa');

			window.location.assign("http://sep.tagfie.com/welcome/item/?item=1&tempQty="+$('#qty option:selected').val()+"&tempColor="+$('#color option:selected').val()+"&itemName="+$('#details>h2').html());

			

			

		}

	

</script>

</head>

<body>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/item_style.css">


<div id="conatiner">



<div id="right_side">



<div id="product_and_details">

<div id="product">

	<?php

		foreach ($image as $object) {

			echo '<img  class="main-image" id="main-image" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg" onclick="clickImg(\''. $object->file_name .'.jpg\')"/>';

		}



	?>

	

</div>



<div id="details">

<h2><?php echo $title; ?></h2>

<ul style="margin-left:20px;">

<li></li>

<li>

	<span>Item condition: <strong><?php echo $itemObject->condition_title; ?></strong></span>

</li>

<form method="post" name="buyForm" action="<?php echo base_url(); ?>cart/add" onSubmit="return validateForm()">

<li>



	<?php 

		//Shows the color option only if colors options are available

		if ($color != NULL){ 

			echo '<div style="">Color

				<select name="color" id="color" class="dropdown" style="margin-left:110px;">

				<option value="">--Select--</option>';

				    

			            foreach($color as $row)

			            { 

			              echo '<option value="'.$row->color_name.'">'.$row->color_name.'</option>';

			            }

				            

			echo '</select><span id="color_validation_error" class = "validation_error">Please select a color</span>

			</div>';

		}

	?>

</li>

<li><div style="">Quantity

<select id="qty" name="qty" id='qty' class="dropdown" style="margin-left:90px;">

   <option value="">--Select--</option>

    <?php 

            for($i=1;$i<=$avail_qty;$i++)

            { 

              echo '<option value="'.$i.'">'.$i.'</option>';

            }

            ?>

</select><span id="qty_validation_error" class = "validation_error">Please enter quantity</span>



</div>

</li>

<li><div>Available Quantity<span style="margin-left:28px;"><?php echo $avail_qty;?></span></div></li>

</ul>

 
    



<div id='priceDiv' style="border-radius:5px;">

			<!--// getShippingTitle and printCurrencyInRs functions are from application/helpers/utility_helper.php (autoload) -->
		<?php
			//Checking if there's a deal and reducing the price
			if ($itemObject->off_percentage != null) {
				echo '<span class="item_price_span">Price: ' 
					. printCurrencyInRs($itemObject->price - $itemObject->price * $itemObject->off_percentage / 100) 
					. '</span><br>
					<span class="item_prev_price_span">' . printCurrencyInRs($itemObject->price). '</span> | ' 
					. $itemObject->off_percentage . '% OFF';
			}else{
				echo '<span class="item_price_span">Price: '. printCurrencyInRs($itemObject->price) . '</span>';
			}
		?>	
        	

        	<br/>

        	<span><?php echo getShippingTitle($itemObject->shipping_cost) ?></span>

        	<br/>
          
					
		
            



<label style="background:#CCC;"></label><br>

<?php 

	if(isset($_SESSION['username'])){

		if (strcmp($_SESSION['username'], $itemObject->username) == 0 ) {

			echo "<span>You are the seller of this Item, You cannot purchase</span>";

		}else{

			echo'

				<input type="hidden" id="item_id" name="item_id" value="'. $itemObject->item_id . '" >

				<input id="addToCart1" class="btn btn-primary btn-sm" value="Buy it now"  type="button" onClick="buy_it_now();" style="margin:0;float:none;margin-top:5px;"><br/>

				<input type="submit" id="AddToCart" class="btn btn-primary btn-sm" value="Add To Cart" style="margin:0;float:none;margin-top:10px;">
				
				<br><span>
						<a href="'.base_url().'wishlist/add/'. $itemObject->item_id . '">
								Add to wishlist       
						</a>
				  </span>
				
				';
				

		}

	}else{

		echo 'Please login, to purchase';

	}

?>	

</form>
<?php if(isset($offermsg)&& $offermsg=='success' ){ ?> <div style="background-color:#80FF80; padding:5px;"><p>Offer Success !</p></div> <?php } ?>
  <?php if($itemObject->allow_offers == 1){ ?>
					<form method="post" name="offer" action="<?php echo base_url(); ?>item/offer">
                    	<label>Offer</label>
                        <input type="hidden" name="item_id" value="<?php echo $itemObject->item_id;?>">
                        <input type="text" name="amount">
                        <input type="hidden" name="offerQty" id="offerQty">
                        <input type="submit" name="submit" value="Submit offer"> 
                    </form>
			<?php } ?>






<script>
$('#qty').on('change', function() {
  $('#offerQty').val($(this).val());
});


function buy_it_now()

{

	var item = document.getElementById('item_id').value;

	var quntity = document.getElementById('qty').value;

	var color = $('#color').val();

	var isOk = true;

	

	if(quntity.length == 0){		

		

		isOk = false;

		$('#qty_validation_error').html('Select Quantity');

		$('#qty_validation_error').show();

		$('#qty_validation_error').css('visibility','visible');

		

	

	}else{

		

		$('#qty_validation_error').html('');

		$('#qty_validation_error').hide();

		$('#qty_validation_error').css('visibility','hidden');

		

		

	}

	
if (document.getElementById("color")){
	if(color.length == 0){		

		

		isOk = false;

		$('#color_validation_error').html('Select Color');

		$('#color_validation_error').show();

		$('#color_validation_error').css('visibility','visible');

		

	

	}else{

		

		$('#color_validation_error').html('');

		$('#color_validation_error').hide();

		$('#color_validation_error').css('visibility','hidden');

		

	}

}	

	if(isOk){

		

		var v = "<?php echo base_url()?>/cart/buy/" + item + "/" + quntity + "/" + color ;

		window.location.href = v;

		

	}

}

</script>





<div id="seller_details">

	<h3>Seller Details</h3>



	<?php

	echo '<span style="top:3px;">'. $itemObject->first_name . ' ' . $itemObject->last_name.'</span></br></br>';

			  //echo '<span style="float:left; top:3px;">'.$lastName.'</span></br>';

	echo '<a = href="'. base_url() .'Profile/Seller/?seller='. $itemObject->user_id .'" >'. $itemObject->username.'</a></br></br>';

	if(isset($_SESSION['username'])){



		if (strcmp($_SESSION['username'], $itemObject->username) == 0 ) {

			echo "<span>You are the seller of this Item</span>";

		}else{

			echo '<a = href="'. base_url() .'Messages/sendForm/?to='. $itemObject->user_id .'&item='. $itemObject->item_id .'&to_user='. $itemObject->username .'" >Contact Seller</a></br></br>';

		}

	}

	?>

</div>











</div>

</div>

<div id='imageList' style="width:370px; border-radius: 7px;">

		

		<?php

			foreach ($images as $object) {

				echo '<img width="50" class="thumb-images" height="50" style="border-radius:3px;" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>';

				echo '&nbsp;';

			}



		?>

	</div>

</div>

<br></br>



<br></br>

</div>





<div id="our_product">

<div id="item_specs_container">

	<table id="item_specs_table">

		<tr>

			<td width="200">Posted Date:</td><td><?php echo date ("M d, Y ",strtotime($itemObject->posted_date));?></td>

		</tr>

		<tr>

			<td>Condition details: </td>

			<td><strong><?php echo $itemObject->condition_title; ?></strong>: <?php echo $itemObject->condition_description; ?></td>

		</tr>

	</table>

	 

</div>

<h2>Description</h2>

<div id='description' >



<?php echo $description; ?>





</div>



</div>

<div id="sellerDetails" style="height=200px; width=300px; background:#FFF;>jjjjjjj

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
						<img width="100" height="100" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
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


<div id="additional_area"> </div>



</div>

</div>



</body>

</html>



