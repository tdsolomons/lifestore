<?php
?>
<html>
<head>
   
   <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/bootstrap.min.css">

<head>
<body>
<div class="panel" style="width:700px;margin-bottom:20px;"><h4> Bid Details  </h4></div>
<table width="1170" class="table table-striped table-bordered" style="margin-top:8px; width:1200px;font-size:12px">
   <tr>
                 <th width="250px" align="left">Bidder</th> 
                 <th width="250px" align="left">Amount</th> 
                 <th width="250px" align="left">Bid Time</th>
                 </tr>
                
        <?php
        if ($bidInfo!= 0) {
            foreach ($bidInfo as $row) {
                ?>

              <tr>
                 <td><?php echo $row->first_name ?></td> 
            	<td><?php echo $row->amount?></td> 
                <td><?php echo $row->bid_datetime ?></td> 
                 </tr>
                
               
                <?php
            }
        } else {
            ?>
        <tr><h4>There is no b</h4></tr>   
    <?php
}
?>
    </table>
</body>
</html>