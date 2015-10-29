<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model{
	   
	   public function __construct()
    {
            parent::__construct();
		     $this->load->database();
    }



		 public function get_sales_report($item_type,$time,$user)
	  {
		  $query = $this->db->query("	") ;
		
			
			if($query->num_rows()>0){
		 		 $row=	$query->result();
				 return $row;
			}
			
			else
			 	return NULL;
	  }
	  
	  
	   public function get_purchases_report($item_type,$time,$user)
	  {
		  $query = $this->db->query("	") ;
		
			
			if($query->num_rows()>0){
		 		 $row=	$query->result();
				 return $row;
			}
			
			else
			 	return NULL;
	  }
	  
	  
	  
	  
	  


}


?>