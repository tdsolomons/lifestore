<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/item_style.css">
<div id="gift_wrapper">
<div id="conatiner">
<div class="row">
  <div class="col-md-4">
  	<img  class="main-image" id="main-image" src="<?php echo base_url().'assets/img/giftcard_images/'.$object->image?>"/>
  </div>
  <div class="col-md-4">
  	<h2><?php echo $object->gift_name; ?></h2> 
    <hr/>  
    <p>Thank you for purchasing </p>
    <p>Gift code is : <?php echo $random; ?></p>
    <p>Please check email for more infomation</p>
    
  </div>
  </div>
 </div>
</div>
  








