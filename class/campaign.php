<?php
	class Campaign
	{
		private $id;
		private $title;
		private $alternate_tite;
		private $campaign_type;
		private $cost_per_lead;
		private $email;
		private $note;
		private $status;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getTitle(){
			return $this->title;
		}

		public function setTitle($title){
			$this->title = $title;
		}

		public function getAlternate_tite(){
			return $this->alternate_tite;
		}

		public function setAlternate_tite($alternate_tite){
			$this->alternate_tite = $alternate_tite;
		}

		public function getCampaign_type(){
			return $this->campaign_type;
		}

		public function setCampaign_type($campaign_type){
			$this->campaign_type = $campaign_type;
		}

		public function getCost_per_lead(){
			return $this->cost_per_lead;
		}

		public function setCost_per_lead($cost_per_lead){
			$this->cost_per_lead = $cost_per_lead;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function getNote(){
			return $this->note;
		}

		public function setNote($note){
			$this->note = $note;
		}

		public function getStatus(){
			return $this->status;
		}

		public function setStatus($status){
			$this->status = $status;
		}
	}
?>