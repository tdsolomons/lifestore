
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
                        <div class="page-header h4">Update items</div>
              
              <?php
              if (isset($itemData)) {
			   foreach ($itemData as $row) {
							$title=$row->title."\n";
                    		$desc=$row->description."\n";
                    		$shcos = $row->shipping_cost . "\n";
                    		$aqua = $row->available_quantity . "\n";
                    		
					
				} }
			  else{
				  $title="";
                    		$desc="";
                    		$shcos = "";
                    		$aqua = "";
			  				$price = "";
			  }
               ?>
               
               <div style="border:1px">
			    <span style="color:#F00;font-size:12px"<?php echo validation_errors(); ?></span>
               </div>
               <!---Add Form-------------------------->
               <div style="margin-top:10px;margin-left:30px;width:400px;height:200px">
                    <form role="form" action="http://sep.tagfie.com/Upload/update_item" method="post" enctype="multipart/form-data">
                        
                            <div class="form-group">
                             <label for="name">Name:</label>
                             <input type="text" class="form-control"  name="name" id="name" value="<?php echo set_value('name', $title);?>" placeholder="">
                            </div>
                    
                            
                             <div class="form-group">
                             <label for="name">Select a Category:</label>
							 <select class="form-control" id="category" name="category"  >
							 <?php
	                              foreach ($categories as $object) {
		  							 if($object->category_name == $category)
									  echo '<option selected="selected">' . $object->category_name . '</option>' ;
									 else
 	                        		  echo '<option>' . $object->category_name . '</option>' ;
								  }

                               ?>
                            </select>
                            </div>
                             
                             <div class="form-group">
                             <label for="desc">Description:</label>
                             <textarea class="form-control"  name="desc" id="desc"  placeholder=""><?php	echo set_value('desc',$desc);?> </textarea>
                            </div>
                            
                             <div class="form-group">
                             <label for="price">Price:</label>
                             <input type="text" class="form-control"  name="price" value="<?php	echo set_value('price',$price); ?>" id="price" placeholder="">
                            </div>
                             
                             <div class="form-group">
                             <label for="cost">Shipping Cost:</label>
                             <input type="text" class="form-control"  name="cost" id="cost" value="
							 <?php echo set_value('cost',$shcos); ?>" placeholder="">
                            
                            </div>             
                            
                             
                             
                             <div class="form-group">
                    		 <label for="cost">Condition:</label>
                       		 <select class="form-control" id="condition" name="condition">
                       		 <?php
	                              foreach ($conditions as $object) {
		  								 echo '<option>' . $object->condition_title . '</option>' ;
 	                              }

                               ?>
                        	 </select>
                      		 </div>
                             
                             
                             <div class="form-group">
                             <label for="cost">Available Quantity:</label>
                             <input type="text" class="form-control"  name="quantity" value="<?php	echo set_value('quantity',$aqua);?>" id="quantity" placeholder="">
                             </div>  
                            
                          <!--Subutton---------------------------------------------->
                         
                           <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                            
                                 <button type="submit" class="btn btn-primary ">Update</button>
                            </div>
                      
                  </form>
                 
                  <script>
				  CKEDITOR.replace('desc');
				

				
				
				  </script>
                 
        		</div>
               </div>
     </div>
 </div>
 
 
 
 
 
 
 