<?php
    require '../class/database.php';
    class Lead_Model
    {
        private $connection = "";
        private $db = "";

        public function __construct()
        {
            $this->db = new Database();
        }
        public function createLead($table , $data)
        {
            return $this->db->insert($table , $data);
        }
    }
?>