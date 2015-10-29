<?php

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/cart_styles.css">

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
 <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

 <script type="text/javascript">
 	$(function(){
		
		$('#new_add').hide();
		
 		$('#change_address').on('change',function(){
				
			if($(this).is((':checked'))){
			
				$('#new_add').show();
		
			}else{
				
				$('#new_add').hide();
		
			}
		});
	});
	
	function btn_change_add_click(){
		
		var isOk = true;
		
		if($('#name').val().length == 0){
			
			isOk = false;
			$('#name').next('span').html('Please insert name');
			
		}else{
			
			$('#name').next('span').html('');
		}
		
		if($('#aline1').val().length == 0){
			
			isOk = false;
			$('#aline1').next('span').html('Please insert address line 1');
			
		}else{
			
			$('#aline1').next('span').html('');
		}
		
		if($('#city').val().length == 0){
			
			isOk = false;
			$('#city').next('span').html('Please insert city');
			
		}else{
			
			$('#city').next('span').html('');
		}
		
		if(isOk){
			
			alert('wede goda');
		}
	}
 </script>
</head>
<body>
<h1>Check out:Review Order</h1>
<div>
<h3>Ship To :</h3>
 <span style="font-weight:bold;"><?php echo $f_name.' '.$l_name ?></span>
 <label style="margin-left:100px;"><input type="checkbox" id="change_address" class="change_address"/>Change Shipping Address</label>
 <br />
    <span><?php echo $address?></span><br />
    <span><?php echo $street ?></span><br/>
    <span><?php echo $city ?></span><br/>
    
 <div style="margin-left: 443px; margin-top: -80px; margin-bottom:30px; display::none;" id="new_add">
 	<span>Name *</span><input style="margin-left: 70px;" type="text" id="name"/><span style="color:red; margin-left:10px;"></span><br/>
    <span style="margin-top:20px;">Address Line1 *</span><input style="margin-top:20px; margin-left: 15px;" type="text" id="aline1"/><span style="color:red; margin-left:10px;"></span><br/>
    <span style="margin-top:20px;">Address Line2  </span><input style="margin-top:20px; margin-left: 15px;" type="text" id="aline2"/><br/>
    <span style="margin-top:20px;">City *  </span><input style="margin-top:20px; margin-left: 78px;" type="text" id="city"/><span style="color:red; margin-left:10px;"></span><br />
    <input type="button" id="btn_change_add" value="Change" onclick="btn_change_add_click();"style="width:60px;"/></div>
 
 
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

		echo '<tr>
			<td>
				<img width="200" height="200" src="' . asset_url() . 'img/item_images/' . $image[0]->file_name. '.jpg"/>
			</td>
			<td>
				<a href="'. base_url() .'item/item/?item='. $items[0]->item_id .'"><h3>'. $items[0]->title . '</h3></a>
				<span>Condition: ' .$items[0]->condition_title . '</span>
				<br>
				
				<span>Seller: <a href="">'.$items[0]->first_name.' '.$items[0]->last_name .'</a></span>
			</td>
			<td>
				Quantity: '. $qty .'
				<br>
				
			</td>
			<td>
				<span class="item_price_span" >'. printCurrencyInRs($items[0]->price) .'</span>
				<br>
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
       echo $price['subtotal'];
		// echo printCurrencyInRs($subTotal); ?></td> 
	</tr>
	<tr>
		<td>Shipping cost:</td>
		<td><?php
		 echo $price['shipping'];
		 //echo printCurrencyInRs($shippingTotal); ?></td>
	</tr>
	<tr>
		<td>Total: </td>
		<td><span class="item_price_span" ><?php
         echo $price['total'];
		// echo printCurrencyInRs($subTotal + $shippingTotal); ?></span></td>
	</tr>

</table>
</body>
</html>
