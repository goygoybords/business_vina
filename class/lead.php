<?php
	class Leads
	{
		private $id;
		private $companyname;
    private $position;
		private $firstname;
		private $middlename;
		private $lastname;
		private $email;
    private $siccode;
		private $leaddetailsid;
		private $address;
		private $city;
		private $state;
		private $zip;
		private $status;
		private $datecreated;
		private $datelastupdated;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCompanyname()
    {
        return $this->companyname;
    }

    public function setCompanyname($companyname)
    {
        $this->companyname = $companyname;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getMiddlename()
    {
        return $this->middlename;
    }

    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;
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

    public function getSiccode()
    {
        return $this->siccode;
    }

    public function setSiccode($siccode)
    {
        $this->siccode = $siccode;
    }

    public function getLeaddetailsid()
    {
        return $this->leaddetailsid;
    }

    public function setLeaddetailsid($leaddetailsid)
    {
        $this->leaddetailsid = $leaddetailsid;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getDatecreated()
    {
        return $this->datecreated;
    }

    public function setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;
    }

    public function getDatelastupdated()
    {
        return $this->datelastupdated;
    }

    public function setDatelastupdated($datelastupdated)
    {
        $this->datelastupdated = $datelastupdated;
    }

}

?>