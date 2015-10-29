<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/buyer_feedback_form_styles.css">
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
	<label>Rating</label>
	<br>
	<div class="stars">
	   
	    <input class="star star-5" id="star-5" type="radio" name="rating" value="5" />
	    <label class="star star-5" for="star-5"></label>
	    <input class="star star-4" id="star-4" type="radio" name="rating" value="4" />
	    <label class="star star-4" for="star-4"></label>
	    <input class="star star-3" id="star-3" type="radio" name="rating" value="3" />
	    <label class="star star-3" for="star-3"></label>
	    <input class="star star-2" id="star-2" type="radio" name="rating" value="2" />
	    <label class="star star-2" for="star-2"></label>
	    <input class="star star-1" id="star-1" type="radio" name="rating" value="1" />
	    <label class="star star-1" for="star-1"></label>
	  
	</div>
	<br>

	<textarea placeholder="Type your honest feedback here..." name="content" rows="5" 
			cols="100" maxlength="100" onkeyup="textCounter(this,'char_left_counter',100);" ></textarea>
	<br/>
	<small id="char_left_counter">Maximum length 100 characters</small>
	<br/>
	<input type="submit" value="Submit feedback" class="colored_button"/>
</form>