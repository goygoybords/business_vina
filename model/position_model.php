<?php
    class Position_Model extends Database
    {
        private $connection = "";
        private $db = "";

        public function __construct()
        {
            require '../class/database.php';
            $this->db = new Database();
        }

        public function get_all($table)
        {
            return $this->db->select($table, array("*"), "1",  array());
        }
    }
?>