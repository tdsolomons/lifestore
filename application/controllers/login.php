<?php

Class Login extends CI_Controller {

//constructor to the controller----------------------------------------------------------------------
    function __construct()
	{
		parent::__construct();
        session_start();
		$this->load->helper(array('form', 'url'));
	    $this->load->database();
	}
	
//login function-------------------------------------------------------------------------------------
	public function login() {
        $data['title'] = 'Login';
		$this->load->view('templates/header', $data);
        $this->load->view('templates/search_box');
		$this->load->view('login');
		$this->load->view('templates/footer');
    }

//logout function------------------------------------------------------------------------------------
    public function logout(){
        $this->load->helper('url');
        session_destroy();
         redirect('/welcome', 'refresh');
    }

//validate credentials in logging in------------------------------------------------------------------
    public function validate_credentials() {

		if (($this->input->post('username') == 'admin') && ($this->input->post('password') == 'admin')) {
            	redirect('admin');
		} else {

		 	$this->load->library('form_validation');
        	//validation rules
       	 	$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]|callback_check_username_valid');
        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[15]');

        	if ($this->form_validation->run() == false) {//didn't validate
            	
				$data['title'] = 'Login';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('login', $data);
				$this->load->view('templates/footer');
			} else {
			
            $this->load->model('Membership_model');
            $query = $this->Membership_model->validateLogin();
			
			if ($query == NULL) {
                $data['account_created'] = 'Password Wrong, </br> Check again';
				$data['title'] = 'Login';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('login', $data);
				$this->load->view('templates/footer');
			}
			else if($query != NULL) {
				//if the user's credentials are validated,
                $data = array(
                    "username" => $this->input->post('username'),
                    "is_logged_in" => true
                );
                //Edited 
                $_SESSION['username'] = $this->input->post('username'); 
                foreach ($query->result() as $row)
                {
                    $_SESSION['user_id'] = $row->user_id;
                }
				
                //echo  $this->input->post('username');
                //echo $_SESSION['username'];
                //$this->load->library('session');
                //$this->session->set_userdata($data);
                $this->load->helper('url');
                //$this->load->view('home_view');
                redirect('/welcome', 'refresh');
            } else { //incorrect username or password
                redirect('/Login/login', 'refresh');
                print_r($query);
            }
        
			}
        }

    
    }
	
//to check the email does exists in db--------------------------------------------------------------------------
	function check_username_valid($username) {//custom callback function
        
		$this->load->model('Membership_model');
        $username_in_use = $this->Membership_model->check_username_exists_db($username);
        if ($username_in_use) {
            return TRUE;
        } else {
			$this->form_validation->set_message('check_username_valid', 'Username is not registered, please check again');
			return FALSE;
        }
    }

//signup pr register form load -----------------------------------------------------------------------------
    public function signup() {
				$data['title'] = 'Register';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('register', $data);
				$this->load->view('templates/footer');
    }

//create a new member with register form--------------------------------------------------------------------
    public function create_member_validate() {
		
        $this->load->library('form_validation');
        //validation rules
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required|alpha');
        $this->form_validation->set_rules('last_name', 'Name', 'trim|required|alpha');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]|callback_check_username');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('street', 'Street', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[9]|max_length[10]|numeric');
        $this->form_validation->set_rules('upassword', 'Password', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[upassword]');

        if ($this->form_validation->run() == false) {//didn't validate
            	$data['title'] = 'Register';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('register', $data);
				$this->load->view('templates/footer');
        } else {
            $this->load->model('Membership_model');

            if ($query = $this->Membership_model->create_member()) {
                $data['account_created'] = 'Account created, </br> You may login';
				
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('login', $data);
				$this->load->view('templates/footer');
            } else {
				$this->load->view('templates/header');
        		$this->load->view('templates/search_box');
                $this->load->view('register');
				$this->load->view('templates/footer');
            }
        }
    }

//check if username already exists in the db, if so cannot enter-------------------------------------------------
    function check_username($requested_username) {//custom callback function
        
		$this->load->model('Membership_model');
        $username_available = $this->Membership_model->check_username_exists_db($requested_username);
        if ($username_available) {
			 $this->form_validation->set_message('check_username', 'Username is not available ');
            return FALSE;
        } else {
		    return TRUE;
        }
    }

//check if email already exists in the db, if so cannot enter-------------------------------------------------
    function check_email($requested_email) {//custom callback function
        
		$this->load->model('Membership_model');
		
        $email_not_in_use = $this->Membership_model->check_email_exists_db($requested_email);
        if ($email_not_in_use) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_email', 'Email is already registered ');
			return FALSE;
        }
    }
	
//view the forgot password form--------------------------------------------------------------------------------
	    function forgotPasswordView() {
			$data['title'] = 'Forgot Password';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('forgotPassView', $data);
				$this->load->view('templates/footer');
    }

