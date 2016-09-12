<?php 
	class Leads 
	{
		private $id;
		private $firstname;
		private $lastname;
		private $email;
		private $password;
		private $userstatusid;
		private $usertypeid;
		private $datecreated;
		private $datelastlogin;

		public function getId()
		{
			return $this->id;
		}

		public function setId($id)
		{
			$this->id = $id;
		}

		public function getFirstname()
		{
			return $this->firstname;
		}

		public function setFirstname($firstname)
		{
			$this->firstname = $firstname;
		}

		public function getLastname()
		{
			return $this->lastname;
		}

		public function setLastname($lastname)
		{
			$this->lastname = $lastname;
		}

		public function getEmail()
		{
			return $this->email;
		}

		public function setEmail($email)
		{
			$this->email = $email;
		}

		public function getPassword(){
			return $this->password;
		}

		public function setPassword($password)
		{
			$this->password = $password;
		}

		public function getUserstatusid()
		{
			return $this->userstatusid;
		}

		public function setUserstatusid($userstatusid)
		{
			$this->userstatusid = $userstatusid;
		}

		public function getUsertypeid(){
			return $this->usertypeid;
		}

		public function setUsertypeid($usertypeid)
		{
			$this->usertypeid = $usertypeid;
		}

		public function getDatecreated()
		{
			return $this->datecreated;
		}

		public function setDatecreated($datecreated)
		{
			$this->datecreated = $datecreated;
		}

		public function getDatelastlogin()
		{
			return $this->datelastlogin;
		}

		public function setDatelastlogin($datelastlogin)
		{
			$this->datelastlogin = $datelastlogin;
		}
	}

?>