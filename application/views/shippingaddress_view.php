<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
 <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script src="<?php echo asset_url() ?>js/shippingAddress.js"></script>

<h1>Shipping Address</h1>
<div>
<h3>Ship To :</h3>

<?php if(isset($_SESSION['shipping_address'])) { 
$shipping_address = $_SESSION['shipping_address'];
	
	?>

    <span style="font-weight:bold;"><?php echo $shipping_address['f_name']; ?></span>
    
    <label style="margin-left:100px;"><input type="checkbox" id="change_address" class="change_address"/>Change Shipping Address</label>
    <br />
    <span><?php echo $shipping_address['address1']; ?></span><br />
    <span><?php echo $shipping_address['address2']; ?></span><br/>
    <span><?php echo $shipping_address['city']; ?></span><br/>

<?php }else{ ?>
 <span style="font-weight:bold;"><?php echo $f_name.' '.$l_name ?></span>

 <label style="margin-left:100px;"><input type="checkbox" id="change_address" class="change_address"/>Change Shipping Address</label>
 <br />
    <span><?php echo $address?></span><br />
    <span><?php echo $street ?></span><br/>
    <span><?php echo $city ?></span><br/>
 <?php } ?>   
  </div>
  </br>
  </br
  ></hr>
 <div style="  margin-bottom:30px; display::none;" id="new_add">
  <form method="post" action="<?php echo base_url() ;?>cart/shipping_address" >
 	<span>Name *</span><input style="margin-left: 70px;" type="text" name='name' id="name"/><span style="color:red; margin-left:10px;"></span><br/>
    <span style="margin-top:20px;">Address Line1 *</span><input style="margin-top:20px; margin-left: 15px;" type="text" name="address1" id="aline1"/><span style="color:red; margin-left:10px;"></span><br/>
    <span style="margin-top:20px;">Address Line2  </span><input style="margin-top:20px; margin-left: 15px;" type="text"name="address2" id="aline2"/><br/>
    <span style="margin-top:20px;">City *  </span><input style="margin-top:20px; margin-left: 78px;" type="text" name="city" id="city"/><span style="color:red; margin-left:10px;"></span><br />
    <input type="submit" id="btn_change_add" name="changeadd" value="Change" onclick="btn_change_add_click();"style="width:60px;"/>
     </form>
    </div>
 
 
</div>


<a class="colored_button"  href="<?php echo base_url() ;?>cart/insertcart">checkout</a>

