<?php


?>



<html>

<head>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/cart_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/deal_styles.css">



<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
 <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script src="<?php echo asset_url() ?>js/shippingAddress.js"></script>

<script type="text/javascript">
	function btn_onclick(){
		
		if($('#change_address').is(':checked')){
			
			return false;
		}
		
	}
</script>


</script>
 

</head>

<body>

<h1>Check out:Review Order</h1>

<div>

<h3>Ship To :</h3>

 <?php if(isset($_SESSION['shipping_address'])) { 
$shipping_address = $_SESSION['shipping_address'];
	
	?>

    <span style="font-weight:bold;"><?php echo $shipping_address['f_name']; ?></span>
    
    <label style="margin-left:100px;"><input type="checkbox" id="change_address" class="change_address"/>Change Shipping Address</label>
    <br />
    <span><?php echo $shipping_address['address1']; ?></span><br />
    <span><?php echo $shipping_address['address2']; ?></span><br/>
    <span><?php echo $shipping_address['city']; ?></span><br/>

<?php }else{ ?>
 <span style="font-weight:bold;"><?php echo $f_name.' '.$l_name ?></span>

 <label style="margin-left:100px;"><input type="checkbox" id="change_address" class="change_address"/>Change Shipping Address</label>
 <br />
    <span><?php echo $address?></span><br />
    <span><?php echo $street ?></span><br/>
    <span><?php echo $city ?></span><br/>
 <?php } ?>   
    

 <div style="margin-left: 443px; margin-top: -80px; margin-bottom:30px; display::none;" id="new_add">
 <form method="post" action="<?php echo base_url().'cart/buy/'. $items[0]->item_id.'/'.$qty ;?>" >
 	<span>Name *</span><input style="margin-left: 70px;" type="text" name='name' id="name"/><span style="color:red; margin-left:10px;"></span><br/>
    <span style="margin-top:20px;">Address Line1 *</span><input style="margin-top:20px; margin-left: 15px;" type="text" name="address1" id="aline1"/><span style="color:red; margin-left:10px;"></span><br/>
    <span style="margin-top:20px;">Address Line2  </span><input style="margin-top:20px; margin-left: 15px;" type="text"name="address2" id="aline2"/><br/>
    <span style="margin-top:20px;">City *  </span><input style="margin-top:20px; margin-left: 78px;" type="text" name="city" id="city"/><span style="color:red; margin-left:10px;"></span><br />
    <input type="submit" id="btn_change_add" name="changeadd" value="Change" onClick="return btn_change_add_click();"style="width:60px;"/>
     </form></div>

 

 

</div>

<hr />



<table id="buy_now_view_table">

	<?php

	//$subTotal = 0;

	//$shippingTotal = 0;

	//foreach ($cart_items as $object) {

		//$subTotal += $object->price * $object->qty;

		//$shippingTotal += $object->shipping_cost * $object->qty;



		//$colorString = '';

		//if (strlen($object->color)>0) {

			//$colorString = "Color: " . $object->color;

		//}


		$item_title=$items[0]->title ;
		echo '<tr>

			<td>

				<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $image[0]->file_name. '.jpg"/>

			</td>

			<td>

				<a href="'. base_url() .'item/item/?item='. $items[0]->item_id .'"><h3>'. $item_title . '</h3></a>

				<span>Condition: ' .$items[0]->condition_title . '</span>

				<br>

				

				<span>Seller: <a href="">'.$items[0]->first_name.' '.$items[0]->last_name .'</a></span>

			</td>

			<td>

				Quantity: '. $qty .'

				<br>

				

			</td>

			<td>';
			$discount = 0;
			$subtotal = 0;
			//Checks if any discounts available and reduces the prices
			if ($items[0]->off_percentage != null) {

			$subtotal += $items[0]->price * $qty;
			$newPrice = $items[0]->price - $items[0]->price * $items[0]->off_percentage / 100;
			$discount += ($items[0]->price - $newPrice) * $qty;
			echo '<span class="item_price_span">Price: ' 
					. printCurrencyInRs($newPrice) 
					. '</span><br>
					<span class="item_prev_price_span">' . printCurrencyInRs($items[0]->price). '</span> | ' 
					. $items[0]->off_percentage . '% OFF';
			}else{
				
				echo '<span class="item_price_span" >'. printCurrencyInRs($items[0]->price) .'</span>';
			}

			echo	'<br>

				<span>'. getShippingTitle($price['shipping']) . '</span>

				<br>

			</td>	

		</tr>';	

	//}

	?>

</table>

<table id="buy_now_total_table">

	<tr>

		<td>Subtotal: </td>

		<td><?php

        
	   echo  printCurrencyInRs($subtotal);

		// echo printCurrencyInRs($subTotal); ?></td> 

	</tr>
	<?php
		if ($discount > 0) {
			echo '<tr>
					<td>Discount: </td>
					<td>' . printCurrencyInRs($discount) . '</td> 
					</tr>';
		}
	?>
	<tr>

		<td>Shipping cost: </td>

		<td><?php

		 echo printCurrencyInRs($price['shipping']);

		 //echo printCurrencyInRs($shippingTotal); ?></td>

	</tr>

	<tr>

		<td>Total: </td>

		<td><span class="item_price_span" ><?php
		 
         echo printCurrencyInRs($subtotal - $discount);

		// echo printCurrencyInRs($subTotal + $shippingTotal); ?></span></td>

	</tr>



</table>
<?php
$item_id_check=$items[0]->item_id; ?>

<!-- Paypal Test button-------------------------------------------------------->

<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="suneth.premarathne@gmail.com">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="<?php echo $item_title; ?>">
<input type="hidden" name="amount" value="<?php echo $subtotal - $discount; ?>">
<input type="hidden" name="return" value="<?php echo base_url().'cart/buy/'. $item_id_check.'/'.$qty ;?>/1?save=1"/>
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>



<a class="colored_button"  href="<?php echo base_url().'cart/buy/'. $item_id_check.'/'.$qty ;?>/1?save=1">checkout</a>

</body>

</html>

