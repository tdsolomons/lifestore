<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Item Details View</title>
   
   <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.css" type="text/css">


</head>
<!----------------------------------------------------------------------------------------------------------------->

<!--------------------------------------------------BODY------------------------------------------------------>
<body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../../Users/Hasantha/Desktop/New folder/js/bootstrap.min.js"></script>
    
      <!--StatusBar---------------------------------------------------------------------------------------->   
     <div style="background-color:#ccc;height:30px;">
         <div style="width: 200px; position: absolute; height: 30px; right: 0px;text-align:right;padding:5px">
         
         <a href="http://sep.tagfie.com/Login/login" ><span class="glyphicon glyphicon-user"></span>  Login | Register </a>
         
         </div>
     </div>
     
     
    <!--Page Header Image-------------------------------------------------------------------------------> 
    <div style="background-image:url(<?php echo asset_url();?>img/sdd.png);height:120px;">
      
        <div style="margin:30px auto auto 60px;background-image:url(<?php echo asset_url();?>img/logo1.png);width:260px;height:65px;position:absolute ; "></div>
     
    </div>
    
    <div align="center" class="container table-bordered" style="width:2000px;margin-top:50px;margin-bottom:100px">
        
        <div align="center" class="container" style="width:2000px;margin-top:20px;text-align:justify;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
        
<div class="panel" style="width:700px;margin-bottom:20px;"><h4> Item Details  </h4></div>
<table width="1170" class="table table-striped table-bordered" style="margin-top:8px; width:1200px;font-size:12px">
   
        <?php
        if ($itemRecord != 0) {
            foreach ($itemRecord as $row) {
                ?>

                <table class="">
                  <tr height="40px"><th width="250px" align="left">Item ID</th> <td><?php echo $row->item_id ?></td> </tr>
                  <tr height="40px"><th width="250px" align="left">Item name</th> <td><?php echo $row->title ?></td> </tr>
                  <tr height="40px"><th width="250px" align="left">Description</th> <td><?php echo $row->description ?></td> </tr>
                  <tr height="40px"><th width="250px" align="left">Posted Date</th> <td><?php echo $row->posted_date ?></td> </tr>
                  <tr height="40px"><th width="250px" align="left">Shipping Cost</th> <td><?php echo $row->shipping_cost ?></td> </tr>
                  <tr height="40px"><th width="250px" align="left">Category</th> <td><?php echo $row->category ?></td> </tr>
                  <tr height="40px"><th width="250px" align="left">Availability</th> <td><?php echo $row->available_quantity ?></td> </tr>
                </table>
                <?php
            }
        } else {
            ?>
        <tr><h4>There is no item by that ID!</h4></tr>   
    <?php
}
?>

<div>

	<a href="http://sep.tagfie.com/myOrders"><input type="button" value="Back to Orders"></a>
    <a href="http://sep.tagfie.com/Login/login"><input type="button" value="Log Out"></a>
    <a href="http://sep.tagfie.com/admin"><input type='button' value='Back to Admin'></a>
                    
</div>

           </div>
        </div>

<!--------------------------------------------------FOOTER-------------------------------------------------------->
<div style="height:260px;background-color:#CCC"></div>
  
 
</body>
</html>