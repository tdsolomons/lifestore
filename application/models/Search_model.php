<?php
class Search_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function search($keywords = '', $freeShipping, $minPrice, $maxPrice, $sorting, $conditionTypes, &$resultRowCount, $page){
        //Search items for a given keywords and Building the query using other functions
        $sql = "SELECT i.* , img.*, fpi.price, u.username
                FROM" . $this->getCommonQuery(). "  AND i.title LIKE '%$keywords%' " 
                . $this->getShippingQuery($freeShipping) 
                . $this->getMinPriceQuery($minPrice) 
                . $this->getMaxPriceQuery($maxPrice) 
                . $this->getConditionQuery($conditionTypes)
                . $this->makeSortQuery($sorting, $keywords)
                . $this->getLimitAndOffsetQuery($page)
                 ;
        
    	$query = $this->db->query($sql);
        //Checking the result count
    	if($query->num_rows() > 0){
            //this query count all result count
            $couterQuery = $this->getCommonQuery(). "  AND i.title LIKE '%$keywords%' " 
                . $this->getShippingQuery($freeShipping) 
                . $this->getMinPriceQuery($minPrice) 
                . $this->getMaxPriceQuery($maxPrice) 
                . $this->getConditionQuery($conditionTypes)
                . $this->makeSortQuery($sorting, $keywords) ;

            $resultRowCount = $this->db->count_all_results($couterQuery);
    		return $query->result();
    	}else{
    		return NULL;
    	}
    }

    public function getItemsForCategory($categoryId, $freeShipping, $minPrice, $maxPrice, $sorting, $conditionTypes, &$resultRowCount, $page){
        //List all the items for a given category Id
        $query = $this->db->query( "SELECT i.* , img.*, fpi.price, u.username
                                    FROM" . $this->getCommonQuery() . 
                                    " AND i.category='$categoryId' " 
                                    .  $this->getShippingQuery($freeShipping) 
                                    . $this->getMinPriceQuery($minPrice)
                                    . $this->getMaxPriceQuery($maxPrice)
                                    . $this->getConditionQuery($conditionTypes)
                                    . $this->makeSortQuery($sorting, '')
                                    . $this->getLimitAndOffsetQuery($page)
                                    );

        if($query->num_rows() > 0){
            //this query count all result count
            $couterQuery = $this->getCommonQuery() . 
                                    " AND i.category='$categoryId' " 
                                    .  $this->getShippingQuery($freeShipping) 
                                    . $this->getMinPriceQuery($minPrice)
                                    . $this->getMaxPriceQuery($maxPrice)
                                    . $this->getConditionQuery($conditionTypes)
                                    . $this->makeSortQuery($sorting, '') ;

            $resultRowCount = $this->db->count_all_results($couterQuery);

            return $query->result();
        }else{
            return NULL;
        }
    }

    private function getLimitAndOffsetQuery($page = 1){
        if($page == NULL)
            $page = 1;
        $offset = (($page - 1) * getResultsPerPageCount()) ;
        return "LIMIT " . getResultsPerPageCount() . " OFFSET $offset"; //getResultsPerPageCount is from utility_helper
    }

    private function getCommonQuery(){
        //Contains the common part of the query used to fetch items
        return " (item i, image img, user u )
                                    LEFT JOIN fixed_price_item fpi
                                    ON i.item_id = fpi.item_id
                                    LEFT JOIN auction_item ai
                                    ON i.item_id = ai.item_id
                                    WHERE i.main_image = img.image_id AND i.seller = u.user_id
                ";
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