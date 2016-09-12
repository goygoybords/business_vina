<?php
    require '../class/database.php';
    class Position_Model 
    {
        private $connection = "";
        private $db = "";

        public function __construct()
        {
            
            $this->db = new Database();
        }

        public function get_all($table)
        {
            return $this->db->select($table, array("*"), "1",  array());
        }
    }
?>