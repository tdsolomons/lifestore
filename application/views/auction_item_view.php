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

<script type="text/javascript">


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


	
	$(function(){
		$('.thumb-images').css('margin-top','20px');
		$('.thumb-images').css('border','1px solid #666');
		$('.thumb-images').mouseenter(function(){			
			
			var src = $(this).attr('src');
			$('#main-image').attr('src',src);
			
			
		});
	});
	
	
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
	<br>
	<span>Bidding ends on: <?php echo $itemObject->end_datetime; ?></span>
</li>

<li>
</li>
<li>
</li>
<li></li>
</ul>
<div id='priceDiv' style="border-radius:5px;">
			<!--// getShippingTitle and printCurrencyInRs functions are from application/helpers/utility_helper.php (autoload) -->
        	<span class="item_price_span">Current bid: <?php echo printCurrencyInRs($itemObject->amount); ?></span>
        	<?php 
        		if (isset($_SESSION['user_id'])) {
        			if (strcmp($_SESSION['user_id'], $itemObject->bidder)== 0) {
        				echo '<br><span>You hold the current bid.</span>';
        			}
        		}
        	?>
        	<br/>
        	<span>Started from <?php echo printCurrencyInRs($itemObject->starting_bid) ?></span>
        	<br/>
        	<span><?php echo getShippingTitle($itemObject->shipping_cost) ?></span>
        	<br/>

<label style="background:#CCC;"></label><br>

<form method="post" name="buyForm" action="<?php echo base_url(); ?>item/bid" onSubmit="return validateForm()">
<?php 
	if(isset($_SESSION['username'])){
		if (strcmp($_SESSION['username'], $itemObject->username) == 0 ) {
			echo "<span>You are the seller of this Item, You cannot Bid</span>";
		}else{
			echo'
				<input type="hidden" id="item_id" name="item_id" value="'. $itemObject->item_id . '" >
				<input type="text" name="amount" />
				<br>
				<span>Enter '. printCurrencyInRs($itemObject->amount + $itemObject->minimum_increment) .' or more
				<br>
				<input type="submit" id="AddToCart" class=" button" value="Place Bid" style="margin:0;float:none;margin-top:10px;">';
		}
	}else{
		echo 'Please login, to Bid';
	}
?>	
</form>


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
<div id='description'>

<?php echo $description; ?>


</div>

</div>
<div id="sellerDetails" style="height=200px; width=300px; background:#FFF;>jjjjjjj
</div>
<div id="additional_area"> </div>

</div>
</div>

</body>
</html>

