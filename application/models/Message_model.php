<?php
class Message_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function listAllMessages($userId){
    	$sql = "SELECT m.*, u1.username AS 'sender_username', u1.user_id AS 'sender_user_id' , i.title, i.item_id, i.seller
                FROM message m, user u1, user u2, item i
    			WHERE  m.receiver = '$userId'
                AND m.sender = u1.user_id AND m.receiver = u2.user_id
                AND m.about_item = i.item_id
                ORDER BY m.sent_time DESC";

    	$query = $this->db->query($sql);

    	if($query->num_rows() > 0){
    		return $query->result();
    	}else{
    		return NULL;
    	}

    }

    public function sendMessage($senderId, $receiverId , $content, $aboutItemId){
        $sql = "INSERT INTO message(sender, receiver, content, about_item, sent_time) 
                VALUES('$senderId', 
                    '$receiverId', 
                    '$content', 
                    '$aboutItemId', 
                    NOW()
                        
                        )";

        $query = $this->db->query($sql);

        if ($query) {
            $lastInsert = $this->db->insert_id();
            $sql = "CALL set_reply_thread_for_new_msg('$lastInsert')";
            $query2 = $this->db->query($sql);
            
            $this->sendEmail($senderId, $receiverId , $content, $aboutItemId);

            return TRUE;
        }else
            return FALSE;
    }

    public function replyToMessageThread($senderId, $receiverId , $content, $aboutItemId, $replyThread){
        $sql = "INSERT INTO message(sender, receiver, content, about_item, sent_time, reply_thread) 
                VALUES('$senderId', 
                    '$receiverId', 
                    '$content', 
                    '$aboutItemId', 
                    NOW(),
                     '$replyThread'   
                        )";

        $query = $this->db->query($sql);

        if ($query) {
            $this->sendEmail($senderId, $receiverId , $content, $aboutItemId, $replyThread);
            return TRUE;
        }else
            return FALSE;
    }

    public function getAllMsgsInThread($replyThread){
        $sql = "SELECT * FROM message m WHERE m.reply_thread = '$replyThread'";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result();
        }else{
            return NULL;
        }

    }

    private function sendEmail($senderId, $receiverId , $content, $aboutItemId, $replyThread = NULL){
        //Sending email

            $sql = "SELECT title FROM item WHERE item_id = '$aboutItemId'";
            $query1 = $this->db->query($sql);
            $itemTitle = "";
            if ($query1) {
                foreach ($query1->result() as $row)
                 {
                    $itemTitle = $row->title;
                 }
            }


            $sql = "SELECT email, first_name, last_name 
                    FROM user 
                    WHERE user_id = '$receiverId' LIMIT 1";
            $query3 = $this->db->query($sql);

            if ($query3) {
                 foreach ($query3->result() as $row)
                 {

                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('noreply@sep.tagfie.com', 'Emarketing Portal');
                    $this->email->to($row->email); 

                    $emailSubject = '';

                    if (isset($replyThread)) {
                        $emailSubject = 'You have a reply to the message about ' . $itemTitle;
                    }else{
                        $emailSubject = 'You have a new message about '. $itemTitle;
                    }

                    $this->email->subject($emailSubject);

                    $emailBody = 'Hello ' . $row->first_name . ' ' . $row->last_name   . ',' 
                                    .  '<br> You have received following message regarding ' 
                                    . $itemTitle 
                                    . ' <br>' 
                                    . $content;

                    $this->email->message($emailBody);  

                    $this->email->send();
                 }
            }
    }



}
