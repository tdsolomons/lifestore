<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offers_model extends CI_Model{
	   
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
	   

		 public function getOffers($userId)
	  {
		  $query = $this->db->query("select distinct 				i.item_id,i.title,i.seller,offer_id,quantity,amount,buyer_id,username,image.name
									from item i,user u,offers f,image 
									where i.seller = $userId 
									and	  f.item_id = i.item_id
									and   i.main_image= image.image_id  	
									and   buyer_id=u.user_id
									and f.offer_status=0	") ;
		
			
			if($query->num_rows()>0){
		 		 $row=	$query->result();
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


		public function email($offer_id){
			 $query = $this->db->query("select f.item_id,i.title,amount,quantity,email,first_name,last_name
									from item i,offers f,user u
									where f.offer_id=$offer_id
									and  i.item_id=f.item_id
									and  f.buyer_id=u.user_id
									") ;
									
						 if ($query) {
                 foreach ($query->result() as $row){
                    $storeName = 'LifeStore.lk';
                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('noreply@sep.tagfie.com', $storeName);
                    $this->email->to($row->email); 

                    $emailSubject = 'Offer Accepted';

                   	$content='Your offer to this item has been accepted by the seller';

                    $this->email->subject($emailSubject);

                    $emailBody = '<html><head></head>
            <body>
            <table cellspacing="0" cellpadding="0" style="padding:30px 10px;background:#EEE;width:100%;font-family:arial">
            <tbody>
                    
            <tr>
                <td>
                    <table cellspacing="0" align="center" style="max-width:650px;min-width:320px">
                        <tbody>
                            <tr>
                                <td style="text-align:left;padding-bottom:14px">
                                    <img align="left" src="'. asset_url() .'img/logolife.png" alt="'. $storeName .'"></img>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background:#FFF;border:1px solid #e4e4e4;padding:50px 30px">
                                    <table align="center">
                                    <tbody>
                                    
                                    <tr>
                                        <td style="color:#666;padding:15px 5px;font-size:14px;line-height:20px;font-family:arial">
                                            <p style="font-weight:bold;font-size:16px">Hello ' . $row->first_name . ' ' . $row->last_name   . 
                                            ',</p>' 
                                    .  '<br> You have received following message regarding the item <strong>' 
                                    . $row->title
                                    . '</strong> <br><p>' 
                                    . $content . '</p><p><a href="http://sep.tagfie.com/cart/buy/'.$row->item_id.'/'.$row->quantity.'/Undefined">Claim your offer</a></p>
                                                                                Best Regards,
                                                                                <br/>
                                                                                '. $storeName .'
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="background:#F8F8F8;border:1px solid #e4e4e4;border-top:none;padding:24px 10px">
                                                            <p></p>         
                                                            
                                                            </td>               
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                                <table style="max-width:650px" align="center">
                                                    
                                                    <tbody><tr>
                                                        <td style="color:#b4b4b4;font-size:11px;padding-top:10px;line-height:15px;font-family:arial">

                                                            © '. $storeName .' 2015 
                                                            
                                                        </td>

                                                    </tr>
                                                </tbody></table>
                                            
                                        </tr>
                                        </tbody>
                                    
                                        </table>
                                        </body>
                                        </html>';

                    $this->email->message($emailBody);  

                    $this->email->send();
                 }
						 }
		
		  
			
		}



}






?>