<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
   
   <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/bootstrap.min.css">
   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   
    
   <link rel="stylesheet" href="<?php echo asset_url(); ?>css/styles.css" type="text/css">
   <link rel="stylesheet" href="<?php echo asset_url(); ?>css/styles.css" type="text/css">

</head>
<!----------------------------------------------------------------------------------------------------------------->

<!--------------------------------------------------BODY------------------------------------------------------>
<body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
 
 	<!--Page Header Image-------------------------------------------------------------------------------> 
    <div style="background-image:url(<?php echo asset_url();?>img/sdd.png);height:120px;">
      
        <div style="margin:30px auto auto 60px;width:260px;height:65px;position:absolute ; ">
        <a href="/"><img src="<?php echo asset_url();?>img/logo1.png" /></a></div>
     
    </div>
    
    
    
    <!--StatusBar---------------------------------------------------------------------------------------->
    <div class="container-fluid" style="padding:0px;">
    <nav class="navbar navbar-default" style="margin:0px;padding:0px;background-color:#ccc;color:#FFF;">
  <div class="container-fluid" >
    
    
    <!-- Brand and toggle get grouped for better mobile display -->
    <!--
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>
	 -->
    
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
      
      
      <ul class="nav navbar-nav" >
        <li ><a href="/">Home <span class="sr-only">(current)</span></a></li>
        
      </ul>
      
      
      <!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      -->
      
      <ul class="nav navbar-nav navbar-right">
       <li><a href="<?php echo base_url();?>admin/getUsersListFull">Users</a></li>
       <li><a href="<?php echo base_url();?>admin/getItemsListFull">Items</a></li>
       <li><a href="<?php echo base_url();?>Parent_categories">Categories</a></li>
       <li><a href="<?php echo base_url();?>SubCategories">Sub Categories</a></li>
       <li><a href="<?php echo base_url();?>AdminImageUpload">Banner Images</a></li>
       <li><a href="<?php echo base_url();?>Refund/admin_view_load">User Support</a></li>
      </ul>
      
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 </div>
    <div id="site_wrap">
    
    
    
    
    
    
    
    <!--StatusBar---------------------------------------------------------------------------------------->   
    
     
    