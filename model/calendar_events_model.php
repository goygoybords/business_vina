<?php

    class Calendar_Events_Model
    {
        private $con = "";

        public function __construct($con)
        {
            $this->con = $con;
        }
        public function createEvent($table , $data)
        {
            return $this->con->insert($table , $data);
        }
        public function get_all($table, $fields, $where, $params)
        {
            return $this->con->select($table, $fields, $where, $params);
        }

        public function updateEvent($table, $fields, $where , $params)
        {
            return $this->con->update($table, $fields, $where, $params);
        }
    }
?>