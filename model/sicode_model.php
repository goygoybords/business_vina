<?php
    class SICode_Model
    {
        private $con = "";
        public function __construct($con)
        {
      
            $this->con = $con;
        }

        public function createCode($table , $data)
        {
            return $this->con->insert($table , $data);
        }
        public function get_all($table)
        {
            return $this->con->select($table, array("*"), "1 ORDER BY 2 ",  array());
        }
    }
?>