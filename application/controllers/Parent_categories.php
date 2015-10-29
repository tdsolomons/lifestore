<?php

class Parent_categories extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
    }

    public function index() {

        $this->load->model('Category_model');
        $categoryList['categories'] = $this->Category_model->getCategories();
		$this->load->view('templates/adminHeader');
        $this->load->view('categoriesView', $categoryList);
		$this->load->view('templates/footer');
    }

    public function addCategory() {

        $newCategory = $this->input->post('new_category');
        $this->load->model('Category_model');
        $this->Category_model->addC($newCategory);
        $this->index();
    }

    public function deleteCategory() {

        $cid = $_GET['cid'];
        $this->load->model('Category_model');
        $this->Category_model->deleteC($cid);
        $this->index();
    }

    public function updateCategoryView() {

        $categoryList['cid'] = $_GET['cid'];
        $this->load->model('Category_model');
        $categoryList['categories'] = $this->Category_model->getCategories();
		$this->load->view('templates/adminHeader');
        $this->load->view('categoriesEdit', $categoryList);
		$this->load->view('templates/footer');
    }

    public function updateCategory() {

        $pcid = $_GET['cid'];
        $this->load->model('Category_model');
        $this->Category_model->updateC($pcid);
        $this->index();
        
    }
}
?>