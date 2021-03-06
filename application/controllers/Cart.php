<?php
/**
 * Cart class
 * Controller for all the cart realated activities
 *
 * @package     EMarketingPortal
 * @author      Dilini udeshika
 */

class Cart extends CI_Controller {

	
	public function __construct()

	{
	         parent::__construct();
	         session_start();
	         $this->load->helper('url');
	         $this->load->model('cart_model');
	         
	}

	/**
	* returns the cart items
	* @access   public
	* get the items add to the session
	*/
	public function cart()

	{

			if(!isset($_SESSION['cart']) || $_SESSION['cart'] == NULL)
			redirect();
			$data['cart_items'] = $_SESSION["cart"];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/search_box');
			$this->load->view('cart_view', $data);
			$this->load->view('templates/footer');
	}
	

	/*public function BuyNow()

	{

			$this->load->model('Item_model');
			$user_info = $this->Item_model->getUserInfomation();
			foreach ($user_info as $object) 
		{
			$data['f_name'] = $object->first_name;
				$data['l_name'] = $object->last_name;
				$data['address'] = $object->address;
				$data['street']  = $object->street;
				$data['city'] = $object->city;
			}
			$data['cart_items'] = $_SESSION["cart"];
			$this->load->view('templates/header', $data);
			$this->load->view('templates/search_box');
			$this->load->view('view_buynow');
			$this->load->view('templates/footer');

	}

	*/

	/**
	* buy items
	* @access   public
	* @param quntity, item
	* get the items add to the session
	*/
	public function buy($a, $b=1)

	{
			$this->load->model('item_model');
			$this->load->model('buynow_model');
			$item_id = $a;
	
			
			$data['items'] = $this->item_model->item($item_id);
			$data['images'] = $this->item_model->getItemImages($item_id);
			$data['image'] = $this->item_model->getItemImage($item_id);
			$data['quantity'] = $this->item_model->getAvailableQuantity($item_id);
			$data['color'] = $this->item_model->getColors($item_id);
			$data['qty'] =$b;
		

			//print_r($data['items']);
			
			//calsulate total
			$data['price']=$this->_calculateTotal($data['items'][0]->price, $b, $data['items'][0]->shipping_cost);
	
			//echo $i;
	
			$user_info = $this->item_model->getUserInfomation();
			//if shipping addresss changed get new address
			if(isset($_POST['changeadd'])){
				$address['f_name']	= $_POST['name'];
				$address['address1']	= $_POST['address1'];
				$address['address2']	= $_POST['address2'];
				$address['city']	= $_POST['city'];
				$_SESSION['shipping_address'] = $address;
				$uid = $_SESSION['user_id'];
			}
			foreach ($user_info as $object) 
			{
				$data['f_name'] = $object->first_name;
				$data['l_name'] = $object->last_name;
				$data['address'] = $object->address;
				$data['street']  = $object->street;
				$data['city'] = $object->city;
	
			}
	
			if(isset($_SESSION['shipping_address'])){
				$ad = $_SESSION['shipping_address'];
				
				$add = $ad['f_name'].' '.$ad['address1'].' '.$ad['address2'].' '.$ad['city'];
			}else{
				$add =$data['address'].' '.$data['street'].' '.$data['city'];
			}
			$order = array(
				'sold_price'=>$data['price']['total'],
				'ordered_date'=>date('Y-m-d H:i:s'),
				'item'=>$a,
				'bought_by_user'=>$uid,
				'ship_to_address'=>$add,
				'ordered_quantity'=>$b
				);
	
			if(isset($_GET['save']) && $_GET['save'] == 1){
				$this->buynow_model->insertItems($order);
				$_SESSION['shipping_address']= NULL;
				redirect('cart/confirmorder');
			}
	
			//$data['cart_items'] = $_SESSION["cart"];
	
			//print_r($data);
			$this->load->view('templates/header', $data);
			$this->load->view('templates/search_box');
			$this->load->view('view_buynow',$data);
			$this->load->view('templates/footer');
	}
	
	

	/**
	* calculate total price
	* @access   public
	* @param itemorice,shipping cost
	* return price
	*/
	private function _calculateTotal($item_price,$b,$shippingcost){
			$price['shipping']=$shippingcost;
			$price['subtotal']=$item_price*$b;
			$price['total'] = ($item_price*$b)+$shippingcost;
			
			return $price;
		}
	
	
	/**
	* insert item to cart
	* @acess public
	*/
	public function add()
	{
			$item_id = $this->input->post('item_id');
			$color = $this->input->post('color');
			$qty = $this->input->post('qty');
			//echo "$color $qty $item_id";
	
			$item = $this->cart_model->getItemDetails($item_id);
			$item[0]->qty = $qty;
			$item[0]->color = $color;
			
			if ($item != NULL) {
				if (isset($_SESSION["cart"])){ //check if cart already there or empty
					$items = $_SESSION['cart'];
					$_SESSION["cart"] = array_merge($items, $item);
				}else{
					$_SESSION["cart"] = $item;
				}
			}
			//View cart
			redirect('/cart/cart', 'refresh');
	}

