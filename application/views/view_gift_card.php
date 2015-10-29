
<div id="left_side_bar">

</div> 

<div id="gift_wrapper">

<div class="row">
<?php
foreach($gift_items as $object){
?>
  <div class="col-md-4">
  <a href="<?php echo base_url().'Giftcard/view/'.$object->id?>">
  	<img src="<?php echo base_url().'assets/img/giftcard_images/'.$object->image?>" />
    <p><?php echo $object->gift_name?></p>
    <p><strong><?php echo $object->price?></strong></p>
 </a>
  </div>
  
	
<?php	
}
?>
</div>
</div>