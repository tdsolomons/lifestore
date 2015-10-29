<div id="login_form">
        <?php
        if(isset($account_created)) { ?> 
        <h3> <?php echo $account_created; ?></h3>
        <?php 
        } else {
        ?>
        <h1>Login</h1>
        <?php
        }
   
        echo form_open('login/validate_credentials');
        $opts = 'placeholder="Username"';
        echo form_input('username', '', $opts) ."<br/><br/>";
        $optsPass = 'placeholder="Password"';
        echo form_password('upassword', '', $optsPass) ."<br/><br/><br/>";
        echo form_submit('submit', 'Login')."|";
        echo anchor('login/signup', 'Create Account');
        ?>
        <a href="http://localhost/testLogin/index.php/login/forgotPasswordView">Forgot Password?</a>
		<?php
		echo form_close();        
        ?>

		

        </div>