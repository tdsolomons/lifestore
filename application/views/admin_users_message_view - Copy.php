<div class="container-fluid"> 
 <!--HEADING-->
 <div class="row">
  <div class="col-md-4">
 	<h2>Review Refund Request</h2>
  </div>
  
  <div class="col-md-4">
   <!--sets the case status-->
   <?php if(isset($req_details)){
     $req_id='';
	 $admin = '';
	 $status = '';
	 foreach($req_details as $r) { 
      $req_id=$r->req_id;
	  $status=$r->case_status;
	  $admin=$r->admin_status; } 
	  if($status==1){ ?>
      <h2><span class="btn btn-primary">Case Open</span></h2>
      <?php } else { ?>
      <h2><span class="btn btn-primary">Case Closed</span></h2>
   <?php } }?> 
  </div>
 </div>
 
 
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
    <tr><td>Quantity : <?php echo $i->ordered_quantity;  ?></td></tr>
   </table>
   <?php 
   		 $seller_of_the_item=$i->seller;
		 $buyer=$i->bought_by_user; 
   		 $order_id=$i->order_id; }?>
  </div>
 
 <!--Admin Support--> 
  <div class="col-md-2">
  </div>
  <div class="col-md-4 table-bordered" style="text-align:right">
    
     <h4>Contact the Users</h4>
     
      <a href="http://sep.tagfie.com/Refund/sjid=<?php echo $req_id  ?>&order=<?php echo $order_id?>&status=1" class="btn btn-primary btn-sm">Contact Seller</a>
     
     
     <a href="http://sep.tagfie.com/Refund/sk?id=<?php echo $req_id  ?>&order=<?php echo $order_id?>&status=1" class="btn btn-primary btn-sm">Contact Buyer</a>
    
    
  <br /><br />
  
  </div>

 </div>
 
 
 
 <!--MESSAGES RECEIVED------------------------------>
 <?php if(isset($messages)){ ?>
 <h3>Messages</h3>
 <div class="row" style="margin-top:30px">
  <div class="col-md-6">
    <table class="table">
	<?php foreach($messages as $msg){ ?>
     <tr>
      <td><?php echo $msg->sender  ?></td>
      <td><?php echo $msg->content ?></td>
      <td><?php echo $msg->sent_time?></td>
  	 </tr>
     <?php }?>
    </table>
  
   </div>
 </div>

 
 
 <!--MESSAGE FORM------------------------------>
   <?php }  else {?>
  <h3>Contact Seller</h3>
   <?php } /*?>
 
  <div class="row" style="margin-bottom:30px">
   <div class="col-md-12">
   <form method="post" action="<?php 
								  if (isset($messages)) {
									  echo base_url() . 'Refund/reply'; 
								  }else
									  echo base_url() . 'Refund/set_request'; 
							  ?>" >
					
	<textarea placeholder="Type your message here..." name="content" rows="5" 
			cols="80" maxlength="200" onkeyup="textCounter(this,'char_left_counter',2000);" ></textarea>
	<br/>
	<small id="char_left_counter">Maximum length 200 characters</small>
	<br/>
	
	<?php
		$buttonTitle = '';
		if (isset($messages)) {
			$buttonTitle = 'Reply';
		}else{
			$buttonTitle = 'Send message';
		}	
		echo '<input type="submit" value="'. $buttonTitle . '" class="colored_button"/>';
	?>
	
   
		  <input type="hidden" name="receiver" value="<?php echo '0'; ?>" />
   
    
    	  <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
    </form>
  </div>
 </div><?php */ ?>
 
 <!--CASE CLOSE OPTION-->
 <?php if($status==1) { ?>
 <div class="row">
  <div class="col-md-4">
 	<h4>Close The Case</h4>
  	
    <a href="http://sep.tagfie.com/Refund/set_request_close?id=<?php echo $req_id  ?>&order=<?php echo $order_id?>" class="btn btn-primary btn-sm">Close Case</a>
  </div>
 </div>
 <?php } ?>
 
 
</div><!--Container----->