<html>
    <head>
        <title></title>
    </head>
    <body>

        <h3>My Orders</h3>

        <table class="">
            <tr>
                <th width="150px">Order ID</th>
                <th width="150px">Ordered Date</th>
                <th width="150px">Sold Price</th>
                <th width="150px">Item</th>
                <th width="150px">Order Status</th>
                <th width="150px">Buyer Status</th>
                <th width="150px">Ship to Address</th>
                <th width="150px">Quantity</th>
                <th width="150px">Details</th>
            </tr>

            <?php
            if ($result != 0) {
                foreach ($result as $row) {
                    ?><tr>
                        <td><?php echo $orderID = $row->order_id ?></td>
                        <td><?php echo $row->ordered_date ?></td>
                        <td><?php echo $row->sold_price ?></td>
                        <td><?php echo $row->item ?></td>
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
                        <td><?php
                            if ($row->order_status == 3) {
                                $id = $orderID;
                                ?>
                                <a href="http://sep.tagfie.com/myOrders/updateReceievedStatus?id=<?php echo $id; ?>"><input type="button" value="Received"></a>
                                <?php
                            } else {
                                
                            }
                            ?></td>
                        <td><?php echo $row->ship_to_address ?></td>
                        <td alilgn="right"><?php echo $row->ordered_quantity ?></td>
                        <?php  $id = $orderID; ?>
                        <td><a href="http://sep.tagfie.com/myOrders/orderDetails?id=<?php echo $id; ?>"><input type="button" value="Details"></a></td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr>   
            <?php
        }
        ?>
        <table>
            <tr align="right">
                <td><a href="http://localhost/testLogin/index.php"><input type='button' value='Back to Login'></a></td>
                <td><a href="http://localhost/testLogin/index.php"><input type='button' value='Notifications'></a></td>
                <td><a href="http://localhost/testLogin/index.php"><input type='button' value='Log out' onClick="<?php //session_destroy(); ?>"></a></td>
            </tr>
        </table>
    </table>



</body>


</html>
