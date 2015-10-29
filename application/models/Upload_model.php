<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model{
	   public function __construct()
    {
            parent::__construct();
		     $this->load->database();
    }

	
	//add an item to database------------------------------------
	public function add_item(){
		
	   session_start();
	   
	   $array=array(
		   'title' => $this->input->post('name'),
		   'description' => $this->input->post('desc'),
		   'seller' => 3,
		   'posted_date' =>  date("Y/m/d"),
		   'shipping_cost' => $this->input->post('cost'),
		   'available_quantity' => $this->input->post('quantity'),
		  			);		
		   
		   
	    $category = $this->input->post('category');
	    $condition = $this->input->post('condition');
	    $price = $this->input->post('price');				
		
		
		$insert = $this->db->insert('item',$array);
		
		//get itemid
		$itemId = $this->db->insert_id();
		$_SESSION['item_id']= $itemId;
		
		//set price
		$insertPrice = $this->db->query("insert into fixed_price_item(item_id,price) values($itemId,$price) ");
		
		//get categoryid
		$categoryId = $this->db->query("select category_id from category where category_name='".$category."' limit 1 ");
		
		$rer=$categoryId->row();
		$catId = $rer->category_id;
		
		
		//get conditionid
		$conditionId = $this->db->query("select condition_id from condition_type where condition_title='".$condition."'         limit 1 ");
		
		$con_row=$conditionId->row();
		$con_id = $con_row->condition_id;
		
		
		
		$this->db->query("update item i set category=$catId where i.item_id=$itemId ");
		$this->db->query("update item i set condition_type=$con_id where i.item_id=$itemId ");
		
		return $itemId;
	    $_SESSION['item_id'];
		
		
		
		
		
		}
		
		
		
		
		
	public function add_auction_item(){
		
	   session_start();
	   
	   $array=array(
		   'title' => $this->input->post('name'),
		   'description' => $this->input->post('desc'),
		   'seller' => 3,
		   'posted_date' =>  date("Y/m/d"),
		   'shipping_cost' => $this->input->post('cost'),
		   'available_quantity' => $this->input->post('quantity'),
		  			);		
		   
		   
	    $category = $this->input->post('category');
	    $condition = $this->input->post('condition');
	    $s_price = $this->input->post('s_price');
	    $minBid = $this->input->post('minBid');
		$endDate=$this->input->get('e_date');				
		
		
		$insert = $this->db->insert('item',$array);
		
		//get itemid
		$itemId = $this->db->insert_id();
		$_SESSION['item_id']= $itemId;
		
		//set price
		$insertPrice = $this->db->query("insert into auction_item(item_id,starting_bid,minimum_increment,end_datetime) values($itemId,$s_price,$minBid,'{$endDate}') ");
		
		//get categoryid
		$categoryId = $this->db->query("select category_id from category where category_name='".$category."' limit 1 ");
		
		$rer=$categoryId->row();
		$catId = $rer->category_id;
		
		
		//get conditionid
		$conditionId = $this->db->query("select condition_id from condition_type where condition_title='".$condition."'         limit 1 ");
		
		$con_row=$conditionId->row();
		$con_id = $con_row->condition_id;
		
		
		
		$this->db->query("update item i set category=$catId where i.item_id=$itemId ");
		$this->db->query("update item i set condition_type=$con_id where i.item_id=$itemId ");
		
		return $itemId;
	    $_SESSION['item_id'];
		
		
		
		
		
		}
		
		
		
		
		
		
		
   //add an image to database------------------------------------
   public function add_image($name,$file,$item,$bid){
		 $dataI = array('file_name'=>$name,'name'=>$file,'item_id'=>$item,'button_id'=>$bid);
		 $dataU = array('file_name'=>$name,'name'=>$file);
		 
		 
         $query = $this->db->query("Select * from image where item_id=$item and button_id=$bid");
		 if($query->num_rows() >= 1){
                  $this->db->update('image',$dataU,array('item_id' => $item,'button_id'=>$bid));
  			  }
				
		 else {
        	   $insert = $this->db->insert('image',$dataI);
		 	   $imageId = $this->db->insert_id();
              }
 
		 
		 if(isset($imageId)){
			//return $imageId; 
		 	
		 }
		 
		 else{
			//$imageId=-1;
			//return $imageId; 
		 
		     }
		
		}
		
		
		
	public function add_main_image($name,$file,$item,$bid){
		 
		 
		 $dataI = array('file_name'=>$name,'name'=>$file,'item_id'=>$item,'button_id'=>$bid);
		 $dataU = array('file_name'=>$name,'name'=>$file);
		 
		 
		 $query = $this->db->query("Select * from image where item_id=$item and button_id=$bid");
		 if($query->num_rows() >= 1){
               $this->db->update('image',$dataU,array('item_id' => $item,'button_id'=>$bid));
  			  }
				
		 else {
        	   $insert = $this->db->insert('image',$dataI);
		 	   $imageId = $this->db->insert_id();
			   //update item table for main image
			   $this->db->query("update item i set main_image=$imageId where i.item_id=$item ");
			  }
		 
			 
		 if(isset($imageId)){
			//return $imageId; 
		 	
		 }
		 
		 else{
			//$imageId=-1;
			//return $imageId; 
		 
		     }
		
		}
	
  
   public function getImages($itemId)
   {
   		$query = $this->db->query("Select * from image where item_id=$itemId and button_id=1");
		if($query->num_rows()==1){
			$row=$query->row();
			$imageOne=$row->name;
		}
		else{
			$imageOne=0;
		}
		
		$query2 = $this->db->query("Select * from image where item_id=$itemId and button_id=2");
		if($query2->num_rows()==1){
			$row2=$query2->row();
			$imageTwo=$row2->name;
		}
		else{
			$imageTwo=0;
		}
		
		$query3 = $this->db->query("Select * from image where item_id=$itemId and button_id=3");
		if($query3->num_rows()==1){
			$row3=$query3->row();
			$imageThree=$row3->name;
		}
		else{
			$imageThree=0;
		}
		
		$query4 = $this->db->query("Select * from image where item_id=$itemId and button_id=4");
		if($query4->num_rows()==1){
			$row4=$query4->row();
			$imageFour=$row4->name;
		}
		else{
			$imageFour=0;
		}
   		
   		
		$ImageArray=array('imageOne'=>$imageOne,'imageTwo'=>$imageTwo,'imageThree'=>$imageThree,'imageFour'=>$imageFour);
		
		return $ImageArray;
   
   
   }
   
  
  
   
   
   
   public function getListings()
   	  {
     	$query = $this->db->query("SELECT title,posted_date,shipping_cost,available_quantity FROM item");   
	    return $query;
      }


   public function getOrderedItems()
   	  {
     	$query = $this->db->query("SELECT * FROM EMarketingPortal.order where sold_by_user=3  ");	
		return $query->result();
      }

	public function getDeliveredItems()
   	  {
     	$query = $this->db->query("SELECT * FROM EMarketingPortal.order where sold_by_user=3 and order_status=3 ");	
		return $query->result();
      }
	  
	  public function getReturnedItems()
   	  {
     	$query = $this->db->query("SELECT * FROM EMarketingPortal.order where sold_by_user=3 and order_status=5 ");	
		return $query->result();
      }
	  
	public function getCompletedOrders()
   	  {
     	$query = $this->db->query("SELECT * FROM EMarketingPortal.order where sold_by_user=3 and order_status=4 ");	
		return $query->result();
      }  

	public function dispatchOrder($orderId)
   	  {
     	$query = $this->db->query("update EMarketingPortal.order set order_status=2 where order_id=$orderId ");	
		return $query;
      }  
	
	public function deliverOrder($orderId)
   	  {
     	$query = $this->db->query("update EMarketingPortal.order set order_status=3 where order_id=$orderId ");	
		return $query;
      }  
	  
	  public function returnedOrder($orderId)
   	  {
     	$query = $this->db->query("update EMarketingPortal.order set order_status=5 where order_id=$orderId ");	
		return $query;
      }  

}


?>