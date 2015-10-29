<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Placebid_Model extends CI_Model{
	   public function __construct()
    {
            parent::__construct();
		     $this->load->database();
    }
	
public function insertbid ($data)
{
	return $this->db->insert('bid',$data);
	
	
	
}
}