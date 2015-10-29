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

<h2>Send message to <?php echo $toUserUsername; ?></h2>
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

<table>
<?php 
	if (isset($msgs)) {
		foreach ($msgs as $msgObject) {
			$senderDisplayName = '';
			if (strcmp($_SESSION['user_id'], $msgObject->sender) == 0) {
				$senderDisplayName = 'You';
			}else{
				$senderDisplayName = $toUserUsername;
			}
			echo '<tr>
					<td>'. $senderDisplayName .':</td>
					<td>'. $msgObject->content .'</td>
					<td><small>'. $msgObject->sent_time .'</small></td>
				</tr>';
		}
	}
?>

</table>
	
<form method="post" action="<?php 
			if (isset($msgs)) {
				echo base_url() . 'Messages/Reply'; 
			}else
				echo base_url() . 'Messages/Send'; 
		?>">
	<input type="hidden" name="to_user_username" value="<?php echo $toUserId; ?>" />
	<input type="hidden" name="about_item" value="<?php echo $aboutItemId; ?>" />

	<textarea placeholder="Type your message here..." name="content" rows="15" 
			cols="100" maxlength="2000" onkeyup="textCounter(this,'char_left_counter',2000);" ></textarea>
	<br/>
	<small id="char_left_counter">Maximum length 2000 characters</small>
	<br/>
	<?php
		$buttonTitle = '';
		if (isset($msgs)) {
			echo '<input type="hidden" name="reply_thread" value="'. $replyThread .'"/>';
			$buttonTitle = 'Reply';
		}else{
			$buttonTitle = 'Send message';
		}	
		echo '<input type="submit" value="'. $buttonTitle . '" class="colored_button"/>';
	?>
	
</form>