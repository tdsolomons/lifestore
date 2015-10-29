<?php
//============================================================
// File name   : Report_model.php
// Version     : 1.0
// Begin       : 2015-10-01
// Last Update : 2015-10-04
// Author      : Hasantha Suneth
// -----------------------------------------------------------
// 
//
// This file is part of Lifestore models
//
// 
//============================================================





defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @class Report_model
 * This Class contains the methods which are used to retreive the Data related to reports fromthe database.
 * @author Hasantha Suneth
 */
class Reports_model extends CI_Model{
	   
	   public function __construct()
    {
            parent::__construct();
		     $this->load->database();
    }





	/**
	 * Gets the data required to produce the Sales report for a user.
	 * @param $item_type(boolean) Parameter which indicates the type of items whether Fixed or Auction
	 * @param $time(string) Specify thye time period to generate a report.
	 * @return $array Array contain the acquired data and the sum of the Sales 
	 * @author Hasantha Suneth
	 */
		 public function get_sales_report($item_type,$time,$user)
	  {
		  
		  if($time=='this')
		  	$t=date('Y-m-').'%';
		  else if($time=='prev'){
		  	$m=idate("m")-1;
			$y=date('Y');
		    $t=$y.'-'.$m.'%';
		  }
		  else 
		  	$t='%';	
		  
		   
		    $query = $this->db->query("SELECT o.ordered_date,i.title,o.ordered_quantity,o.sold_price	
		  							 FROM EMarketingPortal.order o,item i
									 WHERE o.ordered_date LIKE '$t'
									 AND i.seller = $user
									 AND o.item=i.item_id") ;
		
			//get the sum of sales
			if($query->num_rows()>0){
		 		   $query2 = $this->db->query("SELECT SUM(o.sold_price) AS 'total'	
		  							 FROM EMarketingPortal.order o,item i
									 WHERE o.ordered_date LIKE '$t'
									 AND i.seller = $user
									 AND o.item=i.item_id") ;
				   $row=$query2->row();
				   $sum=$row->total;
				   $sales_data=$query->result();
				   $array = array('sales_data'=>$sales_data,'sum'=>$sum);
				   return $array;
			}
			else
			 	return NULL;
	  }
	  
	  
	 
	 
	 
	 /**
	 * Gets the data required to produce the Purchases report for a user.
	 * @param $item_type(boolean) Parameter which indicates the type of items whether Fixed or Auction
	 * @param $time(string) Specify tye time period to generate a report.
	 * @param $user(int) Specify the time the user id to get the data relevant 
	 * @return $array Array contain the acquired data and the sum of the Purchases 
	 * @author Hasantha Suneth
	 */
	   public function get_purchase_report($item_type,$time,$user)
	  {
		  //sets the time to query
		  if($time=='this')
		  	$t=date('Y-m-').'%';
		  else if($time=='prev'){
		  	$m=idate("m")-1;
			$y=date('Y');
		    $t=$y.'-'.$m.'%';
		  }
		  else 
		  	$t='%';	
		  
		  
		    $query = $this->db->query("SELECT o.ordered_date,i.title,o.ordered_quantity,o.sold_price	
		  							 FROM EMarketingPortal.order o,item i
									 WHERE o.ordered_date LIKE '$t'
									 AND o.bought_by_user = $user
									 AND o.item=i.item_id") ;
		
			//get the sumof purchases
			if($query->num_rows()>0){
		 		   $query2 = $this->db->query("SELECT SUM(o.sold_price) AS 'total'	
		  							 FROM EMarketingPortal.order o,item i
									 WHERE o.ordered_date LIKE '$t'
									 AND o.bought_by_user = $user
									 AND o.item=i.item_id") ;
				   $row=$query2->row();
				   $sum=$row->total;
				   $purchase_data=$query->result();
				   $array = array('purchase_data'=>$purchase_data,'sum'=>$sum);
				   return $array;
			}
			
			else
			 	return NULL;
	  }
	  
	  

	  
	  


}//End of Class-------------------------------------------------------------------------------






//End of file ==================================================================================

?>