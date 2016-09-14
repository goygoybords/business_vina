<?php
    class PhoneTypes_Model
    {
        private $con = "";
        public function __construct($con)
        {
            $this->con = $con;
        }

        public function get_all($table)
        {
            return $this->con->select($table, array("id , type"), "1",  array());
        }
    }
?>