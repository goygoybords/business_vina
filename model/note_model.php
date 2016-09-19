<?php

    class Note_Model
    {
        private $con = "";

        public function __construct($con)
        {
            $this->con = $con;
        }
        public function createNote($table , $data)
        {
            return $this->con->insert($table , $data);
        }
        public function get_all($table, $fields, $where, $params)
        {
            return $this->con->select($table, $fields, $where, $params);
        }
        public function updateNote($table, $fields, $where , $params)
        {
            return $this->con->update($table, $fields, $where, $params);
        }
    }
?>