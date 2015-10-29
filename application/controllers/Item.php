<?php
class Item extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
				$this->load->helper('url');
                session_start();
        }

		/*this method displays the item details in the item page on the selected item*/
        public function item(){
	
                $data['title'] = 'Item details';
                $this->load->model('item_model');
                $item_id = $this->input->get('item');
                $data['offermsg'] = $this->input->get('offer');
				//History 
                $this->load->model('history_model');
                $this->history_model->addItemToViewedHistory($item_id);

                $data['items'] = $this->item_model->item($item_id);
                $data['images'] = $this->item_model->getItemImages($item_id);
                $data['image'] = $this->item_model->getItemImage($item_id);
                $data['quantity'] = $this->item_model->getAvailableQuantity($item_id);
                $data['color'] = $this->item_model->getColors($item_id);
				
				//addition made- the recently viewed items can be viewed here below the item
				$this->load->model('Trending_model');
				$data['others_viewed'] = $this->Trending_model->others_viewed_items();
				$data['trending_items'] = $this->Trending_model->get_trending_items();
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('item_view', $data);
                $this->load->view('templates/footer');
        }

		/*this method displays the item details in the item page on the selected auction item*/
        public function AuctionItem(){
                $data['title'] = 'Item details';
                $this->load->model('item_model');
                $item_id = $this->input->get('item');
                $data['auctionItem'] = TRUE;

                //History 
                $this->load->model('history_model');
                $this->history_model->addItemToViewedHistory($item_id);
                
                $data['items'] = $this->item_model->getAuctionItem($item_id);
                $data['images'] = $this->item_model->getItemImages($item_id);
                $data['image'] = $this->item_model->getItemImage($item_id);
                $data['quantity'] = $this->item_model->getAvailableQuantity($item_id);
                $data['color'] = $this->item_model->getColors($item_id);
				$data['bid_count'] = $this->item_model->getBidCount($item_id);
	
                date_default_timezone_set('Asia/Colombo');
                $data['timeLeft'] = date_parse($data['items'][0]->end_datetime) ;
				
				//addition made- the recently viewed items can be viewed here below the item
				$this->load->model('Trending_model');
				$data['others_viewed'] = $this->Trending_model->others_viewed_items();
				$data['trending_items'] = $this->Trending_model->get_trending_items();
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('auction_item_view', $data);
                $this->load->view('templates/footer');
                
               
        }

        public function bid(){
                $amount = addslashes($this->input->post('amount'));
                $itemId = $this->input->post('item_id');
                $userId = $_SESSION['user_id'];

				$this->load->model('BidExceed_model');			
			 	$result = $this->BidExceed_model->getBidExceed($itemId);
                $this->load->model('item_model');
                $this->item_model->bid($itemId, $amount, $userId);
				

                redirect('/item/AuctionItem/?item=' . $itemId, 'refresh');
        }
		 
		public function Bidder(){
            
                $this->load->model('item_model');
                $item_id = $this->input->get('item');
				  
                $data['bidInfo'] = $this->item_model->getBidInformation($item_id);
             
				
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('bid_view', $data);
                $this->load->view('templates/footer');
             
        }

	public function Offer(){

			$itemId = $this->input->post('item_id');
			$qty = $this->input->post('offerQty');
			$userId = $_SESSION['user_id'];
			$amount = addslashes($this->input->post('amount'));
			$this->load->model('item_model');
			$this->item_model->insertOffer($itemId, $amount,$qty,$userId);	
			
        redirect('/item/item/?item=' . $itemId.'&offer=success');			
		}
}

?>