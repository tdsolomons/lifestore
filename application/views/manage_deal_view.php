
  

   
   <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
   <link href="<?php echo asset_url(); ?>css/bEdit.css" rel="stylesheet">
   <link href="<?php echo asset_url(); ?>css/ratingsStyle.php" rel="stylesheet" media="screen">
   <link rel="stylesheet" href="css/style.css" type="text/css">
   <link rel="stylesheet" href="test.css" type="text/css">


	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/rate_by_seller.js"></script>
 


<div class="container" >
    
 <div class="row" style="min-height:1800px">
     
     <div class="row">
      <div class="col-md-12" style="padding-left:100px">
     	<div class="panel" style="background-color:#EBEBEB;padding-left:10px;width:700px;">
        	<h4>Manage Item Deals</h4> 
        </div>             
      </div> 
     </div>     
           
  
  
  
     <div class="row"> 
  	  <?php if(isset($deal)){ 
	  			foreach($deal as $de) {?>
      <div class="col-md-1" style="padding-left:100px">
        <img src="<?php $de->asset_url()."img/item_images/".$de->name?>" >
      </div> 
     
      <div class="col-md-2">
        <table>
         <tr><?php $de->title?></tr>
         <tr><?php ?></tr>
         <tr></tr>
        </table>
      </div>               
      <?php }}?>
     </div> 
    
    
    
 
    
    
 </div>
</div><!--container-->
 
 
 
 
 
 
