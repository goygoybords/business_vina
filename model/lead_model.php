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
    }
?>