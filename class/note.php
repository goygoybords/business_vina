<?php
	class Note
	{
		private $id;
		private $leadid;
		private $details;
		private $userid;
		private $datecreated;
		private $status;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
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

		public function getDetails()
		{
			return $this->details;
		}

		public function setDetails($details)
		{
			$this->details = $details;
		}

		public function getUserid()
		{
			return $this->userid;
		}

		public function setUserid($userid)
		{
			$this->userid = $userid;
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