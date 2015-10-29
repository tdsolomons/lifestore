
    
    <div  class="container-fluid table-bordered" style="width:1300px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
 
 <div class="panel" style="width:700px;margin-bottom:20px;"><h3> User Details  </h3></div>
 <table width="1250" class="table table-striped table-bordered" style="margin-top:8px; margin-left:0px; padding-left:0px; font-size:12px">
               
            <tr>
                <th width="132" height="39">First Name</th>
                <th width="151">Last Name</th>
                <th width="181">Email</th>
                <th width="170">Address</th>
                <th width="70">Phone</th>
                <th width="95">Go to Profile</th>
          </tr>

            <?php
            if ($users != 0) {
                foreach ($users as $row) {
					//$uid = $row->user_id;
                    if ($row->user_status == 1) {
                        ?>
                        <tr>
                            <?php $uname = $row->username ?>
                            <td width="132" height="50px"><?php echo $row->first_name ?></td>
                            <td width="151" height="50px"><?php echo $row->last_name ?></td>
                            <td width="181" height="50px"><?php echo $row->email ?></td>
                            <td width="170" height="50px"><?php echo $row->address . "," . $row->street . "," . $row->city ?></td>
                            <td width="70" height="50px" align="center"><?php echo $row->phone ?></td>
                            <td width="95" height="50px" align="center"><a href="http://sep.tagfie.com/admin/viewProfile?uname=<?php echo $uname; ?>"><input type="button" value="Go to profile"></a></td>
                        </tr>

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
        <div>
                        <a href="http://sep.tagfie.com/admin"><input type='button' value='Back to Home'></a> </b></b></b></b>
                    <a href="http://sep.tagfie.com/admin/getUsersListFull"><input type='button' value='View All Users'></a>

        </div>
        
        </br>
        </br>

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Item Details  </h3></div>
<table width="1250" class="table table-striped table-bordered" style="margin-top:8px; width:1200px;font-size:12px">
               
        <tr>
            <th width="94" height="43" align="center">Item ID</th>
            <th width="124" align="center">Item Name</th>
            <th width="199" align="center">Description</th>
            <th width="69" align="center">Posted Date</th>
            <th width="83" align="center">Shipping Cost</th>
            <th width="82" align="center">Category</th>
            <th width="63" align="center">Seller</th>
            <th width="69" align="center">Availability</th>
            <th width="77" align="center">Details</th>
        </tr>

        <?php
        if ($items != 0) {
            foreach ($items as $row) {
                if ($row->item_status == 1) {
                    ?><tr>
                        <td width="94" height="50px" align="center"><?php echo $id = $row->item_id ?></td>
                        <td width="124" height="50px"><?php echo $row->title ?></td>
                        <td width="199" height="50px"><?php echo $row->description ?></td>
                        <td width="69" height="50px" align="center"><?php echo $row->posted_date ?></td>
                        <td width="83" height="50px" align="center"><?php echo $row->shipping_cost ?></td>
                        <td width="82" height="50px" align="center"><?php echo $row->category ?></td>
                        <td width="63" height="50px" align="center"><?php echo $row->seller ?></td>
                        <td width="69" height="50px" align="center"><?php echo $row->available_quantity ?></td>
                        <td width="77" height="50px" align="center"><a href="http://sep.tagfie.com/admin/viewItemDetails?id=<?php echo $id; ?>"><input type="button" value="Details"></a></td>
                    </tr>

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

 <div>
                        <a href="http://sep.tagfie.com/admin"><input type='button' value='Back to Home'></a> </b></b></b></b>
                   <a href="http://sep.tagfie.com/admin/getItemsListFull"><input type='button' value='View All Items'></a>

        </div>
        </br>
        </br>

       </div>
        </div>

