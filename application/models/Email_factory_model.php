<?php
class Email_factory{

    public static function create_email($email_type, $sender_id, $creceiver_id, $mesage_body){
        if ($email_type = 'MESSAGE') {
            return
        }
    }
}

class Email{
    public $sender_username;
    public $receiver_email;
    public $recever_name;
    public $message_body;
    public $subject;

    const $store_name = 'LifeStore.lk';

    public function __construct()
    {
            $this->load->database();
    }

    function load_receiver($receiver_id){
        $sql = "SELECT email, first_name, last_name 
                    FROM user 
                    WHERE user_id = '$receiver_id' LIMIT 1";
        $query3 = $this->db->query($sql);
        foreach ($query3->result() as $row){
            $recever_name = $row->first_name . ' ' . $row->last_name;
            $receiver_email = $row->email;
        }
    }

    function set_subject($email_subject){
        $subject = $email_subject;
    }

    function embed_in_template($email_content){
        $email_body = '<html><head></head>
            <body>
            <table cellspacing="0" cellpadding="0" style="padding:30px 10px;background:#EEE;width:100%;font-family:arial">
            <tbody>   
            <tr>
                <td>
                    <table cellspacing="0" align="center" style="max-width:650px;min-width:320px">
                        <tbody>
                            <tr>
                                <td style="text-align:left;padding-bottom:14px">
                                    <img align="left" src="'. asset_url() .'img/logolife.png" alt="'. $store_name .'"></img>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="background:#FFF;border:1px solid #e4e4e4;padding:50px 30px">
                                    <table align="center">
                                    <tbody>
                                    
                                    <tr>
                                        <td style="color:#666;padding:15px 5px;font-size:14px;line-height:20px;font-family:arial">
                                            <p style="font-weight:bold;font-size:16px">Hello ' . $recever_name . ',</p>' .
                                            $email_content  
                                                   . 'Best Regards,
                                                    <br/>
                                                    '. $store_name .'
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

                                © '. $store_name .' 2015 
                                
                            </td>

                        </tr>
                    </tbody></table>
                
            </tr>
            </tbody>
        
            </table>
            </body>
            </html>';
            return $email_body;
    }

    function send(){
        $this->load->library('email');
        $this->email->set_mailtype("html");
        $this->email->from('noreply@sep.tagfie.com', $storeName);
        $this->email->to($receiver_email); 

        $this->email->subject($subject);
        $this->email->message($emailBody);  

        $this->email->send();
    }
}

class Followed_search_email extends Email{
    private $search_keyword;

    public function _construct($sender_id, $receiver_id, $item_id, $search_keyword){
        $parent::load_receiver($receiver_id);
        $search_keyword = $search_keyword;     
    }

    function set_subject(){
        parent::set_subject('New item added matching your followed search ' . $search_keyword);
    }

    function load_item($item_id){
        $sql = "SELECT title FROM item WHERE item_id = '$item_id'";
        $query1 = $this->db->query($sql);
        $itemTitle = "";
        if ($query1) {
            foreach ($query1->result() as $row)
             {
                $itemTitle = $row->title;abs(number)
             }
        }
    }

    function send(){
        parent::send();
    }
}

class Message_email extends Email{

    public function _construct($sender_id, $receiver_id, $content, $about_item_id, $reply_thread = NULL){
        $parent::load_receiver($receiver_id);
    }
}