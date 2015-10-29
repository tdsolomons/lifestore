<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>

$(document).ready(function() {
    $(".message_item").click(function() {
        window.document.location = $(this).data("href");
    });
});



</script>

<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/message_styles.css">
<h2>Messages</h2>
<div class="row">
    <div class="col-md-2">
		<ul class="nav nav-pills nav-stacked">
		        <?php
		        	$messageFilter = "";
		        	 
		        	if($this->input->get('messageFilter') != NULL){
		        		$messageFilter = $this->input->get('messageFilter');
		        	}else{
		        		$messageFilter = 'inbox';
		        	}

		        	if ($messageFilter == 'inbox') {

		        		echo '<li class="active" ><a href="/messages/messages?messageFilter=inbox">Inbox</a></li>';
		        	}else{
		        		echo '<li ><a href="/messages/messages?messageFilter=inbox">Inbox</a></li>';
		        	}

		        	if ( strcmp($messageFilter, 'sent') == 0) {	
		        		echo '<li class="active" ><a href="/messages/messages?messageFilter=sent">Sent</a></li>';
		        	}else{
		        		echo '<li><a href="/messages/messages?messageFilter=sent">Sent</a></li>';
		        	}
		        ?>

		</ul>
	</div>
	<div class="col-md-8">
<h3><?php echo ucfirst($messageFilter); ?></h3>
<table id="message_table" >
<?php
if ($messageFilter == 'inbox')
	echo '<tr><th>From</th><th>Subject</th><th>Received date</th></tr>';
else
	echo '<tr><th>To</th><th>Subject</th><th>Sent date</th></tr>';
?>
<?php
	if ($messages != NULL) {
		foreach ($messages as $object){
			$subjectPrefix = '';
			$userUrlSlot = '';
			$toOrFromUserId = '';
			$toOrFromUserName = '';

			if ($messageFilter == 'inbox') {
				$toOrFromUserId = $object->sender_user_id;
				$toOrFromUserName = $object->sender_username;
			}else{
				$toOrFromUserId = $object->receiver_user_id;
				$toOrFromUserName = $object->receiver_username;
			}
			//Checking if the 'about item' is logged in seller's item
			if (strcmp($_SESSION['user_id'], $object->seller)== 0) {
				$subjectPrefix = 'About item you are selling';

				$userUrlSlot = base_url() . '/Profile/buyer/?buyer=' . $toOrFromUserId ;
			}else{
				$subjectPrefix = 'About item';
				$userUrlSlot = base_url() . '/Profile/seller/?seller=' . $toOrFromUserId ;
			}

			$messageItemClass = "message_item unread";
			$messageItemSeenElement = '';
			if ($object->read == '1') {
				$messageItemClass = "message_item read";
				if (strcmp($_SESSION['user_id'], $object->sender_user_id) == 0) {
					$messageItemSeenElement = '<span><img width="10" height="10" src="'. asset_url() .'img/seen_tick.svg"/> Seen</span>';
				}
				
			}

			echo '<tr class="'. $messageItemClass .'"  data-href="'. base_url() . '/Messages/SendForm/?msg_id='
					. $object->message_id .'&reply_thread='. $object->reply_thread .'&to='. $toOrFromUserId 
					.'&to_user='. $toOrFromUserName .'&item='. $object->item_id .'">
					<td><a href="'. $userUrlSlot .'">'. $toOrFromUserName . '</a></td>
					<td>'. $subjectPrefix . ': '. $object->title .'</td>
					<td>'. $object->sent_time .'<br>'. $messageItemSeenElement .'</td>
					</tr>';
			
		}
	}else{
		echo '<span>You have not received any messages</span>';
	}
?>

</table>
</div>	