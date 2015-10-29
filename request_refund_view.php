<div class="container-fluid"> 
 <h2>Request Refund</h2>
 
 <!--ITEM DETAILS------------------------------>
 <div class="row" style="margin-top:30px">
  <?php foreach($item as $i){ ?>
  <!--image-->
  <div class="col-md-2">
   <img src="<?php echo asset_url() . 'img/item_images/' . $i->name; ?>" height="150px" width="150px" />
  </div>
  <!--details-->
  <div class="col-md-4">
   <table>
    <tr><b><?php echo $i->title;?></b></tr>
    <tr><td>Date: <?php echo $i->ordered_date; ?></td></tr>
    <tr><td>Price :<?php echo $i->sold_price; ?></td></tr>
    <tr><td>Quantity : <?php echo $i->ordered_quantity; } ?></td></tr>
   </table>
  </div>
 </div>
 
 
 
 <!--MESSAGES RECEIVED------------------------------>
 <?php if(isset($messages)){ ?>
 <h3>Messages</h3>
 <div class="row" style="margin-top:30px">
  <div class="col-md-5">
    <table>
	<?php foreach($messages as $msg){ ?>
     <tr>
      <td><?php echo $msg->sender ?></td>
      <td><?php echo $msg->content ?></td>
      <td><?php echo $msg->sent_time?></td>
  	 </tr>
     <?php }?>
    </table>
  
   </div>
 </div>
 <?php } ?>
 
 
 <!--MESSAGE FORM------------------------------>
 <h3>Contact Seller</h3>
 <div class="row" style="margin-top:30px">
  <div class="col-md-12">
   <form method="post" action="<?php 
			if (isset($msgs)) {
				echo base_url() . ''; 
			}else
				echo base_url() . ''; 
		?>">
	
    <input type="hidden" name="to_user_username" value="<?php //echo $toUserId; ?>" />
	<input type="hidden" name="about_item" value="<?php //echo $aboutItemId; ?>" />

	<textarea placeholder="Type your message here..." name="content" rows="10" 
			cols="300" maxlength="200" onkeyup="textCounter(this,'char_left_counter',2000);" ></textarea>
	<br/>
	<small id="char_left_counter">Maximum length 200 characters</small>
	<br/>
	<?php
		$buttonTitle = '';
		if (isset($messages)) {
			echo '<input type="hidden" name="reply_thread" value="'. $replyThread .'"/>';
			$buttonTitle = 'Reply';
		}else{
			$buttonTitle = 'Send message';
		}	
		echo '<input type="submit" value="'. $buttonTitle . '" class="colored_button"/>';
	?>
	
	</form>
  </div>



 </div>
 
 
 
</div><!--Container----->