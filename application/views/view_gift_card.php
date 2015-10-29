<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/item_style.css">
<div id="left_side_bar">

</div> 

<div id="gift_wrapper">
<div class="well"><h3>Gift cards</h3></div>

<div class="row">
<div id="conatiner">
<?php
foreach($gift_items as $object){
?>
  <div class="col-md-4">
  <a href="<?php echo base_url().'Giftcard/view/'.$object->id?>">
  	<img width="200px" src="<?php echo base_url().'assets/img/giftcard_images/'.$object->image?>" />
    <p><?php echo $object->gift_name?></p>
    <p><strong>Rs. <?php echo $object->price?></strong></p>
 </a>
  </div>
  
	
<?php	
}
?>
</div>
</div>
</div>