<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/item_style.css">

<div id="gift_wrapper"> 
<div class="well"><h3>Gift card</h3></div>
<div id ="conatiner">
<div class="row">
  <div class="col-md-4">
  	<img width="350px" height="350px"class="main-image" id="main-image" src="<?php echo base_url().'assets/img/giftcard_images/'.$object->image?>"/>
  </div>
  <div class="col-md-4">
  	<h2><?php echo $object->gift_name; ?></h2>
    <hr/>
    </br>
    <div id="priceDiv" style="border-radius:4px";"height:50px">
  	
    <p><strong >Price : Rs <?php echo $object->price; ?></strong></p>
     <?php
    if(isset($_SESSION['username'])){
		?>
   
    <a id="addToCart1" href="<?php echo base_url().'Giftcard/buy/'.$object->id?>" class="btn btn-primary btn-sm"  style="margin:0;float:none;margin-top:5px;">Buy it now </a>
    <?php
	}else{
		echo '<p>'.'Please login to purchase'.'</p>';
	}
	?>
    </div>
  </div>
 </div>
</div>
</div>
  








