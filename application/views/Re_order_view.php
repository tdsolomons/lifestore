
    <!--Login Form----------------------------------------------------------------------------------------> 
<div class="container table-bordered" style="width:800px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="width:600px;height:100px;margin-top:20px;text-align:center;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif"><h2>Re Order Notice</h2>
           
        </div>
    
                <?php
            if ($re_order_required != 0) {
                foreach ($re_order_required as $row) {
		
                    		$item_id = $row->item_id . "\n";
                    		$item_name = $row->title . "\n";
                    		$category = $row->category_name . "\n";
                    		//$quantity = $row->available_quantity . "\n";
                    		$supplier_name = $row->supplier_name . "\n";
                    		$supplier_email = $row->supplier_email . "\n";
					
				}
            }

            ?>
    
        <div class="container" style="margin-top:10px;width:400px;">
            <form role="form" action="http://sep.tagfie.com/Re_order/re_order_validate" method="post">
           
                    <div class="form-group">
                     <label for="fname">Item Id:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('item_id'); ?></span>
                     <input type="text" class="form-control"  name="item_id" id="item_id" placeholder="" value="<?php echo set_value('item_id', $item_id); ?>">
                    </div>
  
                   <div class="form-group">
                     <label for="lname">Item Name:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('item_name'); ?></span>
                     <input type="text area" class="form-control"  name="item_name" id="item_name" placeholder="" value="<?php echo set_value('item_name', $item_name); ?>">
                    </div>
                     
                     <div class="form-group">
                     <label for="email">Item Sub Category:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('category_name'); ?></span>
                     <input type="text" class="form-control"  name="category_name" id="category_name" placeholder="" value="<?php echo set_value('category_name', $category); ?>">
                    </div>
                     
                     <div class="form-group">
                     <label for="addrs"> Requirement:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('requirement'); ?></span>
                     <input type="text" class="form-control"  name="requirement" id="requirement" placeholder="Enter Required Quantity" value="<?php echo set_value('requirement'); ?>">
                    </div>
                     
                    <div class="form-group">
                     <label for="street">Supplier Name:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('supplier_name'); ?></span>
                     <input type="text" class="form-control"  name="supplier_name" id="supplier_name" placeholder="Enter Supplier name" value="<?php 
					  if($supplier_name!=null){echo set_value('supplier_name', $supplier_name);}else{echo set_value('supplier_name');} ?>">
                    </div>
                
                    <div class="form-group">
                     <label for="city">Supplier Email:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('supplier_email'); ?></span>
                     <input type="text" class="form-control"  name="supplier_email" id="supplier_email" placeholder="Enter Supplier Email" value="<?php if($supplier_name!=null){echo set_value('supplier_email', $supplier_email);} else{echo set_value('supplier_email');} ?>">
                    </div>

                    <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                    
                     <button type="submit" class="btn btn-default ">Send Mail</button></br></br>
                     
                     <a href="http://sep.tagfie.com/Re_order"><button type="button" class="btn btn-default ">Cancel</button></a></br>
                         
                    </div>
                 
          </form>
             
        </div>
    
    
    </div>
 
