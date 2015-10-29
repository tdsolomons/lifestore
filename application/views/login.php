
 
 
    <!--Login Form----------------------------------------------------------------------------------------> 
<div class="container table-bordered" style="width:800px;height:400px;margin-top:50px;margin-bottom:100px">
        
        <div class="container" style="width:600px;height:100px;margin-top:20px;text-align:center;font-family:'Trebuchet MS', Arial, Helvetica, sans-serif">
           <div class="h2"><?php
        if(isset($account_created)) { ?> 
        <?php echo $account_created; ?>
        <?php 
        } else {
        ?>
        <h1>Login</h1>
        <?php
        }
        ?>
           </div>
        </div>
    
        <div class="container" style="margin-top:10px;width:400px;height:200px">
        <form role="form" action="http://sep.tagfie.com/Login/validate_credentials" method="post">
                
        <div class="form-group">
        <label for="username">Username:</label>
        <span style="color:#F00;font-size:12px"><?php echo form_error('username'); ?></span>
        <input type="text" class="form-control"  name="username" id="username" placeholder="" value="<?php echo set_value('username'); ?>">
        </div>
                    
        <div class="form-group">
        <label for="upassword">Password:</label>
        <span style="color:#F00;font-size:12px"><?php echo form_error('password'); ?></span>
        <input type="password" class="form-control"  name="password" id="password" placeholder="" value="<?php echo set_value('password'); ?>">
        </div>  
                               
          <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                  <button type="submit" class="btn btn-default ">Login</button>
          </div>
              
              
              <div class="form-group col-md-8" style="padding-left:0px;margin-left:0px;margin-top:10px;" >
                 Not a member?   
                         <a href="/Login/signup"><button type="button" class="btn btn-default ">Register</button></a>
              </div>
              
              <div>
              	       <a href="http://sep.tagfie.com/Login/forgotPasswordView">Forgot Password?</a>
              </div>
              
              
          </form>
             
        </div>
    
    
    </div>
 