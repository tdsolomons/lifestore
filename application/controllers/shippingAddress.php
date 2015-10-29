
<?php

class Shipping_address extends CI_Controller {
	
	
    function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->database();
	}
	

    public function index() {

		$username =  'sachDee'; //----------------------------------------------------------------check..!!
		    //$username =  $_SESSION['username'];
            echo $username ."\n";

        //$array = $this->session->all_userdata();
        //$username = $array['username'];
        //echo $username;
        
        $itemID = 1;

        $this->load->model('Shipping_model');
        $query['resultItem'] = $this->Shipping_model->getItemData($itemID);
        $query['resultUser'] = $this->Shipping_model->getUserData($username);
        $this->load->view('shipping_form', $query);
    }

}

?>
