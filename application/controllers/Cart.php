<?php
class Cart extends CI_Controller {
	
	public function __construct()
	{
	         parent::__construct();
	         session_start();
	         $this->load->helper('url');
	         $this->load->model('cart_model');
	         
	}


	public function cart()
	{
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
	public function buy($a,$b=1)
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
		$data['price']=$this->_calculateTotal($data['items'][0]->price, $b, $data['items'][0]->shipping_cost);
		//echo $i;
	 	$user_info = $this->item_model->getUserInfomation();
		
		foreach ($user_info as $object) 
		{
			$data['f_name'] = $object->first_name;
			$data['l_name'] = $object->last_name;
			$data['address'] = $object->address;
			$data['street']  = $object->street;
			$data['city'] = $object->city;
		}
		
		$order = array(
			'sold_price'=>$data['price']['total'],
			'ordered_date'=>date('Y-m-d H:i:s'),
			'item'=>$a,
			'bought_by_user'=>1,
			
			'ship_to_address'=>$data['address'].' '.$data['street'].' '.$data['city'],
			'ordered_quantity'=>$b
			
			);
			$this->buynow_model->insertItems($order);
			
		//$data['cart_items'] = $_SESSION["cart"];
		$this->load->view('templates/header', $data);
        $this->load->view('templates/search_box');
        $this->load->view('view_buynow',$data);
        $this->load->view('templates/footer');
	}
	
	private function _calculateTotal($item_price,$b,$shippingcost){
		$price['shipping']=$shippingcost;
		$price['subtotal']=$item_price*$b;
		$price['total'] = ($item_price*$b)+$shippingcost;
		
		return $price;
		}
	
	
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
	public function add_buynow(){
		
		$item_id = $this->input->post('item_id');
		
        $qty = $this->input->post('qty');
        //echo "$color $qty $item_id";

		$item = $this->cart_model->getItemDetails($item_id);
		$item[0]->qty = $qty;
		$item[0]->color = $color;
		
		if ($item != NULL) {
			if (isset($_SESSION["buyitnow"])){ //check if cart already there or empty
				$items = $_SESSION['buyitnow'];
				$_SESSION["buyitnow"] = array_merge($items, $item);
			}else{
				$_SESSION["buyitnow"] = $item;
			}
		}
		
		}
		
	
	
	
}