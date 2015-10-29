
   
   <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css" type="text/css">
   <link rel="stylesheet" href="test.css" type="text/css">





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
 
 





<!--Contents------------------------------------------------------------------> 
<div class="container">

   
    
    
    
    <div class="row"  style="min-height:800px;">
               <!--Side Bar----------------------->
               <div class="col-md-6" style="min-height:800px;background-color:#fff;box-shadow:10px;margin-left:0px;width:180px;">
               </div>
               
               
               <!--Main Content----------------------->
               <div class="col-lg-10" style="min-height:800px;">
                        <div class="page-header h4">Add items</div>
                             
               <div style="border:1px">
			  
               </div>
               <!---Add Form-------------------------->
               <div style="margin-top:10px;margin-left:30px;width:400px;height:200px">
                    <form role="form" action="http://sep.tagfie.com/Upload/add_auction_item" method="post" enctype="multipart/form-data">
                        
                            <div class="form-group">
                             <label for="name">Name:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('name'); ?></span>
                             <input type="text" class="form-control"  name="name" id="name" value="<?php echo set_value('name'); ?>" placeholder="">
                            </div>
                    
                            
                             <div class="form-group">
                             <label for="name">Select a Category:</label>
							 <select class="form-control" id="category" name="category" >
							 <?php
	                              foreach ($categories as $object) {
		  							 printf('<option value="%s" %s>%s</option>', $object->category_name, set_select('category', $object->category_name), $object->category_name);
 	                              }

                               ?>
                            </select>
                            </div>
                             
                             
                             
                             <div class="form-group">
                             <label for="desc">Description:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('desc'); ?></span>
                             <textarea class="form-control"  name="desc" id="desc"  placeholder=""><?php echo set_value('desc'); ?></textarea>
                            </div>
                            
                            
                             <div class="form-group">
                             <label for="s_price">Starting Price:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('s_price'); ?></span>
                             <input type="text" class="form-control"  name="s_price" value="<?php echo set_value('s_price'); ?>" id="s_price" placeholder="">
                            </div>
                             
                             <div class="form-group">
                             <label for="minBid">Minimum Bidding Amount:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('minBid'); ?></span>
                             <input type="text" class="form-control"  name="minBid" value="<?php echo set_value('minBid'); ?>" id="minBid" placeholder="">
                            </div>
                            
                            <div class="form-group">
                             <label for="e_date">End date:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('e_date'); ?></span>
                             <input type="text" class="form-control"  name="e_date" value="<?php echo set_value('e_date'); ?>" id="e_date" placeholder="">
                            </div>
                            
                            
                             <div class="form-group">
                             <label for="cost">Shipping Cost:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('cost'); ?></span>
                             <input type="text" class="form-control"  name="cost" id="cost" value="<?php echo set_value('cost'); ?>" placeholder="">
                            </div>             
                            
                             
                             
                             <div class="form-group">
                    		 <label for="condition">Condition:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('condition'); ?></span>
                       		 <select class="form-control" id="condition" name="condition">
                       		 <?php
	                              foreach ($conditions as $object) {
		  								  printf('<option value="%s" %s>%s</option>', $object->condition_title, set_select('condition', $object->condition_title), $object->condition_title);
 	                              }

                               ?>
                        	 </select>
                      		 </div>
                             
                             
                             <div class="form-group">
                             <label for="cost">Available Quantity:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('quantity'); ?></span>
                             <input type="text" class="form-control"  name="quantity" value="<?php echo set_value('quantity'); ?>" id="quantity" placeholder="">
                             </div>  
                            
                            
                          
                          
                             
                            
                         
                         
                         
                         
                          <!--Subutton---------------------------------------------->
                         
                           <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                            
                                 <button type="submit" class="btn btn-primary ">Post</button>
                            </div>
                      
                      
                      
                      
                      
                      
                  </form>
                          
                          
                
                 
                           
                           
                           
                           
                           
                           
                         
             
        </div>
               
               
               
               
               
              
              
               </div>
               
     </div>
 
 </div>
 
 
 
 
 
 
 