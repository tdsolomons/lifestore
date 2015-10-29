<?php $connection = mysqli_connect("EMarketingPortal.db.11358052.hostedresource.com", "EMarketingPortal", "W43edfsa1%h", "EMarketingPortal"); ?>
    <div align="center" class="container table-bordered" style="margin-top:50px;margin-bottom:100px">
        
        <div align="center" class="" style="margin-top:20px;text-align:justify;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Order Details </h3></div>
<table  class="table table-striped table-bordered" style="margin-top:10px; margin-bottom:10px; font-size:12px">

			            
                <tr >
                <th >Order ID</th>
                <th >Ordered Date</th>
                <th >Sold Price</th>
                <th >Order</th>
                <th >Order Status</th>
                <th >Buyer Status</th>
                <th >Ship to Address</th>
                <th >Quantity</th>
                <th >Feedback</th>
                <th>Actions</th>
            	</tr>
                            

            <?php
            if ($result != 0) {
                foreach ($result as $row) {
                    ?>
        
                    
                    <tr>
                        <td align="center"><?php echo $orderID = $row->order_id ?></td>
                        <td><?php echo $row->ordered_date ?></td>
                        <td align="center"><?php echo $row->sold_price ?></td>
                        <td align="center">
						<?php  $id = $orderID; ?>
						<?php $itemId= $row->item; 
						               
                                        $query1a="select title from item where item_id ={$itemId}";
                                        $resultQuery1a=mysqli_query($connection,$query1a);
                                        $result1a=mysqli_fetch_assoc($resultQuery1a);
                                       ?>
						<a href="http://sep.tagfie.com/MyOrders/orderDetails?id=<?php echo $id; ?>"><?php echo $result1a["title"]; ?></a>
										
						</td>
                        
                        <td align="center"><?php
                            $orderStatus = $row->order_status;
                            if ($orderStatus == 1) {
                                echo "Shipped";
                            } else if ($orderStatus == 2) {
                                echo "Yet to be shipped";
                            } else if ($orderStatus == 3) {
                                echo "Delivered";
                            } else if ($orderStatus == 4) {
                                echo "Received";
                            }
                            ?></td>
                        <td align="center"><?php
                            if ($row->order_status == 3) {
                                $id = $orderID;
                                ?>
                                <a href="http://sep.tagfie.com/MyOrders/updateReceievedStatus?id=<?php echo $orderID; ?>"><input type="button" value="Received" class="btn btn-primary btn-sm"></a>
                                <?php
                            } else {
                                
                            }
                            ?></td>
                        <td><?php echo $row->ship_to_address ?></td>
                        <td align="center"><?php echo $row->ordered_quantity ?></td>
                       
                       
                    <td align="center"><a href="http://sep.tagfie.com/MyOrders/feedback?id=<?php echo $id; ?>"><input type="button" value="Feedback" class="btn btn-primary btn-sm"></a></td>
                    
                    <!--Actions column-->
                    <td align="center"><a href="http://sep.tagfie.com/Refund/refund_req?id=<?php echo $id; ?>"><input type="button" value="Request Refund" class="btn btn-primary btn-sm"></a>
                    </td>
                    
                    
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr>   
            <?php
        }
        ?>
       
    </table>
</div>  


<div align="center"  style="margin-top:20px;text-align:justify;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Auction Item Won </h3></div>
<table  class="table table-striped table-bordered" style="margin-top:10px; margin-bottom:10px; font-size:12px">

            <tr>

                <th >Item ID</th>
                <th >Item Title</th>
                <th>End Datetime</th>
                <th >Seller</th>
            </tr>

            <?php
			
            if ($auctionRecord != 0) {
                foreach ($auctionRecord as $row) {
                    ?><tr>
                        <td align="center"><?php echo $orderID = $row->item_id ?></td>
                        <td align="center"><?php echo $row->title ?></td>
                        <td align="center"><?php echo $row->end_datetime ?></td>
                        <td align="center"><?php echo $row->first_name ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr>   
            <?php
        }
        ?>
       
    </table>
 </div>   

<div align="center"  style="margin-top:20px;text-align:justify;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> My Followers </h3></div>
<table  class="table table-striped table-bordered" style="margin-top:10px; margin-bottom:10px; font-size:12px">

            <tr>

                <th >Name</th>
                <th >Username</th>
                <th >Email</th>
                <th >City</th>
            </tr>

            <?php
			
            if ($my_followers != 0) {
                foreach ($my_followers as $row) {
                    ?><tr>
                        <td align="center"><?php echo $row->first_name.' '.$row->last_name ?></td>
                        <td align="center"><?php echo $row->username ?></td>
                        <td align="center"><?php echo $row->email ?></td>
                        <td align="center"><?php echo $row->city ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr>   
            <?php
        }
        ?>
       
    </table>
</div>            

           
<div align="center"  style="margin-top:20px;text-align:justify;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Sellers I Follow </h3></div>
<table  class="table table-striped table-bordered" style="margin-top:10px; margin-bottom:10px; font-size:12px">

            <tr>

                <th >Name</th>
                <th >Username</th>
                <th >Email</th>
                <th >City</th>
            </tr>

            <?php
			
            if ($i_follow != 0) {
                foreach ($i_follow as $row) {
                    ?><tr>
                        <td align="center"><?php echo $row->first_name.' '.$row->last_name ?></td>
                        <td align="center"><?php echo $row->username ?></td>
                        <td align="center"><?php echo $row->email ?></td>
                        <td align="center"><?php echo $row->city ?></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr>   
            <?php
        }
        ?>
       
    </table>
</div>   
                    
                       
      <p><a href="http://sep.tagfie.com/welcome">
        <input type='button' value='Back to Home'>
        </a>
        
      </p>
      <p>&nbsp;</p>
	</div>

  </div>

  </div>
</div>
