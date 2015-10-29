<?php
class Search extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
                 
        }

        public function query(){
                $data['title'] = 'Search Results';
                $this->load->model('search_model');

                $keywords = $this->input->get('keywords'); //Retrive $_GET variable
                $freeShip = $this->input->get('freeShip');
                $minPrice = $this->input->get('minPrice');
                $maxPrice = $this->input->get('maxPrice');
                $sorting = $this->input->get('sorting');
                $page = $this->input->get('page');
                $cond = array_filter(explode(',', $this->input->get('cond')),'strlen');
                $resultRowCount = 0;

                $data['keywords'] = $keywords;
                $data['items'] = $this->search_model->search($keywords, $freeShip, $minPrice, $maxPrice, $sorting, $cond, $resultRowCount, $page);
                $data['conditionTypes'] = $this->search_model->getConditionsTypes();
                $data['checkedConditionTypes'] = $cond;
                $data['resultRowCount'] = $resultRowCount;
                $data['page'] = $page;

                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('search_results_view', $data);
                $this->load->view('templates/footer');
        }

        public function category(){
                $data['title'] = 'Shop by category';
                $this->load->model('search_model');

                $categoryId = $this->input->get('category');
                $freeShip = $this->input->get('freeShip');
                $minPrice = $this->input->get('minPrice');
                $maxPrice = $this->input->get('maxPrice');
                $sorting = $this->input->get('sorting');
                $page = $this->input->get('page');
                $cond = array_filter(explode(',', $this->input->get('cond')),'strlen');
                $resultRowCount = 0;

                $data['items'] = $this->search_model->getItemsForCategory( $categoryId, $freeShip, $minPrice, $maxPrice, $sorting, $cond, $resultRowCount, $page);
                $data['conditionTypes'] = $this->search_model->getConditionsTypes();
                $data['checkedConditionTypes'] = $cond;
                $data['resultRowCount'] = $resultRowCount;
                $data['page'] = $page;

                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('search_results_view', $data);
                $this->load->view('templates/footer');
        }  
}