<?php
class Item extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                 
        }

        public function item(){
                $data['title'] = 'Item details';
                $this->load->model('item_model');
                $item_id = $this->input->get('item');
                
                $data['items'] = $this->item_model->item($item_id);
                $data['images'] = $this->item_model->getItemImages($item_id);
                $data['image'] = $this->item_model->getItemImage($item_id);
                $data['quantity'] = $this->item_model->getAvailableQuantity($item_id);
                $data['color'] = $this->item_model->getColors($item_id);
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('item_view', $data);
                $this->load->view('templates/footer');
        }
}