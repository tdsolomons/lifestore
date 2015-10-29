<?php

class Category_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getCategories() {

        $queryCategory = $this->db->query("SELECT * FROM parent_category");
        $resultCategory = $queryCategory->result();
        if ($queryCategory->num_rows() > 0) {
            return $resultCategory;
        } else {
            return FALSE;
        }
    }

    public function getSubCategories() {

        $querySubCategory = $this->db->query("select c.category_id, c.category_name, p.parent_category 
												from EMarketingPortal.category c 
												inner join EMarketingPortal.parent_category p 
												on c.parent_category = p.parent_category_id");
        $resultSubCategory = $querySubCategory->result();
        if ($querySubCategory->num_rows() > 0) {
            return $resultSubCategory;
        } else {
            return FALSE;
        }
    }

    public function addC($newCat) {

        $insert = $this->db->query("INSERT INTO parent_category (parent_category) VALUES ('" . $newCat . "')");
        return $insert;
    }

    public function deleteC($catID) {

        $delete = $this->db->query("DELETE FROM parent_category WHERE parent_category_id =$catID");
		
        return $delete;
    }

    public function updateC($pcid) {

        $update_pcat = array(
            'parent_category' => $this->input->post('categoryEdit'),
        );
        $this->db->where('parent_category_id', $pcid);
        if ($this->db->update('parent_category', $update_pcat)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getAllCategories() {
        $queryAll = $this->db->query("SELECT * FROM parent_category");
        $resultAll = $queryAll->result();
        if ($queryAll->num_rows() > 0) {
            return $resultAll;
        } else {
            return FALSE;
        }
    }

    public function addSubC($newSubCat) {

        $insert = $this->db->query("INSERT INTO category (category_name) VALUES ('" . $newSubCat . "')");
        return $insert;
    }

    public function deleteSubC($subcatID) {

        $delete = $this->db->query("DELETE FROM category WHERE category_id =$subcatID");
        return $delete;
    }

    public function updateSubC($scid) {

        $update_cat = array(
            'category_name' => $this->input->post('subCategoryEdit'),
            'parent_category' => $this->input->post('parent_category_edit'),
            //'category_image' => $this->input->post('subCategoryImage'),
        );
        $this->db->where('category_id', $scid);
        if ($this->db->update('category', $update_cat)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

	  function checkCategories($scid) {
        $queryAll = $this->db->query("select item_id from item where category =$scid ;");
        $resultAll = $queryAll->result();
        if ($queryAll->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
}

?>