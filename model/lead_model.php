<?php
    require '../class/parent.php'
    class Lead_Model extends Parent
    {
        private $connection = "";
        private $db = "";

        public function __construct($db)
        {
            $this->db = new Database();
        }
        public function createLead($table , $data)
        {
            return $this->db->insert($table , $data);
        }
    }
?>