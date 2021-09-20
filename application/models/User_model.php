<?php

$tableName = "users";

class user_model extends CI_Model {
    

    function create($formArray){
       
        $this->db->insert("users", $formArray);
    }

    function all(){
       return  $this->db->get('users')->result_array();
    }

    function delete($userId){
        $this->db->where('user_id', $userId)->delete('users');
    }

    function getUser($userId){
       return  $this->db->where('user_id',$userId)->get("users")->row_array();
    }

    function updateUser($userId, $formArray){
        $this->db->where('user_id', $userId)->update('users',$formArray);
    }

} 


?>