	/*Cart checkout-------------------------------------------------------------------
	*
	* 
	* @acess public
	*/
	public function insertcart(){
			if(!isset($_SESSION['cart']) || $_SESSION['cart'] == NULL)
			redirect();
			$cart_items = $_SESSION["cart"];
			$uid = $_SESSION['user_id'];
			
			if(isset($_SESSION['shipping_address'])){
				$a = $_SESSION['shipping_address'];
				
				$address = $a['f_name'].' '.$a['address1'].' '.$a['address2'].' '.$a['city'];
			}else{
				$address = $this->_getaddress();
			}
			foreach ($cart_items as $object) {
			$order = array(
				'sold_price'=>($object->price * $object->qty)+$object->shipping_cost,
				'ordered_date'=>date('Y-m-d H:i:s'),
				'item'=>$object->item_id,
				'bought_by_user'=>$uid,
				'ship_to_address'=>$address,
				'ordered_quantity'=>$object->qty,
			
			);
			
			//Call insert cart 
			//check giftcode availble -------------------------------------------------
			if(isset($_SESSION['gift_code'])){
				$this->update_gift_code($_SESSION['gift_code']);	
			}
			
			$this->cart_model->insertItems($order);

			}
			$_SESSION["cart"] = NULL;
			$_SESSION['shipping_address']= NULL;
			$this->load->view('templates/header');
			$this->load->view('templates/search_box');
			$this->load->view('view_orderconfirmation');
			$this->load->view('templates/footer');
	
	}
	/*update gift code as expired when used-------------------------------------------------------------------
	*@param giftcode
	* 
	* @acess public
	*/
	
	private function update_gift_code($gift_code){
			$this->load->model('giftcard_model');
			//update gift code 
			$this->giftcard_model->update_code($gift_code);
			unset($_SESSION['gift_code']);//sesion unset
	}
	
	/*view order confirmation
	*
	* 
	* @acess public
	*/
	public function confirmorder(){
			$this->load->view('templates/header');
			$this->load->view('templates/search_box');
			$this->load->view('view_orderconfirmation');
			$this->load->view('templates/footer');
	}
	

	/*get user address 
	*
	* 
	* @acess private
	*/
	private function _getaddress(){
			$this->load->model('item_model');
			$user_info = $this->item_model->getUserInfomation();
			foreach ($user_info as $object) 
			{
				$address['f_name'] = $object->first_name;
				$address['l_name'] = $object->last_name;
				$address['address'] = $object->address;
				$address['street']  = $object->street;
				$address['city'] = $object->city;
			}
			return $address['address'].' '.$address['street'].' '.$address['city'];
	
	}

	/*get changed shipping adress
	*
	* 
	* @acess public
	*/
	public function shipping_address()
	{

			$this->load->model('item_model');
			$user_info = $this->item_model->getUserInfomation();
		//if addresss is changed		
			if(isset($_POST['changeadd'])){
				$address['f_name']	= $_POST['name'];
				$address['address1']	= $_POST['address1'];
				$address['address2']	= $_POST['address2'];
				$address['city']	= $_POST['city'];
				$_SESSION['shipping_address'] = $address;
		}
		//get user details
		foreach ($user_info as $object) 
		{
				$data['f_name'] = $object->first_name;
				$data['l_name'] = $object->last_name;
				$data['address'] = $object->address;
				$data['street']  = $object->street;
				$data['city'] = $object->city;
			}
				$this->load->view('templates/header');
				$this->load->view('templates/search_box');
				$this->load->view('shippingaddress_view', $data);
				$this->load->view('templates/footer');
	}
	
	
	/*insert auto genetared code when using gift card
	*
	* 
	* @acess public
	*/
	
	public function add_Code(){
			$this->load->model("cart_model");
			//get the gift code from textbox
			$gift_code = $this->input->post('gift_code');
			//code validation
			$code = $this->cart_model->check_code($gift_code);
			if($code){
				//create session
				$_SESSION['gift_code'] = $gift_code;
				$code->status = 'success';
				//pass the data from browser as json object
				 			
				echo json_encode($code);
			}else{
				$ar = array('status' => 'invalid');
				echo json_encode($ar);
			}
	
	}
	

}