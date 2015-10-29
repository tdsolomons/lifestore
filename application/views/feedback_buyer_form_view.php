<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>
function textCounter(field,field2,maxlimit)
{
	 var countfield = document.getElementById(field2);
	 if ( field.value.length > maxlimit ) {
	  field.value = field.value.substring( 0, maxlimit );
	  return false;
	 } else {
	  $('#' + field2).html( maxlimit - field.value.length + ' characters left');
	 }
}
</script>

<?php
	$item = '';
	foreach ($items as $object) {
		$item = $object;
	}
?>

<h2>Leave feedback for seller <?php echo $toUserUsername; ?></h2>
<h3>About Item:</h3>
<table>
	<tr>
		<td><img src="<?php echo asset_url() . 'img/item_images/' . $item->file_name . '.jpg'; ?>" height="100" width="100" >
		</td>
		<td>
			<table>
				<tr><td><?php echo '<a href="' . base_url(). 'item/item/?item=' . $item->item_id . '" >' . $item->title . '</a>'; ?></td></tr>
				<tr><td>Item Number: <?php echo $item->item_id; ?></td></tr>
				<tr><td>Price : <?php echo $item->price; ?></td></tr>
			</table>

		</td>
	</tr>
</table>
	
<form method="post" action="<?php echo base_url() . 'Feedback/BuyerPost'; ?>">
	<input type="hidden" name="order_id" value="<?php echo $orderId; ?>" />
	<span>Rating</span>
	<table>
		<tr>
			<td> <input type="radio" name="rating" vlaue="1">1 </td>
			<td> <input type="radio" name="rating" vlaue="2">2 </td>
			<td> <input type="radio" name="rating" vlaue="3">3 </td>
			<td> <input type="radio" name="rating" vlaue="4">4 </td>
			<td> <input type="radio" name="rating" vlaue="5">5 </td>
		</tr>
	</table>
	

	<textarea placeholder="Type your honest feedback here..." name="content" rows="5" 
			cols="100" maxlength="100" onkeyup="textCounter(this,'char_left_counter',100);" ></textarea>
	<br/>
	<small id="char_left_counter">Maximum length 100 characters</small>
	<br/>
	<input type="submit" value="Submit feedback" class="colored_button"/>
</form>