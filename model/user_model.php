<?php 
 
    class User_Model 
    {
        private $con = "";
        
        public function __construct($con)
        {
            $this->con = $con;
        }
        public function createUser($table , $data)
        {
            return $this->con->insert($table , $data);
        }
        public function login($table, $fields, $where , $params)
        {
            return $this->con->select($table, $fields, $where , $params);
        }
        public function checkUser($table, $fields, $where , $params)
        {
            return $this->con->select($table, $fields, $where , $params);
        }
        public function queryUser($table, $fields, $where , $params)
        {
            return $this->con->select($table, $fields ,$where , $params );
        }
        public function updateUser($table, $fields, $where , $params)
        {
            return $this->con->update($table, $fields, $where, $params);
        }
    }
?>