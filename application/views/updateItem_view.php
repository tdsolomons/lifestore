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
                        <div class="page-header h4">Update items</div>
                             
               <div style="border:1px">
			   <?php echo validation_errors(); ?>
               </div>
               <!---Add Form-------------------------->
               <div style="margin-top:10px;margin-left:30px;width:400px;height:200px">
                    <form role="form" action="http://sep.tagfie.com/Upload/update_item" method="post" enctype="multipart/form-data">
                        
                            <div class="form-group">
                             <label for="name">Name:</label>
                             <input type="text" class="form-control"  name="name" id="name" value="<?php echo $itemData->title?>" placeholder="">
                            </div>
                    
                            
                             <div class="form-group">
                             <label for="name">Select a Category:</label>
							 <select class="form-control" id="category" name="category"  >
							 <?php
	                              foreach ($categories as $object) {
		  							 echo '<option>' . $object->category_name . '</option>' ;
 	                              }

                               ?>
                            </select>
                            </div>
                             
                             
                             
                             <div class="form-group">
                             <label for="desc">Description:</label>
                             <textarea class="form-control"  name="desc" id="desc"  placeholder=""><?php echo $itemData->description?> </textarea>
                            </div>
                            
                            
                             <div class="form-group">
                             <label for="price">Price:</label>
                             <input type="text" class="form-control"  name="price" value="<?php echo $price?>" id="price" placeholder="">
                            </div>
                             
                             <div class="form-group">
                             <label for="cost">Shipping Cost:</label>
                             <input type="text" class="form-control"  name="cost" id="cost" value="<?php echo $itemData->shipping_cost?>" placeholder="">
                            </div>             
                            
                             
                             
                             <div class="form-group">
                    		 <label for="cost">Condition:</label>
                       		 <select class="form-control" id="condition" name="condition">
                       		 <?php
	                              foreach ($conditions as $object) {
		  								 echo '<option>' . $object->condition_title . '</option>' ;
 	                              }

                               ?>
                        	 </select>
                      		 </div>
                             
                             
                             <div class="form-group">
                             <label for="cost">Available Quantity:</label>
                             <input type="text" class="form-control"  name="quantity" value="<?php echo $itemData->available_quantity?>" id="quantity" placeholder="">
                             </div>  
                            
                            
                          
                          
                             
                            
                         
                         
                         
                         
                          <!--Subutton---------------------------------------------->
                         
                           <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                            
                                 <button type="submit" class="btn btn-primary ">Update</button>
                            </div>
                      
                      
                      
                      
                      
                      
                  </form>
                          
                          
                
                 
                           
                           
                           
                           
                           
                           
                         
             
        </div>
               
               
               
               
               
              
              
               </div>
               
     </div>
 
 </div>
 
 
 
 
 
 
 <!--Footer--------------------------------------------------------------------->
 
 
<div style="height:260px;opacity:0.6;background-color:#CCC"></div>
  
  
  













</body>
</html>