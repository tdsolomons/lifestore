<html>
<head>
<title>Image Upload</title>
<link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<div class="container ">
  <div class="well"><h3>Image Upload</h3></div>
  <div class="container" style="text-align:center;width:600px;height:250px">
  <div class="row table-bordered"  >	
  	 
<?php echo $error;?>



<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" align="middle"/>



<input type="submit" value="upload" />

</form>
</div>
</div>
</div>
</div>
</body>
</html>