<html>
<head>

<title>Category Image Upload</title>
<link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="./assets/css/bootstrap.css" rel="stylesheet">

</head>
<body>

<div class="container">
  <div class="well"><h3>Category Image Edit</h3></div>
  <div class="container" style="text-align:center;width:600px;height:250px">
  <div class="row table-bordered"  >	
<?php echo $error;?>

<?php echo form_open_multipart('AdminImageUpload/do_upload_category');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>
</div>
</div>
</div>
</div>

</body>
</html>
