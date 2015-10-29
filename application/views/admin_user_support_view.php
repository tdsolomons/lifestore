<div class="container-fluid"> 
 <!--HEADING-->
 <div class="row">
  <div class="col-md-3">
 	<h2>User Support</h2>
  </div>
 </div>
 
 <!--REFUND REQUESTS------>
 <div class="row">
  <div class="col-md-8">
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
                         <td><a href="http://sep.tagfie.com/Refund/admin_req?id=<?php echo $order_id  ?>&seller=1"><?php  echo $row_req->title; ?></a></td>
                         <td><?php  echo $row_req->ordered_date;  ?></td>
                         <td><?php  echo $row_req->sold_price;  ?></td>
                         
                         <td>
                           <a href="http://sep.tagfie.com/Refund/admin_req?id=<?php echo $order_id  ?>&seller=1" class="btn btn-primary btn-sm" >Reply</a>
                         
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
                         <td><a href="http://sep.tagfie.com/Refund/admin_req?id=<?php echo $order_id  ?>&seller=1"><?php  echo $row_req->title; ?></a></td>
                         <td><?php  echo $row_req->ordered_date;  ?></td>
                         <td><?php  echo $row_req->sold_price;  ?></td>
                         
                         <td>
                           <a href="http://sep.tagfie.com/Refund/admin_req?id=<?php echo $order_id  ?>&seller=1" class="btn btn-primary btn-sm" >View</a>
                         
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
  
  </div>
 </div>




</div>
