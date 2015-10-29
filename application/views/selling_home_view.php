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
                        <div class="page-header h4">Sell your Items </div>
                             
               
               
               <!---Add Form-------------------------->
              
               <a href="http://sep.tagfie.com/UserAccount/sell" class="btn btn-default">Add Item   </a>
               
               		
                    <!--Active Sellings Table------------------>
                    
               
                     <div class="panel" style="width:700px;margin-top:70px;margin-bottom:20px"><h4>All Selling </h4></div>
                     <table class="table table-striped table-bordered" style="margin-top:8px; width:900px">
   	       
                       <th>Item</th><th>Name</th><th>Date</th><th>Quantity</th><th>Actions</th>
                      
                      <?php foreach($query as $rowa){?>
                         <tr>
                         <td><?php  
						 			$item1a=$rowa->main_image;
						 			$query1a="select name from image where image_id ={$item1a}";
						  			$resultQuery1a=mysqli_query($connection,$query1a);
								    $result1a=mysqli_fetch_assoc($resultQuery1a);
						            $url1a=asset_url()."img/item_images/".$result1a["name"];
							?>
									<img src="<?php echo $url1a?>" alt="Smiley face" height="80" width="80"> 	
									
							 
                                    
                         </td>
                         
                                           
                                           
                         <td>
                         <?php
                         $itemId=$rowa->item_id;?>
                         <a href="http://sep.tagfie.com/item/item/?item=<?php  echo $itemId; ?>"><?php  echo $rowa->title; ?></a></td>
                         <td><?php  echo $rowa->posted_date; ?></td>
                         <td><?php  echo $rowa->available_quantity; ?></td>
                         
                         
                      	 <td>
                            <a href="http://sep.tagfie.com/UserAccount/updateItem?item=<?php echo $itemId ;?>" class="btn btn-primary btn-sm"  >Edit</a></td>
             
            			 
                        
                         
                         
                         </tr>
              		<?php } ?>
              
              </table>
              
               
               
               
               
               
               
               
               
               		<!--Ordered items Table--------------------->
                     <div class="panel" style="width:700px;margin-top:70px;margin-bottom:20px;"><h4> Ordered Items</h4></div>
                     <table class="table table-striped table-bordered" style="margin-top:8px; width:900px">
   	       
                       <th>Item</th><th>Name</th><th>Quantity</th><th>Date</th>
                       <th>Price</th><th>Order Status</th><th>Actions</th>
                      <?php foreach($orderedItems as $row){
                         			$check=$row->order_status;
									if(($check==1)||($check==2)){
                         ?>
                         <tr>
                         <td><?php  
						 			$itemId1=$row->item;
						 			$query1="select name from image where image_id in(select main_image from item where item_id={$itemId1})";
						  			$resultQuery1=mysqli_query($connection,$query1);
								    $result1=mysqli_fetch_assoc($resultQuery1);
						            $url1=asset_url()."img/item_images/".$result1["name"];
							?>
									<img src="<?php echo $url1?>" alt="Smiley face" height="80" width="80"> 	
									
							 
                                    
                         </td>
                         
                         <td><?php  $itemId=$row->item; 
									$queryuname="select title  from  item where item_id={$itemId}";
						  			$resultuname=mysqli_query($connection,$queryuname);
								    $result=mysqli_fetch_assoc($resultuname);
						            echo htmlentities($result["title"]); 					 
						 	 ?>
                         </td>
                         
                  
                         
                         <td><?php  echo $row->ordered_quantity; ?></td>
                         <td><?php  echo $row->ordered_date; ?></td>
                         <td><?php  echo $row->sold_price; ?></td>
                         
                         <td><?php  $sId=$check; 
									$query2="select status_title  from  order_status where status_id={$sId}";
						  			$resulQuery2=mysqli_query($connection,$query2);
								    $result2=mysqli_fetch_assoc($resulQuery2);
						            echo htmlentities($result2["status_title"]); 					 
						 	 ?>
                         </td>
                         
                      
             
            			 <td >
                         <?php 	
						 		$order=$row->order_id;
						 		if($check==1) { ?>
                                  <a href="http://sep.tagfie.com/UserAccount/dispatch?order=<?php echo $order;?>" class="btn btn-primary btn-sm"  >Dispatch Order</a></td>
                         		<?php }else if($check==2) {?>
                                  <a href="http://sep.tagfie.com/UserAccount/deliver?order=<?php echo $order;?>" class="btn btn-primary btn-sm"  >Delivered</a></td>
                                <?php }else {} ?>  
                         </tr>
              		<?php } }?>
              
              </table>
              
              
              
              
              
              <!--Delivered items Table--------------------->
                     <div class="panel" style="width:700px;margin-top:70px;margin-bottom:20px"><h4>Delivered Items </h4></div>
                     <table class="table table-striped table-bordered" style="margin-top:8px; width:900px">
   	       
                       <th>Item</th><th>Name</th><th>Quantity</th><th>Date</th>
                       <th>Price</th><th>Order Status</th><th>Actions</th>
                      <?php foreach($deliveredItems as $rowd){?>
                         <tr>
                         <td><?php  
						 			$item1d=$rowd->item;
						 			$query1d="select name from image where image_id in(select main_image from item where item_id={$item1d})";
						  			$resultQuery1d=mysqli_query($connection,$query1d);
								    $result1d=mysqli_fetch_assoc($resultQuery1d);
						            $url1d=asset_url()."img/item_images/".$result1d["name"];
							?>
									<img src="<?php echo $url1d?>" alt="Smiley face" height="80" width="80"> 	
									
							 
                                    
                         </td>
                         
                         <td><?php  $itemIdd=$rowd->item; 
									$queryunamed="select title  from  item where item_id={$itemIdd}";
						  			$resultunamed=mysqli_query($connection,$queryunamed);
								    $resultd=mysqli_fetch_assoc($resultunamed);
						            echo htmlentities($resultd["title"]); 					 
						 	 ?>
                         </td>
                         
                  
                         
                         <td><?php  echo $rowd->ordered_quantity; ?></td>
                         <td><?php  echo $rowd->ordered_date; ?></td>
                         <td><?php  echo $rowd->sold_price; ?></td>
                         
                         <td><?php  $sIdd=$rowd->order_status; 
									$query2d="select status_title  from  order_status where status_id={$sIdd}";
						  			$resulQuery2d=mysqli_query($connection,$query2d);
								    $result2d=mysqli_fetch_assoc($resulQuery2d);
						            echo htmlentities($result2d["status_title"]); 					 
						 	 ?>
                         </td>
                         
                      
             
            			 
                         <td >
                         <?php 	
						 		$orderd=$rowd->order_id; ?>
						 		
                         		
                                  <a href="http://sep.tagfie.com/UserAccount/returned?order=<?php echo $orderd;?>" class="btn btn-primary btn-sm"  >Returned</a></td>
                                 
                         
                         
                         </tr>
              		<?php } ?>
              
              </table>
              
              
              
              
              
              
              <!--Returned items Table--------------------->
                     <div class="panel" style="width:700px;margin-top:70px;margin-bottom:20px"><h4>Returned Items</h4></div>
                     <table class="table table-striped table-bordered" style="margin-top:8px; width:900px">
   	       
                       <th>Item</th><th>Name</th><th>Quantity</th><th>Date</th>
                       <th>Price</th><th>Order Status</th>
                      <?php foreach($returnedItems as $rowr){?>
                         <tr>
                         <td><?php  
						 			$itemId1r=$rowr->item;
						 			$query1r="select name from image where image_id in(select main_image from item where item_id={$itemId1r})";
						  			$resultQuery1r=mysqli_query($connection,$query1r);
								    $result1r=mysqli_fetch_assoc($resultQuery1r);
						            $url1r=asset_url()."img/item_images/".$result1r["name"];
							?>
									<img src="<?php echo $url1r?>" alt="Smiley face" height="80" width="80"> 	
									
							 
                                    
                         </td>
                         
                         <td><?php  $itemIdr=$rowr->item; 
									$queryunamer="select title  from  item where item_id={$itemIdr}";
						  			$resultunamer=mysqli_query($connection,$queryunamer);
								    $resultr=mysqli_fetch_assoc($resultunamer);
						            echo htmlentities($resultr["title"]); 					 
						 	 ?>
                         </td>
                         
                  
                         
                         <td><?php  echo $rowr->ordered_quantity; ?></td>
                         <td><?php  echo $rowr->ordered_date; ?></td>
                         <td><?php  echo $rowr->sold_price; ?></td>
                         
                         <td><?php  $sIdr=$rowr->order_status; 
									$query2r="select status_title  from  order_status where status_id={$sIdr}";
						  			$resulQuery2r=mysqli_query($connection,$query2r);
								    $result2r=mysqli_fetch_assoc($resulQuery2r);
						            echo htmlentities($result2r["status_title"]); 					 
						 	 ?>
                         </td>
                         
                      
             
            			 
                         
                         </tr>
              		<?php } ?>
              
              </table>
              
              
              <!--Completed orders Table--------------------->
                     <div class="panel" style="width:700px;margin-top:70px;margin-bottom:20px"><h4>Completed Orders</h4></div>
                     <table class="table table-striped table-bordered" style="margin-top:8px; width:900px">
   	       
                       <th>Item</th><th>Name</th><th>Quantity</th><th>Date</th>
                       <th>Price</th><th>Order Status</th>
                      <?php foreach($completedOrders as $rowc){?>
                         <tr>
                         <td><?php  
						 			$itemId1c=$rowc->item;
						 			$query1c="select name from image where image_id in(select main_image from item where item_id={$itemId1c})";
						  			$resultQuery1c=mysqli_query($connection,$query1c);
								    $result1c=mysqli_fetch_assoc($resultQuery1c);
						            $url1c=asset_url()."img/item_images/".$result1c["name"];
							?>
									<img src="<?php echo $url1c?>" alt="Smiley face" height="80" width="80"> 	
									
							 
                                    
                         </td>
                         
                         <td><?php  $itemIdc=$rowc->item; 
									$queryunamec="select title  from  item where item_id={$itemIdc}";
						  			$resultunamec=mysqli_query($connection,$queryunamec);
								    $resultc=mysqli_fetch_assoc($resultunamec);
						            echo htmlentities($resultc["title"]); 					 
						 	 ?>
                         </td>
                         
                  
                         
                         <td><?php  echo $rowc->ordered_quantity; ?></td>
                         <td><?php  echo $rowc->ordered_date; ?></td>
                         <td><?php  echo $rowc->sold_price; ?></td>
                         
                         <td><?php  $sIdc=$rowc->order_status; 
									$query2c="select status_title  from  order_status where status_id={$sIdc}";
						  			$resulQuery2c=mysqli_query($connection,$query2c);
								    $result2c=mysqli_fetch_assoc($resulQuery2c);
						            echo htmlentities($result2c["status_title"]); 					 
						 	 ?>
                         </td>
                         
                      
             
            			
                         
                         </tr>
              		<?php } ?>
              
              </table>
              
              
               </div>
               
     </div>
 
 </div>
 
 
 
 
 
 
 <!--Footer--------------------------------------------------------------------->
 
 
<div style="height:260px;opacity:0.6;background-color:#CCC"></div>
  
  
  













</body>
</html>