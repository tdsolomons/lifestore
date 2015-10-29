    
    <div  class="container-fluid table-bordered" style="width:1300px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

        <?php
        if ($itemRecord != 0) {
            foreach ($itemRecord as $row) {
                ?>

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Item Details  </h3></div>
 <table width="900" class="table table-striped table-bordered" style="margin-top:10px; width:800px;font-size:12px">
  
                    <tr height="40px">
                    <th width="301" align="left">Item ID</th> <td width="887"><?php echo $row->item_id ?></td> </tr>
                    <tr height="40px">
                    <th width="301" align="left">Item name</th> <td><?php echo $row->title ?></td> </tr>
                    <tr height="40px">
                    <th width="301" align="left">Description</th> <td><?php echo $row->description ?></td> </tr>
                    <tr height="40px">
                    <th width="301" align="left">Posted Date</th> <td><?php echo $row->posted_date ?></td> </tr>
                    <tr height="40px">
                    <th width="301" align="left">Shipping Cost</th> <td><?php echo $row->shipping_cost ?></td> </tr>
                    <tr height="40px">
                    <th width="301" align="left">Category</th> <td><?php echo $row->category ?></td> </tr>
                    <tr height="40px">
                    <th width="301" align="left">Seller</th> <td><?php echo $row->seller ?></td> </tr>
                    <tr height="40px">
                    <th width="301" align="left">Availability</th> <td><?php echo $row->available_quantity ?></td> </tr>
                    <tr height="40px">
                    <th width="301" align="left">Condition</th> <td><?php echo $row->condition_type ?></td> </tr>
                    
                </table>
                <?php
            }
        } else {
            ?>
        <tr><h4>There is no item by that ID!</h4></tr>   
    <?php
}
?>
</br>
</br>
			<div> 
                    <a href="http://sep.tagfie.com/admin/getItemsListFull"><input type="button" value="Back to Items"></a></b></b>
                    <a href="http://sep.tagfie.com/admin"><input type="button" value="Back to Admin"></a></b></b>
			</div>
</br>
</br>

           </div>
        </div>
</br>
</br>

