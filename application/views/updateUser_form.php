
    <!--Login Form----------------------------------------------------------------------------------------> 
<div class="container table-bordered" style="width:800px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="width:600px;height:100px;margin-top:20px;text-align:center;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif"><h2>Update Account</h2>
           
        </div>
    
                <?php
            if ($resultUser != 0) {
                foreach ($resultUser as $row) {
		
                    		$fname = $row->first_name . "\n";
                    		$lname = $row->last_name . "\n";
                    		$email = $row->email . "\n";
                    		$address = $row->address . "\n";
                    		$street = $row->street . "\n";
                    		$city = $row->city . "\n";
							$username = $row->username . "\n";
                    		$phone = $row->phone . "\n";
					
				}
            }

            ?>
    
        <div class="container" style="margin-top:10px;width:400px;">
            <form role="form" action="http://sep.tagfie.com/UpdateDetails/update_member_validate" method="post">
           
                    <div class="form-group">
                     <label for="fname">First Name:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('first_name'); ?></span>
                     <input type="text" class="form-control"  name="first_name" id="fname" placeholder="" value="<?php echo set_value('first_name', $fname); ?>">
                    </div>
  
                   <div class="form-group">
                     <label for="lname">Last Name:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('last_name'); ?></span>
                     <input type="text" class="form-control"  name="last_name" id="lname" placeholder="" value="<?php echo set_value('last_name', $lname); ?>">
                    </div>
                     
                     <div class="form-group">
                     <label for="email">Email:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('email'); ?></span>
                     <input type="text" class="form-control"  name="email" id="email" placeholder="" value="<?php echo set_value('email', $email); ?>">
                    </div>
                     
                     <div class="form-group">
                     <label for="addrs"> AddressLine:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('address'); ?></span>
                     <input type="text" class="form-control"  name="address" id="address" placeholder="" value="<?php echo set_value('address', $address); ?>">
                    </div>
                     
                    <div class="form-group">
                     <label for="street">Street:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('street'); ?></span>
                     <input type="text" class="form-control"  name="street" id="mname" placeholder="" value="<?php echo set_value('street', $street); ?>">
                    </div>
                
                    <div class="form-group">
                     <label for="city">City:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('city'); ?></span>
                     <input type="text" class="form-control"  name="city" id="mname" placeholder="" value="<?php echo set_value('city', $city); ?>">
                    </div>
 
 					<div class="form-group">
                     <label for="phone">Phone:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('phone'); ?></span>
                     <input type="text" class="form-control"  name="phone" id="phone" placeholder="" value="<?php echo set_value('phone', $phone); ?>">
                    </div>
               

                    <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                    
                     <button type="submit" class="btn btn-default ">Update Account</button></br></br>
                     
                     <a href="http://sep.tagfie.com/Login/passwordChangeView"><button type="button" class="btn btn-default ">Change Password</button></a></br>
                         
                    </div>
                 
          </form>
             
        </div>
    
    
    </div>
 
