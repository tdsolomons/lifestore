<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script>

$(document).ready(function() {
    $(".message_item").click(function() {
        window.document.location = $(this).data("href");
    });
});



</script>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/message_styles.css">

<table id="message_table" >
<tr><th>From</th><th>Subject</th><th>Received date</th></tr>
<?php
	if ($messages != NULL) {
		foreach ($messages as $object){
			$subjectPrefix = '';
			if (strcmp($_SESSION['user_id'], $object->seller)== 0) {
				$subjectPrefix = 'About item you are selling';
			}else{
				$subjectPrefix = 'About item';
			}


			echo '<tr class="message_item"  data-href="'. base_url() . '/Messages/SendForm/?msg_id='. $object->message_id .'&reply_thread='. $object->reply_thread .'&to='. $object->sender_user_id .'&to_user='. $object->sender_username .'&item='. $object->item_id .'">
					<td>'. $object->sender_username . '</td>
					<td>'. $subjectPrefix . ': '. $object->title .'</td>
					<td>'. $object->sent_time .'</td>
					</tr>';
			
		}
	}else{
		echo '<span>You have not received any messages</span>';
	}
	

?>

</table>