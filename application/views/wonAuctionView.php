<?php $connection = mysqli_connect("EMarketingPortal.db.11358052.hostedresource.com", "EMarketingPortal", "W43edfsa1%h", "EMarketingPortal"); ?>
    <div align="center" class="container table-bordered" style="width:2000px;margin-top:50px;margin-bottom:100px">
        
        <div align="center" class="container" style="width:2000px;margin-top:20px;text-align:justify;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">

<div class="panel" style="width:700px;margin-bottom:20px;"><h3> Auction Item Won 
</h3>
</div>
<table width="1250" class="table table-striped table-bordered" style="margin-top:10px; margin-bottom:10px; width:1200px;font-size:12px">

            <tr height="20px">

                <th width="112">Item ID</th>
                <th width="112">Item Title</th>
                <th width="184">End Datetime</th>
                <th width="101">First Time</th>
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
<div>
              
      <p><a href="http://sep.tagfie.com/welcome">
        <input type='button' value='Back to Home'>
        </a>
        
      </p>
      <p>&nbsp;</p>
	</div>

  </div>
</div>
