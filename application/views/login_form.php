<div id="login_form">
        <?php
        if(isset($account_created)) { ?> 
        <h3> <?php echo $account_created; ?></h3>
        <?php 
        } else {
        ?>
        <h1>Login, please.</h1>
        <?php
        }
        ?>
        
        <?php
        
        echo form_open('login/validate_credentials');
        echo form_input('username', 'Username') ."<br/><br/>";
        echo form_password('upassword', 'Password') ."<br/><br/><br/>";
        echo form_submit('submit', 'Login')."|";
        echo anchor('login/signup', 'Create Account');
        echo form_close();
                
        ?>

        </div>