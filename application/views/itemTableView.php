
    
    <div  class="container-fluid table-bordered" style="width:1300px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="margin-top:20px;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h4> Item Details  </h4></div>
<table width="1170" class="table table-striped table-bordered" style="margin-top:8px; width:1200px;font-size:12px">
   
            <tr>
                <th width="82" height="48">Item ID</th>
                <th width="135">Item Name</th>
                <th width="313">Description</th>
                <th width="95">Posted Date</th>
                <th width="87">Shipping Cost</th>
                <th width="88">Category</th>
                <th width="84">Seller</th>
                <th width="85">Availability</th>
                <th width="89">Details</th>
                <th width="89">Remove</th>
            </tr>

            <?php
            if ($items != 0) {
                foreach ($items as $row) {
                    if ($row->item_status == 1) {
                        ?><tr>
                            <td width="82" height="50px" align="center"><?php echo $id = $row->item_id ?></td>
                            <td width="135" height="50px"><?php echo $row->title ?></td>
                            <td width="313" height="50px"><?php echo $row->description ?></td>
                            <td width="95" height="50px" align="center"><?php echo $row->posted_date ?></td>
                            <td width="87" height="50px" align="center"><?php echo $row->shipping_cost ?></td>
                            <td width="88" height="50px" align="center"><?php echo $row->category ?></td>
                            <td width="84" height="50px" align="center"><?php echo $row->seller ?></td>
                            <td width="85" height="50px" align="center"><?php echo $row->available_quantity ?></td>
                            <td width="89" height="50px" align="center">
                            <a href="http://sep.tagfie.com/admin/viewItemDetails?id=<?php echo $id; ?>"><input type="button" value="Details"></a></td>
                            <td width="98" height="50px" align="center">
                            <!--a href="http://sep.tagfie.com/admin/changeItemStatus?id=<?php //echo $id; ?>"><input type='button' value='Remove Item'></a></td-->
                            <input type="button" onclick="toRequestRemove()" value='Request to remove' class="de" id="t<?php echo $id ?>">
                        </td>
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
        
        <script type="text/javascript">
	 
	    function toRequestRemove() {
		  
		 // $(".de").click(function(event) {
          var item=event.target.id.slice(1);
		  //document.write(item);
		  if (confirm("Are you sure you want to reuest to remove item?")) {	
				  location.href='http://sep.tagfie.com/admin/changeItemStatus?id=' + item ;
				  }
		//  });  
	  }
	  
	 </script>
<div>
    <a href="http://sep.tagfie.com/admin"><input type='button' value='Back to Admin'></a>
</div>
           </div>
        </div>

