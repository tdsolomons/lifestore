<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	    $this->load->database();
	}

	
	function index()
	{
		session_start();
		$buttonId=$this->input->get('buttonId');
		$_SESSION['buttonId'] = $buttonId;
		$this->load->view('uploadImage_view', array('error' => ' ' ));
	}

 	
	function loadUpload()
	{
		session_start();
		if(isset($_SESSION['buttonId'])){
			$itemId = $_SESSION['item_id'];
			$this->load->model('Upload_model');
			$imageData=$this->Upload_model->getImages($itemId);
			$this->load->view('addImage_view',$imageData);
		}
		else{					   
		$this->load->view('addImage_view',$data);
		}
	}
	

	
     //Item Details Upload--------------------------------------------
	function add_item()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
        $this->form_validation->set_rules('cost', 'Shipping Cost', 'trim|required|numeric');
        $this->form_validation->set_rules('quantity', 'Available Quantity', 'trim|required|numeric');
       

        if ($this->form_validation->run() == false) {
             $this->load->model('Search_model');
    		 $this->load->view('addItem_view',array('categories'=>$this->Search_model->getAllCategories(),'conditions'=>$this->Search_model->getConditionsTypes()));
        } 
		else {	
			 $this->load->model('Upload_model');
			 $test=array('testValue'=>"");		
			//detail upload -- load image upload page
			if($query = $this->Upload_model->add_item()){
				$this->load->view('addImage_view',$test);
			}
			else{
				echo "Error";
			}
		}
	}
	
	
	
	function add_auction_item()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('s_price', 'Starting Price', 'trim|required|numeric');
		$this->form_validation->set_rules('minBid', 'Minimum Bidding Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('e_date', 'End date', 'trim|required');
        $this->form_validation->set_rules('cost', 'Shipping Cost', 'trim|required|numeric');
        $this->form_validation->set_rules('quantity', 'Available Quantity', 'trim|required|numeric');
       

        if ($this->form_validation->run() == false) {
             $this->load->model('Search_model');
    		 $this->load->view('addAuctionItem1_view',array('categories'=>$this->Search_model->getAllCategories(),'conditions'=>$this->Search_model->getConditionsTypes()));
        } 
		else {	
			 $this->load->model('Upload_model');
			 $test=array('testValue'=>"");		
			//detail upload -- load image upload page
			if($query = $this->Upload_model->add_auction_item()){
				$this->load->view('addImage_view',$test);
			}
			else{
				echo "Error";
			}
		}
	}

	//Item Images Upload------------------------------------------------
	function do_upload()
	{
		session_start();
		$itemId=$_SESSION['item_id'];
		
		$config['upload_path'] = './assets/img/item_images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['file_name'] = mt_rand(100000,10000000).'0000'.$itemId;
		$config['max_size']	= '2000';
		$config['max_width']  = '1920';
		$config['max_height']  = '1080';

		$this->load->library('upload', $config);

		
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('uploadImage_view', $error);
		}
		else
		{
			$data = $this->upload->data();
			$ImageName=$data['raw_name'];	
			$FileName=$data['orig_name'];
			$itemId=$_SESSION['item_id'];					
			$bid=$_SESSION['buttonId'];
			//add imageid to Image table-----
			$this->load->model('Upload_model');
			
			if($bid==1){
				$imageId = $this->Upload_model->add_main_image($ImageName,$FileName,$itemId,$bid);
			}
			else{
				$imageId = $this->Upload_model->add_image($ImageName,$FileName,$itemId,$bid);
			}
			
			
			if($imageId==-1){
			  echo "error uploading";
			}
			else{
			 
			  echo '<script> 
			  			window.opener.location.replace("loadUpload");
 					    window.close(); 
					</script>
					';
			
			}
		}
	}


	
	
	
	
	
	
	
}
?>