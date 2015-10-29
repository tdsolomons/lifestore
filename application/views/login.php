<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
   
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
         
         <a href="login/register.php" ><span class="glyphicon glyphicon-user"></span>  Login | Register </a>
         
         </div>
     </div>
     
     
    <!--Page Header Image-------------------------------------------------------------------------------> 
    <div style="background-image:url(<?php echo asset_url();?>img/sdd.png);height:120px;">
      
        <div style="margin:30px auto auto 60px;background-image:url(<?php echo asset_url();?>img/logo1.png);width:260px;height:65px;position:absolute ; "></div>
     
    </div>
 
 
    <!--Login Form----------------------------------------------------------------------------------------> 
<div class="container table-bordered" style="width:800px;height:400px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="width:200px;height:100px;margin-top:20px;text-align:center;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
           <div class="h2">Login
           </div>
        </div>
    
        <div class="container" style="margin-top:10px;width:400px;height:200px">
            <form role="form" action="http://sep.tagfie.com/Login/validate_credentials" method="post">
                
                    <div class="form-group">
                     <label for="username">User Name:</label>
                     <input type="text" class="form-control"  name="username" id="username" placeholder="">
                    </div>
            
                     <div class="form-group">
                     <label for="pass">Password:</label>
                     <input type="password" class="form-control"  name="password" id="password" placeholder="">
                    </div>             
                    
                     
                     
                    
                     
                    <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                    
                         <button type="submit" class="btn btn-default ">Login</button>
                    </div>
              
              
              <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                 Not a member?   
                         <a href="/login/register"><button type="button" class="btn btn-default ">Register</button></a>
              </div>
              
              
              
          </form>
             
        </div>
    
    
    </div>
 





<!--------------------------------------------------FOOTER-------------------------------------------------------->
<div style="height:260px;background-color:#CCC"></div>
  
  
  













</body>
</html>