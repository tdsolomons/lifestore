<?php

/*
====================================================

File name	: Re_order.php
Version		: 1.0
Begin		: 2015-09-29
Last Update	: 2015-10-05
Authour		: Sachinika Deemansa

----------------------------------------------------

This file is part of LifeStore Models

====================================================
*/

	class Re_order_model extends CI_Model{

		public function __construct()
    	{
            $this->load->database();
			if (!isset($_SESSION)) {
                session_start();
            }
    	}
		
		/* 
		*this function is to return the set or items that needs to be re ordered from the suppliers specified to a seller*/
		public function re_order_list(){
			if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $user_id = $_SESSION['user_id'];
				$sql = "select i.item_id, i.title, c.category_name, i.available_quantity, sd.supplier_name, sd.supplier_email
						from item i 
						left join user u
						on u.user_id = i.seller
						left join item_has_supplier ihs
						on i.item_id = ihs.item_id
						left join supplier_details sd
						on sd.supplier_id = ihs.supplier_id
						left join category c
						on c.category_id = i.category
						where i.available_quantity < 5 and i.item_status = '1' and u.user_id = ".$user_id.";";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
		}
		
		/* this function is to return the details of an item selected from the particular seller's item list that needs to be re ordered from the suppliers specified to a seller*/
		public function re_order_generate($item_id){
			if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $user_id = $_SESSION['user_id'];
                $sql = "select i.item_id, i.title, c.category_name, i.available_quantity, sd.supplier_name, sd.supplier_email
						from item i 
						left join user u
						on u.user_id = i.seller
						left join item_has_supplier ihs
						on i.item_id = ihs.item_id
						left join supplier_details sd
						on sd.supplier_id = ihs.supplier_id
						left join category c
						on c.category_id = i.category
						where available_quantity < 5 and item_status = '1' and i.item_id = ".$item_id.";";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
		}
		
		public function re_order_suppliers($item_id){
			
                $sql2 = "select sd.supplier_name, sd.supplier_email
							from item i 
							left join user u
							on u.user_id = i.seller
							left join item_has_supplier ihs
							on i.item_id = ihs.item_id
							left join supplier_details sd
							on sd.supplier_id = ihs.supplier_id
							left join category c
							on c.category_id = i.category
							where available_quantity < 5 and item_status = '1' and i.item_id = ".$item_id.";";

                $query2 = $this->db->query($sql2);

                if ($query2) {
                    return $query2->result();
                }else
                    return NULL;
					
       }
		
		/* this function is to send an email along with the added details to the supplier as the re order request notice */
		public function send_mail($item_id) {

		if (!isset($_SESSION['user_id'])) {  
                return NULL;
        }else{
				
		$user_id = $_SESSION['user_id'];
		
			$storeName = 'LifeStore.lk';
		
		    $item_id = $this->input->post('item_id');
            $item_name = $this->input->post('item_name');
            $category_name = $this->input->post('category_name');
            $requirement = $this->input->post('requirement');
            $supplier_name = $this->input->post('supplier_name');
            $supplier_email = $this->input->post('supplier_email');
		
			$seller_query = $this->db->query("select first_name, last_name, email
												from user 
												where user_id = ".$user_id.";");
			
			
			$seller_result = $seller_query->result();
			
			foreach($seller_result as $row){
				
					$seller_name = $row->first_name.' '. $row->last_name;
					$seller_email = $row->email;
				
			}
			
	$email_details = array('storeName'=> $storeName,
			'item_id' => $item_id,
			'item_name' => $item_name,
			'category_name' => $category_name,
			'requirement' => $requirement,
			'supplier_name' => $supplier_name,
			'supplier_email' => $supplier_email,
			'seller_name' => $seller_name,
			'seller_email'=>$seller_email);
	
	
		
		 if ($supplier_email) {

                $this->load->library('email');
 				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
                
				$this->email->from("noreply@sep.tagfie.com", "LifeStore.lk");
                $this->email->to($supplier_email);
               //$this->email->to("sachdeemansa@gmail.com");
			   
                $this->email->subject("Request to order the item : ".$item_name);
				
				$msg = $this->load->view('email_view', $email_details, true);
                   
                $this->email->message($msg);
				
                $result = $this->email->send();
                echo $this->email->print_debugger();

            if ($result) {
                return TRUE;
				

           } else {
                return FALSE;
            }
		 }
		 }
	  }
	}

?>