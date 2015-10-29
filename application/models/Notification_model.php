<?php
class Profile_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
            if (!isset($_SESSION)) {
                session_start();
            }
    }

    public function getLatestItemsOfFollowingSellers(){
            if (!isset($_SESSION['user_id'])) {  
                return NULL;
            }else{
                $userId = $_SESSION['user_id'];
                $sql = "SELECT *
                        FROM notification
                        WHERE to_user = '$userId'
                        ORDER BY noti_time DESC
                        ";

                $query = $this->db->query($sql);

                if ($query) {
                    return $query->result();
                }else
                    return NULL;
            }
    }

}