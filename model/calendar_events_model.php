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
        public function get_all_join()
        {
            $sql = "SELECT c.* , l.companyname 
                    FROM calendar_events c
                    JOIN leads l
                    ON c.leadid = l.id
                    WHERE c.status = ?
                    ";
            $cmd = $this->con->getDb()->prepare($sql);
            $cmd->execute(array(1));
            $result = $cmd->fetchAll();
            return $result;
        }
    }
?>