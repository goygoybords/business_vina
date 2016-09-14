<?php
	class CalendarEvents
	{
		private $id;
        private $event_name;
        private $lead_id;
        private $start_date;
        private $end_date;
        private $status;


        public function getId()
        {
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getEvent_name()
        {
            return $this->event_name;
        }

        public function setEvent_name($event_name)
        {
            $this->event_name = $event_name;
        }

        public function getLead_id()
        {
            return $this->lead_id;
        }

        public function setLead_id($lead_id)
        {
            $this->lead_id = $lead_id;
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