<?php 

        class UpdateDetails extends CI_Controller {
			
			
    		function __construct()
			{
				parent::__construct();
				$this->load->helper(array('form', 'url'));
	    		$this->load->database();
				session_start();
			}

            public function index() {
		
		       	$username =  $_SESSION['username'];
                $this->load->model('Shipping_model');
                $query_user['resultUser'] = $this->Shipping_model->getUserData($username);
				$data['title'] = 'Update Details';
				$this->load->view('templates/header', $data);
        		$this->load->view('templates/search_box');
                $this->load->view('updateUser_form', $query_user);
				$this->load->view('templates/footer', $data);
            }

            public function update_member_validate() {
				
					$username =  $_SESSION['username'];
				
                $this->load->library('form_validation');
                $this->form_validation->set_rules('first_name', 'Name', 'trim|required|alpha');
                $this->form_validation->set_rules('last_name', 'Name', 'trim|required|alpha');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('address', 'Address', 'trim|required');
                $this->form_validation->set_rules('street', 'Street', 'trim|required');
                $this->form_validation->set_rules('city', 'City', 'trim|required');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]|numeric');
                //$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]|callback_check_username');

                if ($this->form_validation->run() == false) {//didn't validate
                    $this->index();
                } else {
                    $this->load->model('Membership_model');

                    //$query = $this->Membership_model->update_member();

                    if ($this->Membership_model->update_member($username)) {
                        //$msg['account_updated'] = 'Your account details updated successfully!';
                        //$msg['updated_details_view'] = $query;
						$this->load->helper('url');
                        redirect('UpdateDetails/updated_details_view');
					 ;
						
                    } else {
                        $this->load->view('updateUser_form');
                    }
                }
            }

            function check_username($requested_username) {//custom callback function
                $this->load->model('Membership_model');

                $username_not_available = $this->Membership_model->check_username_exists_db($requested_username);

                if ($username_not_available) {
                    $this->form_validation->set_message('check_username', 'Username already exists, please try again');
					return FALSE;
                } else {
                    return TRUE;
                }
            }

            function check_email($requested_email) {//custom callback function
                $this->load->model('Membership_model');

                $email_not_in_use = $this->Membership_model->check_email_exists_db($requested_email);

                if ($email_not_in_use) {
                    return TRUE;
                } else {
					$this->form_validation->set_message('check_email', 'Email already exists, please try again');
                    return FALSE;
                }
            }

            function updated_details_view() {
                
               $username = $_SESSION['username'];
                $this->load->model('Shipping_model');
                $query_user['resultUser'] = $this->Shipping_model->getUserData($username);
                $this->load->view('updatedView', $query_user);
            }

        }
?>