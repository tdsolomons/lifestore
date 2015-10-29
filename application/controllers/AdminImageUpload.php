<?php 

	class AdminImageUpload extends CI_Controller {
		
		public function __construct() {
			parent::__construct();
			$this->load->helper(array('form', 'url'));
	    	$this->load->database();
			session_start();
		}
		
		public function index(){

				$this->load->model('Category_model');
				$this->load->view('templates/adminHeader');
				$this->load->view('uploadBannerView', array('error' => ' ' ));
			    $this->load->view('templates/footer');
		}

			
		public function file_view(){
			$this->load->view('file_view', array('error' => ' ' ));
		}
		
		public function do_upload_banner(){
			$config = array(
				'upload_path' => "./assets/img/banner_images/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'max_width' => "1024"
				);
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload()){
				
				$data['image'] = array('upload_data' => $this->upload->data());
				//$this->load->view('home_view',$data);
				$this->index();
				
			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('file_view', $error);
			}
		}
		
		public function do_upload_category(){
			
			$config = array(
				'upload_path' => "./assets/img/category_images/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'max_width' => "1024"
				);
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload()){
				
				$data = array('upload_data' => $this->upload->data());
				//$this->load->view('subCategoriesView',$data);
				$this->index();
				
			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('file_view', $error);
			}
		}





		public function delete_im(){
			$ida = $this->input->get('Id');
			unlink('assets/img/banner_images/'.$ida);
			$this->index();
		
		
		}



}
?>