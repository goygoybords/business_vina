<?php
	class Leads
	{
		private $id;
		private $companyname;
		private $firstname;
		private $middlename;
		private $lastname;
		private $email;
		private $leaddetailsid;
		private $address;
		private $city;
		private $state;
		private $zip;
		private $status;
		private $datecreated;
		private $datelastupdated;


    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    private function _setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of companyname.
     *
     * @return mixed
     */
    public function getCompanyname()
    {
        return $this->companyname;
    }

    /**
     * Sets the value of companyname.
     *
     * @param mixed $companyname the companyname
     *
     * @return self
     */
    private function _setCompanyname($companyname)
    {
        $this->companyname = $companyname;

        return $this;
    }

    /**
     * Gets the value of firstname.
     *
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Sets the value of firstname.
     *
     * @param mixed $firstname the firstname
     *
     * @return self
     */
    private function _setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Gets the value of middlename.
     *
     * @return mixed
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * Sets the value of middlename.
     *
     * @param mixed $middlename the middlename
     *
     * @return self
     */
    private function _setMiddlename($middlename)
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Gets the value of lastname.
     *
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Sets the value of lastname.
     *
     * @param mixed $lastname the lastname
     *
     * @return self
     */
    private function _setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    private function _setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Gets the value of leaddetailsid.
     *
     * @return mixed
     */
    public function getLeaddetailsid()
    {
        return $this->leaddetailsid;
    }

    /**
     * Sets the value of leaddetailsid.
     *
     * @param mixed $leaddetailsid the leaddetailsid
     *
     * @return self
     */
    private function _setLeaddetailsid($leaddetailsid)
    {
        $this->leaddetailsid = $leaddetailsid;

        return $this;
    }

    /**
     * Gets the value of address.
     *
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the value of address.
     *
     * @param mixed $address the address
     *
     * @return self
     */
    private function _setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Gets the value of city.
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the value of city.
     *
     * @param mixed $city the city
     *
     * @return self
     */
    private function _setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Gets the value of state.
     *
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Sets the value of state.
     *
     * @param mixed $state the state
     *
     * @return self
     */
    private function _setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Gets the value of zip.
     *
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the value of zip.
     *
     * @param mixed $zip the zip
     *
     * @return self
     */
    private function _setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Gets the value of status.
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the value of status.
     *
     * @param mixed $status the status
     *
     * @return self
     */
    private function _setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Gets the value of datecreated.
     *
     * @return mixed
     */
    public function getDatecreated()
    {
        return $this->datecreated;
    }

    /**
     * Sets the value of datecreated.
     *
     * @param mixed $datecreated the datecreated
     *
     * @return self
     */
    private function _setDatecreated($datecreated)
    {
        $this->datecreated = $datecreated;

        return $this;
    }

    /**
     * Gets the value of datelastupdated.
     *
     * @return mixed
     */
    public function getDatelastupdated()
    {
        return $this->datelastupdated;
    }

    /**
     * Sets the value of datelastupdated.
     *
     * @param mixed $datelastupdated the datelastupdated
     *
     * @return self
     */
    private function _setDatelastupdated($datelastupdated)
    {
        $this->datelastupdated = $datelastupdated;

        return $this;
    }
}

?>