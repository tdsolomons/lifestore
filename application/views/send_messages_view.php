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
<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/message_styles.css">

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
				<tr><td> 
				<?php 
					if (isset($item->price)) {
						echo 'Price :' . $item->price; 
					}else{
						echo 'Auction Item';
					}
					

				?>
				</td></tr>
			</table>

		</td>
	</tr>
</table>

<table id="message_table">
<?php 
	if (isset($msgs)) {
		foreach ($msgs as $msgObject) {
			$userUrlSlot = '';
			if (strcmp($_SESSION['user_id'], $msgObject->sender) == 0) {
				$userUrlSlot = 'You';
			}else{
				$userUrlSlot = '<a href="' . base_url() . '/Profile/seller/?seller=' . $toUserId . '">'. $toUserUsername .'</a>';
			}

			$messageItemClass = "message_item unread";
			$messageItemSeenElement = '';
			if ($msgObject->read == '1') {
				$messageItemClass = "message_item read";
				if (strcmp($_SESSION['user_id'], $msgObject->sender) == 0) {
					$messageItemSeenElement = '<span><img width="10" height="10" src="'. asset_url() .'img/seen_tick.svg"/> Seen</span>';
				}
			}

			echo '<tr class="'. $messageItemClass .'" >
					<td>'. $userUrlSlot .':</td>
					<td>'. $msgObject->content .'</td>
					<td><small>'. $msgObject->sent_time .'</small><br>'. $messageItemSeenElement .'</td>
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