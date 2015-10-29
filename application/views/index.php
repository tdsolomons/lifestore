<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LifeStore.lk</title>
   
    <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    
   <link href="<?php echo asset_url(); ?>css/half-slider.css" rel="stylesheet">
   
   <link rel="stylesheet" href="css/style.css" type="text/css">




</head>

<body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo asset_url(); ?>js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
 
 
 
 
 <div style="background-color:#ccc;height:30px;">
 	 <div style="width: 200px; position: absolute; height: 30px; right: 0px;text-align:right;padding:5px">
     
     <a href="login.php" ><span class="glyphicon glyphicon-user"></span>  Login | Register </a>
     
     </div>
     </div>
  <div style="background-image:url(<?php echo asset_url(); ?>img/sdd.png);height:120px;">
 <div style="margin:30px auto auto 60px;background-image:url(<?php echo asset_url(); ?>img/logo1.png);width:260px;height:65px;position:absolute ; "></div>
  
 </div>
 
 
 
 <!--Search Bar------------------------------------------------------------------> 

 <div class="row"  style="margin-bottom:0px;padding-bottom:0px">
  <table class="table" style="margin-top:10px;margin-bottom:0px;padding-bottom:0px">
   <tr>
          <td >
               <div class="container" style="height:35px;width:850px;;" align="center">
               <form role="form" class="form-inline" action="tset" method="post">
                  <div class="form-group  ">
                      <input type="text" class="form-control"  name="fname" id="fname" placeholder="Search items " style="width:400px;border-radius:0px">                  
                  </div>
                  
                  
                  <div class="form-group">
                      <select class="form-control" id="sel1" style="border-radius:0px">
                        <option>All Categories</option>
						<?php
	                         foreach ($categories as $object) {
		                         echo '<option>' . $object->category_name . '</option>' ;
 	                          }
                          ?>
                       </select>
                  </div>
                  
                  
                  <div class="form-group ">
                      <input type="submit" class="form-control btn btn-primary "  value="Search" style="border-radius:0px" >                  
                  </div>
               
               </form>
               </div>
          </td>
   
   </tr>
   
<tr><td></td></tr>
  
  </table>
 </div>

 
 <!--Middle page contents------>
 <div class="container" style="min-height:800px;width:1100px;border:1px solid #ccc;padding-left:0px;padding-right:0px">
    
     
     <!--Image Banner-------------->
     <div class="row table-bordered" style="height:300px;margin:10px;padding-left:0px">
    	 <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>
          
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="<?php echo asset_url(); ?>img/banner1.png" alt="Chania">
              </div>
          
              <div class="item">
                <img src="<?php echo asset_url(); ?>img/banner2.png" alt="Chania">
              </div>
          
             
            </div>
          
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    
     </div>
 
    
    
    <!--Product Categories----------------->
    <h3 class="page-header" style="margin-left:20px;margin-top:80px;margin-right:20px;font-family:'Myriad Pro'">Popular Categories on LifeStore</h3>
    
    <div class="row table-bordered" style="margin-left:20px;margin-top:10px;margin-right:20px;margin-bottom:30px;padding:10px">
    	<div class="row">
         <div class="col-md-4" >
             <img src="<?php echo asset_url(); ?>img/cat1.png" style="text-align:center"/>
         </div>
         <div class="col-md-4" >
             <img src="<?php echo asset_url(); ?>img/cat2.png" />
         </div>
         <div class="col-md-4">
        	  <img src="<?php echo asset_url(); ?>img/cat3.png" />
         </div>
        </div>
        
        <div class="row" style="margin-top:30px">
         <div class="col-md-4" >
             <img src="<?php echo asset_url(); ?>img/cat4.png" />
         </div>
         <div class="col-md-4" >
         	 <img src="<?php echo asset_url(); ?>img/cat5.png" />
         </div>
         <div class="col-md-4" >
         	 <img src="<?php echo asset_url(); ?>img/cat1.png" />
         </div>
        </div>
    
    	
    
    
    </div>
    
    
    
    
    </div>
 

  
  
  
  
  
  
  
  
  <!--Footer-------------------->
    <div style="height:260px;background-color:#CCC">
    </div>
  
</body>
</html>