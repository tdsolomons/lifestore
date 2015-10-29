<?php
class Message_model extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function listAllMessages($userId, $messageFilter){
        $sql = '';
        if ($messageFilter == 'inbox') {
            $sql = "SELECT m.*, u1.username AS 'sender_username', u1.user_id AS 'sender_user_id' , i.title, i.item_id, i.seller
                FROM message m, user u1, user u2, item i
                WHERE  m.receiver = '$userId'
                AND m.sender = u1.user_id AND m.receiver = u2.user_id
                AND m.about_item = i.item_id
                ORDER BY m.sent_time DESC";
        }else{
            $sql = "SELECT m.*, u1.username AS 'sender_username', u1.user_id AS 'sender_user_id', 
                    u2.username AS 'receiver_username', u2.user_id AS 'receiver_user_id' , i.title, i.item_id, i.seller
                FROM message m, user u1, user u2, item i
                WHERE  m.sender = '$userId'
                AND m.sender = u1.user_id AND m.receiver = u2.user_id
                AND m.about_item = i.item_id
                ORDER BY m.sent_time DESC";
        }
    	

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

        //After getting messages, all messages in thread mark as read.
        $loggedInUserId = $_SESSION['user_id'];
        $sql2 = "UPDATE message SET `read` = '1' WHERE reply_thread = '$replyThread' and receiver = '$loggedInUserId'";
        $query2 = $this->db->query($sql2);

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
                 foreach ($query3->result() as $row){
                    $storeName = 'LifeStore.lk';
                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('noreply@sep.tagfie.com', $storeName);
                    $this->email->to($row->email); 

                    $emailSubject = '';

                    if (isset($replyThread)) {
                        $emailSubject = 'You have a reply to the message about ' . $itemTitle;
                    }else{
                        $emailSubject = 'You have a new message about '. $itemTitle;
                    }

                    $this->email->subject($emailSubject);

                    $emailBody = '<html><head></head>
            <body>
            <table cellspacing="0" cellpadding="0" style="padding:30px 10px;background:#EEE;width:100%;font-family:arial">
            <tbody>
                    
            <tr>
                <td>
                    <table cellspacing="0" align="center" style="max-width:650px;min-width:320px">
                        <tbody>
                            <tr>
                                <td style="text-align:left;padding-bottom:14px">
                                    <img align="left" src="'. asset_url() .'img/logolife.png" alt="'. $storeName .'"></img>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background:#FFF;border:1px solid #e4e4e4;padding:50px 30px">
                                    <table align="center">
                                    <tbody>
                                    
                                    <tr>
                                        <td style="color:#666;padding:15px 5px;font-size:14px;line-height:20px;font-family:arial">
                                            <p style="font-weight:bold;font-size:16px">Hello ' . $row->first_name . ' ' . $row->last_name   . 
                                            ',</p>' 
                                    .  '<br> You have received following message regarding the item <strong>' 
                                    . $itemTitle 
                                    . '</strong> <br><p>' 
                                    . $content . '</p><p><a href="http://sep.tagfie.com/messages/messages">View and reply</a></p>
                                                                                Best Regards,
                                                                                <br/>
                                                                                '. $storeName .'
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="background:#F8F8F8;border:1px solid #e4e4e4;border-top:none;padding:24px 10px">
                                                            <p></p>         
                                                            
                                                            </td>               
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            
                                                <table style="max-width:650px" align="center">
                                                    
                                                    <tbody><tr>
                                                        <td style="color:#b4b4b4;font-size:11px;padding-top:10px;line-height:15px;font-family:arial">

                                                            © '. $storeName .' 2015 
                                                            
                                                        </td>

                                                    </tr>
                                                </tbody></table>
                                            
                                        </tr>
                                        </tbody>
                                    
                                        </table>
                                        </body>
                                        </html>';

                    $this->email->message($emailBody);  

                    $this->email->send();
                 }
            }
    }



}
