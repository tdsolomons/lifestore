<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deals_model_seller extends CI_Model{
	   
	   public function __construct()
    {
            parent::__construct();
		     $this->load->database();
    }



	   public function accept_offer($offer_id)
	   {
		   $query = $this->db->query("UPDATE offers
		   							  SET offer_status=1
									  WHERE offer_id=$offer_id" );
									  
		   if($query)
		    return TRUE;
		   else
		    return FALSE;
			
	   }
	   
	   
	   
	   
	   
	   
	   public function reject_offer($offer_id)
	   {
		   $query = $this->db->query("UPDATE offers
		   							  SET offer_status=2
									  WHERE offer_id=$offer_id" );
									  
		   if($query)
		    return TRUE;
		   else
		    return FALSE;
			
	   }
	   

		 public function getDeals($userId)
	  {
		  $query = $this->db->query("select d.*,i.title,image.name
		  							 from deal d,item i,image
									 where i.seller = $userId
									 and   d.fixed_price_item = i.item_id
									 and   i.main_image = image.image_id") ;
		
			
			if($query->num_rows()>0){
		 		 $row =	$query->result();
				 return $row;
			}
			
			else
			 	return NULL;
	  }
	  
	  
	  
	  
	   public function getOffersAC($userId)
	  {
		  $query = $this->db->query("select distinct 				i.item_id,i.title,i.seller,offer_id,quantity,amount,buyer_id,username,image.name
									from item i,user u,offers f,image 
									where i.seller = $userId 
									and	  f.item_id = i.item_id
									and   i.main_image= image.image_id  	
									and   buyer_id=u.user_id	
									and f.offer_status=1
									") ;
									
			
			if($query->num_rows()>0){
		 		 $row=	$query->result();
				 return $row;
			}
			
			else
			 	return NULL;
	  }
	  
	  
	  
	  
	   public function getOffersRJ($userId)
	  {
		  $query = $this->db->query("select distinct 				i.item_id,i.title,i.seller,offer_id,quantity,amount,buyer_id,username,image.name
									from item i,user u,offers f,image 
									where i.seller = $userId 
									and	  f.item_id = i.item_id
									and   i.main_image= image.image_id  	
									and   buyer_id=u.user_id	
									and f.offer_status=2
									") ;
		
			
			if($query->num_rows()>0){
		 		 $row=	$query->result();
				 return $row;
			}
			
			else
			 	return NULL;
	  }


	



}






?>