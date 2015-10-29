<?php

class Membership_model extends CI_Model {
	
		public function __construct()
    {
            $this->load->database();
    }
	

    function validateLogin() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', $this->input->post('password'));
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            //Edited, returns query
            return $query;
        } else {
            return NULL;
        }
    }

    function create_member() {
        //$username = $this->input->post('username');

        $new_member_insert_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'password' => $this->input->post('upassword')
        );

		$this->db->trans_start();
		$insert = $this->db->insert('user', $new_member_insert_data);
		$userId = $this->db->insert_id();
		$this->db->trans_complete();
		
		$user_phone = array(
		'phone' => $this->input->post('phone'),
		'user_id' => $userId
		);
		
		$insert .= $this->db->insert('user_phone', $user_phone);
		return $insert;
    }

    function check_username_exists_db($username) {

        $this->db->where('username', $username);
        $result = $this->db->get('user');

        if ($result->num_rows() > 0) {
            return TRUE; //username already exists
        } else {
            return FALSE; //username can be registered
        }
    }

    function check_email_exists_db($email) {

        $this->db->where('email', $email);
        $result = $this->db->get('user');

        if ($result->num_rows() > 0) {
            return FALSE; //email already exists
        } else {
            return TRUE; //email can be registered
        }
    }
	
	function check_password_exists_db($pass) {

        $this->db->where('password', $pass);
        $result = $this->db->get('user');

        if ($result->num_rows() > 0) {
            return FALSE; //password already exists
        } else {
            return TRUE; //password can be registered
        }
    }


    function getMemberDetails($username) {

        $this->db->where('username', $username);
        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_member($username) {

        $member_update_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            //'phone' => $this->input->post('phone'),
        );
		
		$phone = $this->input->post('phone');
		// $member_update_phone = array(
           // 'phone' => $this->input->post('phone')
       // );
		
		 $this->db->where('username', $username);
		 //$updateUser = $this->db->update('user', $member_update_data);
		 if($this->db->update('user', $member_update_data)){
		 	$this->db->query("UPDATE EMarketingPortal.user_phone SET phone='$phone' WHERE user_id=(SELECT user_id FROM EMarketingPortal.user WHERE username='$username')");
		 		//$this->db->where('user_id', "SELECT user_id FROM EMarketingPortal.user WHERE username =".$username);
		 			//$updatePhone = $this->db->update('user_phone', $member_update_phone);
		 
        		//if ($this->db->update('user_phone', $member_update_phone)){
				//	
        	//if ($this->db->query("UPDATE EMarketingPortal.user_phone SET phone='719219592' WHERE user_id=(SELECT user_id FROM EMarketingPortal.user WHERE username='$username')")){
            		return TRUE;
		//	}
        		//} else {
            	//	return FALSE;
        		//	}
		 }else{
				return FALSE;
			}
    }
     
	    function forgotPass($email, $randomPass) {
			
		$data = array('password' => $randomPass);
        $this->db->where('email', $email);
        $this->db->update('user', $data);
		
		
	
        if ($email) {
			
			 $sql = "SELECT first_name, last_name 
                    FROM user 
                    WHERE email = '$email' 
					LIMIT 1";
            $query3 = $this->db->query($sql);
			
			 if ($query3) {
                 foreach ($query3->result() as $row)
                 {
	
				$storeName = 'LifeStore.lk';
                $this->load->library('email');
 				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");
                
				$this->email->from("noreply@sep.tagfie.com", $storeName);
                $this->email->to($email);
               
                $this->email->subject("Recovering password");
                $this->email->message('<html><head></head>
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
                                    .  '<br> You can access your account! </br> All you have to do is type the given password in the password textbox in the Login page <strong>' 
                                  ." <br> The new Password is :  ".$randomPass ."</strong> </br> ".
								    "<br> You can change your password again after you log in. Thank you! </br>".
                                    ' <br><p>'.
                                                                               'Best Regards,
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
                                        </html>');
                   
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
	
	    function checkPassword($pass) {

        $data = array('password' => $pass);
        $this->db->select('password');
        $queryRecord = $this->db->get_where('user', $data);
        $resultRecord = $queryRecord->result();

        if ($resultRecord) {
            return $resultRecord;
        } else {
            return FALSE;
        }
    }

    function updatePassword($username, $pass) {

        $data = array('password' => $pass);
        $this->db->where('username', $username);
        $this->db->update('user', $data);
       
    }

	function updatePasswordWithEmail($email, $password) {
	
		$data = array('password' => $upass);
        $this->db->where('email', $email);
        $this->db->update('user', $data);
	
	}

}

?>