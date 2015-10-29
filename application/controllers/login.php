<?php

Class Login extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->database();
	}
	
	
	public function index() {
        
		$this->load->view('login_form');
    }

    public function validate_credentials() {

        if (($this->input->post('username') == 'admin') && ($this->input->post('upasword') == 'admin')) {
            redirect('admin');
        } else {
            $this->load->model('membership_model');
            $query = $this->membership_model->validateLogin();

            if ($query) { //if the user's credentials are validated,
                $data = array(
                    "username" => $this->input->post('username'),
                    "is_logged_in" => true
                );

                $this->load->library('session');
                $this->session->set_userdata($data);
                redirect('myOrders');
            } else { //incorrect username or password
                $this->index();
                print_r($query);
            }
        }
        //print_r($query);
    }

    public function signup() {
        $this->load->view('signup_form');
    }

    public function create_member_validate() {
        $this->load->library('form_validation');

        //validation rules
        $this->form_validation->set_rules('first_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[15]|callback_check_username');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('street', 'Street', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('upassword', 'Password', 'trim|required|min_length[5]|max_length[15]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[upassword]');

        if ($this->form_validation->run() == false) {//didn't validate
            $this->load->view('signup_form');
        } else {
            $this->load->model('membership_model');

            if ($query = $this->membership_model->create_member()) {
                $data['account_created'] = 'Your account has been created, </br> You may now login';

                $this->load->view('login_form', $data);
            } else {
                $this->load->view('signup_form');
            }
        }
    }

    function check_username($requested_username) {//custom callback function
        $this->load->model('membership_model');

        $username_available = $this->membership_model->check_username_exists_db($requested_username);

        if ($username_available) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function check_email($requested_email) {//custom callback function
        $this->load->model('membership_model');

        $email_not_in_use = $this->membership_model->check_email_exists_db($requested_email);

        if ($email_not_in_use) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>