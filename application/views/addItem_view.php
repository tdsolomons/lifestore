
   
   <link href="<?php echo asset_url(); ?>css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="css/style.css" type="text/css">
   <link rel="stylesheet" href="test.css" type="text/css">






<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url(); ?>ckeditor/ckeditor.js"></script>
 
 
 




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
                    <form role="form" action="http://sep.tagfie.com/Upload/add_item" method="post" enctype="multipart/form-data">
                        
                            <div class="form-group">
                             <label for="name">Name:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('name'); ?></span>
                             <input type="text" class="form-control"  name="name" id="name" value="<?php echo set_value('name'); ?>" placeholder="">
                           
                            </div>
                    
                            
                             <div class="form-group">
                             <label for="name">Select a Category:</label>
							 <select class="form-control" id="category" name="category" selec >
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
                             <label for="price">Price:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('price'); ?></span>
                             <input type="text" class="form-control"  name="price" value="<?php echo set_value('price'); ?>" id="price" placeholder="">
                            </div>
                             
                             <div class="form-group">
                             <label for="cost">Shipping Cost:</label>
                             <span style="color:#F00;font-size:12px"><?php echo form_error('cost'); ?></span>
                             <input type="text" class="form-control"  name="cost" id="cost" value="<?php echo set_value('cost'); ?>" placeholder="">
                            </div>             
                            
                             
                             
                             <div class="form-group">
                    		 <label for="cost">Condition:</label>
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
                             
                             <div class="form-group">
                              <div class="col-md-12" style="padding-left:0px">
                                <label >Allow Offers:</label>
                              </div>
                              <div class="col-md-12" style="padding-left:0px">
                             
                               <div class=" radio-inline">
 								 <label class="radio-inline"><input type="radio" name="optradio" value="1">Yes</label>
							   </div>
							   <div class=" radio-inline">
  								 <label class="radio-inline"><input type="radio" name="optradio" checked="checked" value="0">No</label>
							   </div>
                             
                              </div>  
                             </div>
                            
                          
                          
                             
                            
                         
                         
                         
                         
                          <!--Subutton---------------------------------------------->
                         
                           <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:40px;" >
                            
                                 <button type="submit" class="btn btn-primary ">Post</button>
                            </div>
                      
                      
                      
                      
                      
                      
                  </form>
                          
                          
                 <script>
				  CKEDITOR.replace('desc');
				  
                  
                  
                  
                  </script>
                 
                           
                           
                           
                           
                           
                           
                         
             
        </div>
               
               
               
               
               
              
              
               </div>
               
     </div>
 
 </div>
 
 
 
 
 
 
 