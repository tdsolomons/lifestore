<?php

?>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/cart_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/deal_styles.css">
<h1>Your Shopping Cart</h1>
<strong><?php echo count($cart_items) . ' Item(s) in your cart'; ?></strong>
<table id="shopping_cart_view_table">
	<?php
	$subTotal = 0;
	$shippingTotal = 0;
	$discount = 0;
	foreach ($cart_items as $object) {
		
		$subTotal += $object->price * $object->qty;
		$shippingTotal += $object->shipping_cost * $object->qty;
		
		$colorString = '';
		if (strlen($object->color)>0) {
			$colorString = "Color: " . $object->color;
		}

		echo '<tr>
			<td>
				<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $object->file_name . '.jpg"/>
			</td>
			<td>
				<a href="'. base_url() .'item/item/?item='. $object->item_id .'"><h3>'. $object->title . '</h3></a>
				<span>Condition: ' . $object->condition_title . '</span>
				<br>
				
				<span>Seller: <a href="">'. $object->username .'</a></span>
			</td>
			<td>
				Quantity: '. $object->qty .'
				<br>
				' . $colorString . '
			</td>
			<td>';
				
		//Checking if there's a deal and reducing the price
		if ($object->off_percentage != null) {
			$newPrice = $object->price - $object->price * $object->off_percentage / 100;
			$discount += ($object->price - $newPrice) * $object->qty;
			echo '<span class="item_price_span">Price: ' 
					. printCurrencyInRs($newPrice) 
					. '</span><br>
					<span class="item_prev_price_span">' . printCurrencyInRs($object->price). '</span> | ' 
					. $object->off_percentage . '% OFF';
		}else{
			
			echo '<span class="item_price_span" >'. printCurrencyInRs($object->price) .'</span>';
		}
				

		echo	'<br>
				<span>'. getShippingTitle($object->shipping_cost) . '</span>
				<br>
			</td>	
		</tr>';	
	}
	?>
</table>
<table id="cart_total_table">
	<tr>
    	<td width="500"></td>
		<td>Subtotal: </td>
		<td><?php echo printCurrencyInRs($subTotal); ?></td> 
	</tr>
	<?php
		if ($discount > 0) {
			echo '<tr>
					<td></td>
					<td>Discount: </td>
					<td>' . printCurrencyInRs($discount) . '</td> 
					</tr>';
		}
	?>
	<tr>
    	<td></td>
		<td>Shipping cost:</td>
		<td><?php echo printCurrencyInRs($shippingTotal); ?></td>
	</tr>
	<tr>
    	<td></td>
		<td>Total: </td>
		<td><span class="item_price_span total_price" ><?php echo printCurrencyInRs($subTotal + $shippingTotal); ?></span></td>
	</tr>
    
    <tr>
    	<td></td>
		<td>Gift card value: </td>
		<td width="250"><div id="floatdiv">
        <span class="item_price_span gift_code"></span>

<form method="post" id="generate_code" name="generate_code" action="<?php echo base_url(); ?>cart/add_code" >
	<input type='text' name='gift_code' id='gift_code' value='' class="form-control input-sm" >

	<button type="submit" class="btn btn-md btn-primary btn-sm" id="add_menu_submit" action="save" title="Save Menu">Apply</button>
    </form>
    </div></td>
	</tr>
    <tr >
    	<td></td>
		<td><span class="discount_value_label"></span></td>
		<td><span class="item_price_span  discount_value"></span></td>
	</tr>
    

</table>

<!-- enter generated gift code-->

<script>
$(document).ready(function() {
	$('#generate_code').submit(function(event) {
		var form_data = $(this).serializeArray();
			form_data.push({ 'name': 'ajax', 'value': '1' });
			$.ajax({
				url: "<?php echo site_url('cart/add_code'); ?>",
				type: 'POST',
				data: form_data,
				dataType : 'json',
				success: function(msg) {
					//console.log(msg.price);
					$('.gift_code').html('-'+msg.price);
					$('#generate_code').hide();
					var total_price = $('.total_price').html();
					total_price = total_price.replace("Rs ", "");
					total_price = total_price.replace(",", "");
					total_price = parseFloat(total_price);
					$('.discount_value_label').html('Discounted price');
					$('.discount_value').html('Rs '+parseFloat(total_price-msg.price).toFixed(2));					
					return false;
				},
				error:function (xhr, ajaxOptions, thrownError){
                    console.log(xhr.status);
                }  
			});
			return false;		
	});
});
</script>


<a class="light_gray_button" href="<?php echo base_url();?>">Continue shopping</a>
<a class="colored_button"  href="<?php echo base_url();?>/cart/shipping_address">Proceed to checkout</a>