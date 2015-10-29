<?php

class SubCategories extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
       	session_start();
    }

    public function index() {

        $this->load->model('Category_model');
        $categoryList['subCategories'] = $this->Category_model->getSubCategories();
      	$this->load->view('templates/adminHeader');
	    $this->load->view('subCategoriesView', $categoryList);
		$this->load->view('templates/footer');
      
    }
    
    public function addSubCategory() {

        $newSubCategory = $this->input->post('newSubcategory');
        $this->load->model('Category_model');
        $this->Category_model->addSubC($newSubCategory);
        $this->index();
        
    }

    public function deleteSubCategory() {

        $cid = $_GET['cid'];
        $this->load->model('Category_model');
		$this->Category_model->deleteSubC($cid);
		$this->index();

        
    }

    public function updateSubCategoryView(){
  
        $category_list['cid'] = $_GET['cid'];
		$cid = $_GET['cid'];
        $this->load->model('Category_model');
        $category_list['subCategories'] = $this->Category_model->getSubCategories();
        $category_list['categories'] = $this->Category_model->getAllCategories();
		$category_list['check'] = $this->Category_model->checkCategories($cid);
		$this->load->view('templates/adminHeader');
        $this->load->view('subCategoriesEdit', $category_list);
		$this->load->view('templates/footer');
        
    }
    
    public function updateSubCategory() {

        $scid = $_GET['cid'];
        $this->load->model('Category_model');
        $this->Category_model->updateSubC($scid);
        $this->index();
        
    }
    
	function checkCategories($scid){
		
		$this->load->model('Category_model');
        $result['check'] = $this->Category_model->checkCategories($scid);
		return $result;
		
	}
	
	public function load_category_im_upload(){
			$subCatId=$this->input->get('subCatId');
			$_SESSION['subCatId'] = $subCatId;
		
			$this->load->view('uploadCatImage_view', array('error' => ' ' ));
	
	}
	
	
	public function upload_category_image(){
			$subCatId=$_SESSION['subCatId'];
			
			$config = array(
				'upload_path' => "./assets/img/category_images/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf|svg",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'max_width' => "1024",
				'file_name' => $subCatId
				);
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload()){
				
				$data = array('upload_data' => $this->upload->data());
				
								
				 echo '<script> 
			  			window.opener.location.reload(false);
 					    window.close(); 
					</script>
					';
					$_SESSION['subCatId']="";
			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('uploadCatImage_view', $error);
				$_SESSION['subCatId']="";
			}
		}

}

?>