<?php
/**
 * Handles all the operations related to viewing of deals
 *
 * @package Codigniter
 * @subpackage  Emarketing portal
 * @author  Thilina Solomons
 */
class Deals_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    /**
    * Returns all deals available at the time
    *
    * @access   public
    * @return   array of objects
    */
    public function get_all_deals(){
        //Left joins deals if available 
        $sql = "SELECT d.deal_id, 
                    d.off_percentage, 
                    d.end_time, 
                    fpi.price, 
                    i.item_id, 
                    i.title, 
                    i.shipping_cost, 
                    i.available_quantity, 
                    img.file_name
                FROM deal d, fixed_price_item fpi, item i, image img
                WHERE d.fixed_price_item = fpi.item_id
                    AND fpi.item_id = i.item_id
                    AND i.main_image = img.image_id
                    AND d.end_time > NOW()
                ORDER BY off_percentage DESC";

        $query = $this->db->query($sql);
        
        if ($query) {
            return $query->result();
        }else
            return NULL;
        
    }

    /**
    * Returns all deals initiated by logged in seller
    *
    * @access   public
    * @return   array of objects
    */
    public function get_sellers_deals(){
        //Checking if user is logged in
        if (!isset($_SESSION['user_id'])) {  
            return NULL;
        }else{
            //Getting logged in users Id
            $user_id = $_SESSION['user_id'];
            //Left joins deals if available 
            $sql = "SELECT d.deal_id, 
                        d.off_percentage, 
                        d.end_time, 
                        fpi.price, 
                        i.item_id, 
                        i.title, 
                        i.shipping_cost, 
                        i.available_quantity, 
                        img.file_name,
                        CASE 
                            WHEN d.end_time < NOW() THEN 'Ended'
                            ELSE 'Active' 
                        END AS 'deal_status'
                    FROM deal d, fixed_price_item fpi, item i, image img
                    WHERE d.fixed_price_item = fpi.item_id
                        AND fpi.item_id = i.item_id
                        AND i.main_image = img.image_id
                        AND i.seller = '$user_id'
                    ORDER BY d.end_time DESC";

            $query = $this->db->query($sql);
            
            if ($query) {
                return $query->result();
            }else{
                return NULL;
            }
        }
    }

    /**
    * Returns all items that are available for deal(That does not have a active deal) 
    * sold by logged in seller
    *
    * @access   public
    * @return   array of objects
    */
    public function get_sellers_items(){
        //Getting logged in users Id
        $user_id = $_SESSION['user_id'];
        //Left joins deals if available 
        $sql = "SELECT 
                    i.item_id, 
                    i.title,
                    fpi.price, 
                    i.shipping_cost, 
                    i.available_quantity, 
                    img.file_name,
                    d.deal_id
                FROM (fixed_price_item fpi, item i, image img)
                LEFT JOIN deal d
                ON d.fixed_price_item = fpi.item_id AND d.end_time > NOW()
                WHERE fpi.item_id = i.item_id
                    AND i.main_image = img.image_id
                    AND i.seller = '$user_id'
                    AND d.deal_id IS NULL"
                ;
        $query = $this->db->query($sql);
        
        if ($query) {
            return $query->result();
        }else{
            return NULL;
        }
    }

    /**
    * Creates deal for a fixed price item
    *
    * @access   public
    * @param    string $item_id id of the fixed-price item
    * @param    string $end_date Ending time of the deal
    * @param    int $off_percentage Percentage of the discount
    * @return   BOOL
    */
    public function create_deal($item_id, $end_date, $off_percentage){
        if (!isset($_SESSION['user_id'])) {  
            return FALSE;
        }else{
            $user_id = $_SESSION['user_id'];
            $sql = "CALL create_deal('$item_id', '$end_date', '$off_percentage' , '$user_id'); ";

            $query = $this->db->query($sql);

            if ($query) {
                return TRUE;
            }else
                return FALSE;
        }
    }

    /**
    * End/Remove a deal 
    *
    * @access   public
    * @param    string $deal_id id of the deal
    * @return   BOOL
    */
    public function end_deal($deal_id){
        //Setting end time of the deal to past 
        $sql = "UPDATE deal SET end_time = NOW() WHERE deal_id = '$deal_id' ";

        $query = $this->db->query($sql);

        if ($query) {
            return TRUE;
        }else
            return FALSE;
    }

}