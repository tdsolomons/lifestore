<?php
/**
 * Model that Handles all the operations related Searching of Items
 *
 * @package Emarketing portal
 * @author  Thilina Solomons
 */
class Search_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    /**
    * Emails all the users in matching followed searches for a given item
    *
    * @access   public
    * @param    int $item_id id of the new item added
    * @return   void
    */
    public function email_search_followers($item_id){

        //Get all the search criterias that match with the item. Gett all the user and item deatils too
        $sql = "SELECT fs.*, 
                        i.*,
                        fpi.*,
                        ai.*, 
                        u.username, 
                        u.email , 
                        u.first_name, 
                        img.name AS 'image_file_name'
                FROM (followed_search fs, 
                    item i,
                    user u,
                    image img
                    ) 
                LEFT JOIN fixed_price_item fpi
                    ON i.item_id = fpi.item_id
                LEFT JOIN auction_item ai
                    ON i.item_id = ai.item_id
                WHERE i.title LIKE CONCAT('%', fs.keywords, '%')
                    AND i.item_id = '$item_id'
                    AND i.main_image = img.image_id
                    AND u.user_id = fs.user
                    AND i.seller != fs.user
                    AND IF(fs.free_shipping = 1, 0, 1000000) >= i.shipping_cost
                    AND i.condition_type IN (SELECT condition_type
                                            FROM fs_has_condition
                                            WHERE followed_search = fs.search_id)
                    AND (CASE 
                            WHEN fs.item_type = 'auction' THEN ai.item_id
                            WHEN fs.item_type = 'buynow' THEN fpi.item_id
                            ELSE i.item_id
                        END) IS NOT NULL;
    
                ";

        $query = $this->db->query($sql);

        if ($query) {
            //returning the followed searches
            $store_name = 'LifeStore.lk';
            //Traversing through search crieteras
            foreach ($query->result() as $row) {
                //preparing item data for item template
                $item_data['image_file_name'] = $row->image_file_name;

                //Setting price and link data depending on type of the item
                if (isset($row->price)) {
                    $item_data['item_price'] = 'Price: ' . printCurrencyInRs($row->price);
                    $item_data['item_link'] = base_url() .'item/item/?item='. $row->item_id;

                }else if(isset($row->starting_bid)){
                    $item_data['item_price'] = 'Bidding starts at ' . printCurrencyInRs($row->starting_bid) . '
                                    <br>
                                    <span >'. getTimeLeftForDate($row->end_datetime) .'</span>';
                    $item_data['item_link'] = base_url() .'item/AuctionItem/?item='. $row->item_id;
                }

                $item_data['item_title'] = $row->title;
                $item_data['shipping_cost'] = $row->shipping_cost;

                //Setting data for email template
                $data['store_name'] = $store_name;
                $data['recever_name'] = $row->first_name;
                //genetating email content
                $data['email_content'] = 'New item has been added matching your search criteria. 
                                            <br>
                                            Keyword: ' . $row->keywords .
                                            '<br>' . 
                                            $this->load->view('templates/email_item_template', $item_data, true) ;

                //embeding email content in email template
                $email_msg = $this->load->view('templates/email_template', $data, true);
                //preparing the email
                $this->load->library('email');
                $this->email->set_mailtype("html");
                $this->email->from('noreply@sep.tagfie.com', $store_name);
                $this->email->to($row->email); 

                $this->email->subject('New item matching your search has been added');
                $this->email->message($email_msg);  
                //sending email
                $this->email->send();
            }
        }else
            return NULL;        
    }

    /**
    * Returns all the followed searches of logged in user
    *
    * @access   public
    * @return   Array of objects that contains followed searches. Returns null if no results found
    */
    public function get_all_followed_searches(){
        //return if user is not logged in
        if (!isset($_SESSION['user_id'])) {
            return NULL;
        }

        //selecting all followed searches for the logged in user
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT fs.*, u.username 
                FROM (followed_search fs)
                LEFT JOIN user u
                ON fs.seller = u.user_id
                WHERE user = '$user_id'
                ORDER BY search_id DESC";

        $query = $this->db->query($sql);

        if ($query) {
            //returning the followed searches
            return $query->result();
        }else
            return NULL;
    }

    /**
    * Inserts follow search parameters to the data
    *
    * @access   public
    * @param    string $followed_search_id followed_search id
    * @return   BOOL indicates if the unfollow was successful
    */
    public function unfollow_search($followed_search_id){
        //returning if followed_search_id is null
        if ($followed_search_id == NULL) {  
            return FALSE;
        }

        //deleting the record from the database
        $sql = "DELETE FROM followed_search WHERE search_id = '$followed_search_id'";
        $query = $this->db->query($sql);
        //checking if the operation was successful
        if ($query) {
            return TRUE;
        }else
            return FALSE;
    }

    /**
    * Inserts follow search parameters to the data
    *
    * @access   public
    * @param    string $keywords Search keyword
    * @param    string $free_ship is free shipping checked, 'true' or 'false'
    * @param    string $min_price minmum price
    * @param    string $max_price maximum price
    * @param    string $sorting sorting mode value
    * @param    string $item_type Item type as all, action or buynow
    * @param    string $conditions List of item condition values 
    * @param    string $seller_id if items are from specific seller, the Id of seller
    * @return   int index of the followed search. -1 if follow was unsuccessful
    */
    public function follow_search($keywords, 
                                $free_ship, 
                                $min_price, 
                                $max_price, 
                                $sorting, 
                                $item_type, 
                                $condition_types, 
                                $seller_id){

        //return if user is not logged in
        if (!isset($_SESSION['user_id'])) {
            return -1;
        }
        
        //setting price filter values to -1 if empty to avoid being recorded as 0
        if ($min_price == NULL) {
            $min_price = -1;
        }
        if ($max_price == NULL) {
            $max_price = -1;
        }

        //If item type is not specified, set it as 'all'
        if ($item_type == NULL) {
            $item_type = 'all';
        }
        
        //seti 1 if the free shipping is checked, otherwise 0
        if (strcmp($free_ship, 'true') == 0) {
            $free_ship = 1;
        }else{
            $free_ship = 0;
        }

        //Set seller id to -1 if seller is not specified
        if ($seller_id == NULL) {
            $seller_id = -1;
        }

        //Getting logged in user id from session
        $user_id = $_SESSION['user_id'];

        //inserting the followed search criteria to the database
        $sql = "INSERT INTO followed_search(keywords, 
                                            sorting, 
                                            max_price, 
                                            min_price, 
                                            free_shipping, 
                                            item_type,
                                            seller, 
                                            user)
                VALUES ('$keywords',
                        '$sorting', 
                        '$max_price',
                        '$min_price',   
                        '$free_ship', 
                        '$item_type', 
                        '$seller_id',
                        '$user_id'); ";
        
        $query = $this->db->query($sql);
        //checking if the insertion was successfull
        if ($query) {
            //getting the inserted search_id of followed search
            $search_id = $this->db->insert_id();
            //Storing condition types, Preparing the query
            $sql2 = 'INSERT INTO fs_has_condition(followed_search, condition_type)
                            VALUES ';
            $insert_count = 0;
            foreach ($condition_types as $object) {
                //putting the comma mark
                if ($insert_count > 0) {
                    $sql2 .= ',';
                }
                $insert_count++;
                $sql2 .= "('$search_id', '$object')";
            }
            //Running the query
            if ($insert_count > 0) {
                $query = $this->db->query($sql2);
                if ($query) {
                    //returning followed search id
                    return $search_id;
                }else{
                    return -1;
                }
            }else{
                return -1;
            }
            
        }else
            return -1;
    }

    /**
    * returns related keyword suggessions for a given input string
    *
    * @access   public
    * @param    string $inputString user input string
    * @return   array of objects containing related keywords
    */
    public function getKeyWords($inputString){
        //checking if input string is null
        if ($inputString == NULL) {  
            return NULL;
        }else{
            //selecting most frequently searched keywords matching the input
            $sql = "SELECT keyword 
                    FROM keyword 
                    WHERE keyword LIKE '$inputString%'
                    ORDER BY frequency DESC";

            $query = $this->db->query($sql);

            if ($query) {
                //returning the keywords
                return $query->result();
            }else
                return NULL;
        }
    }

    /**
    * inserts new keyword to the DB, records the keywords endtered by users
    *
    * @access   public
    * @param    string $keyword user input keyword
    * @return   BOOL indicates if the insert operation was successful. 
    */
    public function addKeyword($keyword){
        if ($keyword == NULL) {  
            return FALSE;
        }else{
            //Calling the stored proceedure to increse the frequency or add
            $sql = "CALL add_or_update_keyword('$keyword'); ";

            $query = $this->db->query($sql);

            if ($query) {
                return TRUE;
            }else
                return FALSE;
        }
    }

    /**
    * search for items matching to given inputs
    *
    * @access   public
    * @param    string $keywords search keywords user has entered
    * @param    string $freeShipping 'true' if free shipping is checked
    * @param    decimal $minPrice minimum price of the item
    * @param    decimal $maxPrice maximum price of the item
    * @param    string $sorting sorting method:'BM'     - Best Match
    *                                          'TNLF'  - Time: Newly listed first
    *                                          'PSLF'  - Price + Shipping: Lowest first
    *                                          'PSHF'  - Price + Shipping: Highest first
    *                                          'PLF'   - Price : Lowest first
    *                                          'PHF'   - Price : Highest first
    * @param    int[] $conditionTypes array of condition type ids
    * @param    int &$resultRowCount function assign this varible with the result row count
    * @param    int $page index of the page in search result view
    * @param    string $itemType Indicates the type of the items to filter as 'all', 'auction' or 'buynow'
    * @param    int $seller Id of the seller to filter items from a specific seller
    * @return   array of objects containing item details. retuns null if no results found.
    */
    public function search($keywords = '', 
                            $freeShipping, 
                            $minPrice, 
                            $maxPrice, 
                            $sorting, 
                            $conditionTypes, 
                            &$resultRowCount, 
                            $page, 
                            $itemType, 
                            $seller){

        //Search items for a given keywords and Building the query using other functions
        $sql = "SELECT i.* , img.*, ". $this->getColumnsPartOfQueryForType($itemType) . ", u.username
                FROM" . $this->getCommonQuery($itemType). "  AND i.title LIKE '%$keywords%' " 
                . $this->getSellerQuery($seller)
                . $this->getShippingQuery($freeShipping) 
                . $this->getMinPriceQuery($minPrice) 
                . $this->getMaxPriceQuery($maxPrice) 
                . $this->getConditionQuery($conditionTypes)
                . $this->makeSortQuery($sorting, $keywords)
                . $this->getLimitAndOffsetQuery($page)
                 ;
        
    	$query = $this->db->query($sql);
        //Checking the result count, returns null if no results found
    	if($query->num_rows() > 0){
            //this query count all result count
            $couterQuery = $this->getCommonQuery($itemType). "  AND i.title LIKE '%$keywords%' " 
                . $this->getSellerQuery($seller)
                . $this->getShippingQuery($freeShipping) 
                . $this->getMinPriceQuery($minPrice) 
                . $this->getMaxPriceQuery($maxPrice) 
                . $this->getConditionQuery($conditionTypes)
                . $this->makeSortQuery($sorting, $keywords) ;

            //assigning the count of all results to the pass by refference varible
            $resultRowCount = $this->db->count_all_results($couterQuery);
            //returning the search result items
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }

    /**
    * search for items matching to given inputs
    *
    * @access   public
    * @param    string $keywords search keywords user has entered
    * @param    string $freeShipping 'true' if free shipping is checked
    * @param    decimal $minPrice minimum price of the item
    * @param    decimal $maxPrice maximum price of the item
    * @param    string $sorting sorting method:'BM'     - Best Match
    *                                          'TNLF'  - Time: Newly listed first
    *                                          'PSLF'  - Price + Shipping: Lowest first
    *                                          'PSHF'  - Price + Shipping: Highest first
    *                                          'PLF'   - Price : Lowest first
    *                                          'PHF'   - Price : Highest first
    * @param    int[] $conditionTypes array of condition type ids
    * @param    int &$resultRowCount function assign this varible with the result row count
    * @param    int $page index of the page in search result view
    * @param    string $itemType Indicates the type of the items to filter as 'all', 'auction' or 'buynow'
    * @param    int $seller Id of the seller to filter items from a specific seller
    * @return   array of objects containing item details. retuns null if no results found.
    */
    public function getItemsForCategory($categoryId, 
                                        $freeShipping, 
                                        $minPrice, 
                                        $maxPrice, 
                                        $sorting, 
                                        $conditionTypes, 
                                        &$resultRowCount, 
                                        $page, 
                                        $itemType){

        //List all the items for a given category Id
        $query = $this->db->query( "SELECT i.* , img.*, ". $this->getColumnsPartOfQueryForType($itemType) . ", u.username
                                    FROM" . $this->getCommonQuery($itemType) . 
                                    " AND i.category='$categoryId' " 
                                    .  $this->getShippingQuery($freeShipping) 
                                    . $this->getMinPriceQuery($minPrice)
                                    . $this->getMaxPriceQuery($maxPrice)
                                    . $this->getConditionQuery($conditionTypes)
                                    . $this->makeSortQuery($sorting, '')
                                    . $this->getLimitAndOffsetQuery($page)
                                    );
        //Checking the result count, returns null if no results found
        if($query->num_rows() > 0){
            //this query count all result count
            $couterQuery = $this->getCommonQuery($itemType) . 
                                    " AND i.category='$categoryId' " 
                                    .  $this->getShippingQuery($freeShipping) 
                                    . $this->getMinPriceQuery($minPrice)
                                    . $this->getMaxPriceQuery($maxPrice)
                                    . $this->getConditionQuery($conditionTypes)
                                    . $this->makeSortQuery($sorting, '') ;

            //assigning the count of all results to the pass by refference varible
            $resultRowCount = $this->db->count_all_results($couterQuery);
            //returning the search result items
            return $query->result();
        }else{
            return NULL;
        }
    }

    /**
    * Returns seller username for a given seller Id
    *
    * @access   public
    * @param    int $seller_id user input keyword
    * @return   Array of objects containing result
    */
    public function getSellerUsername($seller_id){
        //Return empty string if seller id is null
        if ($seller_id == NULL ) {    
            return '';
        }else{
            //Getting username from database
            $sql = "SELECT username FROM user WHERE user_id='$seller_id';";

            $query = $this->db->query($sql);

            if($query->num_rows() > 0){
                return $query->result();
            }else{
                return '';
            }
        }
    }

    private function getLimitAndOffsetQuery($page = 1){
        if($page == NULL)
            $page = 1;
        $offset = (($page - 1) * getResultsPerPageCount()) ;
        return "LIMIT " . getResultsPerPageCount() . " OFFSET $offset"; //getResultsPerPageCount is from utility_helper
    }

    private function getColumnsPartOfQueryForType($itemType){
        switch ($itemType) {
            case 'buynow':
                return " fpi.price ";
                break;
            case 'auction':
                return " ai.end_datetime, ai.starting_bid ";
                break;
            default:
                return " fpi.price, ai.end_datetime, ai.starting_bid ";
                break;
        }
    }

    private function getCommonQuery($itemType){
        //Contains the common part of the query used to fetch items
        $returnString = "";

        switch ($itemType) {
            case 'buynow':
                $returnString .= "(item i, image img, user u, fixed_price_item fpi )
                                     WHERE i.item_id = fpi.item_id AND ";
                break;

            case 'auction':
                $returnString .= "(item i, image img, user u, auction_item ai )
                                     WHERE  i.item_id = ai.item_id AND ";
                break;

            default:
                //All listings
                $returnString .= "(item i, image img, user u )
                                    LEFT JOIN fixed_price_item fpi
                                    ON i.item_id = fpi.item_id
                                    LEFT JOIN auction_item ai
                                    ON i.item_id = ai.item_id
                                     WHERE ";
                break;
        }

        $returnString .= " i.main_image = img.image_id AND i.seller = u.user_id AND i.item_status = '1' ";
        //  
        return $returnString;
    }

    private function getConditionQuery($conditionTypes){
        if(count($conditionTypes) > 0){
            $conditionQuery = ' AND ( ';
            $addedConitionTypesCount = 0;
            foreach ($conditionTypes as $object) {
                if ($addedConitionTypesCount > 0) {
                    $conditionQuery .= " OR ";
                }
                $conditionQuery .= " i.condition_type ='" . $object . "' ";
                $addedConitionTypesCount += 1;
            }
            return $conditionQuery . ") ";
        }else
            return '';
    }

    private function getShippingQuery($freeShipping = false){
        if($freeShipping == 'true')
            return " AND i.shipping_cost= 0 ";
        else
            return '';
    }

    private function getMinPriceQuery($minPrice = -1){
        if($minPrice > 0)
            return " AND fpi.price > '$minPrice' ";
        else
            return '';
    }

    private function getMaxPriceQuery($maxPrice = -1){
        if($maxPrice > 0)
            return " AND fpi.price < '$maxPrice' ";
        else
            return '';
    }

    private function getSellerQuery($seller){
        if($seller == NULL)
            return '';
        else{
            return " AND i.seller = '$seller' ";
        }
    }

    private function makeSortQuery($sorting = 'BM', $keywords){
        if ($sorting==NULL)
            $sorting = 'BM';
        switch ($sorting) {
            case 'BM':
                    return " ORDER BY CASE 
                                WHEN i.title LIKE '$keywords %' THEN 0
                                WHEN i.title LIKE '% $keywords %' THEN 1
                                WHEN i.title LIKE '$keywords%' THEN 2
                                WHEN i.title LIKE '%$keywords%' THEN 3
                                ELSE 4 END
                            ";
                break;
            case 'TNLF':
                return " ORDER BY i.posted_date DESC ";
                break;
            case 'PSLF':
                return " ORDER BY (fpi.price + i.shipping_cost) ASC ";
                break;
            case 'PSHF':
                return " ORDER BY (fpi.price + i.shipping_cost) DESC ";
                break;
            case 'PLF':
                return " ORDER BY fpi.price ASC ";
                break;
            case 'PHF':
                return " ORDER BY fpi.price DESC ";
                break;
            
            default:
                # code...
                break;
        }
    }

    

    

    public function getAllCategories(){
        $query = $this->db->query("SELECT *
                                    FROM category c
                                    ORDER BY c.category_name"
                                    );

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return NULL;
        }
	}
	
    public function getConditionsTypes(){
        $query = $this->db->query("SELECT c.*
                                    FROM condition_type c
                                    ORDER BY c.condition_id
                                    "
                                    );
        return $query->result();
    }

}