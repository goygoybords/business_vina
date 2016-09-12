<?php 
    require '../class/database.php';
    class User_Model 
    {
        
        
        private $connection = "";
        private $db = "";
        
        public function __construct()
        {
            $this->db = new Database();
        }


    
        public function createUser($table , $data)
        {
            return $this->db->dynamicInsert($table , $data);
        }
        public function login($table, $fields, $where , $params)
        {
            return $this->db->select($table, $fields, $where , $params);
            // $sql = "SELECT firstname, lastname, usertypeid 
            //         FROM users 
            //         WHERE email = ? AND password = ?";
            // $cmd = $this->db->prepare($sql);
            // $cmd->execute(array($email , md5($password)));
            // $result = $cmd->fetchAll();
            // return $result;
        }
        public function checkUser($email)
        {
            $sql = "SELECT email FROM users WHERE email = ? ";
            $cmd = $this->db->prepare($sql);
            $cmd->execute(array($email));
            $result = $cmd->fetchAll();
            return count($result);
        }
    }
?>