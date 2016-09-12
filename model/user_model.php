<?php 
    require '../class/database.php';
    class User_Model 
    {
        
        private $db = "";
        
        public function __construct()
        {
            $this->db = new Database();
        }
        public function createUser($table , $data)
        {
            return $this->db->insert($table , $data);
        }
        public function login($table, $fields, $where , $params)
        {
            return $this->db->select($table, $fields, $where , $params);

        }
        public function checkUser($table, $fields, $where , $params)
        {
            return $this->db->select($table, $fields, $where , $params);
        }
        public function getAllUsers($table, $fields, $where , $params)
        {
            return $this->db->select($table, $fields ,$where , $params );
        }
    }
?>