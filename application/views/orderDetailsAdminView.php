    
    <div  class="container-fluid table-bordered" style="width:1300px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

        
        <?php
        if ($resultRecord != 0) {
            foreach ($resultRecord as $row) {
                ?>

           
<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Order Details </h3></div>
 <table width="900" class="table table-striped table-bordered" style="margin-top:10px; width:800px;font-size:12px">
  
          <tr height="40px"><th width="250px" align="left">Order ID</th><td><?php echo $row->order_id ?></td></tr>
          <tr height="40px"><th width="250px" align="left">Ordered Date</th> <td><?php echo $row->ordered_date ?></td></tr>
          <tr height="40px"><th width="250px" align="left">Sold Price</th> <td><?php echo $row->sold_price ?></td></tr>
          <tr height="40px"><th width="250px" align="left">Item ID</th> <td><?php echo $row->item ?></td></tr>
          <tr height="40px"><th width="250px" align="left">Order Status</th> 
                <td><?php $orderStatus = $row->order_status;
                            if ($orderStatus == 1) {
                                echo "Yet to be Shipped";
                            } else if ($orderStatus == 2) {
                                echo "Shipped";
                            } else if ($orderStatus == 3) {
                                echo "Delivered";
                            } else if ($orderStatus == 4) {
                                echo "Received";
                            }?></td> </tr>
          <tr height="40px"><th width="250px" align="left">Ship to Address</th><td><?php echo $row->ship_to_address ?></td></tr>
          <tr height="40px"><th width="250px" align="left">Quantity</th><td><?php echo $row->ordered_quantity ?></td></tr>
          <tr height="40px"><th width="250px" align="left">Details</th><td><?php //echo $row->order_id ?></td></tr>
                </table>
                    <?php
                }
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr>   
                <?php
            }
            ?>

			<div>
                    <!--a href="http://sep.tagfie.com/admin/viewProfile?uname=<?php echo $uname; ?>"><input type="button" value="Back to Profile"></a-->
                    <a href="/admin"><input type="button" value="Back to Admin"></a>
			</div>

</br>
</br>

           </div>
        </div>
</br>
</br>
