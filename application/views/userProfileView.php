    
    <div  class="container-fluid table-bordered" style="width:1300px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Orders made by <?php echo $_GET['uname']; ?> </h3></div>
 <table width="1250" class="table table-striped table-bordered" style="margin-top:10px; width:1000px;font-size:12px">
  
            <tr>
                <th width="113" height="48">Order ID</th>
                <th width="116">Ordered Date</th>
                <th width="110">Sold Price</th>
                <th width="122">Item</th>
                <th width="116">Order Status</th>
                <th width="159">Ship to Address</th>
                <th width="128">Quantity</th>
                <th width="100">Details</th>
            </tr>

            <?php
            if ($result != 0) {
                foreach ($result as $row) {
                    ?><tr>
                        <td width="113" align="center"><?php echo $orderID = $row->order_id ?></td>
                        <td width="116" align="center"><?php echo $row->ordered_date ?></td>
                        <td width="110" align="center"><?php echo $row->sold_price ?></td>
                        <td width="122" align="center"><?php echo $row->item ?></td>
                        <td><?php
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
                        <td width="159" align="center"><?php echo $row->ship_to_address ?></td>
                        <td width="128" align="center"><?php echo $row->ordered_quantity ?></td>
                        <?php $id = $orderID; ?>
                        <td width="100" align="center"><a href="http://sep.tagfie.com/admin/orderDetails?id=<?php echo $id; ?>"><input type="button" value="Details"></a></td>
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

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Items by <?php echo $_GET['uname']; ?>  </h3></div>
 <table width="1250" class="table table-striped table-bordered" style="margin-top:10px; width:1000px;font-size:12px">
  
            <tr>
                <th width="72" height="48">Item ID</th>
                <th width="118">Item Name</th>
                <th width="286">Description</th>
                <th width="95">Posted Date</th>
                <th width="100">Shipping Cost</th>
                <th width="97">Category</th>
                <th width="104">Availability</th>
                <th width="92">Details</th>
            </tr>

            <?php
            if ($sales != 0) {
                foreach ($sales as $row) {
                    if ($row->item_status == 1) {
                        ?><tr>
                            <td width="72" height="50px" align="center"><?php echo $id = $row->item_id ?></td>
                            <td width="118" height="50px"><?php echo $row->title ?></td>
                            <td width="286" height="50px"><?php echo $row->description ?></td>
                            <td width="95" height="50px" align="center"><?php echo $row->posted_date ?></td>
                            <td width="100" height="50px" align="center"><?php echo $row->shipping_cost ?></td>
                            <td width="97" height="50px" align="center"><?php echo $row->category ?></td>
                            <td width="104" height="50px" align="center"><?php echo $row->available_quantity ?></td>
                            <td width="92" height="50px" align="center"><a href="http://sep.tagfie.com/admin/viewItemDetails?id=<?php echo $id; ?>"><input type="button" value="Details"></a></td>
                            
                        <?php
                    }
                }
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr>   
                <?php
            }
            ?>

        </table>
</br>
</br>
            <div>
                   <a href="http://sep.tagfie.com/admin"><input type='button' value='Back to Home'></a>
                   <a href="http://sep.tagfie.com/Login/login"><input type='button' value='Notifications'></a>
            </div>

           </div>
        </div>

