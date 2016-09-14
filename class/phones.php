<?php
	class Phone
	{
		private $id;
		private $number;
		private $phonetypeid;
		private $leadid;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
		}


		public function getNumber()
		{
			return $this->number;
		}

		public function setNumber($number)
		{
			$this->number = $number;
		}

		public function getPhoneTypeId()
		{
			return $this->phonetypeid;
		}

		public function setPhoneTypeId($phonetypeid)
		{
			$this->phonetypeid = $phonetypeid;
		}

		public function getLeadId()
		{
			return $this->leadid;
		}

		public function setLeadId($leadid)
		{
			$this->leadid = $leadid;
		}
	}
?>