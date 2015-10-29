
  

   
   <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
   <link href="<?php echo asset_url(); ?>css/bEdit.css" rel="stylesheet">
   <link href="<?php echo asset_url(); ?>css/ratingsStyle.php" rel="stylesheet" media="screen">
   <link rel="stylesheet" href="css/style.css" type="text/css">
   <link rel="stylesheet" href="test.css" type="text/css">





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/rate_by_seller.js"></script>
 
 	<?php $connection = mysqli_connect("EMarketingPortal.db.11358052.hostedresource.com", "EMarketingPortal", "W43edfsa1%h", "EMarketingPortal"); ?>
 



<!--Contents------------------------------------------------------------------------------------------------------>
<div class="container" >
     <!--Main Content Title-------------------------------------------------------------------------------------->
    
   <div class="row" style="min-height:1800px">
    
     <div class="row">
      <div class="col-md-12" style="padding-left:100px">
               <!--Side Bar---------------------------------------------------------------------------------------------------->
               <!--
               <div class="col-md-2" style="min-height:800px;box-shadow:10px;margin-left:0px;">
                  <ul class="nav nav-pills nav-stacked" >
                    <li class="active" style=""><a data-toggle="pill" href="#">Home</a></li>
                    <li><a data-toggle="pill" href="#sell" >Sellings</a></li>
                    <li><a data-toggle="pill" href="/MyOrders">Menu 2</a></li>
                    <li><a data-toggle="pill" href="#">Menu 3</a></li>
                  </ul>
               </div>
               -->
              
              
               <!--Dynamic Main Contents Container----------------------------------------------------------------------------->
               <!--<div class="tab-content">-->
               
                   <!--Main Content 1------------------------------------------------------------------------------------------>
                  
                        
                         <div class="panel" style="background-color:#EBEBEB;padding-left:10px;width:700px;"><h4>Sell your Items </h4> </div>
                        
                         <!---Add Form Button-------------------------->
                         <a href="http://sep.tagfie.com/UserAccount/sell" class="btn btn-default">Add Item   </a>
                          <a href="<?php echo base_url() . '/Deals/manage_deals/';?>" class="btn btn-default">Manage Deals</a>
                        <!--Active Sellings Table------------------>
                         <div class="panel" style="width:700px;margin-top:70px;margin-bottom:20px;background-color:#EBEBEB;padding-left:10px"><h4>All Selling </h4></div>

                         <table class="table table-striped table-bordered" style="margin-top:8px;font-size:12px">
               
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
                             			$itemId=$rowa->item_id;
                                        $query1aa="select * from fixed_price_item where item_id ={$itemId}";
                                        $resultQuery1aa=mysqli_query($connection,$query1aa);
                                        if(mysqli_num_rows($resultQuery1aa) > 0)
                                          $url1aa="http://sep.tagfie.com/item/item/?item=".$itemId ;
										else  
										  $url1aa="http://sep.tagfie.com/item/AuctionItem/?item=".$itemId ;
							?> 
							
                             <a href="<?php  echo $url1aa; ?>"><?php  echo $rowa->title; ?></a>
                             </td>
                             
                             
                             <td><?php  echo $rowa->posted_date; ?></td>
                             <td><?php  echo $rowa->available_quantity; ?></td>
                             
                             
                             <td style="width:17%">
                             <div style="padding:0px;display:inline">
                             
                                
                                <a href="http://sep.tagfie.com/UserAccount/updateItem?item=<?php echo $itemId ;?>" class="btn btn-primary btn-sm"  >Edit</a>
                             </div>
                               
                            <div  style="padding:0px;margin-left:5px;display:inline;background-color:#000">
                                <input type="button" id="a<?php echo $itemId ;?>" onClick="removeItem(this.id)" class="btn btn-primary btn-sm" value="Remove">
                                
                                
                            </div>
                            
                             <script type="text/javascript">
							  
							function removeItem(bId) {
						          itemId=bId.slice(1);
		 						 if (confirm("Are you sure you want to remove item?")) {	
				 					 window.location.href="http://sep.tagfie.com/Upload/remove_item?item="+itemId;
				 				 }
							  }
							
							
							 </script>
                            
                            
                             </td>
                             </tr>
                        <?php } ?>
                  </table>
                  
            </div> 
            </div> <!--end of first row-->      
                   
                   
            <div class="row">
             <div class="col-md-12" style="padding-left:100px">        
                    <!--Sellings Summary Tab --------------------->
                   <div class="panel" style="width:700px;margin-top:70px;margin-bottom:0px;background-color:#EBEBEB;padding-left:10px"><h4>Sellings Summary</h4></div>
                   
                   <ul class="nav nav-tabs" style="margin-top:0px;margin-bottom:20px">
                      <li class="active"><a data-toggle="tab" href="#ordered">Ordered</a></li>
                      <li><a data-toggle="tab" href="#delivered">Delivered</a></li>
                      <li><a data-toggle="tab" href="#returned">Returned</a></li>
                      <li><a data-toggle="tab" href="#completed">Completed</a></li>
                   </ul>
    
                    
                    <div class="tab-content" style="margin-bottom:80px">
                      
                     <!--Ordered items Table--------------------->
                      <div id="ordered" class="tab-pane fade in active">
                         <div class="panel" style="width:700px;margin-bottom:20px;"><h4> Ordered Items</h4></div>
                         <table class="table table-striped table-bordered" style="margin-top:8px; width:900px;font-size:12px">
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
                    </div>
                      
                      
                      
                  
                   <!--Delivered items Table--------------------->
                      <div id="delivered" class="tab-pane fade ">
                        <div class="panel" style="width:700px;margin-bottom:20px"><h4>Delivered Items </h4></div>
                         <table class="table table-striped table-bordered" style="margin-top:8px;font-size:12px ">
               
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
                  </div>
                      
                  
                  
                  <!--Returned items Table--------------------->
                      <div id="returned" class="tab-pane fade">
                         <div class="panel" style="width:700px;margin-bottom:20px"><h4>Returned Items</h4></div>
                         <table class="table table-striped table-bordered" style="margin-top:8px; width:900px; font-size:12px">
               
                           <th>Item</th><th>Name</th><th>Quantity</th><th>Date</th>
                           <th>Price</th><th>Order Status</th><th>Actions</th>
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
                      </div>
                     
                      
                      
                  <!--Completed orders Table--------------------->
                      <div id="completed" class="tab-pane fade">
                         <div class="panel" style="width:700px;margin-bottom:20px"><h4>Completed Orders</h4></div>
                         <table class="table table-striped table-bordered" style="margin-top:8px; width:900px;font-size:12px">
                           <th>Item</th><th>Name</th><th>Quantity</th><th>Date</th>
                           <th>Price</th><th>Order Status</th><th>Rate the buyer</th>
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
                             
                             
                             
                             <td style="width:30%">
                                <?php  $bougtc=$rowc->bought_by_user; 
                                        $query3c="select username  from  user where user_id={$bougtc}";
                                        $resulQuery3c=mysqli_query($connection,$query3c);
                                        $result3c=mysqli_fetch_assoc($resulQuery3c);
                                         					 
                                 ?>
                                
                                <div class='movie_choice'>
                                   
                                    <div id="a<?php echo $rowc->order_id; ?>" class="rate_widget">
                                        <div class="star_1 ratings_stars"></div>
                                        <div class="star_2 ratings_stars"></div>
                                        <div class="star_3 ratings_stars"></div>
                                        <div class="star_4 ratings_stars"></div>
                                        <div class="star_5 ratings_stars"></div>
                                        <div class="total_votes">Buyer:<a href="http://sep.tagfie.com/Profile/buyer/?buyer=<?php echo $bougtc?>"><?php echo htmlentities($result3c["username"]);?></a></div>
                                    </div>
                                </div>
                                 
                               
                              
                              
                              </td>
                             
                             
                             
                             </tr>
                        <?php } ?>
                  </table>
                  </div>
                    
                   </div><!--tab contetnts for dynamic tabs-->
                </div>
                </div> <!-- end of second row-->   
                   
               
               
               <div class="row"  >
      			<div class="col-md-12" style="padding-left:100px">    
         <div class="panel" style="width:700px;margin-top:70px;margin-bottom:0px;background-color:#EBEBEB;padding-left:10px"><h4>Item Offers</h4></div>
                 
                   <ul class="nav nav-tabs" style="margin-top:10px;margin-bottom:20px">
                      <li class="active"><a data-toggle="tab" href="#new_offers">New</a></li>
                      <li><a data-toggle="tab" href="#ac_offers">Accepted</a></li>
                      <li><a data-toggle="tab" href="#rj_offers">Rejected</a></li>
                      
                   </ul>
    
                    
                    <div class="tab-content" style="margin-bottom:80px">
                      
                     <!--New Offers Table--------------------->
                      <div id="new_offers" class="tab-pane fade in active">
                      <?php 
					  	if($offers == NULL){ ?>
							No item offers to display.
					 <?php }
						 
						else{ ?>
						<table class="table table-striped table-bordered" style="margin-top:8px; width:900px;font-size:12px">
                        <th>Item</th><th>Name</th><th>Quantity</th><th>Amount</th>
                        <th>Buyer</th><th>Actions</th>
						  
                        <?php  
                          foreach($offers as $row_offers){
							  $url_offer=asset_url()."img/item_images/".$row_offers->name;
                        	  $item_offer = $row_offers->item_id;
							  $offer_id = $row_offers->offer_id; ?>
                        <tr>
                         <td><img src="<?php echo $url_offer?>" alt="i" height="80" width="80"></td>
                         <td><a href="http://sep.tagfie.com/item/item/?item=<?php  echo $item_offer  ?>"><?php  echo $row_offers->title; ?></a></td>
                         <td><?php  echo $row_offers->quantity;  ?></td>
                         <td><?php  echo $row_offers->amount;  ?></td>
                         <td><a href="http://sep.tagfie.com/Profile/buyer/?buyer=<?php  echo $row_offers->buyer_id;?>"><?php  echo $row_offers->username;  ?></a></td>
                         <td><div class="row">
                         		<div class="col-md-6 col-sm-6">
                         <a href="http://sep.tagfie.com/UserAccount/accept_offer?offer_id=<?php  echo $offer_id;?>" class="btn btn-success btn-sm"  >Accept</a> 
                         		</div>
                                <div class="col-md-6 col-sm-6" style="padding-left:0px">
                         <a href="http://sep.tagfie.com/UserAccount/reject_offer?offer_id=<?php  echo $offer_id;?>" class="btn btn-danger btn-sm"  >Reject</a> 
                         		</div>
                        	 </div>
                         </td>
                         </tr>
                     <?php   } }?>
                    </table>
                    </div> <!--newoffers Tab-->
                    
                    
                    
                    <!--Accepted Offers Table--------------------->
                      <div id="ac_offers" class="tab-pane fade ">
                      <?php 
					  	if($offers_accepted == NULL){ ?>
							No item offers to display.
					 <?php }
						 
						else{ ?>
						<table class="table table-striped table-bordered" style="margin-top:8px; width:900px;font-size:12px">
                        <th>Item</th><th>Name</th><th>Quantity</th><th>Amount</th>
                        <th>Buyer</th>
						  
                        <?php  
                          foreach($offers_accepted as $row_offers_ac){
							  $url_offer_ac=asset_url()."img/item_images/".$row_offers_ac->name;
                        	  $item_offer_ac = $row_offers_ac->item_id;
							  $offer_id_ac = $row_offers_ac->offer_id; ?>
                        <tr>
                         <td><img src="<?php echo $url_offer_ac?>" alt="i" height="80" width="80"></td>
                         <td><a href="http://sep.tagfie.com/item/item/?item=<?php  echo $item_offer_ac  ?>"><?php  echo $row_offers_ac->title; ?></a></td>
                         <td><?php  echo $row_offers_ac->quantity;  ?></td>
                         <td><?php  echo $row_offers_ac->amount;  ?></td>
                         <td><a href="http://sep.tagfie.com/Profile/buyer/?buyer=<?php  echo $row_offers_ac->buyer_id;?>"><?php  echo $row_offers_ac->username;  ?></a></td>
                        
                         </tr>
                     <?php   } }?>
                    </table>
                    </div> <!--acoffers Tab-->
                   
                   
                    <!--Rejected Offers Table--------------------->
                      <div id="rj_offers" class="tab-pane fade ">
                      <?php 
					  	if($offers_rejected == NULL){ ?>
							No item offers to display.
					 <?php }
						 
						else{ ?>
						<table class="table table-striped table-bordered" style="margin-top:8px; width:900px;font-size:12px">
                        <th>Item</th><th>Name</th><th>Quantity</th><th>Amount</th>
                        <th>Buyer</th>
						  
                        <?php  
                          foreach($offers_rejected as $row_offers_rj){
							  $url_offer_rj=asset_url()."img/item_images/".$row_offers_rj->name;
                        	  $item_offer_rj = $row_offers_rj->item_id;
							  $offer_id_rj = $row_offers_rj->offer_id; ?>
                        <tr>
                         <td><img src="<?php echo $url_offer_rj?>" alt="i" height="80" width="80"></td>
                         <td><a href="http://sep.tagfie.com/item/item/?item=<?php  echo $item_offer_rj  ?>"><?php  echo $row_offers_rj->title; ?></a></td>
                         <td><?php  echo $row_offers_rj->quantity;  ?></td>
                         <td><?php  echo $row_offers_rj->amount;  ?></td>
                         <td><a href="http://sep.tagfie.com/Profile/buyer/?buyer=<?php  echo $row_offers_rj->buyer_id;?>"><?php  echo $row_offers_rj->username;  ?></a></td>
                        
                         </tr>
                     <?php   } }?>
                    </table>
                    </div> <!--rjoffers Tab-->
                   
                   
                   
                   
                   
                    </div> <!--tb contents-->
                   
                   
                   
                   
                   
                 </div>
                </div> <!--end of third row-->
            
            
            <!--ITEM DEALS HIDDEN--------------------------------------------------------------------------------
            
            <div class="row"  >
      			<div class="col-md-12" style="padding-left:100px">    
         <div class="panel" style="width:700px;margin-top:70px;margin-bottom:0px;background-color:#EBEBEB;padding-left:10px"><h4>Item Deals</h4></div>
                 
                   
    
                    
                  
                      
                     <!--Deals Table--------------------
                
                      <?php /*
					  	if($deals == NULL){ ?>
							No item deals to display.
					 <?php }
						 
						else{ ?>
						<table class="table table-striped table-bordered" style="margin-top:8px; width:900px;font-size:12px">
                        <th>Item</th><th>Name</th><th>Percentage</th><th>End time</th>
                        <th>Actions</th>
						  
                        <?php  
                          foreach($deals as $row_deals){
							  $url_deal=asset_url()."img/item_images/".$row_deals->name;
                        	  //$item_deal = $row_deals->item_id;
							  $deal_id = $row_deals->deal_id; ?>
                        
                        <tr>
                         <td><img src="<?php echo $url_deal?>" alt="i" height="80" width="80"></td>
                         <td><a href="http://sep.tagfie.com/item/item/?item=<?php  echo $item_offer  ?>"><?php  echo $row_deals->title; ?></a></td>
                         <td><?php  echo $row_deals->off_percentage;  ?></td>
                         <td><?php  echo $row_deals->end_time;  ?></td>
                        
                         <td><div class="row">
                         		<div class="col-md-6 col-sm-6">
                         <a href="http://sep.tagfie.com/UserAccount/edit_offer?deal_id=<?php  echo $deal_id;?>" class="btn btn-primary btn-sm"  >Edit</a> 
                         		</div>
                                <div class="col-md-6 col-sm-6" style="padding-left:0px">
                         
                         <input type="button" class="btn btn-primary btn-sm" onclick="removeDeal(this.id)"
                         	id="$deal_id" value="Remove" /> </div>
                        	 </div>
                         </td>
                         </tr>
                     <?php   } }?>
                    </table>
      
                    
                     <script type="text/javascript">
							  
							function removeDeal(bId) {
						          dealId=bId.slice(1);
		 						 if (confirm("Are you sure you want to remove the deal?")) {	
				 					 window.location.href="http://sep.tagfie.com/Upload/remove_deal?item="+itemId;
				 				 }
							  }
							
							
							 </script>
                    
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                   
                 </div>
                </div> <!--end of fourth row--> <?php */ ?>
      ------------------------------------------------------------------------------------------------------------------->          
                
                
                <div class="row"  >
      			<div class="col-md-12" style="padding-left:100px">    
         <div class="panel" style="width:700px;margin-top:70px;margin-bottom:0px;background-color:#EBEBEB;padding-left:10px"><h4>Refund Requests</h4></div>
                 
                   
    				<ul class="nav nav-tabs" style="margin-top:0px;margin-bottom:20px">
                      <li class="active"><a data-toggle="tab" href="#opencases">Open Cases</a></li>
                      <li><a data-toggle="tab" href="#closedcases">Closed Cases</a></li>
                      
                   </ul>
    
                    
                    <div class="tab-content" style="margin-bottom:80px">
                    
                  
                      
                     <!--Refund request Table--------------------->
                     <div id="opencases" class="tab-pane fade in active">
                      <?php 
					  	if($ref_requests_open == NULL){ ?>
							No Open Cases to display.
					 <?php }
						 
						else{ ?>
						<table class="table table-striped table-bordered" style="margin-top:8px; width:900px;font-size:12px">
                        <th>Item</th><th>Order</th><th>Date</th><th>Price</th>
                        <th>Actions</th>
						  
                      <?php  
					  foreach($ref_requests_open as $row_req){
						  $url_req=asset_url()."img/item_images/".$row_req->name;
						  $order_id = $row_req->order_id;
						  $req_id = $row_req->req_id; ?>
                        
                        <tr>
                         <td><img src="<?php echo $url_req?>" alt="i" height="80" width="80"></td>
                         <td><a href="http://sep.tagfie.com/Refund/refund_req?id=<?php echo $order_id  ?>&seller=1"><?php  echo $row_req->title; ?></a></td>
                         <td><?php  echo $row_req->ordered_date;  ?></td>
                         <td><?php  echo $row_req->sold_price;  ?></td>
                         
                         <td>
                           <a href="http://sep.tagfie.com/Refund/refund_req?id=<?php echo $order_id  ?>&seller=1" class="btn btn-primary btn-sm" >Reply</a>
                         
                         <!--
                         <td>
                         	<div class="row">
                         		<div class="col-md-6 col-sm-6">
                         			<a href="http://sep.tagfie.com/UserAccount/=<?php // echo $deal_id;?>" class="btn btn-primary btn-sm"  >Edit</a> 
                         		</div>
                                <div class="col-md-6 col-sm-6" style="padding-left:0px">
                                 	<input type="button" class="btn btn-primary btn-sm" onclick=""
                                    id="$deal_id" value="Remove" /> 
                                </div>
                            </div>
                         </td>
                        -->
                        
                        
                        </tr>
                     <?php   } }?>
                    </table>
     			 </div> <!--opencases tab-->
                 
                 
                 
                 <div id="closedcases" class="tab-pane fade ">
                      <?php 
					  	if($ref_requests_closed == NULL){ ?>
							No Closed Cases to display.
					 <?php }
						 
						else{ ?>
						<table class="table table-striped table-bordered" style="margin-top:8px; width:900px;font-size:12px">
                        <th>Item</th><th>Order</th><th>Date</th><th>Price</th>
                        <th>Actions</th>
						  
                      <?php  
					  foreach($ref_requests_closed as $row_req){
						  $url_req=asset_url()."img/item_images/".$row_req->name;
						  $order_id = $row_req->order_id;
						  $req_id = $row_req->req_id; ?>
                        
                        <tr>
                         <td><img src="<?php echo $url_req?>" alt="i" height="80" width="80"></td>
                         <td><a href="http://sep.tagfie.com/Refund/refund_req?id=<?php echo $order_id  ?>&seller=1"><?php  echo $row_req->title; ?></a></td>
                         <td><?php  echo $row_req->ordered_date;  ?></td>
                         <td><?php  echo $row_req->sold_price;  ?></td>
                         
                         <td>
                           <a href="http://sep.tagfie.com/Refund/refund_req?id=<?php echo $order_id  ?>&seller=1" class="btn btn-primary btn-sm" >View</a>
                         
                         <!--
                         <td>
                         	<div class="row">
                         		<div class="col-md-6 col-sm-6">
                         			<a href="http://sep.tagfie.com/UserAccount/=<?php // echo $deal_id;?>" class="btn btn-primary btn-sm"  >Edit</a> 
                         		</div>
                                <div class="col-md-6 col-sm-6" style="padding-left:0px">
                                 	<input type="button" class="btn btn-primary btn-sm" onclick=""
                                    id="$deal_id" value="Remove" /> 
                                </div>
                            </div>
                         </td>
                        -->
                        
                        
                        </tr>
                     <?php   } }?>
                    </table>
     			 </div> <!--closedcases tab-->
              </div><!-- contentes for refu-->       
                    
                    
                     <script type="text/javascript">
							function removeDeal(bId) {
						          dealId=bId.slice(1);
		 						 if (confirm("Are you sure you want to remove the deal?")) {	
				 					 window.location.href="http://sep.tagfie.com/Upload/remove_deal?item="+itemId;
				 				 }
							  }
					 </script>
                    
                   
                   
                   
                  
                   
                   
                   
                   
                   
                   
                   
                   
                 </div>
                </div> <!--end of fifth row-->
      
    
    
    
    </div>
 </div><!--container-->
 
 
 
 
 
 
