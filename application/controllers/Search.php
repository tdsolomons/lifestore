<?php
/**
 * The Controller that Handles all the operations related Searching of Items
 *
 * @package Emarketing portal
 * @author  Thilina Solomons
 */
class Search extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                session_start();
                 
        }

        public function test(){
                $this->load->model('search_model');
                $data['searches'] = $this->search_model->email_search_followers('181');
        }

        /**
        * Shows all the followed searches of logged in user
        *
        * @access   public
        * @return   void
        */
        public function all_followed_searches(){
                //Getting folowed searches
                $this->load->model('search_model'); 
                $data['searches'] = $this->search_model->get_all_followed_searches();

                $data['title'] = 'Followed Searches';
                //Loading the views
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('followed_searches_view', $data);
                $this->load->view('templates/footer');
        }

        /**
        * Unfollows specific followed search. 
        *
        * @access   public
        * @return   void
        */
        public function unfollow(){
                //reading the followed search id 
                $followed_search_id = $this->input->get('followed_search');
                $redirect_page = $this->input->get('redirect');
                //loading and calling the unfollow function on search model
                $this->load->model('search_model'); 
                $this->search_model->unfollow_search($followed_search_id);

                if (isset($redirect_page)) {
                        redirect('/search/all_followed_searches/' , 'refresh');
                }else{
                        //Preparing redirect url with all the search parameters
                        $parameters = '';
                        //Reading all get varibles and appending to one string
                        foreach ($_GET as $name => $value) {
                                //removing followed index from parameters
                                if (strcmp($name, 'followed') == 0 || strcmp($name, 'followed_search') == 0) {
                                        continue;
                                }
                                //adding & to start of each parameter
                                if (strlen($parameters) != 0) {
                                        $parameters .= '&';
                                }
                                $parameters .=  $name . '=' . $value ;
                        }
                        //redirecting the page 
                        redirect('/search/query/?' . $parameters , 'refresh');
                }
        }

        /**
        * Follows specific search critera. 
        *
        * @access   public
        * @return   void
        */
        public function follow(){
                $this->load->model('search_model'); 
                //Reading all the get parameters
                $keywords = $this->input->get('keywords'); //Retrive $_GET variable
                $free_ship = $this->input->get('freeShip');
                $min_price = $this->input->get('minPrice');
                $max_price = $this->input->get('maxPrice');
                $sorting = $this->input->get('sorting');
                $item_type = $this->input->get('itemType');
                $condition_types = array_filter(explode(',', $this->input->get('cond')),'strlen');
                $seller_id = $this->input->get('seller');

                //calling the function in the search model to follow search
                $followed_search_id = $this->search_model->follow_search($keywords, 
                                                                        $free_ship, 
                                                                        $min_price, 
                                                                        $max_price, 
                                                                        $sorting, 
                                                                        $item_type, 
                                                                        $condition_types, 
                                                                        $seller_id);
                //Preparing redirect url with all the search parameters
                $parameters = '';
                //Reading all get varibles and appending to one string
                foreach ($_GET as $name => $value) {
                        if (strlen($parameters) != 0) {
                                $parameters .= '&';
                        }
                    $parameters .=  $name . '=' . $value ;
                }
                //redirecting the page 
                redirect('/search/query/?' . $parameters . '&followed=' . $followed_search_id , 'refresh');
        }

        /**
        * Searches for a given search criteria and displays the results
        *
        * @access   public
        * @return   void
        */
        public function query(){
                $data['title'] = 'Search Results';
                $this->load->model('search_model');
                $this->load->model('history_model');

                 //Retriving $_GET variables
                $keywords = $this->input->get('keywords');
                $freeShip = $this->input->get('freeShip');
                $minPrice = $this->input->get('minPrice');
                $maxPrice = $this->input->get('maxPrice');
                $sorting = $this->input->get('sorting');
                $itemType = $this->input->get('itemType');
                $page = $this->input->get('page');
                $cond = array_filter(explode(',', $this->input->get('cond')),'strlen');
                $sellerId = $this->input->get('seller');
                $resultRowCount = 0;

                //Recording keyword data for keyword suggesstions
                $data['keywords'] = $keywords;
                $this->search_model->addKeyword($keywords);
                //Getting the result items
                $data['items'] = $this->search_model->search($keywords, $freeShip, $minPrice, $maxPrice, $sorting, $cond, 
                                                                $resultRowCount, $page, $itemType, $sellerId);
                //Getting types of item conditions
                $data['conditionTypes'] = $this->search_model->getConditionsTypes();
                $data['checkedConditionTypes'] = $cond;
                $data['resultRowCount'] = $resultRowCount;
                $data['page'] = $page;
                $data['sellerId'] = $sellerId;
                //Get seller username
                $data['sellerUsername'] = $this->search_model->getSellerUsername($sellerId);

                //Getting recenly viewed items
                $data['recentlyViewdItems'] = $this->history_model->loadRecentlyViewedItems();
                //Loading views
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('search_results_view', $data);
                $this->load->view('templates/footer');
        }

        /**
        * Searches for a given search criteria in a selected category and displays the results
        *
        * @access   public
        * @return   void
        */
        public function category(){
                $data['title'] = 'Shop by category';
                $this->load->model('search_model');

                //Getting search filter inputs
                $categoryId = $this->input->get('category');
                $freeShip = $this->input->get('freeShip');
                $minPrice = $this->input->get('minPrice');
                $maxPrice = $this->input->get('maxPrice');
                $sorting = $this->input->get('sorting');
                $itemType = $this->input->get('itemType');
                $page = $this->input->get('page');
                //Get selected condition types from array
                $cond = array_filter(explode(',', $this->input->get('cond')),'strlen');
                $resultRowCount = 0;

                //Getting search results
                $data['items'] = $this->search_model->getItemsForCategory( $categoryId, $freeShip, $minPrice, $maxPrice, $sorting, $cond, $resultRowCount, $page, $itemType);
                //Geting types of item conditions
                $data['conditionTypes'] = $this->search_model->getConditionsTypes();
                $data['checkedConditionTypes'] = $cond;
                $data['resultRowCount'] = $resultRowCount;
                $data['page'] = $page;
                //Loading views
                $this->load->view('templates/header', $data);
                $this->load->view('templates/search_box');
                $this->load->view('search_results_view', $data);
                $this->load->view('templates/footer');
        }  

        /**
        * Get keyword suggesstions for a user input and returns them
        *
        * @access   public
        * @return   void
        */
        public function getSuggessions(){    
                $keyword = $this->input->get('keyword');
                $this->load->model('search_model');
                $data['keywords'] = $this->search_model->getKeyWords($keyword);
                $this->load->view('keyword_suggetions_view', $data);
        }

        /**
        * Clears history of users
        *
        * @access   public
        * @return   void
        */
        public function clearHistory(){
                $this->load->model('history_model');
                $this->history_model->clearHistory();
                redirect('/search/query/', 'refresh');

        }
}