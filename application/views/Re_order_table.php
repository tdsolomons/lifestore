<?php $connection = mysqli_connect("EMarketingPortal.db.11358052.hostedresource.com", "EMarketingPortal", "W43edfsa1%h", "EMarketingPortal"); ?>
    <div align="center" class="container table-bordered" style="margin-top:50px;margin-bottom:100px">
        
        <div align="center" class="" style="margin-top:20px;text-align:justify;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Re Order List </h3></div>
<table  class="table table-striped table-bordered" style="margin-top:10px; margin-bottom:10px; font-size:12px">

                <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Sub Category</th>
                <th>Current Availability</th>
                <th>Supplier Name</th>
                <th>Supplier Email</th>
                <th>To Confirm Order</th>
            	</tr>

            <?php
            if ($re_order != 0) {
                foreach ($re_order as $row) {
                    ?>
                    
                    <tr>
                    <td align="center"><?php echo $item_id = $row->item_id ?></td>
                    <td><?php echo $row->title ?></td>
                    <td align="center"><?php echo $row->category_name ?></td>
                    <td><?php echo $row->available_quantity ?></td>
                    <td align="center"><?php echo $row->supplier_name?></td>
                    <td align="center"><?php echo $row->supplier_email?></td>
                    <td align="center"><a href="http://sep.tagfie.com/Re_order/re_order_required?id=<?php echo $item_id; ?>"><input type="button" value="Confirm Order" class="btn btn-primary btn-sm"></a>
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
       
                       
      <p><a href="http://sep.tagfie.com/welcome">
        <input type='button' value='Back to Home'>
        </a>
        
      </p>
      <p>&nbsp;</p>
	</div>

  </div>

  </div>
</div>
