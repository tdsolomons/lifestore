<?php

class Membership_model extends CI_Model {

    function validateLogin() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', $this->input->post('upassword'));
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            //Edited, returns query
            return $query;
        } else {
            return NULL;
        }
    }

    function create_member() {
        //$username = $this->input->post('username');

        $new_member_insert_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'phone' => $this->input->post('phone'),
            'upassword' => $this->input->post('upassword')
        );

        $insert = $this->db->insert('users', $new_member_insert_data);
        return $insert;
    }

    function check_username_exists_db($username) {

        $this->db->where('username', $username);
        $result = $this->db->get('users');

        if ($result->num_rows() > 0) {
            return FALSE; //username already exists
        } else {
            return TRUE; //username can be registered
        }
    }

    function check_email_exists_db($email) {

        $this->db->where('email', $email);
        $result = $this->db->get('users');

        if ($result->num_rows() > 0) {
            return FALSE; //email already exists
        } else {
            return TRUE; //email can be registered
        }
    }

    function getMemberDetails($username) {

        $this->db->where('username', $username);
        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function update_member() {
        $array = $this->session->all_userdata();
        $username = $array['username'];
        echo $username;

        $member_update_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            //'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'phone' => $this->input->post('phone'),
            'upassword' => $this->input->post('upassword')
        );
        return $member_update_data;
    }

    function updateUser($username, $member_update_data) {

        $update = $this->db->update('users', $member_update_data, "username = $username");
        return $update;
    }

}

?>
