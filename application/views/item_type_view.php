<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sell</title>
   
   <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css" type="text/css">
   <link rel="stylesheet" href="test.css" type="text/css">




</head>

<body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
 	<?php $connection = mysqli_connect("EMarketingPortal.db.11358052.hostedresource.com", "EMarketingPortal", "W43edfsa1%h", "EMarketingPortal"); ?>
 
<!--Header----------------------------------------------------------------> 
 <div style="background-color:#ccc;height:30px;">
 	 <div style="width: 200px; position: absolute; height: 30px; right: 0px;text-align:right;padding:5px">
     
     <a href="login.php" ><span class="glyphicon glyphicon-user"></span>  Login | Register </a>
     
     </div>
 </div>
<div style="background-image:url(<?php echo asset_url(); ?>img/sdd.png);height:120px;">
  <div style="margin:30px auto auto 60px;background-image:url(<?php echo asset_url(); ?>img/logo1.png);width:260px;height:65px;position:absolute ; "></div>
 
</div>
 
 
 
<!--Search Bar------------------------------------------------------------------> 

 <div class="row"  style="min-height:50px;height:80px">
  <table class="table" style="margin-top:10px;">
   <tr>
          <td style=>
               <div class="container" style="height:35px;width:850px;;" align="center">
               <form role="form" class="form-inline" action="tset" method="post">
            
                  <div class="form-group  ">
                      <input type="text" class="form-control"  name="fname" id="fname" placeholder="Search items " style="width:400px">                  
                  </div>
               
                  
                  <div class="form-group">
                    
                        <select class="form-control" id="sel1">
                        <?php
	                              foreach ($categories as $object) {
		   echo '<option>' . $object->category_name . '</option>' ;
 	                              }

                               ?>
                        </select>
                      </div>
                  
                  
                  <div class="form-group ">
                      <input type="submit" class="form-control btn btn-primary "  value="Search" >                  
                  </div>
               
               
               </form>
              
               </div>
          </td>
           
   </tr>
   
   
   <tr><td></td></tr>
  </table>
 
 
 
 </div>




<!--Contents------------------------------------------------------------------> 
<div class="container">

    <div class="page-header h3" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">My Account</div>
    
    
    
    <div class="row"  style="min-height:800px;">
               <!--Side Bar----------------------->
               <div class="col-md-6" style="min-height:800px;background-color:#fff;box-shadow:10px;margin-left:0px;width:180px;">
               </div>
               
               
               <!--Main Content----------------------->
               <div class="col-lg-10" style="min-height:800px;">
                        <div class="page-header h4">Select the type of your Item </div>
                             
               
               
               <!---Add Form-------------------------->
              
              <div style="width:400px;height:200px;text-align:center;position:absolute">
               <a href="http://sep.tagfie.com/UserAccount/fixed" class="btn btn-default">Fixed Priced Item   </a><br /><br />
               <a href="http://sep.tagfie.com/UserAccount/auction" class="btn btn-default">Auction Item   </a>
               </div>
               		
              
              
               </div>
               
     </div>
 
 </div>
 
 
 
 
 
 
 <!--Footer--------------------------------------------------------------------->
 
 
<div style="height:260px;opacity:0.6;background-color:#CCC"></div>
  
  
  













</body>
</html>