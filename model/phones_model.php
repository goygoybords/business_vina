<?php
    class Phone_Model
    {
        private $con = "";
        public function __construct($con)
        {
            $this->con = $con;
        }

        public function createPhone($table , $data)
        {
            return $this->con->insert($table , $data);
        }

        public function get_all($table)
        {
            return $this->con->select($table, array("*"), "1",  array());
        }

        public function get_phones_by_leadid($leadid)
        {
            $sql = "SELECT
                        p.*, pt.*
                    FROM
                        phones p inner join phonetypes pt
                            on p.phonetypeid = pt.id
                    WHERE
                        p.leadid = ?
                    ORDER BY
                        pt.id
                    ";

            $cmd = $this->con->getDb()->prepare($sql);
            $cmd->execute(array($leadid));
            $result = $cmd->fetchAll();
            return $result;
        }

        public function get_by_id($table, $fields, $where, $params)
        {
            return $this->con->select($table, $fields, $where, $params);
        }

        public function updatePhone($table, $fields, $where , $params)
        {
            return $this->con->update($table, $fields, $where, $params);
        }
    }
?>