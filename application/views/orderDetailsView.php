<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <h3>Order Details</h3>
        <?php
        if ($resultRecord != 0) {
            foreach ($resultRecord as $row) {
                ?>

                <table class="">
                    <tr height="40px"><td><th width="250px" align="left">Order ID</th></td> <td><?php echo $row->order_id ?></td> </tr>
                    <tr height="40px"><td><th width="250px" align="left">Ordered Date</th></td> <td><?php echo $row->ordered_date ?></td> </tr>
                    <tr height="40px"><td><th width="250px" align="left">Sold Price</th></td> <td><?php echo $row->sold_price ?></td> </tr>
                    <tr height="40px"><td><th width="250px" align="left">Item ID</th></td> <td><?php echo $row->item ?></td> </tr>
                    <tr height="40px"><td><th width="250px" align="left">Order Status</th></td> 
                        <td><?php $orderStatus = $row->order_status;
                            if ($orderStatus == 1) {
                                echo "Shipped";
                            } else if ($orderStatus == 2) {
                                echo "Yet to be shipped";
                            } else if ($orderStatus == 3) {
                                echo "Delivered";
                            } else if ($orderStatus == 4) {
                                echo "Received";
                            }?></td> </tr>
                    <tr height="40px"><td><th width="250px" align="left">Ship to Address</th></td> <td><?php echo $row->ship_to_address ?></td> </tr>
                    <tr height="40px"><td><th width="250px" align="left">Quantity</th></td> <td><?php echo $row->ordered_quantity ?></td> </tr>
                    <tr height="40px"><td><th width="250px" align="left">Details</th></td> <td><?php //echo $row->order_id ?></td> </tr>
                    
                    <tr height="40px">
                        <td width="250px" align="center"><a href="http://localhost/testLogin/index.php/myOrders"><input type="button" value="Back to Orders"></a></td>
                        <td width="250px" align="center"><a href="http://localhost/testLogin/index.php/myOrders"><input type="button" value="Messages"></a></td>
                        <td width="250px" align="center"><a href="http://localhost/testLogin/index.php/myOrders"><input type="button" value="Remind Seller"></a></td>
                        <td width="250px" align="center"><a href="http://localhost/testLogin/index.php/myOrders"><input type="button" value="Cart"></a></td>
                        <td width="250px" align="center"><a href="http://localhost/testLogin/index.php"><input type="button" value="Log Out"></a></td>
                    </tr>
                </table>
                    <?php
                }
            } else {
                ?>
                <tr><h4>There are no records to show!</h4></tr>   
                <?php
            }
            ?>

</body>
</html>
