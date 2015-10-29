<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Updated Account Details</title>
   
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
        
        
        
 <?php if (isset($account_updated)) { ?> 
        <div align="center" class="container" style="width:2000px;margin-top:20px;text-align:justify;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif"><h3> <?php echo $account_updated; }?></h3></div>
        
                <?php
                if ($resultUser != 0) {
                    foreach ($resultUser as $row) {
                        ?>
                                        
           
<div class="panel" style="width:700px;margin-bottom:20px;"><h2> Updated Account Details <?php echo $row->username ?> </h2></div>
 <table width="900" class="table table-striped table-bordered" style="margin-top:10px; width:800px;font-size:12px">
  
  
               <tr height="40px"><th width="250px" align="left">First Name</th> <td><?php echo $row->first_name ?></td> </tr>
               <tr height="40px"><th width="250px" align="left">Last Name</th> <td><?php echo $row->last_name ?></td> </tr>
               <tr height="40px"><th width="250px" align="left">Email</th> <td><?php echo $row->email ?></td> </tr>
               <tr height="40px"><th width="250px" align="left">Addressline</th> <td><?php echo $row->address ?></td> </tr>
               <tr height="40px"><th width="250px" align="left">Street</th> <td><?php echo $row->street ?></td> </tr>
               <tr height="40px"><th width="250px" align="left">City</th> <td><?php echo $row->city ?></td> </tr>
               <tr height="40px"><th width="250px" align="left">Phone</th> <td><?php echo $row->phone ?></td> </tr>
                           
                </table>
                            <?php }
                    }
                
                ?>
                    
  <div>
            
      <a href="http://sep.tagfie.com/UpdateDetails"><input type="button" class="btn btn-default" value="Back to Update"></a>
      <a href="http://sep.tagfie.com/myOrders"><input type="button" class="btn btn-default" value="Back to Home"></a>
      <a href="http://sep.tagfie.com/Login/login"><input type="button" class="btn btn-default" value="Log Out"></a>
            
  </div>
             
             </br> 
             </br>      

</body>
</html>
