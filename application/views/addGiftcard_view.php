<html>
<head>
<title>Upload Gift cards</title>
<link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/css/bootstrap.css" rel="stylesheet">
</head>

<body>

<div class="container ">
  <div class="well"><h3>Upload Gift cards</h3></div>
  <div class="container" style="text-align:left;width:500px">
  <div class="row table-bordered"  >	
 
<?php echo $error;?>
<?php echo form_open_multipart('giftcard/add_giftcard');?>
<label>Gift card name</label><input type="text" name="gift_name" size="20" /><br/>
<label>Price</label><input type="text" name="price" size="20" /><br/>
<input type="file" name="userfile" size="20" /><br/>
<input type="submit" value="Add Gift card" name="upload" />
</form>

</div>
</div>
</div>


<div class="container-fluid">
<div class="row" style="margin-top:45px;border:solid 1px #CCCCCC;" align="center">
 
<?php



if($gift_items){
	foreach ($gift_items as $gift_item ){
		
		
			echo 
			
				'
				<div class="col-md-4" style="text-align:center">
				
				<img src="'.asset_url().'img/giftcard_images/'. $gift_item->image.'" width="200px" height="100px" style="padding:9px;padding-bottom:5px" /> <br>
				<p>'.$gift_item->gift_name.'</p>
				
				<a href="http://sep.tagfie.com/giftcard/delete/'. $gift_item->id . '" >Remove</a><br>
				</div>'
				;
	
	}

}

?>
</div> </div> </div>



</body>
</html>
