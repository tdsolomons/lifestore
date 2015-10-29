<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buynow_Model extends CI_Model{
	   public function __construct()
    {
            parent::__construct();
		     $this->load->database();
    }
	
public function insertItems ($data)
{
	return $this->db->insert('order',$data);
	
	
	
}
}