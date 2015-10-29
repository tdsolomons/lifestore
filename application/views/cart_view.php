<?php

?>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/cart_styles.css">
<h1>Your Shopping Cart</h1>
<strong><?php echo count($cart_items) . ' Item(s) in your cart'; ?></strong>
<table id="shopping_cart_view_table">
	<?php
	$subTotal = 0;
	$shippingTotal = 0;
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
			<td>
				<span class="item_price_span" >'. printCurrencyInRs($object->price) .'</span>
				<br>
				<span>'. getShippingTitle($object->shipping_cost) . '</span>
				<br>
			</td>	
		</tr>';	
	}
	?>
</table>
<table id="cart_total_table">
	<tr>
		<td>Subtotal: </td>
		<td><?php echo printCurrencyInRs($subTotal); ?></td> 
	</tr>
	<tr>
		<td>Shipping cost:</td>
		<td><?php echo printCurrencyInRs($shippingTotal); ?></td>
	</tr>
	<tr>
		<td>Total: </td>
		<td><span class="item_price_span" ><?php echo printCurrencyInRs($subTotal + $shippingTotal); ?></span></td>
	</tr>

</table>

<a class="light_gray_button" href="<?php echo base_url() ;?>">Continue shopping</a>
<a class="colored_button"  href="">Proceed to checkout</a>