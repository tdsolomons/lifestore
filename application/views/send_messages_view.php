<h2>Send message to <?php echo $to_user_username; ?></h2>
<h3>About Item:</h3>
<table>
	<tr>
		<td><img src=""></td>
		<td>
			<table>
				<tr><td><?php echo $item->title; ?></td></tr>
				<tr><td><?php echo $item->item_id; ?></td></tr>
				<tr><td><?php echo $item->price; ?></td></tr>
			</table>

		</td>
	</tr>
</table>

<form action="<?php echo base_url() . 'Messages/Send'; ?>">
	<input type="hidden" name="to_user_username" value="<?php echo $to_user_username; ?>" />
	<textarea placeholder="Type your message here..." name="content" rows="20" cols="100"></textarea>
	<input type="submit" value="send_message" class="colored_button"/>	
</form>