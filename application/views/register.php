
 
    <!--Login Form----------------------------------------------------------------------------------------> 
<div class="container table-bordered" style="width:800px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="width:200px;margin-top:20px;text-align:center;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
           <div class="h2">Register
           </div>
        </div>
    
        <div class="container" style="margin-top:10px;width:400px;">
            <form role="form" action="http://sep.tagfie.com/login/create_member_validate" method="post">
                
                    <div class="form-group">
                     <label for="fname">First Name:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('first_name'); ?></span>
                     <input type="text" class="form-control"  name="first_name" id="fname" placeholder="" value="<?php echo set_value('first_name'); ?>">
                    </div>
  
                   <div class="form-group">
                     <label for="lname">Last Name:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('last_name'); ?></span>
                     <input type="text" class="form-control"  name="last_name" id="lname" placeholder="" value="<?php echo set_value('last_name'); ?>">
                    </div>
                     
                     <div class="form-group">
                     <label for="email">Email:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('email'); ?></span>
                     <input type="text" class="form-control"  name="email" id="email" placeholder="" value="<?php echo set_value('email'); ?>">
                    </div>
                     
                     <div class="form-group">
                     <label for="addrs"> Address:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('address'); ?></span>
                     <textarea class="form-control"  name="address" id="address" placeholder="" value="<?php echo set_value('address'); ?>"></textarea>
                    </div>
                     
                    <div class="form-group">
                     <label for="street">Street:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('street'); ?></span>
                     <input type="text" class="form-control"  name="street" id="mname" placeholder="" value="<?php echo set_value('street'); ?>">
                    </div>
                
                    <div class="form-group">
                     <label for="city">City:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('city'); ?></span>
                     <input type="text" class="form-control"  name="city" id="mname" placeholder="" value="<?php echo set_value('city'); ?>">
                    </div>
                    
                
                	<div class="form-group">
                     <label for="phone">Phone:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('phone'); ?></span>
                     <input type="text" class="form-control"  name="phone" id="phone" placeholder="" value="<?php echo set_value('phone'); ?>">
                    </div>
                
                <div class="form-group">
                     <label for="username">User Name:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('username'); ?></span>
                     <input type="text" class="form-control"  name="username" id="username" placeholder="" value="<?php echo set_value('username'); ?>">
                    </div>
                    
                    
                     <div class="form-group">
                     <label for="upassword">Password:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('upassword'); ?></span>
                     <input type="password" class="form-control"  name="upassword" id="password" placeholder="" value="<?php echo set_value('upassword'); ?>">
                    </div>             
                    
                     <div class="passC">
                     <label for="passC">Confirm Password:</label>
                     <span style="color:#F00;font-size:12px"><?php echo form_error('password_confirm'); ?></span>
                     <input type="password" class="form-control"  name="password_confirm" id="passCnfrm" placeholder="" value="<?php echo set_value('password_confirm'); ?>">
                    </div>
        
                    <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                    
                         <button type="submit" class="btn btn-default ">Register</button>
                    </div>
                 
          </form>
             
        </div>
    
    
    </div>
 