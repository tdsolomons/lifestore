<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<html>
    <head>
    	<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/styles.css">
        <title>E Marketing Portal</title>
    </head>
    <body>
    	
    	<div id="site_wrap">
	    	<div id="site_top_bar">
	    		<ul id="site_top_left_menu"> 
	    			<li><a href="<?php echo base_url() ?>"><img src="<?php echo asset_url(); ?>img/house4.png" />Home</a></li>
	    			<li><a href="">Sell</a></li>
	    		</ul>

	    		<ul id="site_top_right_menu">
	    			<?php
	    				//TODO::Check for login
	    				echo '<li><a href="' . base_url() . 'messages/messages"><img src="' . asset_url() . 'img/message.png" />
	    								Messages
								</a><span id="header_messages_count"></span></li>';


	    				$cartCount = 0;
	    				
	    				if(isset($_SESSION['cart']))
	    					$cartCount = count($_SESSION['cart']);
	    				echo '<li><a href="' . base_url() . 'cart/cart"><img src="' . asset_url() . 'img/cart.png" />
	    								Shopping Cart
								</a><span id="header_shopping_cart_count">'. $cartCount .'</span></li>';
	    			?>
	    			
	    			<li><a href="<?php echo base_url() ?>login/" >Login</a></li>
	    			<li><a href="<?php echo base_url() ?>login/register">Register</a></li>
	    		</ul>	
	    	</div>
    	<a id="header_logo" href="<?php echo base_url(); ?>">
    		<img width="120" height="50" src="<?php echo asset_url() . 'img/logo.png'; ?>"/>
    	</a>