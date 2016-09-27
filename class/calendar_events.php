<?php
	class CalendarEvents
	{
		private $id;
        private $event_name;
        private $leadid;
        private $start_date;
        private $end_date;
        private $datecreated;
        private $status;


        public function getId()
        {
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getLeadid()
        {
            return $this->leadid;
        }

        public function setLeadid($leadid)
        {
            $this->leadid = $leadid;
        }

        public function getEvent_name()
        {
            return $this->event_name;
        }

        public function setEvent_name($event_name)
        {
            $this->event_name = $event_name;
        }

        public function getStart_date()
        {
            return $this->start_date;
        }

        public function setStart_date($start_date)
        {
            $this->start_date = $start_date;
        }

        public function getEnd_date()
        {
            return $this->end_date;
        }

        public function setEnd_date($end_date)
        {
            $this->end_date = $end_date;
        }

        public function getDatecreated()
        {
            return $this->datecreated;
        }

        public function setDatecreated($datecreated)
        {
            $this->datecreated = $datecreated;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function setStatus($status)
        {
            $this->status = $status;
        }
    }

?>