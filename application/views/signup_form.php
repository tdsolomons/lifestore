<div id="register_form">
 <?php
        ?>
        <h1>Register here.</h1>
        <?php
        
        echo form_open('login/create_member_validate');
        echo form_input('first_name', set_value('first_name','First Name'))."<br/><br/>";
        echo form_input('last_name', set_value('last_name','Last Name'))."<br/><br/>";
        echo form_input('email', set_value('email','Email'))."<br/><br/>";
        echo form_input('address', set_value('address','Address'))."<br/><br/>";
        echo form_input('street', set_value('street','Street'))."<br/><br/>";
        echo form_input('city', set_value('city','City'))."<br/><br/>";
        echo form_input('phone', set_value('phone','Phone'))."<br/><br/>";
        echo form_input('username', set_value('username', 'Username'))."<br/><br/>";
        echo form_password('upassword','', 'placeholder="Password" class="password" ')."<br/><br/>";
        echo form_password('password_confirm','', 'placeholder="Confirm Password" class="password" ')."<br/><br/><br/>";
        echo form_submit('submit', 'Ceate Account');
        
        ?>
        <a href="http://localhost/testLogin/index.php"><input type="button" value="Back"></a>
        <table></table>
        
        
        <?php echo validation_errors('<p class="error">'); ?>
        
</div>