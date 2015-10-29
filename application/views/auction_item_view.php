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



<script>          

            var year = <?php echo $timeLeft['year'] ?>;
            var month = <?php echo $timeLeft['month'] ?>-1;
            var day = <?php echo $timeLeft['day'] ?>;
            var hour = <?php echo $timeLeft['hour'] ?>;
            var minute = <?php echo $timeLeft['minute'] ?>; 
            var second = <?php echo $timeLeft['second'] ?>;


            var eventtext = "until the next big thing"; // text that appears next to the time left
            var endtext = "We reached the next big thing!!"; // text that appears when the target has been reached
            var end = new Date(year,month,day,hour,minute,second);

            function timeleft(){
                var now = new Date();
                if(now.getYear() < 1900)
                  yr = now.getYear() + 1900;
                var sec = second - now.getSeconds();
                var min = minute - now.getMinutes();
                var hr = hour - now.getHours();
                var dy = day - now.getDate();
                var mnth = month - now.getMonth();
                var yr = year - yr;
                var daysinmnth = 32 - new Date(now.getYear(),now.getMonth(), 32).getDate();

                if(sec < 0){
                  sec = (sec+60)%60;
                  min--;
                }

                if(min < 0){
                  min = (min+60)%60;
                  hr--; 
                }

                if(hr < 0){
                  hr = (hr+24)%24;
                  dy--; 
                }

                if(dy < 0){
                  dy = (dy+daysinmnth)%daysinmnth;
                  mnth--;
                }

                if(mnth < 0){
                  mnth = (mnth+12)%12;
                  yr--;
                } 

                var sectext = " s ";
                var mintext = " m, and ";
                var hrtext = " h, ";
                var dytext = " days, ";
                var mnthtext = " months, ";
                var yrtext = " years, ";

                if (yr == 1)
                  yrtext = " year, ";

                if (mnth == 1)
                  mnthtext = " month, ";

                if (dy == 1)
                  dytext = " day, ";

                if (hr == 1)
                  hrtext = " h, ";

                if (min == 1)
                  mintext = " m, and ";

                if (sec == 1)
                  sectext = " s ";

                if(now >= end){
                  document.getElementById("timeleft").innerHTML = endtext;
                  clearTimeout(timerID);
                }else{
                	document.getElementById("timeleft").innerHTML =  mnth + mnthtext + dy + dytext + hr + hrtext + min + mintext + sec + sectext ;
                }
                timerID = setTimeout("timeleft()", 1000); 
            }
</script>

<script>
function validateForm() {
	var error = false;
	var errorMsg = '';
	var bidValue = $("#bidAmount").val();
	var bidMinValue = $("#bidMinValue").val();
	if(bidValue == null || bidValue == ''){
		error = true;
		errorMsg = 'Amount can not be empty'
	}else if(bidValue < bidMinValue){
		error = true;
		errorMsg = 'Enter Rs.'+ bidMinValue +' or more'
	}
    
    if (error) {
        $('#bidError').html(errorMsg);
        return false;
    }
    return true;
}
</script>        

</head>

<body onLoad="timeleft()">

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

	<span>Bidding ends on: <?php //echo $itemObject->end_datetime; ?>
		<?php if(strtotime($itemObject->end_datetime) >  time() ) { ?>
		<span id="timeleft" ></span>
		<?php }else{?>
		<span > Auction Expired</span>
		<?php } ?>
	</span>
    <br>
    <span>
    	<a href="<?php echo base_url()."item/Bidder/?item=".$itemObject->item_id?>">
				<?php echo $bid_count?> bids        
        </a>
    </span>
   

</ul>
<div id='priceDiv' style="border-radius:5px;">

			<!--// getShippingTitle and printCurrencyInRs functions are from application/helpers/utility_helper.php (autoload) -->

        	<span class="item_price_span">Current bid: <?php echo printCurrencyInRs($itemObject->amount); ?></span>

        	<?php 

        		if (isset($_SESSION['user_id'])) {

        			if (strcmp($_SESSION['user_id'], $itemObject->bidder)== 0) {

        				echo '<br><span style="color:green">You hold the current bid.</span>';
        			}
        		}
        	?>
        	<br/>

<?php 
// check bidding expire date
if(strtotime($itemObject->end_datetime) >  time() ) { ?>

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
			$a = $itemObject->amount + $itemObject->minimum_increment;
			echo '
				<span id="bidError" class="error" style="color:red"></span>
				<input type="hidden" id="item_id" name="item_id" value="'. $itemObject->item_id . '" >
				<input type="hidden" id="bidMinValue" name="bidMinValue" value="'. $a . '" >

				<input id="bidAmount" type="text" name="amount" />

				<br>

				<span>Enter '. printCurrencyInRs($itemObject->amount + $itemObject->minimum_increment) .' or more </span>

				<br>

				<input type="submit" id="AddToCart" class="btn btn-primary btn-sm" value="Place Bid" style="margin:0;float:none;margin-top:10px;">';

		}

	}else{

		echo 'Please login, to Bid';

	}

?>	

</form>
<?php }else{?>
	<span > Auction Expired</span>
<?php } ?>




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

<div id="sellerDetails" style="height=200px; width=300px; background:#FFF;">jjjjjjj

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



