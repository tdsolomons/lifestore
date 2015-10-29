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
	
	if(isset($_GET['itemName'])){
		
		$_SESSION['itemName'] = $_GET['itemName'];
		echo $_SESSION['itemName']."<br/>";
	}
?>
<html>
<head>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo asset_url() ?>js/timer.js"></script>

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
		var x = document.forms["buyForm"]["color"].value;
		if (x == null || x == "") {
		    showColorValidationError();
		    return false;
		}else{
			hideColorValidationError();
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
<div style="background-color:#8FCD7A; color:#060" ><?php
if(isset($_SESSION["message"]) && $_SESSION['message'] != ''){ 
	echo  $_SESSION["message"];
	$_SESSION["message"]='';
}
?></div>

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
<form method="post" name="placebid" action="<?php echo base_url(); ?>place_bid/add/<?php echo $itemObject->item_id; ?>" onSubmit="return validateForm()">

<li><div style="">Time left: <span id="timeleft"> </span>

</div>
</li>
<div id='priceDiv' style="border-radius:5px;">
			<!--// getShippingTitle and printCurrencyInRs functions are from application/helpers/utility_helper.php (autoload) -->
        	<span class="item_price_span">Current bid:</span>
        	<br/>
        	<span><?php echo getShippingTitle($itemObject->shipping_cost) ?></span>
        	<br/>

<label style="background:#CCC;"></label><br>
<input name="bidvalue" type="text">
<input id="Placebid" class="button" value="Placebid"  type="submit" style="margin:0;float:none;margin-top:45px;"><br/>

</form>


<div id="seller_details">
	<h3>Seller Details</h3>

	<?php
	echo '<span style="float:left; top:3px;">'. $itemObject->first_name . ' ' . $itemObject->last_name.'</span></br></br>';
			  //echo '<span style="float:left; top:3px;">'.$lastName.'</span></br>';
	echo '<a = href="" >'. $itemObject->username.'</a></br></br>';
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

