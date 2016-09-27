<?php
    class Position_Model 
    {
        private $con = "";
        public function __construct($con)
        {
            $this->con = $con;
        }

        public function createPosition($table , $data)
        {
            return $this->con->insert($table , $data);
        }

        public function get_all($table)
        {
            return $this->con->select($table, array("id , position"), "1",  array());
        }
    }
?>