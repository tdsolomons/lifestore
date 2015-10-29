<?php
/**
 * Deals Class
 * Controller for all the deals realated activities
 *
 * @package     EMarketingPortal
 * @author      Thilina Solomons
 */
class Deals extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
                 
        }

        /**
        * Shows currently active deals for buyers
        *
        * @access   public
        * @return   void
        */
        public function all_deals(){
                $data['title'] = 'Deals';
                $this->load->model('deals_model');
                //get deals from the deals model
                $data['deals'] = $this->deals_model->get_all_deals();
                //loading views
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('all_deals_view', $data);
                $this->load->view('templates/footer');
        }

        /**
        * Shows manage deals page for logged in seller
        *
        * @access   public
        * @return   void
        */
        public function manage_deals(){
                $data['title'] = 'Manage Deals';
                $this->load->model('deals_model'); 
                //getting the list of deals of logged in seller
                $data['deals'] = $this->deals_model->get_sellers_deals();

                //loading views
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('manage_deals_view', $data);
                $this->load->view('templates/footer');
        }

        /**
        * Shows the select Item page for Creating a new deal
        *
        * @access   public
        * @return   void
        */
        public function select_item(){
                $data['title'] = 'Select Item';
                $this->load->model('deals_model');      
                $data['items'] = $this->deals_model->get_sellers_items(); 

                //loading views
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('create_deal_select_item_view', $data);
                $this->load->view('templates/footer');  
        }

        /**
        * Shows the page for Creating a new deal for a Item passed as $_GET variable
        *
        * @access   public
        * @return   void
        */
        public function create_deal(){
                $data['title'] = 'Create Deal';
                $this->load->model('deals_model'); 

                //Getting the item info
                $item_id = $this->input->get('item');
                $this->load->model('item_model');
                $data['items'] = $this->item_model->item($item_id);

                //loading views
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('create_deal_view', $data);
                $this->load->view('templates/footer');
        } 

        /**
        * Submits the create deal info and redirects back to Manage deals page
        *
        * @access   public
        * @return   void
        */
        public function create_deal_submit(){
                $data['title'] = 'Create Deal';
                $this->load->model('deals_model'); 

                //Getting the deal info
                $item_id = $this->input->post('item');
                $end_date = $this->input->post('date') . ' ' . $this->input->post('time') . ':00';
                $off_perc = $this->input->post('percentage');

                $this->load->helper('url');
                //Creating the deal
                if($this->deals_model->create_deal($item_id, $end_date, $off_perc)){
					
					//Checking the wishlist items .
						$this->load->model('wishlist_model'); 
						$this->wishlist_model->check($item_id, $off_perc);
						
                        redirect('/Deals/manage_deals', 'refresh');
                }else{
                        redirect('/Deals/create_deal/?item=' . $item_id . '&error=TRUE', 'refresh');
                }

        }
		

        /**
        * Ends a deal when seller removes a deal on the manage deal page
        * Redirects back to Manage deals page when done
        *
        * @access   public
        * @return   void
        */
        public function end_deal(){
                $this->load->model('deals_model'); 

                //Getting the deal info
                $deal_id = $this->input->get('deal');
                $this->deals_model->end_deal($deal_id);
                //shows manage deals page
                $this->load->helper('url');
                redirect('/Deals/manage_deals', 'refresh');
        }          
}