//submitting a new password when the current passwrd is forgotten----------------------------------------------
    function forgotPasswordSubmit() {
	
		$_SESSION['email'] = $this->input->post('email');
        $email = $_SESSION['email'];
		
        $this->load->library('form_validation');//validation rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email_valid');

        if ($this->form_validation->run() == false) {//didn't validate
            	$data['title'] = 'Forgot Password';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('forgotPassView', $data);
				$this->load->view('templates/footer');
        } else {
			
			$this->load->helper('string');
			$ranPass = random_string('alnum', 15);
			
            $this->load->model('Membership_model'); //if validates
            if ($query = $this->Membership_model->forgotPass($email, $ranPass)) {
                $data['account_created'] = 'Email sent to you, </br> You can login with a new password';
				$data['title'] = 'Forgot Password';
                $this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('login', $data);
				$this->load->view('templates/footer');
            } else {
				$data['title'] = 'Forgot Password';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                 $this->load->view('forgotPassView', $data);
				$this->load->view('templates/footer');
               
            }
        }
    }
	
//to check the email does exists in db--------------------------------------------------------------------------
	function check_email_valid($email) {//custom callback function
        
		$this->load->model('Membership_model');
        $email_not_in_use = $this->Membership_model->check_email_exists_db($email);
        if ($email_not_in_use) {
            $this->form_validation->set_message('check_email_valid', 'Email is not registered, please check again');
			return FALSE;
        } else {
			return TRUE;
        }
    }

//looads form to change or update the existing password------------------------------------------------------------
    public function passwordChangeView() {
		
        $username =  $_SESSION['username'];
		$data['title'] = 'Change Password';
		$this->load->view('templates/header', $data);
        $this->load->view('templates/search_box');
        $this->load->view('passwordChangeView', $data);
		$this->load->view('templates/footer');
    }

//validate the existing password change----------------------------------------------------------------------------
    public function passwordChangeValidate() {
		
		//$_SESSION['password'] = $this->input->post('passwordExist');
		//$password = $_SESSION['password'];
		$username =  $_SESSION['username'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('passwordExist', 'PasswordExist', 'trim|required|min_length[5]|max_length[15]|callback_check_password_valid');
        $this->form_validation->set_rules('passwordNew', 'PasswordNew', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('password_confirm', 'PasswordConfirm', 'trim|required|matches[passwordNew]');

        if ($this->form_validation->run() == false) {
			$data['title'] = 'Change Password';
			$this->load->view('templates/header', $data);
        	$this->load->view('templates/search_box');
        	$this->load->view('passwordChangeView', $data);
			$this->load->view('templates/footer');

        } else {
			$this->load->model('Membership_model'); //if validates
            $passNew = $this->input->post('passwordNew');
           
		    if (!$this->Membership_model->updatePassword($username, $passNew)) {
                
			$data['account_created']= 'Password Changed, </br> You can login with the new password';
			$data['title'] = 'Login';
			$this->load->view('templates/header', $data);
        	$this->load->view('templates/search_box');
			$this->load->view('login', $data);
			$this->load->view('templates/footer');
		
			} else {
					
				$data['password_changed']= 'Cannot change password, </br> Please Try again!';
				$data['title'] = 'Change Password';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
        		$this->load->view('passwordChangeView', $data);
				$this->load->view('templates/footer');
            }

        }
    }
	
//check if the password exists in the database to update-----------------------------------------------------------
	function check_password_valid($pass) {//custom callback function
        $this->load->model('Membership_model');

        $pass_not_in_use = $this->Membership_model->check_password_exists_db($pass);
        if ($pass_not_in_use) {
			$this->form_validation->set_message('check_password_valid', 'Password does not exist, please check again');
			return FALSE;
        } else {
			return TRUE;
        }
    }
	
	
//load form to adda new one for the forgotten password--------------------------------------------------------------
        public function passwordForgotChangeView() {
				$data['title'] = 'Change Password';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
        		$this->load->view('forgotPasswordRecoverView', $data);
				$this->load->view('templates/footer');
    }
    
//validagting the form to add new password when forgot--------------------------------------------------------------
    public function passwordForgotValidate() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('passwordNew', 'PasswordNew', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('passwordConfirm', 'PasswordConfirm', 'trim|required|matches[passwordNew]');

        if ($this->form_validation->run() == false) {
				$data['title'] = 'Change Password';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
        		$this->load->view('forgotPasswordRecoverView', $data);
				$this->load->view('templates/footer');
			
        } else {
                //$username = $this->input->post('username');
                $passNew = $this->input->post('passwordNew');
                 $this->load->model('Membership_model');
                 $resultNew = $this->Membership_model->updatePasswordWithEmail($email,$passNew);

                if ($resultNew) {
                    $this->load->view('forgotPasswordRecoverView');
                    echo "<h4>Password Changed!</h4>";
                } else {
                    $this->load->view('forgotPasswordRecoverView');
                    echo "<h4>Could not change password! Not valid password</h4>";
                }
     
            
        }
    }

}

?>