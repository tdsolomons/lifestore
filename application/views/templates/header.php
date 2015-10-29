<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LifeStore</title>
   <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/bootstrap.css" media="screen">
   <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/bootstrap.min.css">
   
   
    
   <link rel="stylesheet" href="<?php echo asset_url(); ?>css/styles.css" type="text/css">
   <link rel="stylesheet" href="<?php echo asset_url(); ?>css/styles.css" type="text/css">
   <link rel="stylesheet" href="<?php echo asset_url(); ?>css/notification_styles.css" type="text/css">



</head>
<!----------------------------------------------------------------------------------------------------------------->

<!--------------------------------------------------BODY------------------------------------------------------>
<body>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>


   <script type="text/javascript" >
     $(document).ready(function()
     {
     $("#notificationLink").click(function()
     {
     $("#notificationContainer").fadeToggle(300);
     $("#notification_count").fadeOut("slow");
     return false;
     });

     //Document Click hiding the popup 
     $(document).click(function()
     {
     $("#notificationContainer").hide();
     });

     //Popup on click
     $("#notificationContainer").click(function()
     {
     return false;
     });

     });
   </script>
 
 	<!--Page Header Image-------------------------------------------------------------------------------> 
    <div style="background-image:url(<?php echo asset_url();?>img/sdd.png);height:120px;">
      
        <div style="margin:30px auto auto 60px;width:260px;height:65px;position:absolute ; ">
        <a href="/"><img src="<?php echo asset_url();?>img/logo1.png" /></a></div>
     
    </div>
    
    
    
    <!--StatusBar---------------------------------------------------------------------------------------->
    <div class="container-fluid" style="padding:0px;">
    <nav class="navbar navbar-default" style="margin:0px;padding:0px;background-color:#ccc;color:#FFF;">
  <div class="container-fluid" >
    
    
    <!-- Brand and toggle get grouped for better mobile display -->
    <!--
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>
	 -->
    
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
      
      
      <ul class="nav navbar-nav" >
        <li ><a href="/"><span class="glyphicon glyphicon-home"></span> Home <span class="sr-only glyphicon glyphicon-home">(current)</span></a></li>
        <li ><a href="/Deals/all_deals">Deals</a></li>
      </ul>
      
      
      <!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      -->
      
      
      
      
      <ul class="nav navbar-nav navbar-right">
        
		<?php
		 $cartCount = 0;
		 if(isset($_SESSION['cart']))
		  $cartCount = count($_SESSION['cart']);
		 ?>  
		   <li><a href="<?php echo base_url();?>cart/cart"><span class="glyphicon glyphicon-shopping-cart"></span>        Shopping Cart 
              <?php 
                if ($cartCount > 0) {
                  echo '<span id="header_shopping_cart_count">' . $cartCount . '</span>';
                }
              ?>

              </a>
          </li>
		  
		
        
		
		
		
		<?php
        if(isset($_SESSION['username'])){
        ?>
          <li id="notification_li">
            <!--<span id="notification_count">3</span>-->
            <a href="#" id="notificationLink">Notifications</a>

            <div id="notificationContainer">
              <div id="notificationTitle">Notifications</div>
                <div id="notificationsBody" class="notifications">
            <table>

            <?php
               $this->load->database();
               if (isset($_SESSION['user_id'])) {  
                 $userId = $_SESSION['user_id'];
                    $sql = "SELECT *
                            FROM notification
                            WHERE to_user = '$userId'
                            ORDER BY noti_time DESC
                            ";

                   $query = $this->db->query($sql);
                   $items = $query->result();

                   foreach ($items as $noti_item) {
                      echo '<tr><td>
                      
                        <a href="'. base_url() . $noti_item->link .'">'. $noti_item->message . '</a>
                        <span class="noti_item_time">'. humanTiming($noti_item->noti_time) .' ago</span>
                      
                      </td></tr>' ;

                   }
              }
            ?>

            </table>
                </div>
              <div id="notificationFooter"><a href="#">See All</a></div>
            </div>

          </li>
          

          <li><a href="<?php echo base_url();?>messages/messages"><span class="glyphicon glyphicon-comment"></span> Messages</a></li>
          <li class="dropdown" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url();?>MyOrders">My Orders</a></li>
            <li><a href="<?php echo base_url();?>UserAccount">Sellings</a></li>
            <li><a href="<?php echo base_url();?>Profile/buyer/?buyer=<?php echo $_SESSION['user_id'] ?>">My Buyer Profile</a></li>
            <li><a href="<?php echo base_url();?>Profile/seller/?seller=<?php echo $_SESSION['user_id'] ?>">My Seller Profile</a></li>
             <li><a href="<?php echo base_url();?>Report">Reports</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url();?>UpdateDetails">Update account</a></li>
            <li role="separator" class="divider"></li>
          </ul>
        </li>
          
         <li ><p style="font-weight:500;font-style:oblique; margin-top:15px;color:#666">Logged in as <?php echo " ".$_SESSION['username']  ;?></p></li>
		  <li><a href="<?php echo base_url();?>Login/logout"> Logout</a></li>
		
		<?php
		}else {?>
		   <li><a href="<?php echo base_url();?>Login/login"> Login</a></li>
		   <?php }?>
		
		
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 </div>

    
    
    
    
    
    
    
    <!--StatusBar---------------------------------------------------------------------------------------->   
    
     
    