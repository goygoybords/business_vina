<?php
	class Campaign_Details
	{
		private $id;
		private $leadid;
		private $campaign_id;
		private $datecreated;
		private $status;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getLeadid(){
			return $this->leadid;
		}

		public function setLeadid($leadid){
			$this->leadid = $leadid;
		}

		public function getCampaign_id(){
			return $this->campaign_id;
		}

		public function setCampaign_id($campaign_id){
			$this->campaign_id = $campaign_id;
		}

		public function getDatecreated(){
			return $this->datecreated;
		}

		public function setDatecreated($datecreated){
			$this->datecreated = $datecreated;
		}

		public function getStatus(){
			return $this->status;
		}

		public function setStatus($status){
			$this->status = $status;
		}
	}
?>