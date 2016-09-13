<?php
    class Lead_Model 
    {
        private $con = "";

        public function __construct($con)
        {
            $this->con = $con;
        }
        public function createLead($table , $data)
        {
            return $this->con->insert($table , $data);
        }
        public function get_all($table, $fields, $where, $params)
        {
            return $this->con->select($table, $fields, $where, $params );
        }
       
    }
?>