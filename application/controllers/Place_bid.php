<?php

class Place_bid extends CI_Controller {



        public function __construct()

        {

                parent::__construct();

				   session_start();

				

                 

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

                $this->load->view('placebid_view');

                $this->load->view('templates/footer');

        }

		

		public function add($id){

			 $this->load->model('placebid_model');

			 $item_id = $id;



			$bid = array(

			'auction_item'=>$item_id,

			'bid_datetime'=>date('Y-m-d H:i:s'),

			'amount'=>$this->input->post('bidvalue'),

			'bidder'=>1,

			

			);

			$this->placebid_model->insertbid($bid);

			$_SESSION["message"] = "succsesfully placed a bid";



			redirect('place_bid/item/?item='.$id.'&message=success');

			

			

			}

		

}
?>